<?php

namespace App\Http\Controllers\supply;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthContoller extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'phone' => 'required',
                    'email' => 'required|email|unique:suppliers,email',
                    'password' => 'required',
                    'description' => 'string',
                    'commercial_register_number' => 'nullable', // Add validation rules as needed
                    'commercial_register_image' => 'image|required', // Add validation rules as needed
                    'company_image' => 'image', // Add validation rules as needed
                    'category' => 'required' // Add validation rules as needed
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            $requestData = $request->all();
            if ($request->has('company_image')) {
                $fileName = time() . $request->file('company_image')->getClientOriginalName();
                $path = $request->file('company_image')->storeAs('companiesImages', $fileName, 'public');
                $requestData["company_image"] = '/storage/' . $path;
            }
    
            $fileName = time() . $request->file('commercial_register_image')->getClientOriginalName();
            $path = $request->file('commercial_register_image')->storeAs('commercialRegister', $fileName, 'public');
            $requestData["commercial_register_image"] = '/storage/' . $path;
            $requestData["password"] = Hash::make($requestData["password"]);
            $user = Supplier::create($requestData);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("Supply TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!$this->checkData($request->email, $request->password, 'suppliers')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = Supplier::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("Supply TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
    public function checkData($email, $password, $table)
    {
        $user = DB::table($table)
            ->where('email', $email)
            ->first();
        if (!$user) {
            return false; // User not found
        }

        return Hash::check($password, $user->password);
    }
}

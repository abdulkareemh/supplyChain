<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterClientApiRequest;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthContoller extends Controller
{



    public function register(RegisterClientApiRequest $request)
    {
        try {
            $user = Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'city' => $request->city,
                'region' => $request->region,
                'street' => $request->street,
                'description' => $request->description
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("Client TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            Log::error('User Registration Failed: ' . $th->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Internal Server Error'
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

            if (!$this->checkData($request->email, $request->password, 'clients')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = Client::where('email', $request->email)->first();

            if($user->status =='pending' ||$user->status =='ban'){
                return response()->json([
                    'status' => false,
                    'message' => 'User status is not active',
                    'status' => $user->status,
                ], 200);
            } 
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("Client TOKEN")->plainTextToken
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

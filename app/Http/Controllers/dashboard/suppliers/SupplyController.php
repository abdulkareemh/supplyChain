<?php

namespace App\Http\Controllers\dashboard\suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplyRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Suppliers = Supplier::simplepaginate(2);

        return view('content.dashboard.supply.index', ['Suppliers' => $Suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('content.dashboard.supply.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplyRequest $request)
    {
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
        Supplier::create($requestData);
        return redirect('suppliers')->with('success', 'supplier Addedd!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('content.dashboard.supply.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('content.dashboard.supply.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email|unique:suppliers,email,' . $id . '|max:55',
            'phone' => 'required|numeric',
            'category' => 'required',
            'commercial_register_number' => 'required',
            'password' => 'required|min:8',
            
        ]);

        $supplier = Supplier::findOrFail($id);
        // Update the supplier's data with $validatedData

        return redirect()->route('suppliers.show', $supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

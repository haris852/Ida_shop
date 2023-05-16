<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfigurationStore;
use Illuminate\Http\Request;

class StoreConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.configuration.store.index', [
            'data' => ConfigurationStore::first(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'unique:configuration_store,name,' . $id],
            'address' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'open_at' => ['required'],
            'close_at' => ['required'],
            'shipping_cost' => ['required']
        ]);

        ConfigurationStore::find($id)->update($request->all());
        return redirect()->route('admin.store-configuration.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

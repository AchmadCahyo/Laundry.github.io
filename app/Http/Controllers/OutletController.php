<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outlet = Outlet::paginate(5);
        return view('admin.outlet.index', compact('outlet'));
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
        $this->validate($request, [
            'name' => 'required',
            'alamat' => 'required',
            'telpon' => 'required'
        ]);

        $outlet = Outlet::create([
            'name' => $request->input('name'),
            'alamat' => $request->input('alamat'),
            'telpon' => $request->input('telpon'),
        ]);

        if($outlet) {
            return redirect()->route('outlet.index')->with('sukses', 'Data Berhasil Ditambahkan!');

        }else {
            return redirect()->route('outlet.index')->with('error', 'Gagal Menambahkan Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Outlet $outlet)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $outlet = Outlet::find($id);
        $this->validate($request, [
            'name' => 'required',
            'alamat' => 'required',
            'telpon' => 'required'
        ]);
        
        $outlet = Outlet::findOrFail($id);
        $outlet->update([
            'name' => $request->input('name'),
            'alamat' => $request->input('alamat'),
            'telpon' => $request->input('telpon'),
        ]);

        if($outlet) {
            return redirect()->route('outlet.index')->with('sukses', 'Data Berhasil Diperbaharui!');

        }else {
            return redirect()->route('outlet.index')->with('error', 'Gagal Memperbaharui Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();

        if($outlet) {
            return redirect()->route('outlet.index')->with('sukses', 'Data Berhasil Dihapus!');

        }else {
            return redirect()->route('outlet.index')->with('error', 'Gagal Menghapus Data!');
        }
    }
}

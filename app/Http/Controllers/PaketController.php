<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = Paket::paginate(5);
        $outlet = Outlet::all();
        return view('admin.paket.index', compact('paket', 'outlet'));
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
            'outlet_id' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required'
        ]);

        $paket = Paket::create([
            'outlet_id' => $request->input('outlet_id'),
            'jenis' => $request->input('jenis'),
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
        ]);

        if($paket) {
            return redirect()->route('paket.index')->with('sukses', 'Data Berhasil Ditambahkan!');

        }else {
            return redirect()->route('paket.index')->with('error', 'Gagal Menambahkan Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::find($id);
        $this->validate($request, [
            'outlet_id' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required'
        ]);

        $paket = Paket::findOrFail($id);
        $paket->update([
            'outlet_id' => $request->input('outlet_id'),
            'jenis' => $request->input('jenis'),
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
        ]);

        if($paket) {
            return redirect()->route('paket.index')->with('sukses', 'Data Berhasil Diperbaharui!');

        }else {
            return redirect()->route('paket.index')->with('error', 'Gagal Memperbaharui Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();

        if($paket) {
            return redirect()->route('paket.index')->with('sukses', 'Data Berhasil Dihapus!');

        }else {
            return redirect()->route('paket.index')->with('error', 'Gagal Menghapus Data!');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::paginate(5);
        $user = User::all();
        $outlet = Outlet::all();
        $member = Member::all();
        return view('admin.transaksi.index', compact('transaksi', 'user', 'outlet', 'member'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $outlet = Outlet::all();
        $member = Member::all();
        $user = User::all();
        $paket = Paket::all();
        $data = Transaksi::all();

        // $harga = $request->input('harga');
        // $pajak = $request->input('pajak');
        // $diskon = $request->input('diskon');

        // $totalHarga = $harga + $pajak - $diskon;

        $pdf = Pdf::loadView('admin.transaksi.print', compact('data', 'outlet', 'member', 'user', 'paket'));
        return $pdf->stream();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'outlet_id' => 'required',
            'member_id' => 'required',
            'tanggal' => 'required',
            'batas_waktu' => 'required',
            'tanggal_bayar' => 'required',
            'biaya_tambahan' => 'nullable',
            'diskon' => 'nullable',
            'pajak' => 'nullable',
            'status' => 'required',
            'dibayar' => 'required',
            'user_id' => 'required'
        ]);

        $transaksi = Transaksi::create([
            'outlet_id' => $request->input('outlet_id'),
            'member_id' => $request->input('member_id'),
            'tanggal' => $request->input('tanggal'),
            'batas_waktu' => $request->input('batas_waktu'),
            'tanggal_bayar' => $request->input('tanggal_bayar'),
            'biaya_tambahan' => $request->input('biaya_tambahan'),
            'diskon' => $request->input('diskon'),
            'pajak' => $request->input('pajak'),
            'status' => $request->input('status'),
            'dibayar' => $request->input('dibayar'),
            'user_id' => $request->input('user_id'),
        ]);

        if($transaksi) {
            return redirect()->route('transaksi.index')->with('sukses', 'Data Berhasil Ditambahkan!');

        }else {
            return redirect()->route('transaksi.index')->with('error', 'Gagal Menambahkan Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
        $this->validate($request, [
            'outlet_id' => 'required',
            'member_id' => 'required',
            'tanggal' => 'required',
            'batas_waktu' => 'required',
            'tanggal_bayar' => 'required',
            'biaya_tambahan' => 'nullable',
            'diskon' => 'nullable',
            'pajak' => 'nullable',
            'status' => 'required',
            'dibayar' => 'required',
            'user_id' => 'required'
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'outlet_id' => $request->input('outlet_id'),
            'member_id' => $request->input('member_id'),
            'tanggal' => $request->input('tanggal'),
            'batas_waktu' => $request->input('batas_waktu'),
            'tanggal_bayar' => $request->input('tanggal_bayar'),
            'biaya_tambahan' => $request->input('biaya_tambahan'),
            'diskon' => $request->input('diskon'),
            'pajak' => $request->input('pajak'),
            'status' => $request->input('status'),
            'dibayar' => $request->input('dibayar'),
            'user_id' => $request->input('user_id'),
        ]);


        if($transaksi) {
            return redirect()->route('transaksi.index')->with('sukses', 'Data Berhasil Diperbaharui!');

        }else {
            return redirect()->route('transaksi.index')->with('error', 'Gagal Memperbaharui Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        if($transaksi) {
            return redirect()->route('transaksi.index')->with('sukses', 'Data Berhasil Dihapus!');

        }else {
            return redirect()->route('transaksi.index')->with('error', 'Gagal Menghapus Data!');
        }
    }
}

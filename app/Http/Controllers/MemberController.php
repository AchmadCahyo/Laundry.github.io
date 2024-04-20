<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::paginate(5);
        $paket = Paket::all();
        return view('admin.member.index', compact('member', 'paket'));
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
            'jenis_kelamin' => 'required',
            'telpon' => 'required',
            'paket_id' => 'required',
            'jumlah_berat' => 'required',
        ]);

        $member = Member::create([
            'name' => $request->input('name'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'telpon' => $request->input('telpon'),
            'paket_id' => $request->input('paket_id'),
            'jumlah_berat' => $request->input('jumlah_berat'),
        ]);

        if($member) {
            return redirect()->route('member.index')->with('sukses', 'Data Berhasil Ditambahkan!');

        }else {
            return redirect()->route('member.index')->with('error', 'Gagal Menambahkan Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member, $id)
    {
        $member = Member::find($id);
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        $this->validate($request, [
            'name' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'telpon' => 'required',
            'paket_id' => 'required',
            'jumlah_berat' => 'required',
        ]);

        $member = Member::findOrFail($id);
        $member->update([
            'name' => $request->input('name'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'telpon' => $request->input('telpon'),
            'paket_id' => $request->input('paket_id'),
            'jumlah_berat' => $request->input('jumlah_berat'),
        ]);

        if($member) {
            return redirect()->route('member.index')->with('sukses', 'Data Berhasil Diperbaharui!');

        }else {
            return redirect()->route('member.index')->with('error', 'Gagal Memperbaharui Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        if($member) {
            return redirect()->route('member.index')->with('sukses', 'Data Berhasil Dihapus!');

        }else {
            return redirect()->route('member.index')->with('error', 'Gagal Menghapus Data!');
        }
    }
}

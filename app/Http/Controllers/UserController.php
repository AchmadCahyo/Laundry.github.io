<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', '!=', '1')->paginate(5);
        $outlet = Outlet::all();
        return view('admin.pengguna.index', compact('user', 'outlet'));
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
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'outlet_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'outlet_id' => $request->input('outlet_id')
        ]);

        if($user) {
            return redirect()->route('pengguna.index')->with('sukses', 'Data Berhasil Ditambahkan!');

        }else {
            return redirect()->route('pengguna.index')->with('error', 'Gagal Menambahkan Data!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, $id)
    {
        $user = User::find($id);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'outlet_id' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'outlet_id' => $request->input('outlet_id')
        ]);

        if($user) {
            return redirect()->route('pengguna.index')->with('sukses', 'Data Berhasil Diperbaharui!');

        }else {
            return redirect()->route('pengguna.index')->with('error', 'Gagal Memperbaharui Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if($user) {
            return redirect()->route('pengguna.index')->with('sukses', 'Data Berhasil Dihapus!');

        }else {
            return redirect()->route('pengguna.index')->with('error', 'Gagal Menghapus Data!');
        }
    }
}

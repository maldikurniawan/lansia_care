<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ar_user = User::all();
        return view('user.index', compact('ar_user'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::find($id);
        return view('user.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('user.form_edit', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //proses input produk dari form
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'role' => 'required',
                'isactive' => 'required',
            ],
            //custom pesan errornya
            [
                'name.required' => 'Nama Wajib Diisi',
                'email.required' => 'Email Wajib Diisi',
                'role.required' => 'Role Wajib Diisi',
                'isactive.required' => 'IsActive Wajib Diisi',
            ]
        );

        //lakukan update data dari request form edit
        DB::table('users')->where('id', $id)->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'isactive' => $request->isactive,
            ]
        );

        return redirect('/user')
            ->with('success', 'Data User Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data di database
        User::where('id', $id)->delete();
        return redirect()->route('user.index')
            ->with('success', 'Data User Berhasil Dihapus');
    }
}

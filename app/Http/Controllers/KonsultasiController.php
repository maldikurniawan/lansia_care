<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Controllers\Controller;
use App\Models\subjek;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    /**App\Http\Controllers\
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $datas = DB::table('konsultasi')
                ->join('users', 'users.id', '=', 'konsultasi.users_id')
                ->select('konsultasi.*', 'users.name as pengguna')
                ->orderBy('konsultasi.id', 'desc')
                ->get();
        } else {
            $id = Auth::user()->id;
            $datas = Konsultasi::where('users_id', $id)->get();
        }
        $users = Auth::user();

        return view('konsultasi.index', compact('datas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('konsultasi.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //proses input produk dari form
        $request->validate(
            [
                'subjek' => 'required',
                'isi_pesan' => 'required',
                'tanggal_konsultasi' => 'required',
            ],
            //custom pesan errornya
            [
                'subjek.required' => 'subjek Wajib Diisi',
                'isi_pesan.required' => 'Isi Pesan Wajib Diisi',
                'tanggal_konsultasi.required' => 'Tanggal Konsultasi Wajib Diisi',
            ]
        );

        DB::table('Konsultasi')->insert(
            [
                'subjek' => $request->subjek,
                'isi_pesan' => $request->isi_pesan,
                'tanggal_konsultasi' => $request->tanggal_konsultasi,
                'users_id' => Auth::user()->id,
            ]
        );

        return redirect()->route('konsultasi.index')
            ->with('success', 'Data Konsultasi Baru Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Konsultasi::find($id);
        return view('konsultasi.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Konsultasi::find($id);
        return view('konsultasi.form_edit', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //proses input produk dari form
        $request->validate(
            [
                'subjek' => 'required',
                'isi_pesan' => 'required',
                'balasan' => 'required',
                'tanggal_konsultasi' => 'required',
            ],
            //custom pesan errornya
            [
                'subjek.required' => 'subjek Wajib Diisi',
                'isi_pesan.required' => 'Isi Pesan Wajib Diisi',
                'balasan.required' => 'Balasan Wajib Diisi',
                'tanggal_konsultasi.required' => 'Tanggal Konsultasi Wajib Diisi',
            ]
        );

        //lakukan update data dari request form edit
        DB::table('konsultasi')->where('id', $id)->update(
            [
                'subjek' => $request->subjek,
                'isi_pesan' => $request->isi_pesan,
                'balasan' => $request->balasan,
                'tanggal_konsultasi' => $request->tanggal_konsultasi,
                // 'users_id' => Auth::user()->id,
            ]
        );

        return redirect('/konsultasi')
            ->with('success', 'Data Konsultasi Berhasil Dibalas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data di database
        Konsultasi::where('id', $id)->delete();
        return redirect()->route('konsultasi.index')
            ->with('success', 'Data Konsultasi Berhasil Dihapus');
    }
}

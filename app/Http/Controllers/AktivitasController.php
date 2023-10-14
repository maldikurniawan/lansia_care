<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class AktivitasController extends Controller
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
            $datas = DB::table('aktivitas')
                ->join('users', 'users.id', '=', 'aktivitas.users_id')
                ->select('aktivitas.*', 'users.name as pengguna')
                ->orderBy('aktivitas.id', 'desc')
                ->get();
        } else {
            $id = Auth::user()->id;
            $datas = Aktivitas::where('users_id', $id)->get();
        }
        $users = Auth::user();

        return view('aktivitas.index', compact('datas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Auth::user();
        return view('aktivitas.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //proses input aktivitas dari form
        $request->validate(
            [
                // 'tanggal' => 'required',
                'nama_aktivitas' => 'required',
                'keterangan' => 'required',
            ],
            //custom pesan errornya
            [
                // 'tanggal.required' => 'Tanggal Wajib Diisi',
                'nama_aktivitas.required' => 'Nama Aktifitas Wajib Diisi',
                'keterangan.required' => 'Care Note Wajib Diisi',
            ]
        );

        DB::table('aktivitas')->insert(
            [
                'tanggal' => now(),
                'nama_aktivitas' => $request->nama_aktivitas,
                'keterangan' => $request->keterangan,
                'users_id' => Auth::user()->id,
            ]
        );

        return redirect()->route('aktivitas.index')
            ->with('success', 'Data Aktivitas Baru Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Aktivitas::find($id);
        return view('aktivitas.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Aktivitas::find($id);
        return view('aktivitas.form_edit', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //proses input aktivitas dari form
        $request->validate(
            [
                'nama_aktivitas' => 'required',
                'keterangan' => 'required',
            ],
            //custom pesan errornya
            [
                'nama_aktivitas.required' => 'Nama Aktifitas Wajib Diisi',
                'keterangan.required' => 'Care Note Wajib Diisi',
            ]
        );

        //lakukan update data dari request form edit
        DB::table('Aktivitas')->where('id', $id)->update(
            [
                'tanggal' => now(),
                'nama_aktivitas' => $request->nama_aktivitas,
                'keterangan' => $request->keterangan,
                'users_id' => Auth::user()->id,
            ]
        );

        return redirect('/aktivitas')
            ->with('success', 'Data Aktivitas Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data di database
        Aktivitas::where('id', $id)->delete();
        return redirect()->route('aktivitas.index')
            ->with('success', 'Data Aktivitas Berhasil Dihapus');
    }

    public function aktivitasPDF()
    {
        $ar_aktivitas = DB::table('aktivitas')
                ->join('users', 'users.id', '=', 'aktivitas.users_id')
                ->select('aktivitas.*', 'users.name as pengguna')
                ->orderBy('aktivitas.id', 'desc')
                ->get();
        $pdf = PDF::loadView(
            'aktivitas.aktivitas_pdf',
            ['ar_aktivitas' => $ar_aktivitas]
        );
        return $pdf->download('data_aktivitas_' . date('d-m-Y') . '.pdf');
    }
}

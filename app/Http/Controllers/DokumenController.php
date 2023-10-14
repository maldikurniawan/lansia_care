<?php

namespace App\Http\Controllers;

use App\Models\Dokumen_Medis;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
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
        // $data = Dokumen_Medis::all();
        // dd($data);
        if (Auth::user()->role == 'admin') {
            $datas = DB::table('dokumen_medis')
                ->join('users', 'users.id', '=', 'dokumen_medis.users_id')
                ->select('dokumen_medis.*', 'users.name as pengguna')
                ->orderBy('dokumen_medis.id', 'desc')
                ->get();
        } else {
            $id = Auth::user()->id;
            $datas = Dokumen_Medis::where('users_id', $id)->get();
            // dd($datas);
        }
        $users = Auth::user();

        return view('dokumen.index', compact('datas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = Auth::user();
        return view('dokumen.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //proses input produk dari form
        $request->validate(
            [
                'tipe_dokumen' => 'required',
                'file_upload' => 'required|min:2|max:1000',
            ],
            //custom pesan errornya
            [
                'tipe_dokumen.required' => 'Data Tipe Dokumen Wajib Diisi',
                'file_upload.required' => 'File Wajib Diupload',
                'file_upload.min' => 'Ukuran file kurang 2 KB',
                'file_upload.max' => 'Ukuran file melebihi 1000 KB',
            ]
        );
        $user = Auth::user();
        if (isset($request->file_upload)) {
            $filename = 'dokumen' . $user->user . "_" . $request->tipe_dokumen . '.' . $request->file_upload->extension();
            $request->file_upload->move(public_path('/assets/dokumen/' . $user->user), $filename);
        } else {
            $filename = null;
        }

        DB::table('dokumen_medis')->insert(
            [
                'tipe_dokumen' => $request->tipe_dokumen,
                'file_upload' => $filename,
                'users_id' => Auth::user()->id
            ]
        );

        return redirect()->route('dokumen.index')
            ->with('success', 'Data Kesehatan Baru Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Dokumen_Medis::find($id);
        return view('dokumen.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $data = Dokumen_Medis::find($id);
        return view('dokumen.form_edit', compact('data', 'user'));
    }

    public function update(Request $request, string $id)
    {
        //proses input produk dari form
        $request->validate(
            [
                'tipe_dokumen' => 'required',
                'file_upload' => 'required|min:2|max:1000',
            ],
            //custom pesan errornya
            [
                'tipe_dokumen.required' => 'Data Tipe Dokumen Wajib Diisi',
                'file_upload.required' => 'File Wajib Diupload',
                'file_upload.min' => 'Ukuran file kurang 2 KB',
                'file_upload.max' => 'Ukuran file melebihi 1000 KB',
                'file_upload.pdf' => 'File bukan format pdf',
                'file_upload.mimes' => 'Extension file harus pdf',
            ]
        );
        $user = Auth::user();
        $file = DB::table('dokumen_medis')->select('file_upload')->where('id', $id)->get();
        foreach ($file as $f) {
            $namaFileLama = $f->file_upload;
        }
        //------------apakah user  ingin ubah upload file baru--------- --
        if (isset($request->file_upload)) {
            //jika ada file lama, hapus file lamanya terlebih dahulu
            if (isset($namaFileLama)) {
                unlink('assets/dokumen' . $user->user . "/" . $namaFileLama);
                //lalukan proses ubah file lama menjadi file baru
                $filename = 'dokumen' . $user->user . "_" . $request->tipe_dokumen . '.' . $request->file_upload->extension();
                //$filename = $request->file->getClientOriginalName();
                $request->file_upload->move(public_path('/assets/dokumen/' . $user->user), $filename);
            }
        } else {
            $filename = $namaFileLama;
        }
        //lakukan update data dari request form edit
        DB::table('dokumen_medis')->where('id', $id)->update(
            [
                'tipe_dokumen' => $request->tipe_dokumen,
                'file_upload' => $filename,
            ]
        );

        return redirect('/dokumen')
            ->with('success', 'Data Kesehatan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data di database
        Dokumen_Medis::where('id', $id)->delete();
        return redirect()->route('dokumen.index')
            ->with('success', 'Data Kesehatan Berhasil Dihapus');
    }

    public function download(string $filename)
    {
        return response()->download(public_path('/assets/dokumen/' . $filename));
    }

    // public function download($filename)
    // {
    //     // Build the file path based on the filename or your logic
    //     $filePath = '/assets/dokumen/' . $filename;

    //     // Check if the file exists
    //     if (Storage::exists($filePath)) {
    //         return response()->download(storage_path($filePath));
    //     } else {
    //         // Handle the case when the file doesn't exist
    //         return abort(404, 'File not found');
    //     }
    // }
}

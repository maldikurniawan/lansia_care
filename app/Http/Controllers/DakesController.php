<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Data_Kesehatan;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\artikeljuduljuduldeskripseideskripsiudserse\Eloquent\Model;

class DakesController extends Controller
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
        // dd(Auth::user()->role);
        if (Auth::user()->role == 'admin') {
            $datas = DB::table('data_kesehatan')
                ->join('users', 'users.id', '=', 'data_kesehatan.users_id')
                ->select('data_kesehatan.*', 'users.name as pengguna')
                ->orderBy('data_kesehatan.id', 'desc')
                ->get();
            // $datas = User::with('dakeses')
            //     ->where('role', '!=', 'admin')
            //     ->orderBy('id', 'desc')
            //     ->get();
                // dd($datas);
        } else {
            $id = Auth::user()->id;
            $datas = Data_Kesehatan::where('users_id', $id)->get();
            // $datas = User::with('dakeses')
            //     ->where('id', $id)
            //     ->get();
            //     dd($datas);
        }
        $users = Auth::user();

        $data = $users->tgl_lahir;
        $start = Carbon::parse($data);
        $end = Carbon::now();
        $umur = $end->diffInDays($start);
        foreach ($datas as $item) {
            $detak = $item->detak_jantung;
            // if ($umur >= 20 && $umur <= 34) {
            if ($detak >= 50 && $detak >= 100) {
                $statusDetak = '(Baik)';
            } else {
                $statusDetak = '(Buruk)';
            }
            // } else if ($umur >= 35 && $umur <= 50) {
            //     if ($detak >= 85 && $detak >= 155) {
            //         $statusDetak = '(Baik)';
            //     } else {
            //         $statusDetak = '(Buruk)';
            //     }
            // } else if ($umur > 50) {
            //     if ($detak >= 80 && $detak >= 130) {
            //         $statusDetak = '(Baik)';
            //     } else {
            //         $statusDetak = '(Buruk)';
            //     }
            // }

            $durasi = $item->durasi_tidur;
            if ($durasi >= 7 && $durasi <= 9) {
                $statusDurasi = '(Baik)';
            } else {
                $statusDurasi = '(Buruk)';
            }
        }
        if (isset($statusDetak) || isset($statusDurasi)) {
            return view('dakes.index', compact('datas', 'users', 'statusDetak', 'statusDurasi'));
        }
        return view('dakes.index', compact('datas', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        return view('dakes.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //proses input produk dari form
        $request->validate(
            [
                'detak_jantung' => 'required',
                'tekanan_darah' => 'required',
                'durasi_tidur' => 'required',
            ],
            //custom pesan errornya
            [
                'durasi_tidur.required' => 'Durasi Tidur Wajib Diisi',
                'tekanan_darah.required' => 'Tekanan Darah Wajib Diisi',
                'detak_jantung.required' => 'Detak Jantung Wajib Diisi',
            ]
        );

        DB::table('data_kesehatan')->insert(
            [
                'durasi_tidur' => $request->durasi_tidur,
                'tekanan_darah' => $request->tekanan_darah,
                'detak_jantung' => $request->detak_jantung,
                'users_id' => Auth::user()->id,
            ]
        );

        return redirect()->route('dakes.index')
            ->with('success', 'Data Kesehatan Baru Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        $data = Data_Kesehatan::find($id);
        return view('dakes.detail', compact('data', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $data = Data_Kesehatan::find($id);
        return view('dakes.form_edit', compact('data', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //proses input produk dari form
        $request->validate(
            [
                'detak_jantung' => 'required',
                'tekanan_darah' => 'required',
                'durasi_tidur' => 'required',
            ],
            //custom pesan errornya
            [
                'durasi_tidur.required' => 'Durasi Tidur Wajib Diisi',
                'tekanan_darah.required' => 'Tekanan Darah Wajib Diisi',
                'detak_jantung.required' => 'Detak Jantung Wajib Diisi',
            ]
        );

        //lakukan update data dari request form edit
        DB::table('data_kesehatan')->where('id', $id)->update(
            [
                'durasi_tidur' => $request->durasi_tidur,
                'tekanan_darah' => $request->tekanan_darah,
                'detak_jantung' => $request->detak_jantung,
                'users_id' => Auth::user()->id,
            ]
        );

        return redirect('/dakes')
            ->with('success', 'Data Kesehatan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //hapus data di database
        Data_Kesehatan::where('id', $id)->delete();
        return redirect()->route('dakes.index')
            ->with('success', 'Data Kesehatan Berhasil Dihapus');
    }

    //-- rest api --
    public function apiDakes()
    {
        $datas = DB::table('data_kesehatan')
            ->join('user', 'user.id', '=', 'data_kesehatan.user_id')
            ->select('data_kesehatan.*', 'user.user as pengguna')
            ->orderBy('data_kesehatan.id', 'desc')
            ->get();

        return response()->json(
            [
                'success' => true,
                'message' => 'Data Kesehatan',
                'data' => $datas,
            ]
        );
    }

    public function apiDakesDetail($id)
    {
        $data = DB::table('data_kesehatan')
            ->join('user', 'user.id', '=', 'data_kesehatan.user_id')
            ->select('data_kesehatan.*', 'user.user as pengguna')
            ->orderBy('data_kesehatan.id', '=', $id)
            ->get();

        return response()->json(
            [
                'success' => true,
                'message' => 'Detail Dakes',
                'data' => $data,
            ]
        );
    }
}

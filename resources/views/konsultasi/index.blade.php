@extends('admin.index')
@section('content')
    {{-- <div class="col-9" style="background-color:#867878; border-style: solid; border-color: #A7D7C5;"> --}}
    <h3 align="center">Konsultasi</h3>
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    <div class="col-lg-12">
        <a href="{{ route('konsultasi.create') }}" class="btn btn-primary" title="Tambah jadwal">
            <i class="bi bi-plus"></i>
        </a>
    </div>
    <div class="container mt-3">
        <table class="table table-hover datatable">
            <thead>
                <tr>
                    <th>No</th>
                    @if (Auth::user()->role == 'admin')
                        <th>User</th>
                    @endif
                    <th>Subjek</th>
                    <th>Isi Pesan</th>
                    <th>Balasan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            @foreach ($datas as $data)
                <tbody>
                    <th>{{ $no }}</th>
                    @if (Auth::user()->role == 'admin')
                        <td>{{ $data->pengguna }}</td>
                    @endif
                    <td>{{ $data->subjek }}</td>
                    <td>{{ $data->isi_pesan }}</td>
                    @if ($data->balasan != null)
                        <td>{{ $data->balasan }}</td>
                        <td>Dibalas</td>
                    @else
                        <td>-</td>
                        <td>Belum Dibalas</td>
                    @endif
                    {{-- {{dd($data->status)}} --}}
                    <td>{{ $data->tanggal_konsultasi }}</td>
                    <td>
                        <form method="POST" action="{{ route('konsultasi.destroy', $data->id) }}">
                            @csrf
                            @method('DELETE')
                            @if (Auth::user()->role != 'user')
                                <a class="btn btn-warning" href="{{ route('konsultasi.edit', $data->id) }}" title="ubah">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            @endif
                            @if (Auth::user()->role == 'user')
                                <a class="btn btn-info" href="{{ route('konsultasi.show', $data->id) }}" title="detail">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                            @endif
                            <!-- hapus data -->
                            <button class="btn btn-danger delete-confirm" type="submit" title="Hapus" name="proses"
                                value="hapus">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tbody>
                @php    $no++    @endphp
            @endforeach
        </table>
    </div>
    {{-- </div> --}}
@endsection

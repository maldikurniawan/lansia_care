@extends('admin.index')
@section('content')
    {{-- <div class="col-9" style="background-color:#867878; border-style: solid; border-color: #A7D7C5;"> --}}
    <h3 align="center">Jurnal Kesehatan</h3>
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    <div class="col-lg-12">
        <a href="{{ route('aktivitas.create') }}" class="btn btn-primary" title="Tambah jadwal">
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
                    <th>Nama Aktivitas</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
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
                    <td>{{ $data->nama_aktivitas }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->keterangan }}</td>
                    <td>
                        <form method="POST" action="{{ route('aktivitas.destroy', $data->id) }}">
                            @csrf
                            @method('DELETE')
                            <a href="{{ url('/aktivitas-pdf') }}" class="btn btn-danger" title="Export to PDF">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </a>
                            <a class="btn btn-warning" href="{{ route('aktivitas.edit', $data->id) }}" title="ubah">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
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

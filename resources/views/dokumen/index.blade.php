@extends('admin.index')
@section('content')
    {{-- <div class="col-9" style="background-color:#fffafa; border-style: solid; border-color: #A7D7C5;">
        <div class="container mt-3"> --}}
    <h3 align="center">Dokumen Medis</h3>
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    <div class="col-lg-12">
        <a href="{{ route('dokumen.create') }}" class="btn btn-primary btn-rounded btn-fw">
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
                    <th>Nama Dokumen</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            @foreach ($datas as $item)
                <tbody>
                    <th>{{ $no }}</th>
                    @if (Auth::user()->role == 'admin')
                        <td>{{ $item->pengguna }}</td>
                    @endif
                    <td>{{ $item->tipe_dokumen }}</td>
                    <td>{{ $item->file_upload }}</td>
                    <td>
                        <form method="POST" action="{{ route('dokumen.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-warning" href="{{ route('dokumen.edit', $item->id) }}" title="ubah">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            {{-- Download Data --}}
                            <a class="btn btn-primary" href="{!! route('dokumen-download', $item->file_upload) !!}">
                                <i class="bi bi-download"></i>
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
    {{-- </div>
    </div> --}}
@endsection

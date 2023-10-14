@extends('admin.index')
@section('content')
    @if (Auth::user()->role == 'admin')
        <h3 align="center">Daftar User</h3>
        <br />

        <div class="container mt-3">
            <table class="table table-hover datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>IsActive</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($ar_user as $data)
                        <tr>
                            <th>{{ $no }}</th>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->role }}</td>
                            <td>{{ $data->isactive }}</td>
                            <td>
                                @empty($data->foto)
                                    <img src="{{ url('admin/img/nophoto.jpg') }}" width="15%"
                                        style="width: 50px;border-radius: 10px;">
                                @else
                                    <img src="{{ url('admin/img') }}/{{ $data->foto }}" width="15%"
                                        style="width: 50px;border-radius: 10px;">
                                @endempty
                            </td>
                            <td>
                                <form method="POST" action="{{ route('user.destroy', $data->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-info" href="{{ route('user.show', $data->id) }}" title="detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('user.edit', $data->id) }}" title="ubah">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <!-- hapus data -->
                                    <button class="btn btn-danger delete-confirm" type="submit" title="Hapus"
                                        name="proses" value="hapus">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @php $no++ @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        @include('admin.access_denied')
    @endif
@endsection

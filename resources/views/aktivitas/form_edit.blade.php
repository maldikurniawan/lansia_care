@extends('admin.index')
@section('content')
    <div class="col-9">

        <h3>Form Aktivitas</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container px-5 my-5">
            <form method="POST" action="{{ route('aktivitas.update', $data->id) }}" id="aktivitasForm"
                data-sb-form-api-token="API_TOKEN" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <label for="nama_aktivitas">Nama Aktivitas</label>
                    <input class="form-control" name="nama_aktivitas" value="{{ $data->nama_aktivitas }}" id="nama_aktivitas" type="text"
                        placeholder="" data-sb-validations="required" />
                    <div class="invalid-feedback" data-sb-feedback="nama_aktivitas:required">nama aktivitas is required.</div>
                </div>
                <div class="form-floating mb-4">
                    <label for="keterangan">Keterangan</label>
                    <input class="form-control" name="keterangan" value="{{ $data->keterangan }}" id="keterangan"
                        type="text" placeholder="" data-sb-validations="required" />
                    <div class="invalid-feedback" data-sb-feedback="keterangan:required">keterangan is required.</div>
                </div>

                <button class="btn btn-primary" name="proses" value="simpan" id="simpan" type="submit">Simpan</button>
                <a href="{{ url('/aktivitas') }}" class="btn btn-info">Batal</a>

            </form>
        </div>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </div>
@endsection

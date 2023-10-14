@extends('admin.index')
@section('content')
    <div class="col-9">
        <h3>Form Jurnal Kesehatan</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('aktivitas.store') }}" id="contactForm" data-sb-form-api-token="API_TOKEN"
            enctype="multipart/form-data">
            @csrf
            {{-- <div class="form-floating mb-3">
                <input class="form-control" name="tanggal" value="" id="tanggal" type="date"
                    placeholder="Tanggal Jadwal" data-sb-validations="required" />
                <label for="tanggal">Tanggal</label>
                <div class="invalid-feedback" data-sb-feedback="tanggal:required">tanggal is required.</div>
            </div> --}}
            <div class="form-floating mb-3">
                <label for="nama_aktivitas">Nama Aktivitas</label>
                <input class="form-control" name="nama_aktivitas" value="" id="nama_aktivitas" type="text"
                    placeholder="" data-sb-validations="required" />
                <div class="invalid-feedback" data-sb-feedback="nama_aktivitas:required">nama aktivitas is required.</div>
            </div>
            <div class="form-floating mb-3">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="keterangan" rows="5"></textarea>
                <div class="invalid-feedback" data-sb-feedback="keterangan:required">keterangan is required.</div>
            </div>
            <input class="form-control invisible" name="users_id" value="{{ $users->id }}" id="users_id" type="text"
                placeholder="Foto" data-sb-validations="required" />

            <button class="btn btn-primary" name="proses" value="simpan" id="simpan" type="submit">Simpan</button>
            <button class="btn btn-info" name="unproses" value="batal" id="batal" type="reset">Batal</button>
            <a class="btn btn-danger" name="unproses" href="{{ route('aktivitas.index') }}">Kembali</a>
        </form>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </div>
@endsection

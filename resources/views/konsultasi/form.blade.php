@extends('admin.index')
@section('content')
    <div class="col-9">
        <h3>Form Konsultasi</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('konsultasi.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
                <label for="subjek">Subjek</label>
                <input class="form-control" name="subjek" value="" id="subjek" type="text" placeholder=""
                    data-sb-validations="required" />
                <div class="invalid-feedback" data-sb-feedback="subjek:required">konsultasi is required.</div>
            </div>
            <div class="form-floating mb-3">
                <label for="isi_pesan">Isi Pesan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="isi_pesan" rows="5"></textarea>
                <div class="invalid-feedback" data-sb-feedback="isi_pesan:required">isi pesan is required.</div>
            </div>
            <div class="form-floating mb-3">
                <label for="tanggal_konsultasi">Tanggal Konsultasi</label>
                <input class="form-control" name="tanggal_konsultasi" value="" id="tanggal_konsultasi" type="date"
                    placeholder="Tanggal_konsultasi Jadwal" data-sb-validations="required" />
                <div class="invalid-feedback" data-sb-feedback="tanggal_konsultasi:required">tanggal konsultasi is required.
                </div>
            </div>
            <button class="btn btn-primary" name="proses" value="simpan" id="simpan" type="submit">Simpan</button>
            <button class="btn btn-info" name="unproses" value="batal" id="batal" type="reset">Batal</button>
            <a class="btn btn-danger" name="unproses" href="{{ route('konsultasi.index') }}">Kembali</a>
        </form>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.ds"></script>
    </div>
@endsection

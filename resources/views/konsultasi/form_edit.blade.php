@extends('admin.index')
@section('content')
    <div class="col-9">

        <h3>Form Balas Data Konsultasi</h3>
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
            <form method="POST" action="{{ route('konsultasi.update', $data->id) }}" id="contactForm"
                data-sb-form-api-token="API_TOKEN">
                @csrf
                @method('PUT')
                <div class="form-floating mb-4">
                    <label for="subjek">Subjek</label>
                    <input class="form-control" name="subjek" value="{{ $data->subjek }}" id="subjek" type="text"
                        placeholder="" data-sb-validations="required" readonly/>
                    <div class="invalid-feedback" data-sb-feedback="subjek:required">subjek is required.</div>
                </div>
                <div class="form-floating mb-4">
                    <label for="isi_pesan">Isi Pesan</label>
                    <input class="form-control" name="isi_pesan" value="{{ $data->isi_pesan }}" id="isi_pesan"
                        type="text" placeholder="" data-sb-validations="required" readonly/>
                    <div class="invalid-feedback" data-sb-feedback="isi_pesan:required">isi pesan is required.</div>
                </div>
                <div class="form-floating mb-4">
                    <label for="balasan">Balasan</label>
                    <input class="form-control" name="balasan" value="{{ $data->balasan }}" id="balasan"
                        type="text" placeholder="" data-sb-validations="required" />
                    <div class="invalid-feedback" data-sb-feedback="balasan:required">balasan is required.</div>
                </div>
                <div class="form-floating mb-4">
                    <label for="tanggal_konsultasi">Tanggal Konsultasi</label>
                    <input class="form-control" name="tanggal_konsultasi" value="{{ $data->tanggal_konsultasi }}"
                        id=tanggal_konsultasi type="text" placeholder="" data-sb-validations="required" readonly/>
                    <div class="invalid-feedback" data-sb-feedback="tanggal_konsultasi:required">tanggal konsultasi is
                        required.</div>
                </div>

                <button class="btn btn-primary" name="proses" value="ubah" id="ubah" type="submit">Balas</button>
                <a href="{{ url('/konsultasi') }}" class="btn btn-info">Batal</a>

            </form>
        </div>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    </div>
@endsection

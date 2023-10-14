@extends('admin.index')
@section('content')
    <div class="col-9">

        <h3>Form Dokumen Medis</h3>
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
            <form method="POST" action="{{ route('dokumen.update', $data->id) }}" id="dokumenForm"
                data-sb-form-api-token="API_TOKEN" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <label for="tipe_dokumen">Tipe Dokumen</label>
                    <input class="form-control" name="tipe_dokumen" value="{{ $data->tipe_dokumen }}" id="tipe_dokumen"
                        type="text" placeholder="Tipe Dokumen" data-sb-validations="required" />
                    <div class="invalid-feedback" data-sb-feedback="tipe_dokumen:required">Durasi Tidur is required.</div>
                </div>
                <div class="form-floating mb-3">
                    <label for="file_upload">File Upload</label>
                    <input class="form-control" name="file_upload" value="{{ $data->file_upload }}" id="file_upload"
                        type="file" placeholder="file" />
                </div>

                <button class="btn btn-primary" name="proses" value="simpan" id="simpan" type="submit">Simpan</button>
                <a href="{{ url('/dokumen') }}" class="btn btn-info">Batal</a>

            </form>
        </div>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </div>
@endsection

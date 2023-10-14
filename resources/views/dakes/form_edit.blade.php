@extends('admin.index')
@section('content')
    <div class="col-9">

        <h3>Form Update Data Kesehatan</h3>
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
            <form method="POST" action="{{ route('dakes.update', $data->id) }}" id="contactForm"
                data-sb-form-api-token="API_TOKEN">
                @csrf
                @method('PUT')
                <div class="form-floating mb-4">
                    <input class="form-control" name="durasi_tidur" value="{{ $data->durasi_tidur }}" id="durasi_tidur"
                        type="text" placeholder="Durasi Tidur" data-sb-validations="required" />
                    <label for="durasi_tidur">Durasi Tidur</label>
                    <div id="durasi_tidur" class="form-text">Durasi tidur yang direkomendasikan yaitu sekitar 7 jam - 9 jam.
                    </div>
                    <div class="invalid-feedback" data-sb-feedback="durasi_tidur:required">Durasi Tidur is required.</div>
                </div>
                <div class="form-floating mb-4">
                    <input class="form-control" name="tekanan_darah" value="{{ $data->tekanan_darah }}" id="tekanan_darah"
                        type="text" placeholder="Tekanan Darah" data-sb-validations="required" />
                    <div id="tekanan_darah" class="form-text">Tekanan darah yang baik dapat bervariasi antar individu dan
                        tergantung pada faktor-faktor seperti riwayat kesehatan, gaya hidup, dan kondisi kesehatan secara
                        keseluruhan. Jika Anda memiliki kekhawatiran tentang tekanan darah Anda atau mengalami gejala yang
                        tidak biasa, disarankan untuk berkonsultasi dengan dokter atau profesional kesehatan untuk evaluasi
                        lebih lanjut.</div>
                    <label for="tekanan_darah">Tekanan Darah</label>
                    <div class="invalid-feedback" data-sb-feedback="tekanan_darah:required">Tekanan Darah is required.</div>
                </div>
                <div class="form-floating mb-4">
                    <input class="form-control" name="detak_jantung" value="{{ $data->detak_jantung }}" id=detak_jantung
                        type="text" placeholder="Detak Jantung" data-sb-validations="required" />
                    <div id="detak_jantung" class="form-text"> Normalnya, detak jantung saat berolahraga pada orang dewasa
                        berusia 20 - 35 tahun adalah 95 - 170 kali per menit. Sementara, untuk usia 35 - 50 berkisar 85 -
                        155 kali per menit. Selanjutnya, pada usia diatas 60 tahun kecepatannya antara 80-130 kali per
                        menit.</div>
                    <label for="detak_jantung">Detak Jantung</label>
                    <div class="invalid-feedback" data-sb-feedback="detak_jantung:required">Detak Jantung is required.</div>
                </div>

                <button class="btn btn-primary" name="proses" value="ubah" id="ubah" type="submit">Ubah</button>
                <a href="{{ url('/dakes') }}" class="btn btn-info">Batal</a>

            </form>
        </div>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    </div>
@endsection

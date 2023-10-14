@extends('admin.index')
@section('content')
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Keterangan Update</h5>
            <p class="card-text">Detak Jantung: {{ $data->detak_jantung }} <br> Tekanan Darah: {{ $data->tekanan_darah }} <br> Durasi
                Tidur: {{ $data->durasi_tidur }}</p>
            <a href="{{ url('/dakes') }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
@endsection

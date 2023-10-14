@extends('admin.index')
@section('content')
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Keterangan Balasan</h5>
            <p class="card-text">Subjek: {{ $data->subjek }}</p>
            <p class="card-text">Isi Pesan: {{ $data->isi_pesan }}</p>
            <p class="card-text">Balasan: {{ $data->balasan }}</p>
            <a href="{{ url('/konsultasi') }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
@endsection

@extends('admin.index')
@section('content')
    <div class="col-9">

        <h3>Form Update Data User</h3>
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
            <form method="POST" action="{{ route('user.update', $data->id) }}" id="contactForm"
                data-sb-form-api-token="API_TOKEN">
                @csrf
                @method('PUT')
                <div class="form-floating mb-4">
                    <input class="form-control" name="name" value="{{ $data->name }}" id="name" type="text"
                        placeholder="" data-sb-validations="required" readonly />
                    <label for="name">Username</label>
                    <div class="invalid-feedback" data-sb-feedback="name:required">name is required.</div>
                </div>
                <div class="form-floating mb-4">
                    <input class="form-control" name="email" value="{{ $data->email }}" id="email" type="email"
                        placeholder="" data-sb-validations="required" readonly />
                    <label for="email">Email</label>
                    <div class="invalid-feedback" data-sb-feedback="email:required">email is required.</div>
                </div>
                <div class="form-floating mb-4">
                    {{-- <input class="form-control" name="role" value="{{ $data->role }}" id="role" type="text"
                        placeholder="" data-sb-validations="required" />
                    <label for="role">Role</label>
                    <div class="invalid-feedback" data-sb-feedback="role:required">role is required.</div> --}}
                    <label for="role">Role</label><br>
                    <select class="form-select" name="role" aria-label="role">
                        <option value="{{ $data->role }}" hidden>{{ $data->role }}</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                        <option value="dokter">dokter</option>
                    </select>

                </div>
                <div class="form-floating mb-4">
                    {{-- <input class="form-control" name="isactive" value="{{ $data->isactive }}" id=isactive type="text"
                        placeholder="" data-sb-validations="required" />
                    <label for="isactive">IsActive</label>
                    <div class="invalid-feedback" data-sb-feedback="isactive:required">tanggal user is
                        required.</div> --}}
                    <label for="isactive">IsActive</label><br>
                    <select class="form-select" name="isactive" aria-label="isactive">
                        <option value="{{ $data->isactive }}" hidden>{{ $data->isactive }}</option>
                        <option value="yes">yes</option>
                        <option value="no">no</option>
                        <option value="banned">banned</option>
                    </select>
                </div>

                <button class="btn btn-primary" name="proses" value="ubah" id="ubah" type="submit">Ubah</button>
                <a href="{{ url('/user') }}" class="btn btn-info">Batal</a>

            </form>
        </div>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    </div>
@endsection

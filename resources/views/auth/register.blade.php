<!doctype html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/05f9e72f4d.js" crossorigin="anonymous"></script>

</head>

<body>
    <section style="background-color: #76DEB7;">
        <div class="container py-5 h-100 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card shadow" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('assets/img/Lansia UI 2.png') }}" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem; height:100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">USER REGISTRASI</span>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="name" id="name" name="name"
                                                class="form-control form-control-lg" placeholder="" />
                                            <label class="form-label" for="name">Nama</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="email" id="email" name="email"
                                                class="form-control form-control-lg" placeholder="" />
                                            <label class="form-label" for="email">Email Address</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" placeholder="" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input type="password" id="password" name="password_confirmation"
                                                class="form-control form-control-lg" placeholder="" />
                                            <label class="form-label" for="password-confirm">Confirm Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block"
                                                type="submit">Registrasi</button>
                                            <a class="btn btn-lg btn-block btn-secondary" name="unproses"
                                                href="{{ url('/login') }}">Kembali</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>

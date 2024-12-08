@extends("layouts.template")

@section("content")
    <div class="w-100 text-center position-relative">
        <img class="img-fluid align-content-center position-fixed top-0 start-50 translate-middle-x " src="{{asset("storage/Login/bg.png")}}"
             alt="Loading Login Background" style="padding: 0 20%; z-index: -10"/>

        <div class="container h-100">
            <img src="{{asset("storage/General/Black Logo.png")}}" alt="Eventure Logo" class="img-fluid d-block"
                 style="width: 200px; margin-top: 2rem;"/>
            <div class="mt-5 row text-center bg-white mx-auto w-50 p-4 rounded-3 text-black" style="width: fit-content">
                <div class="col-12 p-5">
                    <h3 class="fw-bold mb-5">Welcome back!</h3>
                    <form method="POST" action="{{ route('login') }}" class="text-start mx-auto" style="max-width: 28rem">
                        @csrf

                        <div>
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                        </div>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="mt-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        </div>
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <button type="submit" class="mt-5 btn bg-yellow-primary w-100">Login</button>

                        <div class="mt-3">
                            Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends("layouts.template")

@section("content")
    <div class="w-100 text-center position-relative">
        <img class="img-fluid align-content-center position-fixed top-0 start-50 translate-middle-x " src="{{storage_asset("/Login/bg.png")}}"
             alt="Loading Login Background" style="padding: 0 20%; z-index: -10"/>

        <div class="container h-100">
            <img src="{{storage_asset("/General/Black Logo.png")}}" alt="Eventure Logo" class="img-fluid d-block"
                 style="width: 200px; margin-top: 2rem;"/>
            <div class="mt-3 row text-center bg-white mx-auto w-50 rounded-3 text-black" style="width: fit-content">
                <div class="col-12 p-5">
                    <h3 class="fw-bold mb-5">Let's get started!</h3>
                    <form method="POST" action="{{ route('register.user') }}" class="text-start mx-auto needs-validation" style="max-width: 28rem">
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
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username">
                        </div>
                        @error('username')
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

                        <div class="mt-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number">
                        </div>
                        @error('phone_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <div class="mt-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth">
                        </div>
                        @error('date_of_birth')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        <button type="submit" class="btn bg-yellow-primary w-100 mt-4">Register</button>
                        <div class="my-3">
                            Already have an account? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="my-5">
                    Copyright @eventure 2024
        </div>
    </div>
@endsection

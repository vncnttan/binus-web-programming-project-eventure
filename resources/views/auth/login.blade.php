@extends("layouts.template")

@section("content")
    <div class="w-100 text-center position-relative">
        <img class="img-fluid align-content-center position-fixed top-0 start-50 translate-middle-x " src="{{asset("storage/Login/bg.png")}}"
             alt="Loading Login Background" style="padding: 0 20%; z-index: -10"/>

        <div class="container">
            <img src="{{asset("storage/General/Black Logo.png")}}" alt="Eventure Logo" class="img-fluid d-block"
                 style="width: 200px; margin-top: 2rem;"/>
            <div class="row text-center bg-white mx-auto w-50 p-4 rounded-3 text-black" style="width: fit-content">
                <div class="col-12">
                    <h3 class="fw-bold">Welcome back!</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check
                            -label" for="remember">Remember me</label>

                            <div class="float-end">Forgot your password?</div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends("layouts.template")

@section("content")
    <div class="w-100 text-center position-relative">
        <img class="img-fluid align-content-center position-fixed top-0 start-50 translate-middle-x " src="{{asset("storage/Login/bg.png")}}"
             alt="Loading Login Background" style="padding: 0 20%; z-index: -10"/>

        <div class="container">
            <img src="{{asset("storage/General/Black Logo.png")}}" alt="Eventure Logo" class="img-fluid d-block"
                 style="width: 200px; margin-top: 2rem;"/>
            <div class="row text-center bg-white mx-auto w-50 p-4 rounded-3" style="width: fit-content">
                <div class="col-12">
                    <h1 class="display-4">Welcome back!</h1>
                    <p class="lead">Please login to continue</p>
                </div>
            </div>
        </div>
    </div>
@endsection

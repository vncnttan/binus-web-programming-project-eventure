@extends("layouts.template")

@section("content")
    <div class="w-100 text-center position-relative">
        <img class="img-fluid align-content-center w-100 position-fixed start-50 translate-middle-x"
             src="{{storage_asset("/Login/choose-role-bg.png")}}"
             alt="Loading Login Background" style="z-index: -10; bottom: -24%"/>

        <div class="container h-100">
            <img src="{{storage_asset("/General/Black Logo.png")}}" alt="Eventure Logo" class="img-fluid d-block"
                 style="width: 200px; margin-top: 2rem;"/>
            <h1 class="fw-bold mt-5">
                Welcome to Eventure!
                <svg width="67" height="66" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <text fill="black" font-family="Poppins"
                          font-size="48" font-weight="600" letter-spacing="0em">
                        <tspan x="0" y="44.64">&#x1f44b;</tspan>
                    </text>
                </svg>
            </h1>
            <p style="margin-top: -0.7rem">We’re glad you’re here! What can we help you with?</p>
            <form action="{{route("choose-role.user")}}" method="POST" class="mt-5 row text-center mx-auto w-75 gap-5 text-black" style="width: fit-content">
                @csrf
                <div class="col p-5 bg-white rounded-3 p-4">
                    <div class="my-4">
                        {!! file_get_contents("storage/Login/find-experience-asset.svg") !!}
                    </div>
                    <div class="mb-4 ">
                        Find and Experience
                    </div>
                    <button type="submit" name="role" value="participant" class="btn btn-outline-dark mb-4">View Events around you</button>
                </div>
                <div class="col p-5 bg-white rounded-3 p-4">
                    <div class="my-4">
                        {!! file_get_contents("storage/Login/organize-events-asset.svg") !!}
                    </div>
                    <div class="mb-4 ">
                        Organize Events
                    </div>
                    <button type="submit" name="role" value="organizer" class="btn btn-outline-dark mb-4">Schedule your events</button>
                </div>
            </form>
        </div>
    </div>
@endsection

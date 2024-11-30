@extends('layouts.template')

@section('content')
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg px-5 py-3">
        <a class="navbar-brand" href="/">
            <img src="{{asset('storage/General/White Logo.png')}}" class="d-inline-block align-top" alt=""
                 style="width: 9rem">
        </a>
        <form class="ms-4 w-50 position-relative">
{{--            TODO: Search Event Functionality --}}
            <input class="bg-white rounded-pill py-2  px-4 w-100" placeholder="Search Events"
                   style="outline: none"/>
            <button type="submit" class="position-absolute top-50 end-0 translate-middle-y rounded-pill text-black"
                    style="padding: 0.5rem 1rem; outline: none; border: none; background-color: transparent">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>


            </button>
        </form>

        <div class="ms-auto row" id="navbarSupportedContent">
            <ul class="col navbar-nav mr-auto">
                <li class="nav-item px-4 active">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item px-4">
                    <a class="nav-link" href="/find-events">Find Events</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Nobel Shan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    @yield('page-content')
@endsection

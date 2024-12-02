@extends('layouts.template')

@section('content')
<nav class="navbar navbar-dark bg-dark navbar-expand-lg px-5 py-3">
    <a class="navbar-brand" href="/">
        <img src="{{asset('storage/General/White Logo.png')}}" class="d-inline-block align-top" alt=""
            style="width: 9rem">
    </a>
    <form class="ms-4 w-50 position-relative">
        {{-- TODO: Search Event Functionality --}}
        <input class="bg-white rounded-pill py-2  px-4 w-100" placeholder="Search Events"
            style="outline: none" />
        <button type="submit" class="position-absolute top-50 end-0 translate-middle-y rounded-pill text-black"
            style="padding: 0.5rem 1rem; outline: none; border: none; background-color: transparent">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
    </form>

    <div class="ms-auto row" id="navbarSupportedContent">
        <ul class="col navbar-nav mx-auto d-flex align-items-center justify-content-center ">
            <!-- Home Link -->
            <li class="nav-item px-4">
                <a class="nav-link text-white" href="/">Home</a>
            </li>
            <!-- Find Events Link -->
            <li class="nav-item px-4">
                <a class="nav-link text-white" href="/find-events">Find Events</a>
            </li>
            <!-- Profile Dropdown -->
            <li class="nav-item px-4 d-flex justify-content-center">
                <div class="btn-group">
                    <button class="btn btn-dark btn-sm d-flex align-items-center justify-content-center" type="button">
                        @if(Auth::check() && Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                        <img src="https://via.placeholder.com/30" alt="Default Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                        @endif
                        <span class="ms-2">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</span>
                    </button>
                    <button type="button" class="btn btn-sm btn-dark dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                        <li><a href="{{ route('profile.view') }}" class="dropdown-item">Organizer Dashboard</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="/logout" class="dropdown-item btn btn-danger">Logout</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

</nav>

@yield('page-content')
@endsection
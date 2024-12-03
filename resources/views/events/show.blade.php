@extends('layouts.template-with-navbar')

@section('page-content')
    {{-- to do fix ui --}}
    <div class="container font-poppins">
        <div class="col py-4">
            <img class="rounded-4 mb-4" style="height: 18rem; object-fit: cover; width: 100%"
                 src="{{$event->banner_image}}"
                 alt="Card image cap">
            <div class="row">
                <div class="col-md-9">
                    <h1 class="fw-bold m-0"
                        style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap">{{$event->name}}</h1>

                    <div class="rounded-3 pt-2 mb-2 gap-2 d-flex flex-row gap-1"
                         style="width: fit-content; place-items: center">
                        <img src="{{$event->organizer->image}}" alt="" style="height: 1.8rem; width: 1.8rem"
                             class="rounded-circle">
                        {{$event->organizer->name}}
                    </div>
                    <div class="bg-yellow-primary d-block px-2 rounded-3 my-3"
                         style="width: fit-content"> {{$event->category->name}} </div>
                    <div class="py-2">
                        <div class="card p-3">
                            <div class="d-flex flex-row gap-2" style="place-items: center;">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
                                </svg>
                                <div class="pt-1">{{ $event->date }}</div>
                            </div>
                            <div class="d-flex flex-row gap-2" style="place-items: center; ">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                                </svg>
                                <div class="pt-1">{{ $event->is_online ? 'Online' : 'Onsite' }} ({{ $event->location }})</div>
                            </div>
                            <div class="d-flex flex-row gap-2" style="place-items: center; ">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                                <div class="pt-1"> {{$event->attendees_count}} / {{ $event->quota }} attendees</div>
                            </div>
                        </div>
                    </div>

                    <div class="py-2">
                        <div class="card px-3 py-4">
                            <h4 class="fw-bold">Event Details</h4>
                            <p class="m-0">{{$event->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 gap-3">
                        @if($role === 'attendee')
                            <button type="button" class="btn btn-outline-dark">+ Wishlist</button>
                            <button type="button" class="bg-yellow-primary btn">Join Event</button>
                        @elseif($role === 'admin')
                            <button type="button" class="btn btn-outline-dark w-100">View Attendees</button>

                            <form action="{{ route('events.edit', $event->id) }}" method="GET">
                                <button type="submit" class="btn bg-yellow-primary w-100">Edit Event</button>
                            </form>
                            {{-- {{ route('events.destroy', $event) }} --}}
                            <form action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn text-white bg-red-primary w-100">Delete Event</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.template-with-navbar')

@section('page-content')
    <div class="container font-poppins">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="fw-bold">Trending Events</h4>
                <div class="row gap-4 my-3">
                    @foreach($trendingEvents as $te)
                        <x-event-card :event="$te"/>
                    @endforeach
                </div>


                <h4 class="fw-bold mt-5">Recent Events</h4>
                <div class="row gap-4 my-3">
                    @foreach($recentEvents as $re)
                        <x-event-card :event="$re"/>
                    @endforeach
                </div>
                {{$recentEvents->links()}}
            </div>
        </div>
    </div>
@endsection

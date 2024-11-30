@extends('layouts.template-with-navbar')

@section('page-content')
    <div class="container font-poppins">
        <div class="row py-4">
            <div class="col-md-12">
                <h4 class="fw-bold">Trending Events</h4>
                <div class="row mt-3">
                    @foreach($trendingEvents as $te)
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{$te->banner_image}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$te->name}}</h5>
                                <p class="card-text"> {{$te->description}} </p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

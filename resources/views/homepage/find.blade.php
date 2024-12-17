@extends('layouts.template-with-navbar')

@section('page-content')

@php
    $text = empty($searchQuery) ? "Find Events" : "Showing search results for \"" . $searchQuery . "\"";
@endphp

<div class="container my-4">
{{--     <a type="button" class="btn text-white bg-yellow-primary" href="{{route('events.add')}}">+ Add Event</a>--}}
    <h3 class="fw-bold mt-5 mb-4">{{$text}}</h3>
    <div class="d-flex flex-col gap-5">
        <div class="col-md-3">
            <div class="bg-light p-3 rounded">
                <form method="GET" action="{{ route('find') }}">
                    <h5>Sort</h5>
                    <select class="form-select mb-2" name="sort">
                        <option value="date" {{ request('sort') === 'date' ? 'selected' : '' }}>Date</option>
                        <option value="popularity" {{ request('sort') === 'popularity' ? 'selected' : '' }}>Popularity</option>
                    </select>

                    <select class="form-select mb-4" name="ordering">
                        <option value="asc" {{ request('ordering') === 'asc' ? 'selected' : '' }}>Ascending</option>
                        <option value="desc" {{ request('ordering') === 'desc' ? 'selected' : '' }}>Descending</option>
                    </select>

                    <h5>Filter</h5>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-select">
                            <option value="">Select category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Start date</label>
                        <input type="date" id="startDate" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">End date</label>
                        <input type="date" id="endDate" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <button type="submit" class="btn btn-warning">Apply</button>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row gap-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                @foreach($events as $event)
                    <x-event-card :event="$event"/>
                @endforeach
            </div>
            <div class="mt-4">{{$events->links()}}</div>
        </div>
    </div>
</div>
@endsection

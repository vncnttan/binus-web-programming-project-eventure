@extends('layouts.template-with-navbar')

@section('page-content')
<div class="container font-poppins">
    <div class="col py-4">  

        <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="text-center position-relative">
                <input type="file" name="banner_image" id="banner_image" class="form-control position-absolute" 
                       style="top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; cursor: pointer;" 
                       accept="image/*" required>
                    <img class="rounded-4 mb-4" style="height: 18rem; object-fit: cover; width: 100%"
                     src="{{ $event->banner_image }}" alt="Event banner" id="event-image">
                </input>
            </div>
            
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="event_name">Event Name</label>
                        <input type="text" id="event_name" name="name" class="form-control"
                               value="{{ $event->name }}" placeholder="Event name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="category">Category</label>
                        <select id="category" name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" class="form-control" value="{{ $event->date }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="start_time">Start Time</label>
                        <input type="time" id="start_time" name="start_time" class="form-control"
                               value="{{ $event->start_time }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="end_time">End Time</label>
                        <input type="time" id="end_time" name="end_time" class="form-control"
                               value="{{ $event->end_time }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="quota">Quota</label>
                        <input type="number" id="quota" name="quota" class="form-control"
                               value="{{ $event->quota }}" placeholder="Quota" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="max_per_account">Max Per Account</label>
                        <input type="number" id="max_per_account" name="max_per_account" class="form-control"
                               value="{{ $event->max_per_account }}" placeholder="Max. per account" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="type">Type</label>
                        <select id="type" name="is_online" class="form-control" required>
                            <option value="1" {{ $event->is_online ? 'selected' : '' }}>Online</option>
                            <option value="0" {{ !$event->is_online ? 'selected' : '' }}>Onsite</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" class="form-control"
                               value="{{ $event->location }}" placeholder="Location" required>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="description">Event Details</label>
                <textarea id="description" name="description" class="form-control" rows="10" placeholder="Event details...">
                    {{ $event->description }}
                </textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a type="button" class="btn text-white bg-red-primary" href="{{route('event.show', $event)}}">Discard Changes</a>
                <button type="submit" class="btn bg-yellow-primary">Update Event</button>
            </div>
        </form>
    </div>
</div>
@endsection

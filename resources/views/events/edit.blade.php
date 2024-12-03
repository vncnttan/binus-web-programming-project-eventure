@extends('layouts.template-with-navbar')

@section('page-content')
<div class="container font-poppins">
    <div class="col py-4">

        <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="text-center position-relative">
                <input type="file" name="banner_image" id="banner_image"
                       class="form-control position-absolute top-50 start-50 translate-middle opacity-0"
                       accept="image/*" required>
                <img class="rounded-4 mb-4 w-100" style="height: 18rem; object-fit: cover;"
                     src="{{ $event->banner_image }}" alt="Event banner" id="event-image">
                <svg class="position-absolute top-50 start-50 translate-middle overlay-icon"
                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="80" width="80" viewBox="0 0 487 487">
                    <path d="M308.1,277.95c0,35.7-28.9,64.6-64.6,64.6s-64.6-28.9-64.6-64.6s28.9-64.6,64.6-64.6S308.1,242.25,308.1,277.95z M440.3,116.05c25.8,0,46.7,20.9,46.7,46.7v122.4v103.8c0,27.5-22.3,49.8-49.8,49.8H49.8c-27.5,0-49.8-22.3-49.8-49.8v-103.9 v-122.3l0,0c0-25.8,20.9-46.7,46.7-46.7h93.4l4.4-18.6c6.7-28.8,32.4-49.2,62-49.2h74.1c29.6,0,55.3,20.4,62,49.2l4.3,18.6H440.3z M97.4,183.45c0-12.9-10.5-23.4-23.4-23.4c-13,0-23.5,10.5-23.5,23.4s10.5,23.4,23.4,23.4C86.9,206.95,97.4,196.45,97.4,183.45z M358.7,277.95c0-63.6-51.6-115.2-115.2-115.2s-115.2,51.6-115.2,115.2s51.6,115.2,115.2,115.2S358.7,341.55,358.7,277.95z"/>
                </svg>
            </div>


            <div class="row">
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
                <textarea id="description" name="description" class="form-control" rows="10" placeholder="Event details...">{{ $event->description }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a type="button" class="btn text-white bg-red-primary" href="{{route('event.show', $event)}}">Discard Changes</a>
                <button type="submit" class="btn bg-yellow-primary">Update Event</button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.template-with-navbar')

@section('page-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">Edit Profile</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row" style="width: 30%;"><label for="name" class="form-label">Name</label></th>
                                    <td>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="email" class="form-label">Email</label></th>
                                    <td>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="phone_number" class="form-label">Phone Number</label></th>
                                    <td>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}">
                                        @error('phone_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="date_of_birth" class="form-label">Date of Birth</label></th>
                                    <td>
                                        <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $user->date_of_birth }}">
                                        @error('date_of_birth')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><label for="image" class="form-label">Profile Picture</label></th>
                                    <td>
                                        <input type="file" name="profile_image" id="profile_image" class="form-control" accept="image/*" >
                                        @error('profile_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        @if($user->image)
                                            <small class="text-muted">Current Image: {{ $user->image }}</small>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success">Update Profile</button>
                            <a href="{{ route('profile.view') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

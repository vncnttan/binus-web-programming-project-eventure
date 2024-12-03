@extends('layouts.template-with-navbar')

@section('page-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">Profile</h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($user->image)
                        <img src="{{ asset($user->image) }}" alt="Profile Picture" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px;">
                        @else
                        <img src="{{ asset($user->image) }}" alt="Profile Picture" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px;">
                        @endif
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%;">Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Date of Birth</th>
                                <td>{{ $user->date_of_birth ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Phone Number</th>
                                <td>{{ $user->phone_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Role</th>
                                <td>{{ ucfirst($user->role) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('profile.edit') }}" class="btn btn-dark">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
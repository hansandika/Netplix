@extends('layouts.app',['title' => 'Profile'])
@section('library')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-3 d-flex flex-column justify-content-center align-items-center">
                <h4 class="fs-1 fw-bolder text-light mb-3">My <span style="color: #FB3842;">Profile</span></h4>
                @if ($user->image_url)
                    <!-- Button trigger modal -->
                    <img src="{{ $user->image_url }}" class="mb-3"
                        style="border-radius: 50%; width: 150px;object-fit: cover; height: 150px; display: block; cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                @else
                    <span style="font-size:7rem;cursor: pointer" class="text-light" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class=" fas fa-user-circle"></i>
                    </span>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Image</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="POST">
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="cbo-wrapper">
                                        <input id="input-link" class="form-control" type="url" name="url"
                                            placeholder="Image URL">
                                        <small class="form-text text-muted link-muted">Please upload your image to other
                                            sources first and Use the URL</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary save-btn">Save
                                        changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="vw-25 text-center">
                    <p class="name fs-3 fw-bolder">{{ $user->name }}</p>
                    <p class="email fs-3">{{ $user->email }}</p>
                </div>
            </div>
            <div class="col-xl-7 m-5">
                <p class="fw-bolder fs-1 p-3 text-xl-start text-center" style="color: #FB3842;">Update Profile</p>
                <form method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-4">
                        <div class="form-content p-3">
                            <label class="fs-3 me-5">Username</label>
                            <input class="fs-3 @error('username')is-invalid @enderror" type="text" name='username'
                                value="{{ old('username') ?? $user->name }}">
                        </div>
                        @error('username')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="form-content p-3">
                            <label class="fs-3 me-5">Email</label>
                            <input class="fs-3 @error('email')is-invalid @enderror" type="text" name="email"
                                value="{{ old('email') ?? $user->email }}">
                        </div>
                        @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="form-content p-3">
                            <label class="fs-3 me-5">DOB</label>
                            <input class="fs-3 @error('dob')is-invalid @enderror" type="date" placeholder="Fill in your DOB"
                                name="dob" value="{{ old('dob') ?? $user->dob }}">
                        </div>
                        @error('dob')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="form-content p-3 ">
                            <label class="fs-3 me-5">Phone</label>
                            <input class="fs-3" type="text" placeholder="Fill in your Phone Number" name="phone"
                                value="{{ old('phone') ?? $user->phone }}">
                        </div>
                        @error('phone')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="mt-3 btn btn-danger form-control save-changes-btn">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection

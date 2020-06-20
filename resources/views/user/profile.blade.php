@extends('layouts.backend.app')

@section('title', 'Profile')

@push('css')
    <style>
        section.content {
            margin: 60px 5px 0 5px !important;
        }
    </style>
@endpush

@section('content')

        <div class="container-fluid">
            <div class="row clearfix">
                @include('layouts.backend.partial.user-side')
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#profile_settings" aria-controls="settings" role="tab" data-toggle="tab">Profile Settings</a></li>
                                    <li role="presentation"><a href="#change_password_settings" aria-controls="settings" role="tab" data-toggle="tab">Change Password</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane animated fadeIn active" id="profile_settings">
                                        <div class="row clearfix">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-lg-offset-2"><br>
                                                <form method="POST" action="{{ route('user.update.profile') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <label for="name">Name</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" id="name" class="form-control" name="name" value="{{ Auth::user()->name }}">
                                                        </div>
                                                    </div>

                                                    <label for="email_address">Name</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="email" id="email" class="form-control" name="email" value="{{ Auth::user()->email }}">
                                                        </div>
                                                    </div>

                                                    <label for="password">Profile Image</label>
                                                    <div class="form-group">
                                                        <input type="file" name="image">
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane animated fadeIn" id="change_password_settings">
                                        <div class="row clearfix">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-7 col-lg-offset-2"><br>
                                                <form method="POST" action="{{ route('user.update.password') }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <label for="old_password">Old Password</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" id="old_password" class="form-control" placeholder="Enter your old password" name="old_password">
                                                        </div>
                                                    </div>
                                                    <label for="password">New Password</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" id="password" class="form-control" placeholder="Enter your new password" name="password">
                                                        </div>
                                                    </div>
                                                    <label for="password">Confirm New Password</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" id="confirm_password" class="form-control" placeholder="Enter your new password again" name="password_confirmation">
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>





@endsection


@push('js')

@endpush

@extends('layouts.backend.app')

@section('title', 'Change Password')


@push('css')

@endpush

@section('content')


    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-lg-offset-2 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header align-center">
                    <h2>
                        Changes Password
                    </h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ route('admin.change.password') }}">
                        @csrf
                        @method('PUT')
                        <label for="email_address">Old Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="old_password" class="form-control" placeholder="Enter your old password" name="old_password">
                            </div>
                        </div>

                        <label for="email_address">New Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" class="form-control" placeholder="Enter your new password" name="password">
                            </div>
                        </div>
                        <label for="image">Confirm Password</label>
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
    <!-- #END# Vertical Layout -->

@endsection

@push('js')

@endpush

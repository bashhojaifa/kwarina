@extends('layouts.backend.app')

@section('title', 'Create Users')


@push('css')

@endpush

@section('content')




    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-8 col-lg-offset-2 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a class="header-back" href="{{ route('admin.user.index') }}"><i class="material-icons">keyboard_backspace</i></a>
                    <h2 class="align-center">User Register</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('authors') ? 'focused error' : '' }}">
                                <label for="user">Select Author <span class="red">*</span></label>
                                <select name="author" id="author" class="form-control" data-live-search="true">
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <label for="Name">Name <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your name" required>
                            </div>
                        </div>

                        <label for="email_address">Email Address <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email_address" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter User email address" required autocomplete="email">
                            </div>
                        </div>
                        <label for="password">Password <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter User password" required>
                            </div>
                        </div>

                        <label for="password-confirm">Confirm Password  <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" autocomplete="new-password" required>
                            </div>
                        </div>
                        <label for="image">Profile Image</label>
                        <div class="form-group">
                            <input type="file" name="image">
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">REGISTER</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

@endsection

@push('js')

@endpush

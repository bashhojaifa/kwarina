@extends('layouts.backend.app')

@section('title', 'Update User')


@push('css')

@endpush

@section('content')

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-lg-offset-2 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a class="header-back" href="{{ route('admin.user.index') }}"><i class="material-icons">keyboard_backspace</i></a>
                    <h2 class="align-center">User Update</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group form-float">
                            <div class="form-line {{ $errors->has('authors') ? 'focused error' : '' }}">
                                <label for="category">Select Author <span class="red">*</span></label>
                                <select name="author" id="author" class="form-control show-tick" data-live-search="true">
                                    @foreach($authors as $author)
                                        <option
                                            {{ $user->reference_id == $author->id ? 'selected' : '' }}
                                            value="{{ $author->id }}">{{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label for="name">Name <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" placeholder="Enter your name" required>
                            </div>
                        </div>

                        <label for="email_address">Email Address <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email_address" name="email" class="form-control" value="{{ $user->email }}" placeholder="Enter your email address" required autocomplete="email">
                            </div>
                        </div>

                        <label for="password">Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="Password">
                            </div>
                        </div>

                        <label for="password-confirm">Confirm Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" autocomplete="new-password">
                            </div>
                        </div>
                        <label for="image">Profile Image</label>
                        <div class="form-group">
                            <input type="file" name="image">
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

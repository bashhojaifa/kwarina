@extends('layouts.backend.app')

@section('title', 'Edit Author')


@push('css')

@endpush

@section('content')
    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-lg-offset-2 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a class="header-back" href="{{ route('admin.author.index') }}"><i class="material-icons">keyboard_backspace</i></a>
                    <h2 class="align-center">Author Update</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ route('admin.author.update', $author->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <label for="email_address">Name <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" value="{{ $author->name }}" required>
                            </div>
                        </div>

                        <label for="email_address">Email Address <span class="red">*</span></label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email_address" name="email" class="form-control" value="{{ $author->email }}" required autocomplete="email">
                            </div>
                        </div>
                        <label for="password">Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" >
                            </div>
                        </div>

                        <label for="password-confirm">Confirm Password</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password_confirmation" class="form-control"  autocomplete="new-password" placeholder="Confirm Pssword">
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

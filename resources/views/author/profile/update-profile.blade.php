@extends('layouts.backend.app')

@section('title', 'Profile Update')


@push('css')

@endpush

@section('content')




    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-12 col-lg-offset-2 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header align-center">
                    <h2>
                        Profile Update
                    </h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ route('author.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <label for="email_address">Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                            </div>
                        </div>

                        <label for="email_address">Email Address</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="email_address" name="email" class="form-control" value="{{ Auth::user()->email }}" required autocomplete="email">
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

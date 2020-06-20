@extends('layouts.frontend.app')

@section('title', 'Login')

@push('css')

@endpush

@section('content')
    <section class="section">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default mt-5">
                        <div class="panel-heading">
                            <h3 class="panel-title">Login</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label class="login-label" for="exampleInputEmail1">Email address</label>
                                    <input id="email" type="email" class="form-control"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                </div>
                                <div class="form-group">
                                    <label class="login-label" for="exampleInputPassword1">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">

                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush


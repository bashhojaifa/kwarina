@extends('layouts.frontend.app')

@section('title', 'Reset Password')

@push('css')

@endpush

@section('content')
    <section class="section">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default mt-5">
                        <div class="panel-heading">
                            <h3 class="panel-title">Reset Password</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label for="email" class="login-label">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="login-label" for="exampleInputPassword1">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                                </div>


                                <div class="form-group">
                                    <label for="password-confirm" class="login-label">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn btn-primary">Reset Password</button>

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

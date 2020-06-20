@extends('layouts.backend.app')

@section('title', 'All Users')

@push('css')

@endpush

@section('content')

    <div class="container-fluid">
        <!-- Basic Card -->
        <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 col-lg-offset-2" >
                    <div class="card">
                        <div class="header text-center">
                            <h2>{{ Auth::user()->name }}</h2>
                        </div>
                        <div class="body">
                            @foreach($users as $user)
                                <div class="col-md-4">
                                    <p class="text-center">{{ $user->name }}</p>
                                </div>
                            @endforeach
                            <br>
                        </div>
                    </div>
                </div>
        </div>
    </div>




@endsection


@push('js')

@endpush

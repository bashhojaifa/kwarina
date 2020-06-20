@extends('layouts.backend.app')

@section('title', 'Users Sequences')

@push('css')

@endpush

@section('content')

<div class="container-fluid">
    <!-- Basic Card -->
    <div class="row clearfix">
        @foreach($authorSequence as $author)
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header text-center">
                    <h2>{{ $author->name }}</h2>
                </div>
                <div class="body">
                    @foreach($users as $user)
                        @if($user->reference_id == $author->id)
                            <div class="col-md-4">
                                <p class="text-center">{{ $user->name }}</p>
                            </div>
                        @endif
                    @endforeach
                    <br>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>




@endsection


@push('js')

@endpush

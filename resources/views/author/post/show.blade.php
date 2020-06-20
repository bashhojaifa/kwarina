@extends('layouts.backend.app')

@section('title','Post')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ route('author.post.index') }}" class="btn btn-danger">Back</a>

        @if($post->is_approved == false)
            <button type="button" class="btn btn-danger waves-effect pull-right" disabled>
                <span>Pending</span>
            </button>
        @else
            <button disabled type="button" class="btn btn-success pull-right">
                <i class="material-icons">done</i>
                <span>Approved</span>
            </button>
        @endif
        <br>
        <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                {{ $post->title }} <small>Posted by <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->toFormattedDateString() }}</small>
                            </h2>
                        </div>
                        <div class="body">
                            {!! $post->body !!}

                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

@push('js')

@endpush

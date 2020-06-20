@extends('layouts.backend.app')

@section('title', 'Comment Posts')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/user-profile.css') }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Total Posts <span class="badge bg-blue">{{ Auth::user()->comments->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        @if(Auth::user()->comments->count() == 0)
                            <h4 class="text-center">You have no comment post</h4>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable center">
                                    <thead>
                                    <tr>
                                        <th>Posted By</th>
                                        <th>Title</th>
                                        <th class="text-center"><i style="font-size: 18px;" class="material-icons">favorite</i></th>
                                        <th class="text-center"><i style="font-size: 18px;" class="material-icons">comment</i></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($comments as $comment)
                                        @foreach($posts as $post)
                                            @if($comment->post_id == $post->id)
                                                <tr>
                                                    <td>{{ $post->user->name }}</td>
                                                    <td class="like_post"><a href="{{ route('post.details', $post->slug) }}">{{ Str::limit($post->title, 100) }}</a></td>
                                                    <td class="text-center">{{ $post->likes->count() }}</td>
                                                    <td class="text-center">{{ $post->comments->count() }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

                {{ $comments->links() }}
            </div>

        </div>
        <br>
    </div>





@endsection


@push('js')

@endpush

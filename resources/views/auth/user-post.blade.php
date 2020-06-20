@extends('layouts.frontend.app')

@section('title', 'User Posts')

@push('css')

@endpush

@section('content')
    <section class="blog-area section">
        <div class="container">

            <div class="row">
                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                    <div class="card h-100">

                        <div class="single-post post-style-2 post-style-3 h-297">

                            <div class="blog-info">

                                <h4 class="title"><a href="{{ route('post.details', $post->slug) }}"><b>{{ Str::limit($post->title, '25') }}</b></a></h4>

                                <p>{!! Str::limit($post->body, '210') !!} <a class="font-red" href="{{ route('post.details', $post->slug) }}">See more</a></p>

                                <div class="avatar-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/' .$post->user->image) }}" alt="Profile Image"></a>
                                    <div class="right-area">
                                        <a class="name" href="{{ route('user.post', $post->id) }}"><b>{{ $post->user->name }}</b></a>
                                        <h6 class="date" href="#">{{ $post->created_at->toFormattedDateString() }}</h6>
                                    </div>
                                </div>

                                <ul class="post-footer">
                                    <li><a class="like {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'font-red' : '' : ''   }}"  data-postid = "{{ $post->id }}" href="javascript:void(0);" title="Like"><i class="ion-heart"></i>{{ $post->likes->count() }}</a></li>
                                    <li><a href="javascript:void(0)"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                    <li><a href="javascript:void(0)"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                </ul>

                            </div><!-- blog-right -->

                        </div><!-- single-post extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
                @endforeach
            </div><!-- row -->


        </div><!-- container -->
    </section><!-- section -->




@endsection

@push('js')
    <script src="{{ asset('assets/frontend/js/like.js') }}"></script>

    <script>
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';e
    </script>
@endpush

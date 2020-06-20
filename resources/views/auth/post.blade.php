@extends('layouts.frontend.app')

@section('title', 'Posts')

@push('css')

@endpush

@section('content')

    <section class="blog-area section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    @foreach($posts as $post)
                        <div class="card h-100">
                            <div class="single-post post-style-2 post-style-3">
                                <div class="blog-info">
                                    <div class="avatar-area">
                                        <a class="avatar" href="#">
                                            <img src="{{ Storage::disk('public')->url('profile/' .$post->user->image) }}" alt="Profile Image"></a>
                                        <div class="right-area">
                                            <a class="name" href="{{ route('user.post', $post->user->id) }}"><b>{{ $post->user->name }}</b></a>
                                            <h6 class="date" href="#">on {{ $post->created_at->toFormattedDateString() }}</h6>
                                        </div>
                                    </div>

                                    <h4 class="title">
                                        <a href="{{ route('post.details', $post->slug) }}"><b>{{ Str::limit($post->title, 80) }}</b></a>
                                    </h4>

                                    <p>{!! Str::limit($post->body, 250, '....') !!} <a class="font-red" href="{{ route('post.details', $post->slug) }}">See more</a></p>
                                    <ul class="post-footer">
                                        <li><a class="like {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'font-red' : '' : ''   }}"  data-postid = "{{ $post->id }}" href="javascript:void(0);" title="Like"><i class="ion-heart"></i>{{ $post->likes->count() }}</a></li>
                                        <li><a href="javascript:void(0)"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                        <li><a href="javascript:void(0)"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                                    </ul>

                                </div><!-- blog-right -->

                            </div><!-- single-post2 extra-blog -->

                        </div><!-- card -->
                        <br>
                    @endforeach
                    <br>
                </div><!-- col-lg-4 col-md-6 -->
                <style>
                    .sticky-sidebar {
                        position: -webkit-sticky;
                        position: sticky !important;
                        top: 52px;
                    }
                </style>

                <div class="col-lg-4 col-md-6">
                    <div class="sticky-sidebar">
                        <div class="card h-100">
                            <div class="single-post post-style-2 post-style-3">
                                <div class="blog-info" style="padding-bottom: 10px">
                                    <div class="notice-heading">
                                        <img src="{{ Storage::disk('public')->url('news.gif') }}" alt="#">
                                    </div>
                                    <div class="new-notice">
                                        <div class="right-direc">
                                            <marquee behavior="scroll" scrolldelay="150" height="200px" direction="up" onmouseover="this.stop();" onmouseout="this.start();">
                                                @foreach($notifications as $notification)
                                                    @if($notification->status == true)
                                                        @foreach($posts as $post)
                                                            @if($post->title == $notification->notification)
                                                                <p><a href="{{ route('post.details', $post->slug) }}">* {{ $notification->notification }}</a></p>
                                                            @endif
                                                        @endforeach
                                                        @if($notification->post_status == false)
                                                            <p>* {{ $notification->notification }}</p>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </marquee>
                                        </div>
                                    </div>
                                    <div class="notice-title">
                                        <h5>NEW NOTICE</h5>
                                    </div>
                                    <div class="old-notice">
                                        <div class="up-direc">
                                            <marquee behavior="scroll" scrolldelay="150" direction="down" height="200px" onmouseover="this.stop();" onmouseout="this.start();">
                                                @foreach($notifications as $notification)
                                                    @if($notification->status == false)
                                                        @foreach($posts as $post)
                                                            @if($post->title == $notification->notification)
                                                                <p>
                                                                    @auth
                                                                        <a href="{{ route('post.details', $post->slug) }}">* {{ $notification->notification }} </a>
                                                                    @else
                                                                        * {{ $notification->notification }}
                                                                    @endauth

                                                                </p>
                                                            @endif
                                                        @endforeach
                                                        @if($notification->post_status == false)
                                                            <p>* {{ $notification->notification }}</p>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </marquee>
                                        </div>
                                    </div>

                                    <div class="book-section">
                                        <div class="book-header">
                                            <h4><b>BOOKS</b></h4>
                                        </div>
                                        <div class="books">
                                            @foreach($books as $book)
                                                <a href="#">{{ Str::limit($book->name, 41) }} </a>
                                            @endforeach
                                        </div>
                                        <div class="book-footer">
                                            <a href="{{ route('all.book') }}">More books</a>
                                        </div>
                                    </div>
                                </div><!-- blog-right -->
                            </div><!-- single-post2 extra-blog -->

                        </div><!-- card -->
                    </div>
                </div><!-- col-lg-4 col-md-6 -->
            </div><!-- row -->

            {{ $posts->links() }}
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

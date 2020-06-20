@extends('layouts.frontend.app')

@section('title', 'Home')

@push('css')

@endpush

@push('carousel')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @for($img = 0; $img < $images->count(); $img++)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $img }}" class="{{ $img == 0 ? 'active' : '' }}"></li>
            @endfor
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            @foreach($images as $key => $image)
                <div class="item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ Storage::disk('public')->url('carousel/'.$image->image) }}">
                </div>
            @endforeach
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="ion-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <i class="ion-chevron-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
        </a>
    </div>



@endpush

@section('content')

    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-content">
                            @foreach($contents as $content)
                                @if($content->title == true)
                                    <h4 class="pt-2"><b>{{ $content->title }}</b></h4>
                                @endif

                                <p class="pt-1">{!! $content->body !!} </p>
                            @endforeach
                        </div><!-- single-post2 extra-blog -->

                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->

                <div class="col-lg-4 col-md-6">
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
                                                            <p>* {{ $notification->notification }}  </p>
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

                                </div><!-- blog-right -->
                            </div><!-- single-post2 extra-blog -->
                    </div><!-- card -->
                </div><!-- col-lg-4 col-md-6 -->
            </div><!-- row -->

        </div><!-- container -->





    </section><!-- section -->























@endsection

@push('js')

    <script>

        // window.onscroll = function() {myFunction()};
        //
        // var header = document.getElementById("nav-header");
        // // var sticky = header.offsetTop;
        //
        // function myFunction() {
        //     if (window.pageYOffset > 600) {
        //         header.classList.add("sticky");
        //     } else {
        //         header.classList.remove("sticky");
        //     }
        // }


        $(document).scroll(function(e){
            var scrollTop = $(document).scrollTop();
            if(scrollTop > 600){
                //console.log(scrollTop);57
                $('#nav-header').addClass('sticky');
            } else {
                $('#nav-header').delay(400).removeClass('sticky');
            }
        });



    //
    // $(".carousel").swipe({
    //
    // swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
    //
    // if (direction == 'left') $(this).carousel('next');
    // if (direction == 'right') $(this).carousel('prev');
    //
    // },
    // allowPageScroll:"vertical"
    //
    // });
</script>
@endpush

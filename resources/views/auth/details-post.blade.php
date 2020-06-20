@extends('layouts.frontend.app')

@section('title')
    {{ $post->title }}
@endsection

@push('css')

    <link rel="stylesheet" href="{{ asset('assets/frontend/css/single-post/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/single-post/responsive.css') }}">

@endpush

@section('content')
{{--    @include('auth.comment-form')--}}
    <div class="header-bg">

    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/'.$post->user->image) }}" alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="{{ route('user.post', $post->user->id) }}"><b>{{ $post->user->name }}</b></a>
                                    <h6 class="date">on {{ $post->created_at->toFormattedDateString() }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><b>{{ $post->title }}</b></h3>

                            <div class="para">
                                {!! html_entity_decode($post->body) !!}
                            </div>

                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li><a class="like {{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'font-red' : '' : ''   }}"  data-postid = "{{ $post->id }}" href="javascript:void(0);" title="Like"><i class="ion-heart"></i>{{ $post->likes->count() }}</a></li>
                                <li><a href="javascript:void(0)"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                                <li><a href="javascript:void(0)"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>



                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area">
                            <h4 class="title"><b>{{ $post->user->name }} Posts</b></h4>
                            <ul>
                                @foreach($authorPost as $authPost)
                                    <li><a href="{{ route('post.details', $authPost->slug) }}">* {{ Str::limit($authPost->title, 40) }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tag-area">
                            <h4 class="title"><b>ALL Posts</b></h4>
                            <ul>
                                @foreach($randomposts as $random)
                                    <li><a href="{{ route('post.details', $random->slug) }}">* {{ Str::limit($random->title, 40) }}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <br>
    <br>
    <section class="comment-section">
        <div class="container">
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        <form method="post" action="{{ route('comment.store', $post->id) }}">
                            @csrf
                            <div class="row">

                                <div class="col-sm-12">
                                    <textarea name="comment" rows="2" class="text-area-messge form-control" placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea>
                                </div><!-- col-sm-12 -->
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                                </div><!-- col-sm-12 -->

                            </div><!-- row -->
                        </form>
                    </div>
                    <h4><b>COMMENTS ({{ $comments->count() }})</b></h4>
                    @if($comments->count() > 0)
                        @foreach($comments as $comment)
                            <div class="commnets-area ">
                                <div class="comment">

                                    <div class="post-info">
                                        <div class="left-area">
                                            <a class="avatar" href="#"><img src="{{ Storage::disk('public')->url('profile/' .$comment->user->image) }}" alt="Profile Image"></a>
                                        </div>
                                        <div class="right-area">
                                            @if($comment->user->id == Auth::id())
                                            <div class="btn-group">
                                                <a  href="javascript:void(0);" data-toggle="dropdown">
                                                    <i class="ion-android-more-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-left-manual" role="menu">
                                                    <li class="editComment">
                                                        <a href="javascript:void(0)" class="edit" data-commentid="{{ $comment->id }}">Edit</a>
                                                    </li>

                                                    <li>
                                                        <a href="#" onclick="deleteComment({{ $comment->id }})">
                                                            Delete
                                                        </a>
                                                    </li>
                                                    <form id="delete-form-{{ $comment->id }}" method="POST" action="{{ route('comment.destroy',$comment->id) }}" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </ul>

                                            </div>
                                            @endif

                                        </div>

                                        <div class="middle-area">
                                            <a class="name" href="javascript:void(0);"><b>{{ $comment->user->name }}</b></a>
                                            <h6 class="date">{{ $comment->created_at->diffForHumans() }}</h6>
                                        </div>


                                    </div><!-- post-info -->

                                    <p>{{ $comment->comment }}</p>
                                </div>

                            </div><!-- commnets-area -->
                        @endforeach
                    @else
                        <div class="commnets-area">
                            <div class="comment">
                                <p>No Comment yet </p>
                            </div>
                        </div>
                    @endif

                    <br>
                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>


<div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="post-body">Edit the Comment</label>
                        <textarea class="form-control" name="comment-body"  id="comment-body" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection

@push('js')
    <script>
        var urlLike = '{{ route('like') }}';
        var token = '{{ Session::token() }}';
        var urlEdit = '{{ route('comment.edit') }}';
    </script>
    <script src="{{ asset('assets/frontend/js/like.js') }}"></script>
    <script src="{{ asset('assets/common/js/sweetalert/sweetalert2.all.js') }}"></script>
    <script type="text/javascript">
        function deleteComment(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush


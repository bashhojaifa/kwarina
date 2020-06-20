@extends('layouts.backend.app')

@section('title', 'admin-dashboard')

@push('css')

@endpush

@section('content')

    <div class="container-fluid">

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">library_books</i>
                    </div>
                    <div class="content">
                        <div class="text">ALL POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_post }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">lock</i>
                    </div>
                    <div class="content">
                        <div class="text">PENDING POSTS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $pending_post }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="content">
                        <div class="text">AUTHORS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_author }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="content">
                        <div class="text">USERS</div>
                        <div class="number count-to" data-from="0" data-to="{{ $all_user }}" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
        <!-- CPU Usage -->
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>MOST POPULAR POSTS</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Views</th>
                                    <th>Likes</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($popular_posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ Str::limit($post->title, '40') }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>{{ $post->view_count }}</td>
                                            <td>{{ $post->likes_count }}</td>
                                            <td>{{ $post->comments_count }}</td>
                                            <td>
                                                <a class="btn btn-primary waves-effect" href="{{ route('post.details', $post->slug) }}" target="_blank">view</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <!-- Answered Tickets -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="card">
                    <div class="body bg-teal">
                        <div class="font-bold m-b--35">ADMIN OVERVIEW</div>
                        <ul class="dashboard-stat-list">
                            <li>
                                VIEW ALL POSTS
                                <span class="pull-right"><b>{{ $all_view }}</b></span>
                            </li>
                            <li>
                                LIKE POSTS
                                <span class="pull-right"><b>{{ $likes }}</b></span>
                            </li>
                            <li>
                                COMMENT POSTS
                                <span class="pull-right"><b>{{ $comments }}</b> </span>
                            </li>
                            <li>
                                NEW NOTIFICATION
                                <span class="pull-right"><b>{{ $newNotification }}</b> </span>
                            </li>

                            <li>
                                OLD NOTIFICATION
                                <span class="pull-right"><b>{{ $oldNotification }}</b> </span>
                            </li>
                            <li>
                                PUBLISHED BOOK
                                <span class="pull-right"><b>{{ $publishedBook }}</b> </span>
                            </li>
                            <li>
                                PUBLISHED CAROUSEL
                                <span class="pull-right"><b>{{ $publishedCarousel }}</b> </span>
                            </li>

                            <li>
                                NON PUBLISHED CAROUSEL
                                <span class="pull-right"><b>{{ $nonPublishedCarousel }}</b> </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #END# Answered Tickets -->
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="header">
                        <h2>TOP 5 ACTIVE AUTHOR</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Like</th>
                                    <th>Comment</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($active_authors as $key=>$author)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $author->name }}</td>
                                            <td>{{ $author->posts_count }}</td>
                                            <td>{{ $author->likes_count }}</td>
                                            <td>{{ $author->comments_count }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Task Info -->

        </div>
    </div>

@endsection

@push('js')

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

   <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
@endpush

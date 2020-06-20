@if(Auth::user()->role_id == 1 && Request::is('admin*') || Auth::user()->role_id == 2 && Request::is('author*'))
<section>
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="{{ Storage::disk('public')->url('profile/' .Auth::user()->image) }}" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                <div class="email">{{ Auth::user()->email }}</div>
                @if(Request::is('admin*'))
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{ route('admin.profile.form') }}">
                                    <i class="material-icons">person</i>
                                    <span>Profile Update</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.password.form') }}">
                                    <i class="material-icons">change_history</i>
                                    <span>Change Pass</span>
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="material-icons">input</i> {{ __('Sign Out') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                @if(Request::is('admin*'))
                    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    {{-- Home page content --}}
                    <li  class="{{ Request::is('admin/home-content*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('admin/home-content') ? 'active' : '' }}">
                                <a href="{{ route('admin.home-content.index') }}">All Contents</a>
                            </li>
                            <li class="{{ Request::is('admin/home-content/create') ? 'active' : '' }}">
                                <a href="{{ route('admin.home-content.create') }}">Add new Content</a>
                            </li>
                        </ul>
                    </li>
                    {{-- End Home page content --}}

                    {{-- Book --}}
                    <li  class="{{ Request::is('admin/book*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">book</i>
                            <span>Book</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('admin/book') ? 'active' : '' }}">
                                <a href="{{ route('admin.book.index') }}">All Books</a>
                            </li>
                            <li class="{{ Request::is('admin/book/create') ? 'active' : '' }}">
                                <a href="{{ route('admin.book.create') }}">Add new Book</a>
                            </li>
                        </ul>
                    </li>
                    {{-- End Book --}}

                    {{-- Authors part --}}
                    <li  class="{{ Request::is('admin/author*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_add</i>
                            <span>Authors</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('admin/author') ? 'active' : '' }}">
                                <a href="{{ route('admin.author.index') }}">All Authors</a>
                            </li>
                            <li class="{{ Request::is('admin/author/create') ? 'active' : '' }}">
                                <a href="{{ route('admin.author.create') }}">Add new Author</a>
                            </li>
                        </ul>
                    </li>
                    {{--End Author part--}}

                    {{-- Users part --}}
                    <li  class="{{ Request::is('admin/user*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('admin/user') ? 'active' : '' }}">
                                <a href="{{ route('admin.user.index') }}">All Users</a>
                            </li>
                            <li class="{{ Request::is('admin/user/create') ? 'active' : '' }}">
                                <a href="{{ route('admin.user.create') }}">Add new User</a>
                            </li>
                        </ul>
                    </li>
                    {{--End User part--}}

                    {{-- Sequence -> Admin, Authro, User Circle--}}
                    <li class="{{ Request::is('admin/sequence') ? 'active' : '' }}">
                        <a href="{{ route('admin.sequence') }}">
                            <i class="material-icons">share</i>
                            <span>Sequence</span>
                        </a>
                    </li>
                    {{-- End Sequence -> Admin, Authro, User Circle--}}


                    {{-- Posts part --}}
                    <li  class="{{ Request::is('admin/post*') || Request::is('admin/pending/post') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_books</i>
                            <span>Posts</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('admin/post') ? 'active' : '' }}">
                                <a href="{{ route('admin.post.index') }}">All Posts</a>
                            </li>

                            <li class="{{ Request::is('admin/post/create') ? 'active' : '' }}">
                                <a href="{{ route('admin.post.create') }}">Add new post</a>
                            </li>

                            <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                                <a href="{{ route('admin.pending.post') }}">Pending Post</a>
                            </li>
                        </ul>
                    </li>
                    {{--End Posts part--}}

                    {{-- View Like Posts --}}
                    <li class="{{ Request::is('admin/like/posts') ? 'active' : '' }}">
                        <a href="{{ route('admin.like.posts') }}">
                            <i class="material-icons">favorite</i>
                            <span>Like Posts</span>
                        </a>
                    </li>
                    {{-- End View Like Posts --}}

                    {{-- View Comment Posts --}}
                    <li class="{{ Request::is('admin/comment/posts') ? 'active' : '' }}">
                        <a href="{{ route('admin.comment.posts') }}">
                            <i class="material-icons">comment</i>
                            <span>Comment Posts</span>
                        </a>
                    </li>
                    {{-- End View Comment Posts --}}

                    {{-- Notificaion --}}
                    <li  class="{{ Request::is('admin/notification*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">notifications_active</i>
                            <span>Notification</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('admin/notification') ? 'active' : '' }}">
                                <a href="{{ route('admin.notification.index') }}">All Notifications</a>
                            </li>
                            <li class="{{ Request::is('admin/notification/create') ? 'active' : '' }}">
                                <a href="{{ route('admin.notification.create') }}">Add new Notification</a>
                            </li>
                        </ul>
                    </li>
                    {{-- End Notification --}}


                    {{-- Carousel --}}
                    <li  class="{{ Request::is('admin/carousel*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">collections</i>
                            <span>Carousel</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="{{ Request::is('admin/carousel') ? 'active' : '' }}">
                                <a href="{{ route('admin.carousel.index') }}">Images</a>
                            </li>
                            <li class="{{ Request::is('admin/carousel/create') ? 'active' : '' }}">
                                <a href="{{ route('admin.carousel.create') }}">Add new Image</a>
                            </li>
                        </ul>
                    </li>
                    {{-- End Carousel --}}

                @endif

                @if(Request::is('author*'))
                    {{-- View all Posts --}}
                    <li class="{{ Request::is('author/post') ? 'active' : '' }}">
                        <a href="{{ route('author.post.index') }}">
                            <i class="material-icons">library_books</i>
                            <span>Post</span>
                        </a>
                    </li>
                    {{-- End View all Posts --}}

                    {{-- Create Posts --}}
                    <li class="{{ Request::is('author/post/create') ? 'active' : '' }}">
                        <a href="{{ route('author.post.create') }}">
                            <i class="material-icons">add</i>
                            <span>Add Post</span>
                        </a>
                    </li>
                    {{-- End Create Posts --}}

                    {{-- Author Users --}}
                    <li class="{{ Request::is('author/your-users') ? 'active' : '' }}">
                        <a href="{{ route('author.users') }}">
                            <i class="material-icons">person</i>
                            <span>Users</span>
                        </a>
                    </li>
                    {{-- Author Users --}}

                    {{-- View Like Posts --}}
                    <li class="{{ Request::is('author/like/posts') ? 'active' : '' }}">
                        <a href="{{ route('author.like.posts') }}">
                            <i class="material-icons">favorite</i>
                            <span>Like Posts</span>
                        </a>
                    </li>
                    {{-- End View Like Posts --}}

                    {{-- View Comment Posts --}}
                    <li class="{{ Request::is('author/comment/posts') ? 'active' : '' }}">
                        <a href="{{ route('author.comment.posts') }}">
                            <i class="material-icons">comment</i>
                            <span>Comment Posts</span>
                        </a>
                    </li>
                    {{-- End View Comment Posts --}}

                    <li class="header">Settings</li>

                    <li class="{{ Request::is('author/profile/update') ? 'active' : '' }}">
                        <a href="{{ route('author.profile.form') }}">
                            <i class="material-icons">face</i>
                            <span>Profile Update</span>
                        </a>
                    </li>

                    <li class="{{ Request::is('author/password/change') ? 'active' : '' }}">
                        <a href="{{ route('author.password.form') }}">
                            <i class="material-icons">change_history</i>
                            <span>Change Password</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i> <span>{{ __('Sign Out') }}</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endif
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
</section>
@else
{{--    <section>--}}
{{--            --}}
{{--    </section>--}}
@endif

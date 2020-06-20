
        <div class="col-xs-12 col-sm-3">
            <div class="card profile-card">
                <div class="profile-header">&nbsp;</div>
                <div class="profile-body">
                    <div class="image-area">
                        <img src="{{ Storage::disk('public')->url('profile/' .Auth::user()->image) }}" alt="AdminBSB - Profile Image" />
                    </div>
                    <div class="content-area">
                        <h3>{{ Auth::user()->name }}</h3>
                        <h4>{{ Auth::user()->email }}</h4>
                        <p>Your Admin Name</p>
                        <p>
                            @foreach($authors as $author)
                                @if($author->id == Auth::user()->reference_id)
                                    {{ $author->name }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="profile-footer">
                    <ul>
                        <li>
                            <a href="{{ route('user.like.posts') }}">Likes</a>
                            <span>{{ Auth::user()->likes()->count() }}</span>
                        </li>
                        <li>
                            <a href="{{ route('user.comment.posts') }}">Comment</a>
                            <span>{{ Auth::user()->comments()->count() }}</span>
                        </li>
                    </ul>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-lg waves-effect btn-block">BACK TO PROFILE</a>
                </div>
            </div>
</div>

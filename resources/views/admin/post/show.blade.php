@extends('layouts.backend.app')

@section('title','Post')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <a href="{{ route('admin.post.index') }}" class="btn btn-danger">Back</a>

        @if($post->is_approved == false)
            <button type="button" class="btn btn-success waves-effect pull-right" onclick="approvePost({{ $post->id }})">
                <i class="material-icons">done</i>
                <span>Approve</span>
            </button>
            <form method="post" action="{{ route('admin.post.approve',$post->id) }}" id="approval-form" style="display: none">
                @csrf
                @method('PUT')
            </form>
        @else
            <button disabled type="button" class="btn btn-success pull-right">
                <i class="material-icons">done</i>
                <span>approved</span>
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
    <script src="{{ asset('assets/common/js/sweetalert/sweetalert2.all.js') }}"></script>

    <script>
        function approvePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You went to approve this post ",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('approval-form').submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'The post remain pending :)',
                        'info'
                    )
                }
            })
        }
    </script>
@endpush

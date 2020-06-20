@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')

@endpush

@section('content')

    <div class="container-fluid">


        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Posts <span class="badge bg-blue">{{ $posts->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        @if($posts->count() == 0)
                            <h4 class="text-center">No Pending Post</h4>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Is Approved</th>
                                        <th>Created At</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($posts as $key=>$post)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ Str::limit($post->title, '10') }}</td>
                                            <td>{{ $post->user->name }}</td>
                                            <td>
                                                @if($post->is_approved == true)
                                                    <span class="badge bg-blue">approved</span>
                                                @else
                                                    <span class="badge bg-pink">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at->toFormattedDateString() }}</td>
                                            <td class="text-center">
                                                @if($post->is_approved == false)
                                                    <button type="button" class="btn btn-success waves-effect" onclick="approvePost({{ $post->id }})">
                                                        <i class="material-icons">done</i>
                                                    </button>
                                                    <form method="post" action="{{ route('admin.post.approve',$post->id) }}" id="approval-form" style="display: none">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                @endif
                                                <a class="btn btn-info waves-effect" title="Show Post" href="{{ route('admin.post.show', $post->id) }}">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <a class="btn btn-info waves-effect" title="Edit" href="{{ route('admin.post.edit', $post->id) }}">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <button class="btn btn-danger waves-effect" title="Delete" type="button" onclick="deletePost({{ $post->id }})">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                <form id="delete-form-{{ $post->id }}" action="{{ route('admin.post.destroy',$post->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>
@endsection


@push('js')
    <script src="{{ asset('assets/common/js/sweetalert/sweetalert2.all.js') }}"></script>
    <script type="text/javascript">
        function deletePost(id) {
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

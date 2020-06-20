@extends('layouts.backend.app')

@section('title', 'All Notification')

@push('css')

@endpush

@section('content')


    <div class="container-fluid">
        <div class="block-header">
            <h2>TOTAL <span class="badge">{{ $notifications->count() }}</span></h2>
        </div>
        <div class="row clearfix">
            @foreach($notifications as $notification)
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            NOTIFICATION
                                @if($notification->status == true)
                                    <span class="badge bg-pink">new</span>
                                @endif

                            <small> <code>{{ $notification->created_at->toFormattedDateString() }}</code> </small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="{{ route('admin.notification.edit', $notification->id) }}" class=" waves-effect waves-block">Edit</a></li>
                                    <li>
                                        <a href="javascript:void(0);" onclick="deleteNotification({{ $notification->id }})" class=" waves-effect waves-block">Delete</a>
                                        <form id="delete-form-{{ $notification->id }}" action="{{ route('admin.notification.destroy',$notification->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        {{ $notification->notification }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- #END# Exportable Table -->
    </div>


@endsection


@push('js')
    <script src="{{ asset('assets/common/js/sweetalert/sweetalert2.all.js') }}"></script>
    <script type="text/javascript">
        function deleteNotification(id) {
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

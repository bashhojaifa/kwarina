@extends('layouts.backend.app')

@section('title', 'Post')

@push('css')
    <style>
        .text-red {
            color: #c7254e;
        }
    </style>

@endpush

@section('content')

    <div class="container-fluid">

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Posts <span class="badge bg-blue">{{ $books->count() }}</span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>PDF</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($books as $key=>$book)
                                    <tr>
                                        <td>
                                            {{ $key+1 }}
                                        </td>
                                        <td>{{ Str::limit($book->name, '30') }}</td>
                                        <td>{{ Str::limit($book->book_name, '30') }}</td>
                                        <td>
                                            @if($book->status== true)
                                                <span class="badge bg-blue">published</span>
                                             @else
                                                <span class="badge bg-pink">Pending</span>
                                             @endif
                                        </td>
                                        <td>{{ $book->created_at->toFormattedDateString() }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info waves-effect" title="Show Post" href="{{ route('admin.book.show', $book->id) }}">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a class="btn btn-info waves-effect" title="Edit" href="{{ route('admin.book.edit', $book->id) }}">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button class="btn btn-danger waves-effect" title="Delete" type="button" onclick="deleteBook({{ $book->id }})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $book->id }}" action="{{ route('admin.book.destroy',$book->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

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
        <!-- #END# Exportable Table -->
    </div>
@endsection


@push('js')
    <script src="{{ asset('assets/common/js/sweetalert/sweetalert2.all.js') }}"></script>
    <script type="text/javascript">
        function deleteBook(id) {
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

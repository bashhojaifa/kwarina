@extends('layouts.backend.app')

@section('title', 'Add Book')


@push('css')

@endpush

@section('content')

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-6 col-md-8 col-lg-offset-3 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a class="header-back" href="{{ route('admin.book.index') }}"><i class="material-icons">keyboard_backspace</i></a>
                    <h2 class="align-center">Add New Book</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ route('admin.book.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="name">Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}" autofocus>
                            </div>
                        </div>

                        <label for="image">Book</label>
                        <div class="form-group">
                            <input type="file" name="file">
                            <small><code>Must be pdf file</code></small>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                            <label for="publish">Publish Book</label>
                        </div>

                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Book</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

@endsection

@push('js')

@endpush

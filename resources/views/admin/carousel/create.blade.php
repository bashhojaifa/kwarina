@extends('layouts.backend.app')

@section('title', 'Add Carousel Images')


@push('css')

@endpush

@section('content')

    <!-- Vertical Layout -->
    <div class="row clearfix">
        <div class="col-lg-6 col-md-8 col-lg-offset-3 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <a class="header-back" href="{{ route('admin.carousel.index') }}"><i class="material-icons">keyboard_backspace</i></a>
                    <h2 class="align-center">Add New Images</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ route('admin.carousel.store') }}" enctype="multipart/form-data">
                        @csrf
                        <label for="image">Carousel Image</label>
                        <div class="form-group">
                            <input type="file" name="image">
                            <small><code>Size up to 1400*600</code></small>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="publish" class="filled-in" name="status" value="1">
                            <label for="publish">Publish Image</label>
                        </div>

                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add Image</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Vertical Layout -->

@endsection

@push('js')

@endpush

@extends('layouts.frontend.app')

@section('title', 'blog')

@push('css')

@endpush
@section('content')
    <section class="blog-area section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-lg-offset-2">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $key=>$book)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $book->name }}</td>
                                        <td>
                                            <a href="{{ route('book.view', $book->id) }}" class="btn-sm btn-info"><i class="ion-eye"></i></a>
                                            <a href="{{ route('book.download', $book->id) }}" class="btn-sm btn-primary"><i class="ion-android-download"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')

@endpush

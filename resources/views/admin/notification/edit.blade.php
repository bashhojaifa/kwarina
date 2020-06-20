@extends('layouts.backend.app')

@section('title', 'Edit Notification')

@push('css')

@endpush

@section('content')


    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
                <div class="card">
                    <div class="header">
                        <a class="header-back" href="{{ Route('admin.notification.index') }}"><i class="material-icons">keyboard_backspace</i></a>
                        <h2 class="align-center">Update New Notification</h2>
                    </div>
                    <div class="body">
                        <form method="POST" action="{{ Route('admin.notification.update', $notification->id) }}">
                            @csrf
                            @method('PUT')
                            <label for="email_address">Notification</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="notification" class="form-control" placeholder="Enter Notification" value="{{ $notification->notification }}" }}>
                                </div>
                                @if($notification->post_status == true)
                                    <code>if you changed then unlink post</code>
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1" {{ $notification->status == true ? 'checked' : '' }}>
                                <label for="publish">Publish as new notification</label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@push('js')

@endpush

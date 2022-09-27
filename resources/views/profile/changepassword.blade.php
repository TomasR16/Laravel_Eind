@extends('layouts.app')

@section('content')
<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="col-lg-8">
        <br>
        <h3>Update password:</h3>
        <div class="card mb-4">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br />
            @endif
            {!! Form::model($user, ['method' => 'POST', 'route' => ['updatepassword', $user->id]]) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        {!! Form::label('old_password', 'Old password: ') !!}
                    </div>
                    <div class="col-lg-9">
                        {!! Form::password('old_password', ['class'=>'form-control']) !!}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">{!! Form::label('password', 'New password: ') !!}</div>
                    <div class="col-lg-9">{!! Form::password('password', ['class'=>'form-control']) !!}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">{!! Form::label('password_confirmation', 'Repeat new password: ') !!}</div>
                    <div class="col-lg-9">{!! Form::password('password_confirmation', ['class'=>'form-control']) !!}</div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <a class="btn btn-danger " href="{{ route('profile.index') }}">Cancel</a>
                    </div>
                    <div class="col-lg-9"><button type="submit" class="btn btn-primary">Save</button></div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
</div>


@endsection
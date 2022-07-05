@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-4">Create new band</h1>
    </div>
    <div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
        @endif
        <form method="post" action="{{ route('band.store') }}">

            @csrf
            <div class="form-group">
                <label for="band_name">Band name:</label>
                <input type="text" class="form-control" name="band_name" />
            </div>

            <div class="form-group">
                <label for="bio">Band biography:</label>
                <input type="text" class="form-control" name="bio" />
            </div>
            <div class="form-group">
                <label for="photo">Band photograph:</label>
                <input type="text" class="form-control" name="photo" />
            </div>
            <div class="form-group">
                <label for="member">Select user/users:</label>
                <!-- Special Form with laravel/collective package -->
                {!! Form::select('users[]', $users, $band->users,
                ['class' => 'form-control', 'multiple']) !!}
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>





@endsection
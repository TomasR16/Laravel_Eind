<!-- Extention -->
@extends('layouts.app')
<!-- content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Edit band: {{$band->band_name}}</h1>

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
            <form method="post" action="{{ route('band.update', $band->id) }}">
                @method('PATCH')
                @csrf
                <div class="form-group">

                    <label for="first_name">Band name:</label>
                    <input id="formControlLg" type="text" class="form-control" name="band_name" value="{{ $band->band_name }}" />
                </div>

                <div class="form-group">
                    <label for="last_name">Biography:</label>
                    <input type="text" class="form-control" width="5" name="bio" value="{{ $band->bio }}" />
                </div>

                <div class="form-group">
                    <label for="photo">Photograph:</label>
                    <input type="text" class="form-control" name="photo" value="{{ $band->photo }}" />
                </div>

                <div class="form-group">
                    <label for="member">Select new band user:</label>
                    <br>
                    <!-- adding user to band -->
                    <select name="users">
                        <option value="">No user</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div class="form-group pull-right">
                    <a class="btn btn-danger" href="{{ route('band.index') }}">Cancel</a>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>

        <!-- Side column -->
        <div class="col-sm">
            <table class="table">
                <tbody>
                    <!-- Show current band users -->
                    <thead>
                        <h2>Current band users:</h2>
                    </thead>
                    @foreach($band->users as $user)
                    <tr>
                        <td>

                            <li>id {{$user->id}}: {{$user->name}}</li>
                        </td>
                    </tr>
                    <br>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Einde content -->
@endsection
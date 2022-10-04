@extends('layouts.app')

@section('content')

<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="col-sm-8 offset-sm-2">

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

        <h1 class="display-4">{{$band->band_name}}</h1>
        <div class="container">
            <hr>
            <div class="jumbotron h6">
                <h3 class="jumbotron h1">Band biography:</h3>
                <br>
                <p class="jumbotron h3">{{$band->bio}}</p>
                <hr>

                <div class="">
                    <h1 class="jumbotron h1">Members:</h1>
                    <br>
                    <div class="">
                        <!-- if band has user show users -->
                        @if(isset($band->users))
                        <!-- Show band users -->
                        @foreach($band->users as $user)
                        <h2>id {{$user->id}}: {{$user->name}}</h2>
                        @endforeach
                        @endif
                    </div>
                    <hr>
                    <div class="">
                        @if (!empty($band->photo))
                        <img class="rounded" style="width: 75%; height: 75%" src="/storage/photo/{{$band->photo}}" alt="Band photograph">
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <!-- Embeded video -->
            <h4>{{ $band->url }}</h4>
            <br>
            <div class="media">
                <div class="media-body">
                    <iframe width="560" height="315" src="{{ $band->url }}" frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
        <div>
            <a style="margin: 19px;" href="{{ route('band.index')}}" class="btn btn-primary">&larr; back</a>
        </div>
    </div>
</div>

@endsection
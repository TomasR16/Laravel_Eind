@extends('layouts.app')
<link rel="stylesheet" href="/css/bandShow.css">
@section('content')

<div class="main">
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
                        <h2>{{$user->name}}</h2>
                        @endforeach
                        @endif
                    </div>
                    <hr>
                    <!-- Band Banner -->
                    <div class="frame-square">
                        @if (!empty($band->photo))
                        <img class="rounded" src="/storage/photo/{{$band->photo}}" alt="Band photograph">
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <!-- Embeded video -->
            <br>
            <div class="media">
                <div class="media-body">
                    @foreach($band->youtubes as $tubes)
                    <x-embed url="{{$tubes->url}}" aspect-ratio="16:9" />
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Button -->
        <div class="button">
            <a style="margin: 19px;" href="{{ route('band.index')}}" class="btn btn-primary">&larr; back</a>
        </div>
    </div>
</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="row">
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


        <div class="container">
            <h1 class="display-4">{{$band->band_name}}</h1>
            <hr>


            <div class="jumbotron h6">
                <h3 class="jumbotron h2">Band biography:</h3>
                <br>
                <p class="jumbotron h3">{{$band->bio}}</p>
            </div>
        </div>
        <div>
            <a style="margin: 19px;" href="{{ route('band.index')}}" class="btn btn-primary">&larr; back</a>
        </div>
    </div>
</div>

@endsection
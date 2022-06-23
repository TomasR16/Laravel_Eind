@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h1 class="display-3">Band EPK: {{$band->band_name}}</h1>

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

        <div>
            <a style="margin: 19px;" href="{{ route('band.index')}}" class="btn btn-primary">Overzicht</a>
        </div>

        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>Band Name:</td>
                    <td>{{ $band->band_name }}</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>

@endsection
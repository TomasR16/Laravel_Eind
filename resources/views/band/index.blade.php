@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
</div>




<div>
    <a style="margin: 19px;" href="{{ route('band.create')}}" class="btn btn-primary">Band toevoegen</a>
</div>
<div class="row">
    <div class="col-sm-12">
        <h1 class="display-3">Bands</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>ID:</td>
                    <td>Name:</td>
                    <td>Actions:</td>
                </tr>
            </thead>
            <tbody>
                @foreach($band as $band)
                <tr>
                    <td>{{$band->id}}</td>
                    <td>{{$band->band_name}}</td>

                    <td>
                        <a href="{{ route('band.show',$band->id)}}" class="btn btn-primary">Show</a>
                    </td>
                    <td>
                        <a href="{{ route('band.edit',$band->id)}}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('band.destroy', $band->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
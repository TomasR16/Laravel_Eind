@extends('layouts.app')

@section('content')
<div class="col-sm-12">

    @if(session()->get('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
</div>
<br>
<!-- Begin Search -->
<div class="row">
    {!! Form::open(['method'=>'GET','url'=>'/band/','class'=>'navbar-form navbar-left','role'=>'search']) !!}
    <div class="input-group custom-search-form">
        <input type="text" class="form-control" name="keyword" placeholder="Search Bands">
        <span class="input-group-btn">
            <button class="btn btn-default-sm" type="submit">
                <i class="fa fa-search"><span class="glyphicon glyphicon-search" />
            </button>
        </span>
    </div>
    {!! Form::close() !!}
</div>
<!-- END Search -->


<div class="row">
    <div class="col-sm-12">
        <div class="col-sm-12">

            <h1 class="display-9">Bands:</h1>
            <a style="margin: 12px;" href="{{ route('band.create')}}" class="btn btn-primary">Create band</a>
        </div>


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
@extends('layouts.app')

@section('content')
<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="col-lg-8">
        <br>
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
            <form method="post" action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name:</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="" type="text" name="name" value="{{Auth::user()->name}}" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email:</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="" type="text" name="email" value="{{Auth::user()->email}}" />
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <a class="btn btn-danger" href="{{ route('profile.index') }}">Cancel</a>
                        </div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


@endsection
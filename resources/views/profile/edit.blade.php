@extends('layouts.app')

@section('content')
<div class="h-100 d-flex align-items-center justify-content-center">
    <div class="col-lg-8">
        <br>
        <div class="card mb-4">
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
                            <p class="mb-0">Password:</p>
                        </div>
                        <div class="col-sm-9">
                            <input class="" style="width: 600px;" name="password" type="text" value="{{Auth::user()->password}}" />
                        </div>
                    </div>
                </div>
                <div class="">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-danger" href="{{ route('profile.index') }}">Cancel</a>
                </div>
            </form>
        </div>

    </div>
</div>


@endsection
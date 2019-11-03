@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="row justify-content-center">
                    <img width="300" height="300" class="rounded-circle" src="{{auth()->user()->avatar}}" alt="">
                </div>
            </div>
            <form class="col-sm" method="post" action="{{route('profile.change')}}" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 position-relative color ">
                    <input class="d-block custom-file-input" id="avatar" name="avatar" type="file"/>
                    <label class="custom-file-label" for="avatar">nothing is selected</label>
                </div>
                <label class="d-block mt-2 ">Change profile photo</label>
                <input class="d-block btn btn-primary mt-5" type="submit" value="Change your photo">
            </form>
            <div class="col-sm">
            </div>
        </div>
    </div>
@endsection

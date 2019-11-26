@extends('layouts.app')

{{--Just wanded to provide ability to change default photo to something you prefer--}}

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm">
                <div class="row justify-content-center">
                    <img width="300" height="300" class="rounded-circle" src="{{auth()->user()->avatar}}" alt="">
                </div>
            </div>
            <form class="col-sm" method="post" action="{{route('profile.change')}}" enctype="multipart/form-data">
                @csrf
                <div class="mt-4 position-relative color ">
                    <input accept="image/png, image/jpeg" required class="d-block custom-file-input" id="avatar" name="avatar" type="file"/>
                    <label class="custom-file-label" for="avatar">nothing is selected</label>
                </div>
                <label class="d-block mt-2 ">Change profile photo</label>
                <input class="d-block btn btn-primary mt-5" type="submit" value="Change your photo">
            </form>
            <div class="col-sm">
            </div>
            <div class="mt-5 w-100">
                <comment-box :routename="'profile'+{{auth()->user()->id}}" :user="{{json_encode(auth()->user())}}"></comment-box>
            </div>
        </div>
    </div>
@endsection

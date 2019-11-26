@extends('layouts.app')

{{--Pass user instance in order to enable/disable buttons--}}
{{--When not provided, ability to comment or reply is disabled--}}
{{--:routename is unique identifier--}}
{{--you can have different comment tables on different routes or even at the same route, like I did here--}}

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <comment-box :routename="'home'" :user="{{json_encode(auth()->user())}}"></comment-box>
        <div class="d-flex w-100 mt-5">
            <div class="float-left mr-5" style="width: 60%">
                <comment-box :routename="'home1'" :user="{{json_encode(auth()->user())}}"></comment-box>
            </div>
            <div class="float-right" style="width: 30%">
                <comment-box :routename="'home2'" :user="{{json_encode(auth()->user())}}"></comment-box>
            </div>
        </div>
    </div>
</div>
@endsection

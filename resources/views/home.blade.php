@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <comment-box :user="{{json_encode(auth()->user())}}"></comment-box>
    </div>
</div>
@endsection

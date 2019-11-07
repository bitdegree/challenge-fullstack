@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
{{--        <div>--}}
{{--            <a href="{{route('comments.index')}}">click</a>--}}
{{--            <form action="{{route('comments.store')}}" method="post">--}}
{{--                {{csrf_field()}}--}}
{{--                <input type="hidden" name="reply" id="reply" value={{true}}>--}}
{{--                <input type="hidden" name="id" id="id" value={{1}}>--}}
{{--                <input type="hidden" name="textField" id="textField" value={{"dfdsfsfs fsfs"}}>--}}
{{--                <input type="hidden" name="user_id" id="user_id" value=1>--}}
{{--                <input value="submit" type="submit">--}}
{{--            </form>--}}
{{--        </div>--}}
        <comment-box :user="{{json_encode(auth()->user())}}"></comment-box>
        <div class="d-flex w-100 mt-5">
            <div class="float-left mr-5" style="width: 65%">
                <comment-box :user="{{json_encode(auth()->user())}}"></comment-box>
            </div>
            <div class="float-right" style="width: 30%">
                <comment-box :user="{{json_encode(auth()->user())}}"></comment-box>
            </div>
        </div>

    </div>
</div>
@endsection

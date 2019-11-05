@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div>
            <a href="{{route('comments.index')}}">click</a>
            <form action="{{route('comments.store')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="reply" id="reply" value={{false}}>
                <input type="hidden" name="id" id="id" value={{1}}>
                <input type="hidden" name="textField" id="textField" value={{"dfdsfsfs fsfs"}}>
                <input value="submit" type="submit">
            </form>
        </div>
        <comment-box :user="{{json_encode(auth()->user())}}"></comment-box>
    </div>
</div>
@endsection

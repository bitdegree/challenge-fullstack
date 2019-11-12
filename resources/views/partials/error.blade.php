
@if(\Illuminate\Support\Facades\Session::has('error'))
    <div class="p-2 w-100">
        <div class="alert alert-danger m-5 w-90">
            {{\Illuminate\Support\Facades\Session::get('error')}}
        </div>
    </div>
@endif

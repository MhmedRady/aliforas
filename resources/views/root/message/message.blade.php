
@if(Session::has('error'))
    <button class="btn btn-block btn-danger mb-3 font-85" style="font-weight: bold;">
        {{Session::get('error')}}
    </button>
@endif

@if(Session::has('success'))
    <button class="btn btn-block btn-success mb-3 font-85" style="font-weight: bold;">
        {{Session::get('success')}}
    </button>
@endif

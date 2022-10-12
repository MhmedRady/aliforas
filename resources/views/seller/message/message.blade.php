
@if(Session::has('error'))
    <button class="btn btn-block btn-danger font-85 m-auto d-block" style="font-weight: bold;">
        {{Session::get('error')}}
    </button>
@endif

@if(Session::has('success'))
    <button class="btn btn-block btn-success font-85 m-auto d-block" style="font-weight: bold;">
        {{Session::get('success')}}
    </button>
@endif

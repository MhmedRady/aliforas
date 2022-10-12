{{-- @if(Session::has('success'))
    <div id="toaster" class="toast show align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="me-auto">{{__('auth.tSuccess')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{Session::get('success')}}
    </div>
</div>
@endif
@if(Session::has('error'))
    <div id="toaster" class="toast show align-items-center text-white bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">{{__('auth.tError')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{Session::get('error')}}
        </div>
    </div>
@endif --}}

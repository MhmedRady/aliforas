@if(Session::has('success-sweet-alert'))
    <script>
        Swal.fire(
            'operation accomplished successfully',
            `{!! Session::get('success')!!}`,
            'success'
        );
        Sound.run();
    </script>
@endif
@if(Session::has('fault-sweet-alert'))
    <script>
        Sound.run('error');
        Swal.fire({
            type: 'error',
            icon: 'error',
            title: 'Oops...',
            html: `{!! Session::get('fault') !!}`,
        });
    </script>
@endif
{{--@if($errors->any() )
    <script>
        @if (Route::currentRouteAction()=='App\Http\Controllers\Auth\LoginController@showLoginForm')
        Swal.fire({
            type: 'error',
            icon: 'error',
            title: 'Oops...',
            text: 'Email Or Password is wrong !',
        });
        @else
        Swal.fire({
            type: 'error',
            icon: 'error',
            title: 'Oops...',
            text: 'An error occurred in the operation!',
        });
        @foreach($errors->all() as $e)
        console.log("{{$e}}");
        alertify.error("{{$e}}");
        @endforeach
        @endif
    </script>
@endif--}}

{{--

--}}

@section('style')
    <link rel="stylesheet" href="{{asset('base/table/table.css')}}">
@append

@section('script_head')
    {{--no update in this file--}}
    <script data-pagespeed-no-defer src="{{asset('base/table/filtable/filtable.min.js')}}"></script>

    {{--no update in this file--}}
    <script data-pagespeed-no-defer src="{{asset('base/table/tablesort/jquery.tablesort.min.js')}}"></script>

    {{--custome code--}}
    <script data-pagespeed-no-defer src="{{asset('base/table/table.js')}}"></script>
@append


{{--
filter table
$('#table_data').filtable({
            controlPanel: $('#table_data_filter')
        });

 $('#mainTable').on('aftertablefilter', function (event) {
            getRowCounterInMainTable();
        });

--}}


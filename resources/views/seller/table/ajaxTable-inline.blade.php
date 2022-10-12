@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/tables/datatable/responsive.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link href="/sweetalert.min.css" rel="stylesheet">
@endsection
<section>
    <div class="row">
        <div class="col-12">
            <div class="card">
                @isset($title)
                    <div class="card-header border-bottom">
                        <h4 class="card-title">{{ $title }}</h4>
                        @if(checkCurrentRoute('seller.products.index'))
                            <div class="row justify-content-between">
                                <a href="{{route('seller.products.importShow')}}" class="col-auto btn btn-success text-capitalize" style="margin-right: .5rem">import Excel</a>
                                <a href="{{route('seller.products.export')}}" class="col-auto btn btn-primary text-capitalize" style="margin-left: .5rem">export Excel</a>
                            </div>
                        @endif
                    </div>
                @endisset
                <div class="card-datatable">
                    <table id="ajaxTable" class="table table-striped table-bordered dt-responsive" style="width:100%">
                        <thead>
                        <tr>
                            @if(!isset($withoutId) || $withoutId !== true)
                                <th>{{ @$IdTitle ?: '#' }}</th>
                            @endif
                            @yield('tableColumns')
                            @if(!isset($withoutCreated) || $withoutCreated !== true)
                                    <th>@lang('layouts.created_at')</th>
                            @endif
                            <th class="no-search text-start">#</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@section('vendor-script')
    {{-- vendor files --}}

    @if(app()->getLocale() === 'ar')
        <script src="{{ asset('admin-asset/vendors/js/tables/datatable/jquery.dataTables_ar.min.js') }}"></script>
    @else
        <script src="{{ asset('admin-asset/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    @endif

    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('admin-asset/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="/sweetalert.min.js"></script>
@endsection
@php
    if(!isset($columns) || !is_array($columns))
        $columns = [];
    if(!isset($withoutId) || $withoutId !== true)
        array_unshift($columns, 'id');

    if(!isset($withoutCreated) || $withoutCreated !== true)
        $columns[] = 'created_at';
    $columns[] = 'id';
    $columns = collect($columns)->map(fn($column) => ['data' => $column])->toArray();
@endphp
@section('page-script')
    <script>
        @if (session('success'))
        Swal.fire(
            'Success!',
            'Saved Successfully!',
            'success'
        );
        @endif
        $(document).ready(function () {

            if (window.innerWidth > 780) {
                let _head = $('#ajaxTable thead tr').clone(true);
                _head.appendTo('#ajaxTable thead');
                $('#ajaxTable thead tr:eq(0) th.no-search').attr('rowspan', '2').css('text-align', 'center');
                $('#ajaxTable thead tr:eq(1) th').each(function (i, v) {
                    window.dtTableSearcher.bind(this)(() => dtTable, i)
                });
            }
            let dtTable = $('#ajaxTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                ajax: `{{ $url }}`,
                autoWidth: true,
                columns: {!! json_encode($columns) !!},
                columnDefs: [
                    {
                        targets: -1,
                        title: '@lang('layouts.actions')',
                        orderable: false,
                        render: function (data, type, row, meta) {
                            let _html = [];
                            if ('deleted_at' in row && row['deleted_at'] != null) {
                                if (row['can_restore'])
                                    _html.push('<a href="javascript:void(0);" data-model-id="' + data + '" class="model-restore">' +
                                        feather.icons['rotate-ccw'].toSvg({class: 'font-medium-5'}) + '</a>')
                                _html.push('<span class="text text-danger">' + row['deleted_at'] + '</span>')
                            } else {
                                if (row['actions'] && row['actions'].length > 0) {
                                    for (let i = 0; i < row['actions'].length; i++) {
                                        // console.log(row['actions'][i]['class']);
                                        let icon = row['actions'][i]['icon'] || row['actions'][i]['text']
                                        if (row['actions'][i]['icon'])
                                            try {
                                                icon = feather.icons[row['actions'][i]['icon']].toSvg({class: 'font-medium-5'});
                                            } catch (e) {
                                            }
                                        if (row['actions'][i]['type'] === 'ajax')
                                            _html.push('<a href="javascript:void(0);" data-url="' + row['actions'][i]['url'] + '" data-title="' + row['actions'][i]['title'] + '" class="ajax-btn">' + icon + '</a>')
                                        else if(row['actions'][i]['type'] === 'btnAjax'){
                                            _html.push(`<button type='button' data-url="${row['action'][i]['url']}" data-title="${row['action'][i]['title']}" class="ajax-btn ${row['actions'][i]['class']}">${icon}</button>`);
                                        }
                                        else
                                            _html.push('<a href="' + row['actions'][i]['url'] + '" class="' + (row['actions'][i]['class'] || '') + '">' + icon + '</a>')
                                    }
                                }
                                if (row['update_url'])
                                    _html.push('<a @if(isset($createPopup) && $createPopup === false) href="' + row['update_url'] + '" @else href="' + row['update_url'] + '" data-update-url="' + row['update_url'] + '" class="model-update" @endif>' +
                                        feather.icons['edit'].toSvg({class: 'font-medium-5'}) + '</a>')
                                if (row['delete_url'])
                                    _html.push('<a href="javascript:void(0);" data-delete-url="' + row['delete_url'] + '" class="model-delete">' +
                                        feather.icons['trash-2'].toSvg({class: 'font-medium-5'}) + '</a>');
                                if (row['restore_url'])
                                    _html.push('<a href="javascript:void(0);" data-restore-url="' + row['restore_url'] + '" class="restore">' +
                                        feather.icons['trash-2'].toSvg({class: 'font-medium-5'}) + '</a>');
                            }
                            return _html.join('&nbsp;');
                        }
                    }
                ],
                dom: '<"d-flex justify-content-between align-items-center mx-0 row col-12"<"col"l><"dt-action-buttons m-1 col-auto text-left"B>>rt<"d-flex justify-content-between mx-0 row"<"col-xs-12 col-sm"i><"col-xs-12 col-sm-auto"p>>',
                responsive: true,
                language: {
                    url: `{{ asset('admin-asset/vendors/js/tables/datatable/datatable_ar.json') }}`,
                    processing: feather.icons['refresh-cw'].toSvg({class: 'font-medium-5 mr-50'}) + '<span>@lang('layouts.loading')</span> ',
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                buttons: [
                    ReloadButton,
                    @if(isset($createUrl) && !empty($createUrl))
                    {
                        text: feather.icons['plus'].toSvg({class: 'mr-50 font-small-4'}) + ' @lang('New') ',
                        className: 'create-new btn btn-primary',
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                        },
                        action: function (e, dt, node, config) {
                            {{--@if(!isset($createPopup) || $createPopup !== false)
                                window.ajaxCreateUpdate(dtTable, '{{ $createUrl }}', 'Add New')
                            @else--}}
                                window.location.href = '{{ $createUrl }}'
                            {{--@endif--}}
                        }
                    },
                    @endif
                ],
            }).on('click', 'a.model-update', function () {
                let _btn = $(this);
                window.ajaxCreateUpdate(dtTable, `${_btn.data('updateUrl')}`, 'تعديل')
            }).on('click', 'a.ajax-btn', function () {
                let _btn = $(this);
                window.ajaxCreateUpdate(dtTable, `${_btn.data('url')}`, `${_btn.data('title') || null}`, {
                    showConfirmButton: false,
                    grow: 'fullscreen',
                    position: 'top',
                })
            }).on('click', 'a.model-delete', function () {
                let _btn = $(this);
                Swal.fire({
                    title: '@lang('layouts.deleteConfirm')',
                    showDenyButton: true,
                    confirmButtonText: '@lang('Yes')',
                    denyButtonText: '@lang('Cancel')',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // console.log(_btn.data('deleteUrl'));
                        $.ajax({
                            type: 'DELETE',
                            url: `${_btn.data('deleteUrl')}`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE',
                            },
                            success: function (res) {
                                Swal.fire(
                                    'Success!',
                                    'Saved Successfully!',
                                    'success'
                                );
                                dtTable.ajax.reload(null, false);
                            },
                            error: function (res) {
                                if (res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error))
                                    Swal.fire({
                                        icon: 'error',
                                        //title: 'Oops...',
                                        text: (res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error)),
                                        //footer: '<a href="">Why do I have this issue?</a>'
                                    });
                            }
                        });
                    }
                })
            }).on('click', 'a.model-restore', function () {
                let _btn = $(this);
                Swal.fire({
                    title: 'تأكيد عملية الإستعادة ؟',
                    showDenyButton: true,
                    confirmButtonText: 'إستعادة',
                    denyButtonText: `إلغاء`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: `${_btn.data('restoreUrl')}`,
                            // success: function (res) {
                            //     dtTable.ajax.reload(null, false);
                            // },
                            error: function (res) {
                                if (res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error))
                                    toastr.error(res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error));
                            }
                        });
                    }
                })
            });


            $(document).on('click', '.btn-outline-secondary', function () {
                $('input').val('')
                dtTable.destroy();

                dtTable = $('#ajaxTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    ajax: `{{ $url }}`,
                    autoWidth: true,
                    columns: {!! json_encode($columns) !!},
                    columnDefs: [
                        {
                            targets: -1,
                            title: '@lang('layouts.actions')',
                            orderable: false,
                            render: function (data, type, row, meta) {
                                let _html = [];
                                if ('deleted_at' in row && row['deleted_at'] != null) {
                                    if (row['can_restore'])
                                        _html.push('<a href="javascript:void(0);" data-model-id="' + data + '" class="model-restore">' +
                                            feather.icons['rotate-ccw'].toSvg({class: 'font-medium-5'}) + '</a>')
                                    _html.push('<span class="text text-danger">' + row['deleted_at'] + '</span>')
                                } else {
                                    if (row['actions'] && row['actions'].length > 0) {
                                        for (let i = 0; i < row['actions'].length; i++) {
                                            // console.log(row['actions'][i]['class']);
                                            let icon = row['actions'][i]['icon'] || row['actions'][i]['text']
                                            if (row['actions'][i]['icon'])
                                                try {
                                                    icon = feather.icons[row['actions'][i]['icon']].toSvg({class: 'font-medium-5'});
                                                } catch (e) {
                                                }
                                            if (row['actions'][i]['type'] === 'ajax')
                                                _html.push('<a href="javascript:void(0);" data-url="' + row['actions'][i]['url'] + '" data-title="' + row['actions'][i]['title'] + '" class="ajax-btn">' + icon + '</a>')
                                            else if(row['actions'][i]['type'] === 'btnAjax'){
                                                _html.push(`<button type='button' data-url="${row['action'][i]['url']}" data-title="${row['action'][i]['title']}" class="ajax-btn ${row['actions'][i]['class']}">${icon}</button>`);
                                            }
                                            else
                                                _html.push('<a href="' + row['actions'][i]['url'] + '" class="' + (row['actions'][i]['class'] || '') + '">' + icon + '</a>')
                                        }
                                    }
                                    if (row['update_url'])
                                        _html.push('<a @if(isset($createPopup) && $createPopup === false) href="' + row['update_url'] + '" @else href="' + row['update_url'] + '" data-update-url="' + row['update_url'] + '" class="model-update" @endif>' +
                                            feather.icons['edit'].toSvg({class: 'font-medium-5'}) + '</a>')
                                    if (row['delete_url'])
                                        _html.push('<a href="javascript:void(0);" data-delete-url="' + row['delete_url'] + '" class="model-delete">' +
                                            feather.icons['trash-2'].toSvg({class: 'font-medium-5'}) + '</a>');
                                    if (row['restore_url'])
                                        _html.push('<a href="javascript:void(0);" data-restore-url="' + row['restore_url'] + '" class="restore">' +
                                            feather.icons['trash-2'].toSvg({class: 'font-medium-5'}) + '</a>');
                                }
                                return _html.join('&nbsp;');
                            }
                        }
                    ],
                    dom: '<"d-flex justify-content-between align-items-center mx-0 row col-12"<"col"l><"dt-action-buttons m-1 col-auto text-left"B>>rt<"d-flex justify-content-between mx-0 row"<"col-xs-12 col-sm"i><"col-xs-12 col-sm-auto"p>>',
                    responsive: true,
                    language: {
                        url: `{{ asset('admin-asset/vendors/js/tables/datatable/datatable_ar.json') }}`,
                        processing: feather.icons['refresh-cw'].toSvg({class: 'font-medium-5 mr-50'}) + "<span>@lang('layouts.loading')</span>",
                        paginate: {
                            previous: '&nbsp;',
                            next: '&nbsp;'
                        }
                    },
                    buttons: [
                        ReloadButton,
                        @if(isset($createUrl) && !empty($createUrl))
                        {
                            text: feather.icons['plus'].toSvg({class: 'mr-50 font-small-4'}) + ' New',
                            className: 'create-new btn btn-primary',
                            init: function (api, node, config) {
                                $(node).removeClass('btn-secondary');
                            },
                            action: function (e, dt, node, config) {
                                {{--@if(!isset($createPopup) || $createPopup !== false)
                                    window.ajaxCreateUpdate(dtTable, '{{ $createUrl }}', 'Add New')
                                @else--}}
                                    window.location.href = '{{ $createUrl }}'
                                {{--@endif--}}
                            }
                        },
                        @endif
                    ],
                }).on('click', 'a.model-update', function () {
                    let _btn = $(this);
                    window.ajaxCreateUpdate(dtTable, `${_btn.data('updateUrl')}`, 'تعديل')
                }).on('click', 'a.ajax-btn', function () {
                    let _btn = $(this);
                    window.ajaxCreateUpdate(dtTable, `${_btn.data('url')}`, `${_btn.data('title') || null}`, {
                        showConfirmButton: false,
                        grow: 'fullscreen',
                        position: 'top',
                    })
                }).on('click', 'a.model-delete', function () {
                    let _btn = $(this);
                    Swal.fire({
                        title: 'Delete Confirm',
                        showDenyButton: true,
                        confirmButtonText: 'Delete',
                        denyButtonText: `Cancel`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // console.log(_btn.data('deleteUrl'));
                            $.ajax({
                                type: 'DELETE',
                                url: `${_btn.data('deleteUrl')}`,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    _method: 'DELETE',
                                },
                                success: function (res) {
                                    Swal.fire(
                                        'Success!',
                                        'Saved Successfully!',
                                        'success'
                                    );
                                    dtTable.ajax.reload(null, false);
                                },
                                error: function (res) {
                                    if (res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error))
                                        Swal.fire({
                                            icon: 'error',
                                            //title: 'Oops...',
                                            text: (res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error)),
                                            //footer: '<a href="">Why do I have this issue?</a>'
                                        });
                                }
                            });
                        }
                    })
                }).on('click', 'a.model-restore', function () {
                    let _btn = $(this);
                    Swal.fire({
                        title: 'تأكيد عملية الإستعادة ؟',
                        showDenyButton: true,
                        confirmButtonText: 'إستعادة',
                        denyButtonText: `إلغاء`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: 'POST',
                                url: `${_btn.data('restoreUrl')}`,
                                // success: function (res) {
                                //     dtTable.ajax.reload(null, false);
                                // },
                                error: function (res) {
                                    if (res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error))
                                        toastr.error(res && res.responseJSON && (res.responseJSON.message || res.responseJSON.error));
                                }
                            });
                        }
                    })
                });
            });
        });

    </script>
@endsection

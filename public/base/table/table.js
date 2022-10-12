class Table {
    static check_hide_col(new_setting = {}) {
        /*
        *    Attribute in CheckBox
        *       data-display-col => col_display eq start form 0
        *       data-display-att => th att like (data-display-attr='data-name') in th data-name
        * */
        var Settings = {
            type: 'create',// type create || refresh
            containerCheckSelector: 'container_show_column',
            tableSelector:'#table_data',
        };
        $.extend(Settings, new_setting);
        $(Settings.containerCheckSelector + ' input:checkbox[data-display-col],'+Settings.containerCheckSelector + ' input:checkbox[data-display-attr]').each(function () {
            if ($(this).is('[data-display-col]'))
                var col_index = $(this).attr('data-display-col');
            else {
                var data_display_attr=$(this).attr('data-display-attr');
                var col_index=$(Settings.tableSelector).find('th['+data_display_attr+']').index();
            }
            if (col_index!=-1){
                if (Settings.type == 'create') {
                    $(this).on('change', function () {
                        var state = $(this).prop('checked');
                        $(Settings.tableSelector + ' tr').each(function () {
                            if (state)
                                $(this).children().eq(col_index).show();
                            else
                                $(this).children().eq(col_index).hide();
                        });
                    });
                }
                var state = $(this).prop('checked');
                $(Settings.tableSelector + ' tr').each(function () {
                    if (state)
                        $(this).children().eq(col_index).show();
                    else
                        $(this).children().eq(col_index).hide();
                });
            }
        });
    }

    static load(table_selector, new_setting = {}) {
        var Settings = {
            clearBody: true, //clear body html
            lang: 'ar'// en  || ar
        };
        $.extend(Settings, new_setting);

        var count_col = $(table_selector + ' thead tr:first').children().length;
        if (Settings.clearBody == true)
            $(table_selector + ' tbody').html('');

        if (Settings.lang == 'ar') var message = 'برجاء الإنتظار جارى التحميل';
        if (Settings.lang == 'en') var message = 'Loading, please wait';

        $(table_selector + ' tbody').append(
            '<tr>' +
            '<td colspan="' + count_col + '" class="text-center" >' +
            '<span>' + message + ' </span>' +
            '<div class="d-inline-block" style="max-width: 150px;">' +
            '<div class="circle"></div>' +
            '<div class="circle"></div>' +
            '<div class="circle"></div>' +
            '</div>' +
            '</td>' +
            '</tr></tbody>'
        )
    }

    static sort(table_selector = 'table.sorted') {
        $(table_selector + ':not([data-sorted="server"])').tablesort();
    }

    static filtable(table_selector = '#table_data', filter_container_selector = '#table_data_filter', function_aftertablefilter = '') {
        $(table_selector).filtable({
            controlPanel: $(filter_container_selector)
        });
        if ($.isFunction(function_aftertablefilter)) {
            $(table_selector).on('aftertablefilter', function (event) {
                function_aftertablefilter();
            });
        }
    }
}

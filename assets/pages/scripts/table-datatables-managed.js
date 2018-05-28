var TableDatatablesManaged = function () {

    var initTable1 = function () {

        var table = $('#sample_1');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_1_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable2 = function () {

        var table = $('#sample_2');

        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.
            "pagingType": "bootstrap_extended",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_2_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });
    }

    var initTable3 = function () {

        var table = $('#sample_3');

        // begin: third table
        table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "lengthMenu": [
                [6, 15, 20, -1],
                [6, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 6,
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_3_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });
    }



    var initTable4 = function () {

        var table = $('#sample_4');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_4_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }



    var initTable5 = function () {

        var table = $('#sample_5');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_5_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }



    var initTable6 = function () {

        var table = $('#sample_6');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_6_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable10 = function () {

        var table = $('#sample_10');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_10_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }



    var initTable15 = function () {

        var table = $('#sample_15');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_15_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable20 = function () {

        var table = $('#sample_20');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_20_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable30 = function () {

        var table = $('#sample_30');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_30_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable40 = function () {

        var table = $('#sample_40');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_40_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable45 = function () {

        var table = $('#sample_45');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_45_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable50 = function () {

        var table = $('#sample_50');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_50_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }

    var initTable60 = function () {

        var table = $('#sample_60');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_60_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }


    var initTable70 = function () {

        var table = $('#sample_70');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_70_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }



    var initTable80 = function () {

        var table = $('#sample_80');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_80_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }


    var initTable90 = function () {

        var table = $('#sample_90');

        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            // "language": {
            //     "aria": {
            //         "sortAscending": ": activate to sort column ascending",
            //         "sortDescending": ": activate to sort column descending"
            //     },
            //     "emptyTable": "No data available in table",
            //     "info": "Showing _START_ to _END_ of _TOTAL_ records",
            //     "infoEmpty": "No records found",
            //     "infoFiltered": "(filtered1 from _MAX_ total records)",
            //     "lengthMenu": "Show _MENU_",
            //     //"search": "Search:",
            //     "search": "Pesquisar:",
            //     "zeroRecords": "No matching records found",
            //     "paginate": {
            //         "previous":"Prev",
            //         "next": "Next",
            //         "last": "Last",
            //         "first": "First"
            //     }
            // },

            // Or you can use remote translation file
            "language": {
              url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columnDefs": [ {
                "targets": 0,
                "orderable": false,
                "searchable": false
            }],

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_90_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });
    }


    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
            initTable2();
            initTable3();
            initTable4();
            initTable5();
            initTable6();

            initTable10();//novo
            initTable15();//analise
            initTable20();//retorno
            initTable30();//impedido
            initTable40();//autorizado
            initTable45();//notificado
            initTable50();//atribuido
            initTable60();//realizado
            initTable70();//homologado
            initTable80();//homologado
            initTable90();//indeferido
        }

    };

}();

if (App.isAngularJsApp() === false) {
    jQuery(document).ready(function() {
        TableDatatablesManaged.init();
    });
}
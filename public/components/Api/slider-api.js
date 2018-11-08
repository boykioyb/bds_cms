var DatatablesDataSourceAjaxServer = {
    init: function () {
        var a;
        a = $("#m_table_1").DataTable({
            responsive: !0,
            dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
            lengthMenu: [5, 10, 25, 50],
            pageLength: 10,
            language: {
                lengthMenu: "Hiển thị _MENU_"
            },
            processing: !0,
            serverSide: !0,
            ajax: "/sliders/dataTables",
            columns: [
                {data: null},
                {data: "code"},
                {data: "name"},
                {data: "lang_code"},
                {data: "url_alias"},
                {data: "status"},
                {data: "Actions"}
            ],
            columnDefs: [{
                targets: -1, title: "Thao tác", orderable: !1, render: function (a, e, t, n) {
                    return '\n                        <span class="dropdown">\n                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true">\n                              <i class="la la-ellipsis-h"></i>\n                            </a>\n                            <div class="dropdown-menu dropdown-menu-right">\n                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\n                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\n                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\n                            </div>\n                        </span>\n                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="View">\n                          <i class="la la-edit"></i>\n                        </a>'
                }
            }, {
                targets: 5, render: function (a, e, t, n) {
                    var s = {
                        0: {title: "Đợi xét duyệt", class: "m-badge--warning"},
                        1: {title: "Thành Công", class: "m-badge--success"},
                        2: {title: "Xóa", class: " m-badge--danger"},
                    };
                    return void 0 === s[a] ? a : '<span class="m-badge ' + s[a].class + ' m-badge--wide">' + s[a].title + "</span>"
                }
            }, {
                targets: 3, render: function (a, e, t, n) {
                    var s = {
                        'vi': "Tiếng Việt",
                        'en': 'Tiếng Anh',
                    };
                    return void 0 === s[a] ? a : '<span class="text-primary">' + s[a] + '</span>'
                }
            }, {"orderable": false, "targets": [0, 1, 2, 3, 4, 5, 6]},
            ]
        }), $("#m_search").on("click", function (t) {
            t.preventDefault();
            var e = {};
            $(".m-input").each(function () {
                var a = $(this).data("col-index");
                e[a] ? e[a] += "|" + $(this).val() : e[a] = $(this).val()
            }), $.each(e, function (t, e) {
                a.column(t).search(e || "", !1, !1)
            }), a.table().draw()
        }), $("#m_reset").on("click", function (t) {
            t.preventDefault(), $(".m-input").each(function () {
                $(this).val(""), a.column($(this).data("col-index")).search("", !1, !1)
            }), a.table().draw()
        }), $("#m_datepicker").datepicker({
            todayHighlight: !0,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });

        a.on('order.dt search.dt draw.dt', function () {
            a.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i+1+a.page()*a.page.len();
            });
        }).draw();
    }
};
jQuery(document).ready(function () {
    DatatablesDataSourceAjaxServer.init()
});

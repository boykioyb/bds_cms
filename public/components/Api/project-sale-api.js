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
            ajax: "/project-sales/dataTables",
            columns: [
                {data: null},
                {data: "name"},
                {data: null},
                {data: "priority"},
                {data: "status"},
                {data: "Actions"}
            ],
            columnDefs: [{
                targets: -1, title: "Thao tác", orderable: !1, render: function (a, e, t, n) {
                    let action = '<a href="/project-sales/edit/' + t._id + '" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="sửa">';
                    action += '<i class="la la-edit"></i>';
                    action += '</a>';
                    return action
                }
            },{
                targets: 1, render: function (a, e, t, n) {
                    return void 0 === a ? a : '<span class="m-badge m-badge--primary m-badge--rounded">' + a + "</span>"
                }
            }, {
                targets: 2, render: function (a, e, t, n) {
                    let html = '<div>';
                    html += '<p>URL: <a href="' + t.url_alias + '">' + t.name + '</a></p>';
                    html += '<p>Tỉnh/Thành phố: ' + (t.city !== null ? t.city : 'Đang cập nhật')  + '</p>';
                    html += '<p>Quận/Huyện: ' + (t.district !== null ? t.district : 'Đang cập nhật') + '</p>';
                    html += '<p>Loại hình phát triển: ' + (t.type !== null ? t.type : 'Đang cập nhật') + '</p>';
                    html += '<p>Quy mô dự án: ' + (t.scale !== null ? t.scale : 'Đang cập nhật') + '</p>';
                    html += '<p>Phân khúc chức năng: ' + (t.functional !== null ? t.functional : 'Đang cập nhật') + '</p>';
                    html += '<p>Tư vấn thiết kế: ' + (t.design_consultancy !== null ? t.design_consultancy : 'Đang cập nhật') + '</p>';
                    html += '<p>Tư vấn quản lý và giám sát dự án: ' + (t.pm_mc !== null ? t.pm_mc : 'Đang cập nhật') + '</p>';
                    html += '<p>Diện tích đất nghiên cứu: ' + (t.land_area_of_study !== null ? t.land_area_of_study + ' m<sup>2</sup>' : 'Đang cập nhật') + '</p>';
                    html += '<p>Diện tích đất xây dựng: ' + (t.construction_land_area !== null ? t.construction_land_area + ' m<sup>2</sup>'  : 'Đang cập nhật') + '</p>';
                    html += '<p>Mật độ xây dựng: ' + (t.construction_density !== null ? t.construction_density + ' %' : 'Đang cập nhật') + '</p>';
                    html += '</div>';
                    return html;
                }
            },{
                targets: 3, render(a,e,t,n){
                    var s = {
                        0: 'Không ưu tiên',
                        1: 'Ưu tiên cấp 1',
                        2: 'Ưu tiên cấp 2',
                        3: 'Ưu tiên cấp 3',
                    };
                    return void 0 === s[a] ? a : '<span>' + s[a] + "</span>"
                }
            }, {
                targets: 4, render: function (a, e, t, n) {
                    var s = {
                        0: {title: "Đợi xét duyệt", class: "m-badge--warning"},
                        1: {title: "Thành Công", class: "m-badge--success"},
                        2: {title: "Xóa", class: " m-badge--danger"},
                    };
                    return void 0 === s[a] ? a : '<span class="m-badge ' + s[a].class + ' m-badge--wide">' + s[a].title + "</span>"
                }
            }, {"orderable": false, "targets": [0, 1, 2, 3, 4]},
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
                cell.innerHTML = i + 1 + a.page() * a.page.len();
            });
        }).draw();
    }
};
jQuery(document).ready(function () {
    DatatablesDataSourceAjaxServer.init()
});

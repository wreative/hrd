"use strict";

var table = $("#table").DataTable({
    pageLength: 10,
    processing: true,
    serverSide: true,
    responsive: true,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Semua"]
    ],
    ajax: {
        url: "/employee",
        type: "GET",
        data: function(d) {
            d.filter_period = $("#filter_period").val();
        }
    },
    dom: '<"html5buttons">lBrtip',
    columns: [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        { data: "code" },
        { data: "name" },
        { data: "division" },
        { data: "position" },
        { data: "long_month" },
        { data: "salary" },
        { data: "status" },
        { data: "action", orderable: false, searchable: true }
    ],
    buttons: [
        {
            extend: "print",
            text: "Print Semua",
            exportOptions: {
                modifier: {
                    selected: null
                },
                columns: ":visible"
            },
            messageTop: "Dokumen dikeluarkan tanggal " + moment().format("L"),
            // footer: true,
            header: true
        },
        {
            extend: "csv"
        },
        {
            extend: "print",
            text: "Print Yang Dipilih",
            exportOptions: {
                columns: ":visible"
            }
        },
        {
            extend: "excelHtml5",
            exportOptions: {
                columns: ":visible"
            }
        },
        {
            extend: "pdfHtml5",
            exportOptions: {
                columns: [0, 1, 2, 5]
            }
        },
        {
            extend: "colvis",
            postfixButtons: ["colvisRestore"],
            text: "Sembunyikan Kolom"
        }
    ]
});

$(".filter_name").on("keyup", function() {
    table.search($(this).val()).draw();
});
$(".filter_status").on("change", function() {
    table
        .column($(this).data("column"))
        .search($(this).val())
        .draw();
});
$("#filter_period").on("change", function() {
    table.draw();
});

function del(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan. Apakah ingin melanjutkan?",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then(willDelete => {
        if (willDelete) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                url: "/employee/" + id,
                type: "DELETE",
                success: function() {
                    swal("Data karyawan berhasil dihapus", {
                        icon: "success"
                    });
                    table.draw();
                }
            });
        } else {
            swal("Data karyawan Anda tidak jadi dihapus!");
        }
    });
}

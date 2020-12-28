"use strict";

$(".currency")
    .toArray()
    .forEach(function(field) {
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: "thousand"
        });
    });

function check(argument) {
    var id = $("#karyawan").val();
    $.ajax({
        url: "/salary/check",
        data: { id: id },
        type: "GET",
        success: function(data) {
            var tgl = data.karyawan[0]["tgl"];
            var nama = data.karyawan[0]["nama"];
            var dedikasi = data.karyawan[0]["dedikasi"];
            var loyalitas = data.karyawan[0]["loyalitas"];
            var gaji = data.karyawan[0]["gaji"];
            const wrapper = document.createElement("div");
            wrapper.innerHTML =
                "<table class='table table-hover'><thead><tr><th scope='col'>Nama</th><th scope='col'>Detail</th></tr></thead><tbody><tr><th scope='row'>Tanggal</th><td>" +
                moment(tgl).format("DD-MM-YYYY") +
                "</td></tr><tr><th scope='row'>Gaji</th><td>Rp." +
                numberWithCommas(gaji) +
                "</td></tr><tr><th scope='row'>Dedikasi</th><td>Rp." +
                numberWithCommas(dedikasi) +
                "</td></tr><tr><th scope='row'>Loyalitas</th><td>Rp." +
                numberWithCommas(loyalitas) +
                "</td></tr></tbody></table>";
            swal({
                title: "Data " + nama,
                content: wrapper,
                icon: "info",
                button: "Tutup"
            });
        }
    });
}

function numberWithCommas(x) {
    if (x == null) {
        return 0;
    } else {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
}

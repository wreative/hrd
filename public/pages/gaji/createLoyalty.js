"use strict";

$(function() {
    $(
        "#absen,#waktu,#uniform,#sop,#tj,#kt,#loyalitas,#amanah,#produktif,#tw,#dedikasi"
    ).on("keyup", function() {
        var absen = parseInt($("#absen").val()) || 0;
        var waktu = parseInt($("#waktu").val()) || 0;
        var uniform = parseInt($("#uniform").val()) || 0;
        var sop = parseInt($("#sop").val()) || 0;
        var tj = parseInt($("#tj").val()) || 0;
        var kt = parseInt($("#kt").val()) || 0;
        var amanah = parseInt($("#amanah").val()) || 0;
        var produktif = parseInt($("#produktif").val()) || 0;
        var tw = parseInt($("#tw").val()) || 0;
        $("#loyalitas").val(absen + waktu + uniform + sop + tj + kt);
        $("#dedikasi").val(amanah + produktif + tw);
    });
});

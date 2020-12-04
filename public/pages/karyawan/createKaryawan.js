"use strict";

var cleave = new Cleave(".currency", {
    numeral: true,
    numeralThousandsGroupStyle: "thousand"
});

var cleave = new Cleave(".nik", {
    blocks: [16],
    numericOnly: true
});

var cleave = new Cleave(".tlp", {
    prefix: "+62",
    delimiter: " ",
    phone: true,
    phoneRegionCode: "id"
});

$("#foto").on("change", function() {
    var filename = this.files[0].name;
    $("#foto_label").html(filename);
});

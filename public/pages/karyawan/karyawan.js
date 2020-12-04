"use strict";

$("#karyawan").dataTable({
    responsive: true,
    columnDefs: [{ sortable: false, targets: [6] }]
});

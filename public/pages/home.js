"use strict";

var ctx = document.getElementById("absensi").getContext("2d");
var myChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ],
        datasets: [
            {
                label: "Statistics",
                data: [
                    460,
                    458,
                    330,
                    502,
                    430,
                    610,
                    488,
                    343,
                    343,
                    575,
                    543,
                    965
                ],
                borderWidth: 2,
                backgroundColor: "#6777ef",
                borderColor: "#6777ef",
                borderWidth: 2.5,
                pointBackgroundColor: "#ffffff",
                pointRadius: 4
            }
        ]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            yAxes: [
                {
                    gridLines: {
                        drawBorder: false,
                        color: "#f2f2f2"
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 150
                    }
                }
            ],
            xAxes: [
                {
                    ticks: {
                        display: false
                    },
                    gridLines: {
                        display: false
                    }
                }
            ]
        }
    }
});

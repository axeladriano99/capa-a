$(document).ready(function() {
	$('#li-dashboard').addClass('active');


	/************SALES ANALYTICS*****************/
	var amchart = AmCharts.makeChart("sales-analytics", {
		"type": "serial",
		"theme": "light",
		"marginTop": 0,
		"marginRight": 0,
		"dataProvider": [
			{
				"year": "1970",
				"value": -0.068
			},
			{
				"year": "1971",
				"value": -0.19
			},
			{
				"year": "1972",
				"value": -0.056
			},
			{
				"year": "1973",
				"value": 0.077
			},
			{
				"year": "1974",
				"value": -0.213
			},
			{
				"year": "1975",
				"value": -0.17
			},
			{
				"year": "1976",
				"value": -0.254
			},
			{
				"year": "1977",
				"value": 0.019
			},
			{
				"year": "1978",
				"value": -0.063
			},
			{
				"year": "1979",
				"value": 0.05
			},
			{
				"year": "1980",
				"value": 0.077
			},
			{
				"year": "1981",
				"value": 0.12
			},
			{
				"year": "1982",
				"value": 0.011
			},
			{
				"year": "1983",
				"value": 0.177
			},
			{
				"year": "1984",
				"value": -0.021
			},
			{
				"year": "1985",
				"value": -0.037
			},
			{
				"year": "1986",
				"value": 0.03
			},
			{
				"year": "1987",
				"value": 0.179
			},
			{
				"year": "1988",
				"value": 0.18
			},
			{
				"year": "1989",
				"value": 0.104
			},
			{
				"year": "1990",
				"value": 0.255
			},
			{
				"year": "1991",
				"value": 0.21
			},
			{
				"year": "1992",
				"value": 0.065
			},
			{
				"year": "1993",
				"value": 0.11
			},
			{
				"year": "1994",
				"value": 0.172
			},
			{
				"year": "1995",
				"value": 0.269
			},
			{
				"year": "1996",
				"value": 0.141
			},
			{
				"year": "1997",
				"value": 0.353
			},
			{
				"year": "1998",
				"value": 0.548
			},
			{
				"year": "1999",
				"value": 0.298
			},
			{
				"year": "2000",
				"value": 0.267
			},
			{
				"year": "2001",
				"value": 0.411
			},
			{
				"year": "2002",
				"value": 0.462
			},
			{
				"year": "2003",
				"value": 0.47
			},
			{
				"year": "2004",
				"value": 0.445
			},
			{
				"year": "2005",
				"value": 0.47
			},
			{
				"year": "2006",
				"value": -0.307
			},
			{
				"year": "2007",
				"value": -0.168
			},
			{
				"year": "2008",
				"value": -0.073
			},
			{
				"year": "2009",
				"value": -0.027
			},
			{
				"year": "2010",
				"value": -0.251
			},
			{
				"year": "2011",
				"value": -0.281
			},
			{
				"year": "2012",
				"value": -0.348
			},
			{
				"year": "2013",
				"value": -0.074
			},
			{
				"year": "2014",
				"value": -0.011
			},
			{
				"year": "2015",
				"value": -0.074
			},
			{
				"year": "2016",
				"value": -0.124
			},
			{
				"year": "2017",
				"value": -0.024
			},
			{
				"year": "2018",
				"value": -0.022
			},
			{
				"year": "2019",
				"value": 0
			},
			{
				"year": "2020",
				"value": -0.296
			},
			{
				"year": "2021",
				"value": -0.217
			},
			{
				"year": "2022",
				"value": -0.147
			}
		],
		"valueAxes": [{
			"axisAlpha": 0,
			"gridAlpha": 0,
			"position": "left"
		}],
		"graphs": [{
			"id": "g1",
			"balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
			"bullet": "round",
			"bulletSize": 8,
			"lineColor": "#fe5d70",
			"lineThickness": 2,
			"negativeLineColor": "#fe9365",
			"type": "smoothedLine",
			"valueField": "value"
		}],
		"chartScrollbar": {
			"graph": "g1",
			"gridAlpha": 0,
			"color": "#888888",
			"scrollbarHeight": 55,
			"backgroundAlpha": 0,
			"selectedBackgroundAlpha": 0.1,
			"selectedBackgroundColor": "#888888",
			"graphFillAlpha": 0,
			"autoGridCount": true,
			"selectedGraphFillAlpha": 0,
			"graphLineAlpha": 0.2,
			"graphLineColor": "#c2c2c2",
			"selectedGraphLineColor": "#888888",
			"selectedGraphLineAlpha": 1

		},
		"chartCursor": {
			"categoryBalloonDateFormat": "YYYY",
			"cursorAlpha": 0,
			"valueLineEnabled": true,
			"valueLineBalloonEnabled": true,
			"valueLineAlpha": 0.5,
			"fullWidth": true
		},
		"dataDateFormat": "YYYY",
		"categoryField": "year",
		"categoryAxis": {
			"minPeriod": "YYYY",
			"parseDates": true,
			"gridAlpha": 0,
			"minorGridAlpha": 0,
			"minorGridEnabled": true
		},
		"export": {
			"enabled": true
		}
	});
	amchart.addListener("rendered", zoomChart);
	if (amchart.zoomChart) {
		amchart.zoomChart();
	}

	function zoomChart() {
		amchart.zoomToIndexes(Math.round(amchart.dataProvider.length * 0.4), Math.round(amchart.dataProvider.length * 0.55));
	}
	/*************END SALES ANALYTICS*********************/

	/********************DoughnutChart***********************/
	var ctx = document.getElementById("newuserchart");

	var data = {
		labels: ["Al dia", "Pendientes", "En mora"],
		datasets: [
			{
				data: [85, 6, 9],
				backgroundColor: [
					"#1ABC9C",
					"#E8CA0F",
					"#E05A76"
				],
				borderWidth: [
					"5px",
					"5px",
					"5px"
				],
				borderColor: [
					"#13B213",
					"#C2A906",
					"#BF032B"
				]
			}
		]
	};

	var myDoughnutChart = new Chart(ctx, {
		type: 'doughnut',
		data: data
	});

    /********************END DoughnutChart***********************/

    /********************Total Leads***********************/

    function e() {
        return {
            title: { display: !1 },
            tooltips: { intersect: !1, mode: "nearest", xPadding: 10, yPadding: 10, caretPadding: 10 },
            legend: { display: !1 },
            hover: { mode: "index" },
            scales: { xAxes: [{ display: !1, gridLines: !1, scaleLabel: { display: !0, labelString: "Month" } }], yAxes: [{ display: !1, gridLines: !1, scaleLabel: { display: !0, labelString: "Value" }, ticks: { min: 1, max: 50 } }] },
            elements: { point: { radius: 4, borderWidth: 12 } },
            layout: { padding: { left: 0, right: 0, top: 0, bottom: 0 } },
        };
    }
    function t(e, t, a) {
        return (
            null == a && (a = "rgba(0,0,0,0)"),
            {
                labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14"],
                datasets: [
                    {
                        label: "",
                        borderColor: e,
                        borderWidth: 3,
                        hitRadius: 30,
                        pointRadius: 0,
                        pointHoverRadius: 4,
                        pointBorderWidth: 2,
                        pointHoverBorderWidth: 12,
                        pointBackgroundColor: Chart.helpers.color("#000000").alpha(0).rgbString(),
                        pointBorderColor: e,
                        pointHoverBackgroundColor: e,
                        pointHoverBorderColor: Chart.helpers.color("#000000").alpha(0.1).rgbString(),
                        fill: !0,
                        lineTension: 0,
                        backgroundColor: Chart.helpers.color(a).alpha(0.7).rgbString(),
                        data: t,
                    },
                ],
            }
        );
    }

    var gttll = document.getElementById("tot-lead").getContext("2d");

    chartO = new Chart(gttll, {
    	type: "line",
    	data: t("#01a9ac", [30, 15, 25, 35, 30, 20, 15, 20, 25, 40, 25, 30, 22, 31], "#01a9ac"),
    	options: e()
    });


    /********************END Total Leads***********************/

    






    



});
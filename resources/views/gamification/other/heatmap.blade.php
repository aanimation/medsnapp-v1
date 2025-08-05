<div class="row mt-4 mb-2">
	<div class="col-12">
		<div class="card with-border">
			<div class="card-header pb-0 p-3 ps-4">
				<h6 class="mb-0">Heatmap</h6>
			</div>
			<div class="card-body overflow-x-auto p-3">
				<div class="max-height-100" id="heatmap-chart"></div>
			</div>
		</div>
	</div>
</div>

@push('js')
<script src="{{ asset('assets') }}/js/plugins/apexcharts.js"></script>

<script>
    function generateData(count, yrange) {
		var i = 0;
		var series = [];
		while (i < count) {
		  var xVal = (i + 1).toString();
		  var yVal = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

		  series.push({x: xVal, y: yVal});
		  i++;
		}
		return series;
	}

	function getDateFromISOWeek(day, week) {
		const yearFormatted = 2024;
  	    const custom = new Date(Date.UTC(yearFormatted, 0, 4));
  	    const firstMonday = new Date(
    	    custom.setUTCDate(custom.getUTCDate() - (custom.getUTCDay() === 0 ? 6 : custom.getUTCDay() - 1))
        );

        const targetDate = new Date(firstMonday);
        targetDate.setUTCDate(targetDate.getUTCDate() + (week - 1) * 7 + (day - 1));
        const dayFormatted = String(targetDate.getUTCDate()).padStart(2, '0');
        const monthFormatted = String(targetDate.getUTCMonth() + 1).padStart(2, '0');
        // const yearFormatted = targetDate.getUTCFullYear();

        return dayFormatted + '-' + monthFormatted + '-' + yearFormatted;
	}

	var optionsHeatmap = {
        series: <?php echo $series ?>,
        chart: { height: 280, type: 'heatmap', toolbar: { show: false } },
  	    dataLabels: { enabled: false, style: { colors: ['#F44336', '#E91E63', '#9C27B0'] } },
  	    colors: ["#5007b2"],
        grid: { show: false },
	    //title: { text: 'Activities (Last 1 year)', style: { color: '#FFFFFF'}, },
	    yaxis: { reversed: true, labels: { style: { colors: '#FFFFFF', }} }, /* daily */
        xaxis: {  /* months */
            labels: { style: { colors: '#000000', fontSize: '0px',}},
            position: 'top',
            tooltip: { enabled: false },
            axisTicks: { show: false },
            axisBorder: { show: false },
            type: 'category',
            group: {
                style: { colors: '#FFFFFF' },
                groups: <?php echo $groups ?>,
              }
        },
	    tooltip: {
	  	    enabled: true,
            followCursor: true,
            fillSeriesColor: false,
            hideEmptySeries: true,
            theme: 'dark',
            style: {
      	        colors: '#000000',
                fontSize: '12px',
            },
            x: {
                show: true,
                formatter: function(val, idx) {
                    return getDateFromISOWeek(idx.seriesIndex + 1, val)
                }
            },
            y: {
                title: {
                    formatter: (val) => 'Activities:',
                },
            },
        },
        stroke: {
            show: true,
            colors: ['#1f283e', '#000000'],
            linecap: 'round',
            width: 6,
            dashArray: 0,
		},
        plotOptions: {
            heatmap: {
                radius: 10,
            }
        },
		legend: { show: false },
        responsive: [
            {
                breakpoint: 426,
                options: {
                    // xaxis: {
                    //     group: { style: { fontSize: '6px', colors:'#FFFFFF' }}
                    // },
                    // yaxis: {
                    //     labels: { style: { fontSize: '6px', colors:'#FFFFFF' }}
                    // },
                    stroke: {
                        width: 3,
                    },
                    plotOptions: {
                        heatmap: {
                            radius: 6,
                        }
                    },
                    chart: { height: 230, width: 1200, offsetX: -10 }
                }
            },
            {
                breakpoint: 769,
                options: {
                    stroke: {
                        width: 3,
                    },
                    plotOptions: {
                        heatmap: {
                            radius: 6,
                        }
                    },
                    chart: { height: 230, width: 1200, offsetX: -10 }
                }
            },
            {
                breakpoint: 1025,
                options: {
                    stroke: {
                        width: 3,
                    },
                    plotOptions: {
                        heatmap: {
                            radius: 4,
                        }
                    },
                    chart: { height: 200 }
                }
            },
            {
                breakpoint: 1441,
                
                options: {
                    plotOptions: {
                        heatmap: {
                            radius: 6,
                        }
                    },
                    chart: { height: 230 }
                }
            },
            {
                breakpoint: 1921,
                options: {
                    plotOptions: {
                        heatmap: {
                            radius: 10,
                        }
                    },
                    chart: { height: 280 }
                }
            },
            {
                breakpoint: 2561,
                options: {
                    plotOptions: {
                        heatmap: {
                            radius: 14,
                        }
                    },
                    chart: { height: 350 }
                }
            }
        ]
    };

    var chart = new ApexCharts(document.querySelector("#heatmap-chart"), optionsHeatmap);
    chart.render();

</script>
@endpush
{{-- DEPRECATED --}}

<div class="row mt-4 mb-2">
	<div class="col-12">
		<div class="card">
			<div class="card-header pb-0 p-3 ps-4">
				<h6 class="mb-0">Heatmap</h6>
			</div>
			<div class="card-body p-3">
				<div id="heatmap-chart"></div>
			</div>
		</div>
	</div>
</div>

@push('js')
<script src="{{ asset('assets') }}/js/plugins/apexcharts.js"></script>

<script>
	function getDateFromISOWeek(day, week) {
		const yearFormatted = 2024;
  	const jan4 = new Date(Date.UTC(yearFormatted, 0, 4));
  	const firstMonday = new Date(
    	jan4.setUTCDate(jan4.getUTCDate() - (jan4.getUTCDay() === 0 ? 6 : jan4.getUTCDay() - 1))
  	);

  	const targetDate = new Date(firstMonday);
  	targetDate.setUTCDate(targetDate.getUTCDate() + (week - 1) * 7 + (day - 1));

  	const dayFormatted = String(targetDate.getUTCDate()).padStart(2, '0');
  	const monthFormatted = String(targetDate.getUTCMonth() + 1).padStart(2, '0');
  	// const yearFormatted = targetDate.getUTCFullYear();

  	return dayFormatted + '-' + monthFormatted + '-' + yearFormatted;
	}

	function generateData(count, yrange) {
		var i = 0;
		var series = [];
		while (i < count) {
		  var x = (i + 1).toString();
		  var y =
		  Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

		  series.push({
		    x: x,
		    y: y
		  });
		  i++;
		}
		// console.log(series);
		return series;
	}

	var optionsHeatmap = {
    series: [
    	{
		    name: 'Mon',
		    data: generateData(52, { min: 0, max: 30 })
		  },
		  {
		    name: 'Tue',
		    data: generateData(52, { min: 0, max: 30 })
		  },
		  {
		    name: 'Wed',
		    data: generateData(52, { min: 0, max: 30 })
		  },
		  {
		    name: 'Thu',
		    data: generateData(52, { min: 0, max: 30 })
		  },
		  {
		    name: 'Fri',
		    data: generateData(52, { min: 0, max: 30 })
		  },
		  {
		    name: 'Sat',
		    data: generateData(52, { min: 0, max: 30 })
		  },
		  {
		    name: 'Sun',
		    data: generateData(52, { min: 0, max: 30 })
		    // data: [{x:"1",y:1},{x:"2",y:30},{x:"3",y:0},{x:"4",y:0},{x:"5",y:0},{x:"6",y:0},{x:"7",y:0},{x:"8",y:0},{x:"9",y:0},{x:"10",y:0},{x:"11",y:0},{x:"12",y:0},{x:"13",y:0},{x:"14",y:30},{x:"15",y:0},{x:"16",y:0},{x:"17",y:0},{x:"18",y:0},{x:"19",y:0},{x:"20",y:0},{x:"21",y:0},{x:"22",y:0},{x:"23",y:0},{x:"24",y:0},{x:"1",y:0},{x:"2",y:30},{x:"3",y:0},{x:"4",y:0},{x:"5",y:0},{x:"6",y:0},{x:"7",y:0},{x:"8",y:0},{x:"9",y:0},{x:"10",y:0},{x:"11",y:0},{x:"12",y:0},{x:"13",y:0},{x:"14",y:30},{x:"15",y:0},{x:"16",y:0},{x:"17",y:0},{x:"18",y:0},{x:"19",y:0},{x:"20",y:0},{x:"21",y:0},{x:"22",y:0},{x:"23",y:0},{x:"24",y:0},{x:"24",y:0},{x:"24",y:0},{x:"24",y:0},{x:"24",y:0}]
		  }
  	],
    chart: { height: 250, type: 'heatmap', toolbar: { show: false } },
  	dataLabels: { enabled: false, style: { colors: ['#F44336', '#E91E63', '#9C27B0'] } },
  	colors: ["#5007b2"],
	  title: { text: 'Activities (Last 1 year)', style: { color: '#FFFFFF'}, },
	  yaxis: { reversed: true, labels: { style: { colors: '#FFFFFF', }} }, /* daily */
	  xaxis: {  /* months */
	  	labels: { style: { colors: '#000000', fontSize: '0px',}},
	  	position: 'top',
	  	tooltip: { enabled: false },
	  	type: 'category',
	  	group: {
	  		style: { colors: '#FFFFFF' },
        groups: [
        	{ title: 'Jan', cols: 4 },
          { title: 'Feb', cols: 4 },
          { title: 'Mar', cols: 5 },
          { title: 'Apr', cols: 4 },
          { title: 'May', cols: 5 },
          { title: 'Jun', cols: 4 },
          { title: 'Jul', cols: 4 },
          { title: 'Aug', cols: 5 },
          { title: 'Sep', cols: 4 },
          { title: 'Oct', cols: 5 },
          { title: 'Nop', cols: 4 },
          { title: 'Des', cols: 4 },
        ],
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
      // custom: function({series, seriesIndex, dataPointIndex, w}) {
    	// 	return '<div class="text-white">' +
      // 					'<span>' + series[seriesIndex][dataPointIndex] + '</span>' +
      // 					'</div>'
  		// },
      x: {
          show: true,
          // format: "DD",
          formatter: function(val, idx) {
          		return getDateFromISOWeek(idx.seriesIndex + 1, val)
              // return "Day " + (idx.seriesIndex + 1)  + " on week " + val
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
		legend: { show: false }
  };

  var chart = new ApexCharts(document.querySelector("#heatmap-chart"), optionsHeatmap);
  chart.render();

</script>
@endpush
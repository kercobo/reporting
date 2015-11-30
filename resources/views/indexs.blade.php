@extends ('layouts.index')
@section('page_heading','Home')
@section('section')
<div class="col-sm-12">	
	<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
	<script src="/home/soran/work/laravel/report/resource/assets/script/chart.js"></script>
	
	<div class="row">
	
		</div>
		
		<div class="col-sm-6" align="">
			
	
	</div>
<script src="//cdn.jsdelivr.net/spinjs/1.3.0/spin.min.js"></script>
<div class="row">
    <div class="col-md-12" align="center">
        <h1>Cakupan Pelayanan Bulan ini</h1>

    </div>
</div>
<br><br><br><br>
<div class="row">
    <div class="col-lg-12">
        <div id="stats-container" align="center" style="height: 250px;"><b>Cakupan K1 Bulan ini</b></div>
    </div>
</div>
<br><br><br><br>
<div class="row">
    <div class="col-lg-12">
        <div id="k4" align="center" style="height: 250px;"><b>Cakupan K4 Bulan ini</b></div>
    </div>
</div>
<script>
    $(function () {

        // Define the area for the spinner
        var spinTarget = document.getElementById('stats-container');

        // Create a function that will handle AJAX requests
        function requestData(days, chart) {
            // Activate the spinner
            var spinner = new Spinner().spin(spinTarget);

            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "./api", // This is the URL to the API
                data: { days: days }
            })
                .done(function (data) {
                    // When the response to the AJAX request comes back render the chart with new data
                    chart.setData(data);
                })
                .fail(function () {
                    // If there is no communication between the server, show an error
                    alert("error occured");
                })
                .always(function () {
                    // No matter if request is successful or not, stop the spinner
                    spinner.stop();
                });
        }

        var chart = Morris.Bar({
            // ID of the element in which to draw the chart.
            resize:true,
            gridTextSize:'12px',
            barGap:1,
            barSizeRatio:0.5,
            element: 'stats-container',
            data: [0, 0], // Set initial data (ideally you would provide an array of default data)
            xkey: 'dusun', // Set the key for X-axis
            ykeys: ['jumlah'], // Set the key for Y-axis
            labels: ['jumlah'] // Set the label when bar is rolled over
        });

        // Request initial data 
        requestData(31, chart);

        $('ul.ranges a').click(function (e) {
            e.preventDefault();

            // Get the number of days from the data attribute
            var el = $(this);
            days = el.attr('data-range');

            // Request the data and render the chart using our handy function
            requestData(days, chart);

            // Make things pretty to show which button/tab the user clicked
            el.parent().addClass('active');
            el.parent().siblings().removeClass('active');
        })
    });
</script>

<script>
    $(function () {

        // Define the area for the spinner
        var spinTarget = document.getElementById('k4');

        // Create a function that will handle AJAX requests
        function requestData(days, chart) {
            // Activate the spinner
            var spinner = new Spinner().spin(spinTarget);

            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "./apik4", // This is the URL to the API
                data: { days: days }
            })
                .done(function (data) {
                    // When the response to the AJAX request comes back render the chart with new data
                    chart.setData(data);
                })
                .fail(function () {
                    // If there is no communication between the server, show an error
                    alert("error occured");
                })
                .always(function () {
                    // No matter if request is successful or not, stop the spinner
                    spinner.stop();
                });
        }

        var chart = Morris.Bar({
            // ID of the element in which to draw the chart.
            resize:true,
            gridTextSize:'15px',
            barGap:1,
            barSizeRatio:0.5,
            element: 'k4',
            data: [0, 0], // Set initial data (ideally you would provide an array of default data)
            xkey: 'dusun', // Set the key for X-axis
            ykeys: ['jumlah'], // Set the key for Y-axis
            labels: ['jumlah'], // Set the label when bar is rolled over
           
        });

        // Request initial data 
        requestData(31, chart);

        $('ul.ranges a').click(function (e) {
            e.preventDefault();

            // Get the number of days from the data attribute
            var el = $(this);
            days = el.attr('data-range');

            // Request the data and render the chart using our handy function
            requestData(days, chart);

            // Make things pretty to show which button/tab the user clicked
            el.parent().addClass('active');
            el.parent().siblings().removeClass('active');
        })
    });
</script>
	
</div>

@stop

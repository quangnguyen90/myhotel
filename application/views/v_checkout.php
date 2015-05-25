<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Hotel - Check Out</title>

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<script type="text/javascript">
		var datefield=document.createElement("input")
		datefield.setAttribute("type", "date")
		    if (datefield.type!="date"){ //if browser doesn't support input type="date", load files for jQuery UI Date Picker
		    	document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n')
		    document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n')
		    document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n') 
		}
	</script>

	<script>
if (datefield.type!="date"){ //if browser doesn't support input type="date", initialize date picker widget:
    jQuery(function($){ //on document.ready
    	$('#ngay_ra').datepicker();
    })
}
</script>
</head>
<body>
	<div class="container">
		<div class="row">
			<h1 class="text-center">Check Out</h1>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<h3>CheckOut Form</h3>
				<a href="http://localhost/myhotel/index.php/room_rent/checkIn">Go to CheckIn</a>
				<?php  if($this->uri->segment(3) != "x") echo ($checkOutForm); ?>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<h3>Guest Room</h3>
				<?php echo($phongCoKhach); ?>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title></title>

	<style type="text/css">
		@media print{
			@page{
				size: 101.6mm 101.6mm !important;
			}
			@page :footer {
        display: none
    }
 
    @page :header {
        display: none
    }

        .container {page-break-after: always;}
		}
	</style>
</head>
<body>
@foreach($data as $ans)
<div class="container">
	<div class="row">
		<!--<p align="center" style="margin-top:0px;">-->
		<!--	<img src="{{config('app.baseURL')}}/assets/images/kdmc-logo.png" style="width: 80px;margin-bottom: 0px;">-->
		<!--</p>-->
		<h3 align="center" style="font-size: 18px;margin-top:10px;">MANCHAR NAGARPANCHAYAT</h3>
			<?php $data1="Id :".$ans->id."\nAddress :".$ans->address."";?>
			
			<p align="center">
				{!! QrCode::size(100)->generate($data1) !!}
			</p><br>
			<p align="center" style="font-size: 14px;margin-top: -15px;">Area Name : {{$ans->address}}</p>
	</div>
</div>
@endforeach
</body>
<script type="text/javascript">
	$(document).ready(function(){
		window.print();
		history.back();
	});
</script>
</html>
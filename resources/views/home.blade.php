@extends('layout.app') 
@section('content') 

<div class="container-fluid p-5 bg-light border border-1 text-center">
	<h3 class="text-center">Welcome to UTas Smart Spend</h3>
	<span>Utas SmartSpend (USS) is a web-based expense management system designed specifically for the University of Tasmania
	</span>
</div>

<div class="container p-5">
	<div class="row">
		<h4 class="text-center mb-5">UTas Smart Spend (USS) is :</h4>

		<div class="col-sm-4 text-center">
			<img class="thumbnailImage" src="images/img1.png" alt="" srcset="">
			<br><br>
			<span>User Friendly</span>
		</div>

		<div class="col-sm-4 text-center rounded-circle">
			<img class="thumbnailImage" src="images/img2.jpg" alt="" srcset="">  
			<br><br>      
			<span>Report Generation</span>
		</div>

		<div class="col-sm-4 text-center">
			<img class="thumbnailImage" src="images/img3.png" alt="" srcset="">
			<br><br>
			<span>Increased Efficiency</span>
		</div>

	</div>
</div>
@endsection

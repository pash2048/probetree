<?php
error_reporting(1);

if(!isset($_GET["keyword"])){
	notissetUi();
}else{
	require_once("process.php");
	issetUi();
}

function notissetUi(){
		echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Probe Tree</title>
<link rel="icon" href="img/favi.png">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
<link rel="stylesheet" href="css/main.css">

</head>

<body onResize="res()">
	<div class="logo">
	 <div class="column_center">
		<form method="get"> 
			<div class="input-group">
				<input autocomplete="off" type="text" id="keyword" name="keyword" class="form-control" autofocus oninput="changecolor()" maxlength="250">
				<div class="input-group-append">
					<button id="bt" type="submit" class="btn"><i class="fas fa-search"></i></button>
				</div>
			</div>
		</form>
	 </div>
		<div id="google">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500">
	<path class="g1" style="fill:#FFFFFF;" d="M110.811,302.156l-17.404,64.973l-63.612,1.346C10.783,333.214,0,292.871,0,250
		c0-41.456,10.082-80.55,27.953-114.973h0.014L84.6,145.41l24.809,56.293c-5.192,15.138-8.022,31.388-8.022,48.297
		C101.388,268.352,104.712,285.935,110.811,302.156z"/>
	<path class="g1" style="fill:#FFFFFF;" d="M495.632,203.297C498.503,218.42,500,234.038,500,250c0,17.898-1.882,35.357-5.467,52.198
		c-12.17,57.308-43.97,107.349-88.021,142.761l-0.014-0.014l-71.332-3.64l-10.096-63.021c29.23-17.143,52.074-43.97,64.107-76.085
		H255.496v-98.902h135.632L495.632,203.297L495.632,203.297z"/>
	<path class="g1" style="fill:#FFFFFF;" d="M406.497,444.945l0.014,0.014C363.668,479.396,309.244,500,250,500
		c-95.206,0-177.98-53.214-220.206-131.524l81.017-66.318c21.112,56.346,75.467,96.456,139.189,96.456
		c27.39,0,53.05-7.404,75.068-20.33L406.497,444.945z"/>
	<path class="g1" style="fill:#FFFFFF;" d="M409.574,57.555l-80.989,66.305c-22.788-14.244-49.726-22.473-78.585-22.473
		c-65.165,0-120.536,41.95-140.591,100.316l-81.442-66.676h-0.014C69.561,54.808,153.379,0,250,0
		C310.659,0,366.277,21.607,409.574,57.555z"/>
</svg>
		</div>
		<div id="bing">
<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 402 500">
<polygon id="b1" style="fill:#FFFFFF;" points="149.316,126.75 201.277,246.211 272.176,274.593 3.347,423.923 118.002,306.637 
	118.002,47.93 0.17,0 0.17,427.174 119.477,500 402.385,330.995 402.385,213.862 "/>
</svg>
		</div>
		<div id="yahoo">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 537 500">
<path id="y1" style="fill:#FFFFFF;" d="M529.43,62.105h-0.006H318.281c-2.136,0-4.172,0.901-5.607,2.482
	c-1.435,1.582-2.137,3.693-1.933,5.821l4.117,42.686c0.36,3.726,3.386,6.63,7.124,6.835l44.11,2.427l-84.691,117.511L189.045,55.864
	l66.677-2.549c4.032-0.153,7.234-3.436,7.286-7.47l0.487-38.174c0.023-2.026-0.762-3.978-2.184-5.419
	C259.888,0.812,257.948,0,255.921,0H7.495C3.31,0-0.079,3.389-0.079,7.575V50.12c0,4.14,3.325,7.514,7.464,7.574l70.195,1.011
	l133.49,235.484l-0.596,147.072l-92.814,3.809c-4.004,0.163-7.185,3.419-7.262,7.423l-0.751,39.343
	c-0.039,2.034,0.743,3.996,2.17,5.45c1.422,1.451,3.369,2.267,5.403,2.267h290.319c2.078,0,4.065-0.853,5.496-2.36
	c1.43-1.505,2.18-3.533,2.07-5.608l-2.028-38.951c-0.202-3.873-3.294-6.966-7.17-7.168l-79.852-4.187L314.43,298.021l143.35-172.727
	l58.365-2.654c3.213-0.149,5.984-2.31,6.91-5.391l13.542-45.125c0.26-0.765,0.404-1.59,0.404-2.446
	C537,65.497,533.614,62.105,529.43,62.105z"/>
</svg>
		</div>
	</div>
	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/main.js"></script>

</body>
</html>
';
}


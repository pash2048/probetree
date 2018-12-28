<?php
function prepare_string_url($str){
    $str = trim($str);
    $str = urldecode($str);
    $str = strtolower($str);
    $str = strip_tags($str);
    $search = array(
        'http://',
        'https://',
        'www.'
    );
    $str = str_replace($search, '', $str);
    if($str[strlen($str) - 1] == '/'){
        $str = substr_replace($str, '', strlen($str) - 1);
    }
    return $str;
}

function headingsPreparing(){
    global $aForGoogle;
    //Google has html tags in its source
    for($i = 0; $i < count($aForGoogle); $i++){ //4 google
        $aForGoogle[$i][1] = strip_tags($aForGoogle[$i][1]);
    }
}

function ThreeIterates(){
    global $bingRating4google;
    global $yahooRating4google;
    global $aForGoogle;
    ///google 2 iterate
    $ThreeIterate = [];
    foreach ($bingRating4google as $key => $value) {
        if(!isset($yahooRating4google[$key])){
            continue;
        }
        else{
            //key + 1 = googleRate | value + 1 = bingRate | $yahooRating4google[$key] + 1 = yahooRate
            $ThreeIterate[] = array($aForGoogle[$key][0], ($key + 1) + ($value + 1) + ($yahooRating4google[$key] + 1), $aForGoogle[$key][1]);
        }
    }
    return $ThreeIterate;
}

function TwoIterates(){
    $TwoIterate = googleOneIterate();
	
	// dar in halat ma faqat do moshtarek hayi ke yeki an anha hatman google ast ra joda karde'im
    // $TwoIterate["bing"] = bingOneIterate();
    // $TwoIterate["yahoo"] = yahooOneIterate();
	
    return $TwoIterate;
}

function urlsComparison(){
    //global
    global $urlS4googleComparison;
    global $urlS4bingComparison;
    global $urlS4yahooComparison;
    global $aForGoogle;
    global $aForBing;
    global $aForYahoo;
    //
    for($i = 0; $i < count($aForGoogle); $i++){ //4 google
        $urlS4googleComparison[$i] = prepare_string_url($aForGoogle[$i][0]);
        $urlS4googleComparison[$i] = urldecode($urlS4googleComparison[$i]);
    }
    for($i = 0; $i < count($aForBing); $i++){ //4 bing
        $urlS4bingComparison[$i] = prepare_string_url($aForBing[$i][0]);
    }
    for($i = 0; $i < count($aForYahoo); $i++){ //4 yahoo
        $urlS4yahooComparison[$i] = prepare_string_url($aForYahoo[$i][0]);
    }
}

function bestUrlsSorting(){
    global $bestUrlS3iterates;
    global $bestUrls2iterates;
    
    $bestUrlS3iterates = ThreeIterates();
	for($i = 0; $i < count($bestUrlS3iterates) - 1; $i++){
		$flag = false;
		for($j = 0; $j < count($bestUrlS3iterates) - ($i + 1); $j++){
			if($bestUrlS3iterates[$j][1] > $bestUrlS3iterates[$j + 1][1]){
				$tmp = $bestUrlS3iterates[$j];
				$bestUrlS3iterates[$j] = $bestUrlS3iterates[$j + 1];
				$bestUrlS3iterates[$j + 1] = $tmp;
				$flag = true;
			}
		}
		if($flag === false){
			break;
		}
	}
	
	$bestUrls2iterates = TwoIterates();
	for($i = 0; $i < count($bestUrls2iterates) - 1; $i++){
		$flag = false;
		for($j = 0; $j < count($bestUrls2iterates) - ($i + 1); $j++){
			if($bestUrls2iterates[$j][1] > $bestUrls2iterates[$j + 1][1]){
				$tmp = $bestUrls2iterates[$j];
				$bestUrls2iterates[$j] = $bestUrls2iterates[$j + 1];
				$bestUrls2iterates[$j + 1] = $tmp;
				$flag = true;
			}
		}
		if($flag === false){
			break;
		}
	}
}

function issetUi(){
	global $keyword;
	$decKeyword = urldecode($keyword);
	global $bestUrlS3iterates;
	global $bestUrls2iterates;
	global $aForGoogle;
	global $aForBing;
	global $aForYahoo;
	/////////start the top of page------------------------
	echo '<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>';
	echo $decKeyword;
	echo ' - Probe Tree</title>
  <link rel="icon" href="img/favi.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
<link rel="stylesheet" href="css/Style.css">
</head>

<body onResize="res()">

<div class="container mt-3 sticky">
	<form method="get"> 
		<div class="input-group">
			<input maxlength="250" type="text" id="keyword" name="keyword" class="form-control" autofocus oninput="changecolor()" autocomplete="off" value="'; echo $decKeyword; echo '">'.'
			<div class="input-group-append">
				<button id="bt" type="submit" class="btn"><i class="fas fa-search"></i></button>
			</div>
		</div>
	</form>
</div>';
	
	/////////end the top of page------------------------
	
	
	///////////////////////////////// check if the key not exists *********
	
	if(     empty($bestUrlS3iterates) && empty($bestUrls2iterates)
		 && empty($aForGoogle)
		 && empty($aForBing)	
		 && empty($aForYahoo)	 )
	{
		echo '<p class="h5 mt-3" style="color: #E42225; text-align: center">
				<i class="fas fa-times-circle"></i> No results found for "';
		echo $decKeyword;
		echo '"</p>';
	}
	///////////////////////////////// check if the key not exists *********
		
		//our smart service
		ourSmartSeviceContent();
		//google
		googleContent();
		//bing
		bingContent();
		//yahoo
		yahooContent();
	
	
	/////////////////////////////////////////////end of page
		echo '<script src="js/res.js"></script>
<script>
$(document).ready(function(){
  $(\'[data-toggle="tooltip"]\').tooltip();   
});
	
	res();
	
	$(window).on("load resize ", function() {
	  var scrollWidth = $(\'.tbl-content\').width() - $(\'.tbl-content table\').width();
	  $(\'.tbl-header\').css({\'padding-right\':scrollWidth});
	}).resize();
</script>

</body>
</html>';
	/////////////////////////////////////////////end of page
}

$ip = $_SERVER["REMOTE_ADDR"];
$useragent = $_SERVER["HTTP_USER_AGENT"];
$decodekeyword = urldecode($keyword);
$lastsearch = date("d/m/Y - H:i:s");

function usersearches(){
	global $conn, $ip, $useragent, $decodekeyword, $lastsearch;
	
	
	$sql = "SELECT count, lastdate, id FROM usersearches WHERE ip = '$ip' AND useragent = '$useragent' AND keyword = '$decodekeyword'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0){
		
		$sqlinsert = "INSERT INTO usersearches (ip, useragent, keyword, count, lastdate)
		VALUES ('$ip', '$useragent', '$decodekeyword', 1, '$lastsearch')";
		$conn->query($sqlinsert);

		
	}elseif($result->num_rows == 1){
		while($row = $result->fetch_assoc()){
			$count = $row['count'];
			$id = $row['id'];
			$count++;

			$sqlupdate = "UPDATE usersearches SET count='$count', lastdate='$lastsearch' WHERE id=$id";
			$conn->query($sqlupdate);
		}
	}
}

function keywordcount(){
	global $conn, $ip, $useragent, $decodekeyword, $lastsearch;
	
	$sql = "SELECT count FROM usersearches WHERE ip = '$ip' AND useragent = '$useragent' AND keyword = '$decodekeyword'";
	$result = $conn->query($sql);
	while($row = $result->fetch_assoc()){
		$count = $row['count'];
		if($count == 1){ //haqe update ya create dar keycount ra darim
			$sqlselect = "SELECT * FROM keywordcount WHERE keyword='$decodekeyword'";
			$res = $conn->query($sqlselect);			
			if($res->num_rows == 0){
				$sqlinsert = 
				"INSERT INTO keywordcount (keyword, count) VALUES ('$decodekeyword', 1)";
				$conn->query($sqlinsert);
			}
			else{
				$row = $res->fetch_assoc();
				$id = $row['id'];
				$count = $row['count'];
				$count++;
				$sqlupdate = "UPDATE keywordcount SET count=$count WHERE id=$id";
				$conn->query($sqlupdate);
			}
		}
	}
}
function ourSmartSeviceContent(){
	global $bestUrlS3iterates;
	global $bestUrls2iterates;
	
	if( !(empty($bestUrlS3iterates) && empty($bestUrls2iterates)) ){
  echo '<section>
  <!--our offers-->
  <h1 class="offer blink">Our Offers</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th class="num">#</th>
          <th class="headerOff">Result</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>';
	$i = 0;
	while(isset($bestUrlS3iterates[$i]) === true){
		echo '<tr>';
		if($i === 0){
			echo '<td class="num one">1st</td>';
		}elseif($i === 1){
			echo '<td class="num two">2nd</td>';
		}elseif($i === 2){
			echo '<td class="num three">3rd</td>';
		}else{
			echo "<td class=\"num\">";
			echo $i + 1;
			echo "</td>";
		}
		echo '<td class="headerOff">
          <a href="'; echo $bestUrlS3iterates[$i][0]; echo '" ';
		echo 'title="'; echo $bestUrlS3iterates[$i][0]; echo '" ';
		echo 'target="_blank" data-placement="left" data-toggle="tooltip">';
		echo $bestUrlS3iterates[$i][2];  
		echo '</a></td></tr>';
		$i++;
	}
	$j = $i;
	$i = 0;
	while(isset($bestUrls2iterates[$i]) === true){
		echo '<tr>';
		if($j === 0){
			echo '<td class="num one">1st</td>';
		}elseif($j === 1){
			echo '<td class="num two">2nd</td>';
		}elseif($j === 2){
			echo '<td class="num three">3rd</td>';
		}else{
			echo "<td class=\"num\">";
			echo $j + 1;
			echo "</td>";
		}
		echo '<td class="headerOff">
          <a href="'; echo $bestUrls2iterates[$i][0]; echo '" ';
		echo 'title="'; echo $bestUrls2iterates[$i][0]; echo '" ';
		echo 'target="_blank" data-placement="left" data-toggle="tooltip">';
		echo $bestUrls2iterates[$i][2];  
		echo '</a></td></tr>';
		
		$i++;
		$j++;
	}
		
  echo '</tbody>
    </table>
  </div>
</section>';
  
	}else{
		//echo "<p>we have no suggestion</p>";
	}
 }

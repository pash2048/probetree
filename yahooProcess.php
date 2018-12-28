<?php
function yahooProcess(){
    global $keyword;
	$a = '';
	$output;
	
    $source4yahoo = html_entity_decode(file_get_contents("https://search.yahoo.com/search?p=$keyword&b=1"));
	
    //start Url
	$offset4yahoo = 0;
    while (strpos($source4yahoo,'<a class=" ac-algo fz-l ac-21th lh-24" href="',$offset4yahoo)!==false){
        $start = strpos($source4yahoo,'<a class=" ac-algo fz-l ac-21th lh-24" href="',$offset4yahoo);
        $end = strpos($source4yahoo,'</a></h3>',$start) + 4;
		$a .= substr($source4yahoo, $start, $end - $start);
		$offset4yahoo = $end + 500;
    }
	
	$dom = new DomDocument();
	$dom->loadHTML($a);
	foreach ($dom->getElementsByTagName('a') as $item) {
	   $output[] = array($item->getAttribute('href'), $item->nodeValue);
	}
	return $output;
}

function ComparisionYahooUrlsWithBingAndGoogleUrls(){
    global $bingindex4yahoo;
    global $googleindex4yahoo;
    global $urlS4googleComparison;
    global $urlS4yahooComparison;
    global $urlS4bingComparison;
    //
    ///////////////ai calc for yahoo

    for($i = 0; $i < count($urlS4yahooComparison); $i++)
    {
        $googleflag = false;
        $bingflag = false;
        //google
        for($j = 0; $j < count($urlS4googleComparison); $j++)
        {
            if($urlS4yahooComparison[$i] === $urlS4googleComparison[$j])
            {
                $googleindex4yahoo[$i] = $j;
                $googleflag = true;
                break;
            }        
        }
        if ($googleflag === false) {
            $googleindex4yahoo[$i] = -1;
        }
        //bing
        for($j = 0; $j < count($urlS4bingComparison); $j++)
        {
            if($urlS4yahooComparison[$i] === $urlS4bingComparison[$j])
            {
                $bingindex4yahoo[$i] = $j;
                $bingflag = true;
                break;
            } 
        }
        if ($bingflag === false) {
            $bingindex4yahoo[$i] = -1;
        }
    }
}

function yahooCalcRatingInGoogleAndBing(){
    //global
    global $googleindex4yahoo;
    global $bingindex4yahoo;
    global $googleRating4yahoo;
    global $bingRating4yahoo;
    //yahoo -> google section 4 ai
    for($i = 0; $i < count($googleindex4yahoo); $i++){
        if($googleindex4yahoo[$i] === -1){
            continue;
        }
        else{
            $googleRating4yahoo[$i] = $googleindex4yahoo[$i];
        }
    }
    //yahoo -> bing section 4 ai
    for($i = 0; $i < count($bingindex4yahoo); $i++){
        if($bingindex4yahoo[$i] === -1){
            continue;
        }
        else{
            $bingRating4yahoo[$i] = $bingindex4yahoo[$i];
        }
    }
}

function yahooOneIterate(){
    //globa;
    global $googleRating4yahoo;
    global $bingRating4yahoo;
    global $aForYahoo;
    //
    /////yahoo 1 iterate
    $yahoo1iterate = [];
    //google section
    foreach ($googleRating4yahoo as $key => $value) {
        if(!isset($bingRating4yahoo[$key])){
            //key + 1 = yahooRate | value + 1 = googleRate
            $yahoo1iterate[] = array($aForYahoo[$key][0], ($key + 1) + ($value + 1));
        }
    }
    //bing section
    foreach ($bingRating4yahoo as $key => $value) {
        if(!isset($googleRating4yahoo[$key])){
            //key + 1 = yahooRate | value + 1 = bingRate
            $yahoo1iterate[] = array($aForYahoo[$key][0], ($key + 1) + ($value + 1));
        }
    }
    return $yahoo1iterate;
}

function yahooContent(){
	global $aForYahoo;
	global $googleindex4yahoo;
	global $bingindex4yahoo;

	if( !(empty($aForYahoo) )){
		echo '<section>
  <!--yahoo-->
  <h1 class="yahoo">Yahoo</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th class="num">#</th>
          <th class="header">Result</th>
          <th class="searchEngine google">google</th>
          <th class="searchEngine bing">Bing</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>';
		//while
		$i = 0;
		while( isset($aForYahoo[$i][0]) && isset($aForYahoo[$i][1]) ) {
			echo '<tr>';
			echo '<td class="num">'; echo $i + 1;  echo "</td>";
			echo '<td class="header">
			<a href="'; echo $aForYahoo[$i][0]; echo '" ';
			echo 'title="'; echo $aForYahoo[$i][0]; echo '" ';
			
			echo 'target="_blank" data-placement="left" data-toggle="tooltip">';
			echo $aForYahoo[$i][1];
			echo '</a></td>';
			
			echo '<td class="searchEngine">'; 
			if($googleindex4yahoo[$i] == -1)
				echo '-';
			else
				echo $googleindex4yahoo[$i] + 1;
			echo '</td>';
			
			echo '<td class="searchEngine">'; 
			if($bingindex4yahoo[$i] == -1)
				echo '-';
			else
				echo $bingindex4yahoo[$i] + 1;  
			echo '</td>';
			
			echo '</tr>';
			
			$i++;
		}
		
		echo '</tbody>
    </table>
  </div>
</section>';
		
		
	}
	else{
		///////////
	}
}
<?php
function bingProcess(){
    global $keyword;
	$html = file_get_html("https://www.bing.com/search?q=$keyword&first=00");
	$li = $html->find('li.b_algo h2 a');

	foreach($li as $elmt){
		$a[] = array($elmt->href, $elmt->plaintext);
	}

	return $a;
}

function ComparisionBingUrlsWithGoogleAndYahooUrls(){
    //global
    global $yahooindex4bing;
    global $googleindex4bing;
    global $urlS4googleComparison;
    global $urlS4yahooComparison;
    global $urlS4bingComparison;
    //

    for($i = 0; $i < count($urlS4bingComparison); $i++)
    {
        $googleflag = false;
        $yahooflag = false;
        //google
        for($j = 0; $j < count($urlS4googleComparison); $j++)
        {
            if($urlS4bingComparison[$i] === $urlS4googleComparison[$j])
            {
                $googleindex4bing[$i] = $j;
                $googleflag = true;
                break;
            }        
        }
        if ($googleflag === false) {
            $googleindex4bing[$i] = -1;
        }
        //yahoo
        for($j = 0; $j < count($urlS4yahooComparison); $j++)
        {
            if($urlS4bingComparison[$i] === $urlS4yahooComparison[$j])
            {
                $yahooindex4bing[$i] = $j;
                $yahooflag = true;
                break;
            } 
        }
        if ($yahooflag === false) {
            $yahooindex4bing[$i] = -1;
        }
    }
}

function bingCalcRatingInGoogleAndYahoo(){
    //global
    global $googleindex4bing;
    global $yahooindex4bing;
    global $googleRating4bing;
    global $yahooRating4bing;
    //bing -> google section 4 ai
    for($i = 0; $i < count($googleindex4bing); $i++){
        if($googleindex4bing[$i] === -1){
            continue;
        }
        else{
            $googleRating4bing[$i] = $googleindex4bing[$i];
        }
    }
    //bing -> yahoo section 4 ai
    for($i = 0; $i < count($yahooindex4bing); $i++){
        if($yahooindex4bing[$i] === -1){
            continue;
        }
        else{
            $yahooRating4bing[$i] = $yahooindex4bing[$i];
        }
    }
}

function bingOneIterate(){
    //global
    global $googleRating4bing;
    global $yahooRating4bing;
    global $aForBing;
    //
    /////bing 1 iterate
    $bing1iterate = [];
    //google section
    foreach ($googleRating4bing as $key => $value) {
        if(!isset($yahooRating4bing[$key])){
            //key + 1 = bingRate | value + 1 = googleRate
            $bing1iterate[] = array($aForBing[$key][0], ($key + 1) + ($value + 1));
        }
    }
    //yahoo section
    foreach ($yahooRating4bing as $key => $value) {
        if(!isset($googleRating4bing[$key])){
            //key + 1 = bingRate | value + 1 = yahooRate
            $bing1iterate[] = array($aForBing[$key][0], ($key + 1) + ($value + 1));
        }
    }
    return $bing1iterate;
}

function bingContent(){
	global $aForBing;
	global $googleindex4bing;
	global $yahooindex4bing;

	if( !(empty($aForBing) )){
		echo '<section>
  <!--bing-->
  <h1 class="bing">Bing</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th class="num">#</th>
          <th class="header">Result</th>
          <th class="searchEngine google">Google</th>
          <th class="searchEngine yahoo">yahoo</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>';
		//while
		$i = 0;
		while( isset($aForBing[$i][0]) && isset($aForBing[$i][1]) ) {
			echo '<tr>';
			echo '<td class="num">'; echo $i + 1;  echo "</td>";
			echo '<td class="header">
			<a href="'; echo $aForBing[$i][0]; echo '" ';
			echo 'title="'; echo $aForBing[$i][0]; echo '" ';
			
			echo 'target="_blank" data-placement="left" data-toggle="tooltip">';
			echo $aForBing[$i][1];
			echo '</a></td>';
			
			echo '<td class="searchEngine">'; 
			if($googleindex4bing[$i] == -1)
				echo '-';
			else
				echo $googleindex4bing[$i] + 1;
			echo '</td>';
			
			echo '<td class="searchEngine">'; 
			if($yahooindex4bing[$i] == -1)
				echo '-';
			else
				echo $yahooindex4bing[$i] + 1;  
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
		////////////
	}
}
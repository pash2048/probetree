<?php
function googleprocess(){
    //global
    global $keyword;
	    
	$html = file_get_html("https://www.google.com/search?q=$keyword&start=00");
	$h3 = $html->find('h3.r a');

	foreach($h3 as $elmt)
		$a[] = array($elmt->href, $elmt->plaintext);
	
	for($i = 0; $i < count($a); $i++)
		if(strpos($a[$i][0], "/url?q=") === FALSE)
			unset($a[$i]);
	
	$a = array_values($a);
		
	
	for($i = 0; $i < count($a); $i++)
		$a[$i][0] = str_replace("/url?q=", "", $a[$i][0]);
	
	for($i = 0; $i < count($a); $i++)
		$a[$i][0] = substr_replace($a[$i][0], "", strpos($a[$i][0], "&"));           
	
 	return $a;
}

function ComparisionGoogleUrlsWithBingAndYahooUrls(){
    //global
    global $yahooindex4google;
    global $bingindex4google;
    global $urlS4googleComparison;
    global $urlS4yahooComparison;
    global $urlS4bingComparison;
    //

    for($i = 0; $i < count($urlS4googleComparison); $i++)
    {
        $yahooflag = false;
        $bingflag = false;
        //yahoo
        for($j = 0; $j < count($urlS4yahooComparison); $j++)
        {
            if($urlS4googleComparison[$i] === $urlS4yahooComparison[$j])
            {
                $yahooindex4google[$i] = $j;
                $yahooflag = true;
                break;
            }        
        }
        if ($yahooflag === false) {
            $yahooindex4google[$i] = -1;
        }
        //bing
        for($j = 0; $j < count($urlS4bingComparison); $j++)
        {
            if($urlS4googleComparison[$i] === $urlS4bingComparison[$j])
            {
                $bingindex4google[$i] = $j;
                $bingflag = true;
                break;
            } 
        }
        if ($bingflag === false) {
            $bingindex4google[$i] = -1;
        }
    }
}

function googleCalcRatingInBingAndYahoo(){
    //global
    global $bingindex4google;
    global $yahooindex4google;
    global $bingRating4google;
    global $yahooRating4google;
    //google -> bing section 4 ai
    for($i = 0; $i < count($bingindex4google); $i++){
        if($bingindex4google[$i] === -1){
            continue;
        }
        else{
            $bingRating4google[$i] = $bingindex4google[$i];
        }
    }
    //google -> yahoo section 4 ai
    for($i = 0; $i < count($yahooindex4google); $i++){
        if($yahooindex4google[$i] === -1){
            continue;
        }
        else{
            $yahooRating4google[$i] = $yahooindex4google[$i];
        }
    }
}

function googleOneIterate(){
    //global
    global $bingRating4google;
    global $yahooRating4google;
    global $aForGoogle;
	
    /////google 1 iterate
    $google1iterate = [];
    //bing section
    foreach ($bingRating4google as $key => $value) {
        if(!isset($yahooRating4google[$key])){
            //key + 1 = googleRate | value + 1 = bingRate
            $google1iterate[] = array($aForGoogle[$key][0], ($key + 1) + ($value + 1), $aForGoogle[$key][1]);
        }
    }
    //yahoo section
    foreach ($yahooRating4google as $key => $value) {
        if(!isset($bingRating4google[$key])){
            $google1iterate[] = array($aForGoogle[$key][0], ($key + 1) + ($value + 1), $aForGoogle[$key][1]);
        }
    }
    return $google1iterate;
}

function googleContent(){
	global $aForGoogle;
	global $bingindex4google;
	global $yahooindex4google;

	if( !(empty($aForGoogle) )){
		echo '<section>
  <!--google-->
  <h1 class="google">Google</h1>
  <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead>
        <tr>
          <th class="num">#</th>
          <th class="header">Result</th>
          <th class="searchEngine bing">Bing</th>
          <th class="searchEngine yahoo">Yahoo</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>';
		//while
		//<a href="#" title="Hooray!" target="_blank" data-placement="left" data-toggle="tooltip">Love - Wikipedia</a>
		$i = 0;
		while( isset($aForGoogle[$i][0]) && isset($aForGoogle[$i][1]) ) {
			echo '<tr>';
			echo '<td class="num">'; echo $i + 1;  echo "</td>";
			echo '<td class="header">
			<a href="'; echo $aForGoogle[$i][0]; echo '" ';
			echo 'title="'; echo $aForGoogle[$i][0]; echo '" ';
			
			echo 'target="_blank" data-placement="left" data-toggle="tooltip">';
			echo $aForGoogle[$i][1];
			echo '</a></td>';
			
			echo '<td class="searchEngine">'; 
			if($bingindex4google[$i] == -1)
				echo '-';
			else
				echo $bingindex4google[$i] + 1;
			echo '</td>';
			
			echo '<td class="searchEngine">'; 
			if($yahooindex4google[$i] == -1)
				echo '-';
			else
				echo $yahooindex4google[$i] + 1;  
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
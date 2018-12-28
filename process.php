<?php
//time zone
date_default_timezone_set('Asia/Tehran');

$keyword = trim(urlencode(filter_input(INPUT_GET, "keyword")));

require_once 'simple_html_dom.php';
require_once 'functions.php';
require_once 'googleProcess.php';
require_once 'bingProcess.php';
require_once 'yahooProcess.php';
require_once 'config.php';



usersearches();
keywordcount();
$conn->close();

$aForGoogle = googleprocess();
$aForBing = bingProcess();
$aForYahoo = yahooProcess();


//Urls Comparison vars
$urlS4googleComparison = [];
$urlS4bingComparison = [];
$urlS4yahooComparison = [];
///////////////////////

////////////////////////under vars are 4 calc rating in (google bing yahoo)contents and
					////useful 4 google one iterates	
$yahooindex4google = [];
$bingindex4google = [];

$googleindex4bing = [];
$yahooindex4bing = [];

$googleindex4yahoo = [];
$bingindex4yahoo = [];


////////////////////////////////////////////////////////////////////////////////////////


//////////////ratings 4 one iterates ******************************************
$bingRating4google = [];
$yahooRating4google = [];

////////////                useful 4 bing and yahoo oneiterates
//$yahooRating4bing = [];
//$googleRating4bing = [];
//$bingRating4yahoo = [];
//$googleRating4yahoo = [];

//////////////*****************************************************************
//------------------------BestUrls 4 oursartsevices
$bestUrlS3iterates = [];
$bestUrls2iterates = [];
//-------------------------------------------------


urlsComparison();  //remove http urldecode etc  //functions.php

headingsPreparing();						   //functions.php

ComparisionGoogleUrlsWithBingAndYahooUrls();   //googleProcess.php

ComparisionBingUrlsWithGoogleAndYahooUrls();  //bingProcess.php

ComparisionYahooUrlsWithBingAndGoogleUrls();  //yahooProcess.php



//\//\//\//\//\//\//\//\//\//\-------under functions are usefull  one iterates
googleCalcRatingInBingAndYahoo();			//googleProcess.php
////////////bingCalcRatingInGoogleAndYahoo();   ---->its useful 4 bingOneIterate();
////////////yahooCalcRatingInGoogleAndBing();   ---->its useful 4 yahooOneIterate();
//\//\//\//\//\//\//\//\//\//\-----------------------------------------------


bestUrlsSorting();   // 3iterates and 2iterates arrays Sorting  //functions.php
					 // useful in oursmart services

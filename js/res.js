var w;
var i;

var heads1 = document.getElementsByTagName('h1');
var theads = document.getElementsByTagName('th');
var tcells = document.getElementsByTagName('td');
var section = document.getElementsByTagName('section');
var googleTH = $("th.google");
var bingTH = $("th.bing");
var yahooTH = $("th.yahoo");
var elmnt;

function res(){
	w = window.outerWidth;
	if(w < 768){
	for(i = 0; i < theads.length; i++)
	{
		elmnt = theads[i];
		elmnt.style.fontSize = '12px';
	}
	for(i = 0; i < tcells.length; i++)
	{
		elmnt = tcells[i];
		elmnt.style.fontSize = '12px';
	}
	for(i = 0; i < heads1.length; i++)
	{
		elmnt = heads1[i];
		elmnt.style.fontSize = '20px';
	}
	for(i = 0; i < section.length; i++)
	{
		elmnt = section[i];
		elmnt.style.marginLeft = '0px';
		elmnt.style.marginRight = '0px';
	}
	}else{
	for(i = 0; i < theads.length; i++)
	{
		elmnt = theads[i];
		elmnt.style.fontSize = '14px';
	}
	for(i = 0; i < tcells.length; i++)
	{
		elmnt = tcells[i];
		elmnt.style.fontSize = '14px';
	}
	for(i = 0; i < heads1.length; i++)
	{
		elmnt = heads1[i];
		elmnt.style.fontSize = '30px';
	}
	for(i = 0; i < section.length; i++)
	{
		elmnt = section[i];
		elmnt.style.marginLeft = '50px';
		elmnt.style.marginRight = '50px';
	}
	}
	if(w < 430){
		for(i = 0; i < googleTH.length; i++)
		{
			elmnt = googleTH[i];
			elmnt.innerHTML = "G";
		}
		for(i = 0; i < bingTH.length; i++)
		{
			elmnt = bingTH[i];
			elmnt.innerHTML = "B";
		}
		for(i = 0; i < yahooTH.length; i++)
		{
			elmnt = yahooTH[i];
			elmnt.innerHTML = "Y";
		}
	}else{
		for(i = 0; i < googleTH.length; i++)
		{
			elmnt = googleTH[i];
			elmnt.innerHTML = "Google";
		}
		for(i = 0; i < bingTH.length; i++)
		{
			elmnt = bingTH[i];
			elmnt.innerHTML = "Bing";
		}
		for(i = 0; i < yahooTH.length; i++)
		{
			elmnt = yahooTH[i];
			elmnt.innerHTML = "Yahoo";
		}
	}
	
}

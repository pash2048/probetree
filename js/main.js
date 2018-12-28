var rand, i;
function changecolor(){
	rand = Math.floor(Math.random() * 3);
	if(rand == 0){
		//google
		document.getElementsByClassName('g1')[0].style.fill = '#fbbc05';
		document.getElementsByClassName('g1')[1].style.fill = '#4285f4';
		document.getElementsByClassName('g1')[2].style.fill = '#34a853';
		document.getElementsByClassName('g1')[3].style.fill = '#ea4335';
		//white bing yahoo
		document.getElementById('b1').style.fill = '#fff';
		document.getElementById('y1').style.fill = '#fff';
	}else if(rand == 1){
		//bing
		document.getElementById('b1').style.fill = '#ffba00';
		//white google yahoo
		document.getElementsByClassName('g1')[0].style.fill = '#fff';
		document.getElementsByClassName('g1')[1].style.fill = '#fff';
		document.getElementsByClassName('g1')[2].style.fill = '#fff';
		document.getElementsByClassName('g1')[3].style.fill = '#fff';
		document.getElementById('y1').style.fill = '#fff';
	}else{
		//yahoo
		document.getElementById('y1').style.fill = '#6b0094';
		//white bing google
		document.getElementsByClassName('g1')[0].style.fill = '#fff';
		document.getElementsByClassName('g1')[1].style.fill = '#fff';
		document.getElementsByClassName('g1')[2].style.fill = '#fff';
		document.getElementsByClassName('g1')[3].style.fill = '#fff';
		document.getElementById('b1').style.fill = '#fff';
	}
}

var w,h;
function res(){
	w = window.outerWidth;
	h = window.outerHeight;
	if(h > w){
		document.getElementsByClassName('logo')[0].style.width = '1000px';
		document.getElementsByClassName('logo')[0].style.height = '1200px';
		document.getElementsByClassName('column_center')[0].style.width = '600px';
		document.getElementById('keyword').style.height = '60px';
		document.getElementById('bt').style.height = '60px';
		///google
		document.getElementById('google').style.width = '160px';
		document.getElementById('google').style.height = '160px';
		document.getElementById('google').style.bottom = '80px';
		///bing
		document.getElementById('bing').style.width = '160px';
		document.getElementById('bing').style.height = '160px';
		document.getElementById('bing').style.left = '200px';
		///yahoo
		document.getElementById('yahoo').style.width = '160px';
		document.getElementById('yahoo').style.height = '160px';
		document.getElementById('yahoo').style.bottom = '80px';
	}else{
		document.getElementsByClassName('logo')[0].style.width = '500px';
		document.getElementsByClassName('logo')[0].style.height = '600px';
		document.getElementsByClassName('column_center')[0].style.width = '400px';
		document.getElementById('keyword').style.height = '40px';
		document.getElementById('bt').style.height = '40px';
		///google
		document.getElementById('google').style.width = '80px';
		document.getElementById('google').style.height = '80px';
		document.getElementById('google').style.bottom = '40px';
		///bing
		document.getElementById('bing').style.width = '80px';
		document.getElementById('bing').style.height = '80px';
		document.getElementById('bing').style.left = '100px';
		///yahoo
		document.getElementById('yahoo').style.width = '80px';
		document.getElementById('yahoo').style.height = '80px';
		document.getElementById('yahoo').style.bottom = '40px';
	}
}
res();

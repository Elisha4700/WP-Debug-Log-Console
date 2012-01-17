function setCookie( cookie_name, value, exdays ){
	if( exdays === undefined )
		exdays = 365;
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString() );
	document.cookie = cookie_name + "=" + c_value;
}


function getCookie( cookie_name ){
	var i, x, y, ARRcookies = document.cookie.split(";");
	for ( i = 0; i < ARRcookies.length; i++ ){
		x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
		y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
		x  =x.replace(/^\s+|\s+$/g,"");
		if (x == cookie_name){
			return unescape(y);
		}
	}
}


function deleteCookie( cookie_name ){
	setCookie( cookie_name, '', -365 );
}
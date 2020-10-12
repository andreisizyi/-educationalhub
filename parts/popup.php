		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script>
if (getCookie('country') == null) {
	//Создаю попап
	$('html').prepend('<div id="popup" class="bg-secondary t-center"><div class="wrap"><h2>З якої ви країни?</h2><div id="input_area"><button data-val="ua" class="btn-light" type="button">Україна</button><button data-val="ru" class="btn-light" type="button">Росія</button><button data-val="by" class="btn-light" type="button">Білорусь</button></div></div>');
	$('html').css('overflow', 'hidden');
	//Тут обработка клика, создание куков, проверка условий
	$('#input_area button').click(function(e) {
		let country_val = $(this).attr('data-val');
		let now = new Date();
		let target_date = now.setFullYear(now.getFullYear() + 1);
		target_date = new Date(target_date);
		let target = target_date.format("dd-m-yy");
		let cookies = btoa(country_val + ':' + target);
		//alert(target_date.toUTCString());
		//Записываю куки с значением страны и даты в 
		document.cookie = "country=" + cookies + "; expires=" + target_date;
		if (country_val == 'by') {
			e.preventDefault();
			$.ajax({
				url: '/wp-admin/admin-ajax.php?action=load_menu',
				type: 'POST',
				data: {
					country: country_val
				},
				dataType: 'text',
				beforeSend: function() {},
				error: function() {
					console.log("Error load menu");
				},
				success: function(response) {
					$('#insert_menu').html(response);
				}
			});
		} else if (country_val == 'ru') {
			var url = "/";
			$(location).attr('href', url);
		}
		$('#popup').remove();
		$('html').css('overflow', 'auto');
	});
}
//Получаю значние куков
function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}
//date format
var dateFormat = function() {
	var token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function(val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};
	// Regexes and supporting functions are cached through closure
	return function(date, mask, utc) {
		var dF = dateFormat;
		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}
		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");
		mask = String(dF.masks[mask] || mask || dF.masks["default"]);
		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}
		var _ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d: d,
				dd: pad(d),
				ddd: dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m: m + 1,
				mm: pad(m + 1),
				mmm: dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy: String(y).slice(2),
				yyyy: y,
				h: H % 12 || 12,
				hh: pad(H % 12 || 12),
				H: H,
				HH: pad(H),
				M: M,
				MM: pad(M),
				s: s,
				ss: pad(s),
				l: pad(L, 3),
				L: pad(L > 99 ? Math.round(L / 10) : L),
				t: H < 12 ? "a" : "p",
				tt: H < 12 ? "am" : "pm",
				T: H < 12 ? "A" : "P",
				TT: H < 12 ? "AM" : "PM",
				Z: utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o: (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S: ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};
		return mask.replace(token, function($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();
// Some common format strings
dateFormat.masks = {
	"default": "ddd mmm dd yyyy HH:MM:ss",
	shortDate: "m/d/yy",
	mediumDate: "mmm d, yyyy",
	longDate: "mmmm d, yyyy",
	fullDate: "dddd, mmmm d, yyyy",
	shortTime: "h:MM TT",
	mediumTime: "h:MM:ss TT",
	longTime: "h:MM:ss TT Z",
	isoDate: "yyyy-mm-dd",
	isoTime: "HH:MM:ss",
	isoDateTime: "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};
// Internationalization strings
dateFormat.i18n = {
	dayNames: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
	monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
};
// For convenience...
Date.prototype.format = function(mask, utc) {
	return dateFormat(this, mask, utc);
};
//Получаю куки js
/*
let cookie_val = getCookie('country');
cookie_val = atob(getCookie('country'));
let cookie_flag = cookie_val.substring(0, cookie_val.lastIndexOf(":"));
let cookie_date = cookie_val.substring(cookie_val.lastIndexOf(":") + 1);
//Добавляю текущую дату
let date1 = new Date();
//Преобразую текущую дату в такой же формат как и полученная с кука
date1 = date1.format("dd-m-yy");
date1 = new Date(date1);
let date2 = new Date(cookie_date);
//console.log(date1 + '---' + date2);
let diff = date1 - date2;
let milliseconds = diff;
let seconds = milliseconds / 1000;
let minutes = seconds / 60;
let hours = minutes / 60;
let days = hours / 24;
//Устанавливаю правила
if ((days < 0) && (cookie_flag == 'ru')) {
	//days = Math.ceil(Math.abs(days));
	//alert('Доступ заблокирован на ' + days);
	//$('body').html('Для вашої країни сайт заблокований').css('display','block');
} else if (cookie_flag == 'by') {
	//alert('Доступ открыт для Белориси и подгружаеться особое меню');
	//$('body').css('display','block');
} else {
	//alert('Доступ открыт для Украины');
	//$('body').css('display','block');
};*/

			</script>

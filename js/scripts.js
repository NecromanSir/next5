window.onload = function() {
    var dt = new Date();
    document.getElementById("dateTimeDisplay").innerHTML = dt.toLocaleString();
}

window.setInterval(function(){
	  updateTime();
	  updateDuration();
}, 1000);

function updateTime(){
	var dt = new Date();
	document.getElementById("dateTimeDisplay").innerHTML = dt.toLocaleString();
}

function updateDuration() {
	var elms = document.getElementsByClassName('durationField')
	for (var i = 0; i < elms.length; i++) {
		var dur = elms[i].innerHTML;
		if (dur.indexOf("minutes") > -1) {
			var timeSplit = dur.split(" ");
			var hrs = parseInt(timeSplit[0]) * 60 * 60;
			var mins = parseInt(timeSplit[2]) * 60;
			var secs = parseInt(timeSplit[4]);
			dur = hrs + mins + secs;
			dur--;
			hrs = ~~(dur / 3600);
		    mins = ~~((dur % 3600) / 60);
		    secs = dur % 60;
		    elms[i].innerHTML = hrs + " hours " + mins + " minutes " + secs + " seconds";
		} else {
			var dur = parseInt(elms[i].innerHTML);
//			var minutes = Math.floor(dur / 60);
//			var seconds = dur - minutes * 60;
//			var hours = Math.floor(dur / 3600);
		    var hrs = ~~(dur / 3600);
		    var mins = ~~((dur % 3600) / 60);
		    var secs = dur % 60;
			elms[i].innerHTML = hrs + " hours " + mins + " minutes " + secs + " seconds";
		}
		
		if (dur < 0) {
			location.reload(true);
		}	
	}
}

jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
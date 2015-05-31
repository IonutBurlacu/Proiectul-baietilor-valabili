
/* Question textarea */

// var textArea = document.getElementById("question-textarea");
// alert(textArea.scrollHeight);




/* Question avatar */

var calculateAvatarSize = function(){
	var avatars = document.getElementsByClassName("avatar");
	[].forEach.call(avatars, function(avatar){
		var childs = Array.prototype.slice.call(avatar.children);
		var img = childs[0];
		var height = img.clientHeight;
		var width = img.clientWidth;

		if(height > width){
			//portrait
			img.className = img.className + " portrait";
			height = img.height;
			img.style.marginTop = "-" + height / 2;
		}
		else {
			//landscape
			img.className = img.className + " landscape";
			width = img.width;
			img.style.marginLeft = "-" + width / 2;
		}
	});
}

/* Vote question */

var voteQuestion = function(element, question_id, type, voted){
	var user_id = document.getElementsByClassName('user-id')[0].id;
	if(user_id != ""){
		var hr = new XMLHttpRequest();
	    var url = 'http://' + window.location.host + '/vote-question';

	    if(typeof voted !== 'undefined'){
		    var vars = 'question_id=' + question_id + '&user_id=' + user_id + '&type=' + type + '&voted=' + voted;
	    }
	    else {
	    	var vars = 'question_id=' + question_id + '&user_id=' + user_id + '&type=' + type;	
	    }
	    hr.open("POST", url, true);
	    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    hr.onreadystatechange = function() {
		    if(hr.readyState == 4 && hr.status == 200) {
			    if(type == 1){
			    	if(element.className.indexOf("voted") != -1){
			    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) + 1;
			    		element.className = "down-arrow";
			    	}
			    	else {
				    	if(typeof element.parentNode.getElementsByClassName('voted')[0] !== 'undefined'){
				    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) - 2;
				    	}
				    	else {
				    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) - 1;
				    	}
				    	element.className = "down-arrow voted";
				    	element.parentNode.getElementsByClassName('up-arrow')[0].className = "up-arrow ";
			    	}
			    }
			    else {
			    	if(element.className.indexOf("voted") != -1){
			    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) - 1;
			    		element.className = "up-arrow ";
			    	}
			    	else {
				    	if(typeof element.parentNode.getElementsByClassName('voted')[0] !== 'undefined'){
				    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) + 2;
				    	}
				    	else {
				    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) + 1;
				    	}
				    	element.className = "up-arrow voted";
				    	element.parentNode.getElementsByClassName('down-arrow')[0].className = "down-arrow";
			    	}	
			    }
		    }
	    }
	    hr.send(vars);
	}
	else {
		window.location = "/login";
	}
}

/* Vote answer */

var voteAnswer = function(element, answer_id, type, voted){
	var user_id = document.getElementsByClassName('user-id')[0].id;
	var hr = new XMLHttpRequest();
    var url = 'http://' + window.location.host + '/vote-answer';

    if(typeof voted !== 'undefined'){
	    var vars = 'answer_id=' + answer_id + '&user_id=' + user_id + '&type=' + type + '&voted=' + voted;
    }
    else {
    	var vars = 'answer_id=' + answer_id + '&user_id=' + user_id + '&type=' + type;	
    }
    console.log(vars);
    hr.open("POST", url, true);
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    if(type == 1){
		    	if(element.className.indexOf("voted") != -1){
		    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) + 1;
		    		element.className = "down-arrow";
		    	}
		    	else {
			    	if(typeof element.parentNode.getElementsByClassName('voted')[0] !== 'undefined'){
			    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) - 2;
			    	}
			    	else {
			    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) - 1;
			    	}
			    	element.className = "down-arrow voted";
			    	element.parentNode.getElementsByClassName('up-arrow')[0].className = "up-arrow ";
		    	}
		    }
		    else {
		    	if(element.className.indexOf("voted") != -1){
		    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) - 1;
		    		element.className = "up-arrow ";
		    	}
		    	else {
			    	if(typeof element.parentNode.getElementsByClassName('voted')[0] !== 'undefined'){
			    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) + 2;
			    	}
			    	else {
			    		element.parentNode.getElementsByTagName("p")[0].innerHTML = parseInt(element.parentNode.getElementsByTagName("p")[0].innerHTML) + 1;
			    	}
			    	element.className = "up-arrow  voted";
			    	element.parentNode.getElementsByClassName('down-arrow')[0].className = "down-arrow";
		    	}	
		    }
	    }
    }
    hr.send(vars);
}

/* Open file dialog */

var openFileDialog = function(){
	var fileInput = document.getElementById("file-dialog");
	fileInput.click();
}

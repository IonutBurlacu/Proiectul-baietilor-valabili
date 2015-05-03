
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

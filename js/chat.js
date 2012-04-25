var req;
var lastId = null;

function showChat() {
	req = getXmlHttpRequest();
	req.onreadystatechange = showChatComplete;
	if (lastId){
		req.open("GET", "?r=chat/read/lastId/"+lastId, true);
		req.send(null);
	}
	else{
		var children = document.getElementById('chat').getElementsByTagName('P');
		lastId = children[children.length-1].id;
	}
}
function showChatComplete()	{
	// только при состоянии "complete"
	if (req.readyState == 4) {
		var table = req.responseText;
		if (table != "null") {
			table = eval("("+table+")");
			for(var i=0; i<table.length; i++) {
				var post = document.createElement("P");
				post.innerHTML = "<b>"+table[i]["user"]+":</b> "+table[i]["text"];
				document.getElementById("chat").appendChild(post);
				lastId = table[(table.length-1)]["id"];
			}
		}
		
	}
}

function sendSey(user, text){
	req = getXmlHttpRequest();
	req.open("GET", '?r=chat/create&user='+user+'&text='+text, true);
	req.send(null);
}
function say(){
	var user = document.getElementById("user");
	var text = document.getElementById("text");
	sendSey(user.value, text.value);
	text.value = '';
}

window.onload = function () {
	setInterval("showChat()", 5000);
}

// on input/text enter--------------------------------------------------------------------------------------
$('.usrInput').on('keyup keypress', function (e) {
	var keyCode = e.keyCode || e.which;
	var text = $(".usrInput").val();
	if (keyCode === 13) {
		if (text == "" || $.trim(text) == '') {
			e.preventDefault();
			return false;
		} else {
			$(".usrInput").blur();
			setUserResponse(text);
			send(text);
			e.preventDefault();
			return false;
		}
	}
});


//------------------------------------- Set user response------------------------------------
function setUserResponse(val) {


	var UserResponse = '<img class="userAvatar" src=' + "../staticChatBot/img/userAvatar.jpg" + '><p class="userMsg">' + val + ' </p><div class="clearfix"></div>';
	$(UserResponse).appendTo('.chats').show('slow');
	$(".usrInput").val('');
	scrollToBottomOfResults();
	$('.suggestions').remove();
}

//---------------------------------- Scroll to the bottom of the chats-------------------------------
function scrollToBottomOfResults() {
	var terminalResultsDiv = document.getElementById('chats');
	terminalResultsDiv.scrollTop = terminalResultsDiv.scrollHeight;
}

function send(message) {
	console.log("User Message:", message)
	$.ajax({
		url: 'http://172.16.16.249:5005/webhooks/rest/webhook',
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify({
			"message": message,
			"sender": "Me"
		}),
		success: function (data, textStatus) {
			if(data != null){
					setBotResponse(data);

//					function speech() {
//					    var voiceOutMsg = new SpeechSynthesisUtterance();
//					    voiceOutMsg.text =  'I can help you book the meeting for your team, check which meetings you have recently, and help you quickly invite friends to edit together.';
//					    voiceOutMsg.lang = 'en-US';
//					    voiceOutMsg.rate = 0.8;
//					    window.speechSynthesis.speak(voiceOutMsg);
//					}
//					window.onload = speak;
                    // var voiceOutMsg = new window.SpeechSynthesisUtterance(data[0].text);
//					var voiceOutMsg = new window.SpeechSynthesisUtterance("I can help you book the meeting for your team, check which meetings you have recently, and help you quickly invite friends to edit together.");
//					voiceOutMsg.lang = 'en-US';
//					voiceOutMsg.rate = 0.8;
//					voiceOutMsg.volume = 0.7;
//					voiceOutMsg.pitch = 1.8;

//					speechSynthesisUtteranceInstance.lang = 'en-US';
//					speechSynthesisUtteranceInstance.rate = 0.8;
//                    window.speechSynthesis.speak(voiceOutMsg);
                    playAudio(data[0].text);
			}
			console.log("Rasa Response: ", data, "\n Status:", textStatus);
			console.log(data[0].text)
            $('.message-content p').html(data[0].text)
		},
		error: function (errorMessage) {
			setBotResponse("");
			console.log('Error' + errorMessage);

		}
	});
}

//
//var voiceOutMsg = new SpeechSynthesisUtterance(data[0].text);
//window.SpeechSynthesis.speak(voiceOutMsg);
//  语音合成baiduapi
function  playAudio(param) {
	var url = "http://tts.baidu.com/text2audio?cuid=baike&lan=ZH&ctp=1&pdt=301&vol=9&rate=32&per=0&tex="+param;
	var n=new Audio(url);
	n.src=url;
	n.play();
 }



//------------------------------------ Set bot response -------------------------------------
function setBotResponse(val) {
	setTimeout(function () {
		if (val.length < 1) {
			//if there is no response from Rasa
			msg = 'I couldn\'t get that. Let\' try something else!';

			var BotResponse = '<img class="botAvatar" src="../staticChatBot/img/botAvatar.png"><p class="botMsg">' + msg + '</p><div class="clearfix"></div>';
			$(BotResponse).appendTo('.chats').hide().fadeIn(1000);

		} else {
			//if we get response from Rasa
			for (i = 0; i < val.length; i++) {
				//check if there is text message
				if (val[i].hasOwnProperty("text")) {
					var BotResponse = '<img class="botAvatar" src="../staticChatBot/img/botAvatar.png"><p class="botMsg">' + val[i].text + '</p><div class="clearfix"></div>';
					$(BotResponse).appendTo('.chats').hide().fadeIn(1000);
				}

				//check if there is image
				if (val[i].hasOwnProperty("image")) {
					var BotResponse = '<div class="singleCard">' +
						'<img class="imgcard" src="' + val[i].image + '">' +
						'</div><div class="clearfix">'
					$(BotResponse).appendTo('.chats').hide().fadeIn(1000);
				}

				//check if there is  button message
				if (val[i].hasOwnProperty("buttons")) {
					addSuggestion(val[i].buttons);
				}

			}
			scrollToBottomOfResults();
		}

	}, 500);
}


// ------------------------------------------ Toggle chatbot -----------------------------------------------
$('#profile_div').click(function () {
	$('.profile_div').toggle();
	$('.widget').toggle();
	scrollToBottomOfResults();
	start();
});

$('#close').click(function () {
	$('.profile_div').toggle();
	$('.widget').toggle();
});


// ------------------------------------------ Suggestions -----------------------------------------------

function addSuggestion(textToAdd) {
	setTimeout(function () {
		var suggestions = textToAdd;
		var suggLength = textToAdd.length;
		$(' <div class="singleCard"> <div class="suggestions"><div class="menu"></div></div></diV>').appendTo('.chats').hide().fadeIn(1000);
		// Loop through suggestions
		for (i = 0; i < suggLength; i++) {
			$('<div class="menuChips" data-payload=\''+(suggestions[i].payload)+'\'>' + suggestions[i].title + "</div>").appendTo(".menu");
		}
		scrollToBottomOfResults();
	}, 1000);
}


// on click of suggestions, get the value and send to rasa
$(document).on("click", ".menu .menuChips", function () {
	var text = this.innerText;
	var payload= this.getAttribute('data-payload');
	console.log("button payload: ",this.getAttribute('data-payload'))
	setUserResponse(text);
	send(payload);
	$('.suggestions').remove(); //delete the suggestions 
});

<?php
	require_once('../includes/databaseConnection.php');
	session_start();
	require_once("../includes/checkLogin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "../includes/head-meta-data.inc.php"; ?>
	<!-- chatbot css -->

     <!--Import Google Icon Font-->
      <!--   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
      <link href="../staticChatBot/css/style.css" rel="stylesheet">
      <!--Import materialize.css-->
      <link rel= "stylesheet" type= "text/css" href= "../staticChatBot/css/style.css">
      <!--Main css-->
      <!-- <link rel= "stylesheet" type= "text/css" href= "../staticChatBot/css/materialize.min.css"> -->
      <!--  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
      <link href="../staticChatBot/css/style.css" rel="stylesheet">
      <!--   speech main CSS   -->
      <link rel="stylesheet" href="../staticChatBot/css/style_speech.css">
      <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
 	<link rel='stylesheet' href='../css/index.css' />
 	<!-- <link rel="stylesheet" type="text/css" href="../css/taskList.css"> -->
 	<style type="text/css">
		.updateBtn, .delBtn, .addBtn {
			color: #2bbbad;
			cursor: pointer;
		}
		.updateBtn:hover, .delBtn:hover, .addBtn:hover {
			color: blue;
		}
		audio{display:none;}
		#btn-start-recording,#btn-stop-recording{margin:0;}

		iframe {
			width: 100%;
			position: relative;
			top: -10px;
		}
	 </style>
	 
	
</head>
<body>
<header>
    <div>
      <!-- Navigation Bar -->
      <?php include "../includes/navigation-bar.inc.php"; ?>
      <!-- End of Navigation Bar -->
    </div>
</header>
<div class="container">
	<iframe  src="http://172.16.16.249:3500" id="editIframe" name="editIframe" frameborder="0" scrolling="no" allowTransparency="true"  ></iframe>
</div>

 <!-- speech ASR test -->
 <section>
        <!-- <button id="btn-start-recording">recording</button>
        <button id="btn-stop-recording" disabled>stop</button> -->
        <div style="opacity: 0;">
            <p>You said: </p>
            <p id="txt"></p>
        </div>
        <!-- <audio controls autoplay playsinline></audio> -->
        <!-- <audio controls  playsinline></audio> -->
      </section>
      <div class="container">
         <div class="widget">
            <div class="chat_header">
               <!--Add the name of the bot here -->
               <span style="color:white;margin-left: 5px;">ChatBot </span>
               <span style="color:white;margin-right: 5px;float:right;margin-top: 5px;" id="close">
               <i class="material-icons">close</i>
               </span>
            </div>
            <!--Chatbot contents goes here -->
            <div class="chats" id="chats">
               <div class="clearfix"></div>
            </div>
            <!--user typing indicator -->
            <div class="keypad" >
               <input type="text" id="keypad" class="usrInput browser-default" placeholder="Type a message..." autocomplete="off">
               <!-- <span><img src="./static/img/录音.png" class="mic_logo" id="btn-start-recording"></span>
               <span><img src="./static/img/结束 (3).png" class="mic_logo" id="btn-stop-recording""></span> -->
               <!-- <section>
                <button id="btn-start-recording">recording</button>
                <button id="btn-stop-recording" disabled>stop</button>
                </section> -->
                <button id="btn-start-recording">R</button>
                <button id="btn-stop-recording" disabled>S</button>
                <audio controls  playsinline></audio>
            </div>

         </div>
         <!--bot widget -->
         <div class="profile_div" id="profile_div">
            <img class="imgProfile" src="../staticChatBot/img/botAvatar0.png"/>
         </div>
      </div>

	<script src="../staticChatBot/js/jquery.min.js"></script>
	<script type="text/javascript" src="../staticChatBot/js/materialize.min.js"></script>
	<script type="text/javascript" src="../staticChatBot/js/script.js"></script>
	<script src="../staticChatBot/js/md5.min.js"></script>
    <script src="https://www.webrtc-experiment.com/common.js"></script>
    <script src="../staticChatBot/js/RecordRTC.js"></script>

<script type="text/javascript">
	$(function(){
	    // 菜单栏点击事件
	    $("#mainMenu li, #mobile_menu li").removeClass("active");
	    $("#coEdit, #coEdit_m").addClass("active");
	});

	var window_height = $(window).height();
	var window_width = $(window).width();
	var minHeight = 500; 

	// 初始化
	if(window_height > minHeight) {
		$("iframe").height (window_height - 100);
	} else {
		$("iframe").height(window_height);
	}
	
	//当浏览器大小变化时
	$(window).resize(function () {      
		if(window_height > minHeight) {
			$("iframe").height (window_height - 100);
		} else {
			$("iframe").height(window_height);
		}

	});
	let audio = document.querySelector('audio');
        let audioTxt = document.getElementById('txt');
        let ws = new WebSocket('ws://172.16.16.249:9001');
	function start(){
		
        ws.onopen = e => {
                console.log('Connection to server opened');

			}
		ws.onmessage = e => {
            console.log("111");
            console.log(e);
            console.log("ddddd")
            console.log(e.data);
			console.log("ddd")
            if (e.data) {
				audioTxt.innerHTML += e.data;
				setUserResponse(e.data);
                send(e.data);
            }
        }
        ws.onclose = e => {
            console.log('Connection to server closed');

        }
	}

	// let audio = document.querySelector('audio');
    //     let audioTxt = document.getElementById('txt');
    //     let ws = new WebSocket('ws://172.16.16.249:9001');
    //     ws.onopen = e => {
    //             console.log('Connection to server opened');

    //         }
            /**
             * @name: captureMicrophone
             * @description: 获取麦克风权限
             * @param {type} callback
             * @return: none
             */
        function captureMicrophone(callback) {
            navigator.mediaDevices.getUserMedia({
                audio: true
            }).then(callback).catch(function(error) {
                alert('Unable to access your microphone.');
                console.error(error);
            });
        }
        // converts blob to base64
        const blobToBase64 = function(blob, cb) {
            let reader = new FileReader();
            reader.onload = function() {
                let dataUrl = reader.result;
                let base64 = dataUrl.split(',')[1];
                cb(base64);
            };
            reader.readAsDataURL(blob);
        };
        /**
         * @name: stopRecordingCallback
         * @description: 停止说话
         * @param {type} none
         * @return: none
         */
        function stopRecordingCallback() {
            audio.srcObject = null;
            let blob = recorder.getBlob();
            console.log(blob);
            ws.send(blob)
            audio.src = URL.createObjectURL(blob);

            recorder.microphone.stop();

        }
        // ws.onmessage = e => {
        //     console.log("111");
        //     console.log(e);
        //     console.log("ddddd")
        //     console.log(e.data);
		// 	console.log("ddd")
        //     if (e.data) {
		// 		audioTxt.innerHTML += e.data;
		// 		setUserResponse(e.data);
        //         send(e.data);
        //     }
        // }
        // ws.onclose = e => {
        //     console.log('Connection to server closed');

        // }

        let recorder; // globally accessible
        /**
         * @name: 
         * @description: 开始说话
         * @param {type} none
         * @return: 
         */
        // 音频采集的过程中（录音过程），判断输入音量的大小是否小于设置的值，小于的话就停止录音。
        // recorder.onaudioprocess = e => {
        //     let data = e.inputBuffer.getChannelData(0);
        //     let l = Math.floor(data.length / 10);
        //     let vol = 0;
        //     for (let i = 0; i < l; i++) {
        //         vol += Math.abs(data[i * 10]);
        //     }
        //     emptyCheckCount++;
        //     console.log(vol);
        //     if (vol < 30) { //设置音量 数值越大越容易停 emptydatacount ++; console.log(emptydatacount); if(emptydatacount> 30){
        //         //设置静音停止次数
        //         console.log('stoped');
        //         self.recordStop();

        //     } else {
        //         emptydatacount = 0;
        //     }
        //     audioData.input(e.inputBuffer.getChannelData(0));
        // }
        document.getElementById('btn-start-recording').onclick = function() {
            // this.disabled = true;
			audioTxt.innerHTML = '';
			document.getElementById('btn-start-recording').style.background = "#6072e6";
            captureMicrophone(function(microphone) {
                audio.srcObject = microphone;


                recorder = RecordRTC(microphone, {
                    type: 'audio',
                    recorderType: StereoAudioRecorder,
                    desiredSampRate: 16000
                });

                recorder.startRecording();

                // 点击停止说话是释放麦克风
                recorder.microphone = microphone;
                document.getElementById('btn-stop-recording').disabled = false;
            });
        };
        /**
         * @name: 
         * @description: 停止说话
         * @param {type} none
         * @return: 
         */
        document.getElementById('btn-stop-recording').onclick = function() {
            // this.disabled = true;
			recorder.stopRecording(stopRecordingCallback);
			document.getElementById('btn-start-recording').style.background = "linear-gradient(180deg, #39C2C9 0%, #3FC8C9 80%, #3FC8C9 100%)";

        };

	
</script>
</body>
</html>
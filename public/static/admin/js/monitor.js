function closeRoom(roomId){
  	var data2 = {"token":"1234567","roomnum":roomId};
	$.ajax({
		async: false,
		url: '/Admin/Monitor/stopRoom',
		data:{uid:roomId},
		dataType: "json",
		success: function(data){
		    //console.log(data);
            
			if(data.status ==0){
				alert(data.info);
			}else{
				socket.emit("superadminaction",data2);
				alert("房间已关闭");
				location.reload();
			}
		},
		error:function(XMLHttpRequest, textStatus, errorThrown){
			alert('关闭失败，请重试');
		}
	});
}

function fullRoom(uid){

	$.ajax({
	    type:"post",
	    url:"/Admin/Monitor/full",
	    data:{uid:uid},
	    success:function(data){

	      $("#buyvip").css({"left":getMiddlePos('buyvip').pl+"px","z-index":2100,}).show();
	      $("#buyvip").html(data);

    	}

	});
}

function closePorp(){

	$('#buyvip').hide();
  	$('#buyvip').html("");
}

function setVideo(id,pull){

	console.log(pull);
    if(pull==''){
        return !1;
    }
    var last_len=pull.lastIndexOf(".")+1;
    var len = pull.length;
    var pathf = pull.substring(last_len,len).toLowerCase();
    
    document.getElementById(id).innerHTML ='';

    if(pathf=='flv'){
        new FlvJsPlayer({
            id: id,
            url: pull,
            autoplay: true,
            autoplayMuted: true,
            playsinline:true,
            volume:0.2,
            width:'100%',
            height:'100%',
            fitVideoSize: 'auto',
            ignores: ['time','replay']
        });
        return !0;
    }
    
    if(pathf=='hls'){
        new HlsJsPlayer({
            id: id,
            url: pull,
            autoplay: true,
            autoplayMuted: true,
            playsinline:true,
            volume:0.2,
            width:'100%',
            height:'100%',
            fitVideoSize: 'auto',
            ignores: ['time','replay']
        });
        return !0;
    }
    
    new Player({
        id: id,
        url: pull,
        autoplay: true,
        autoplayMuted: true,
        playsinline:true,
        volume:0.2,
        width:'100%',
        height:'100%',
        fitVideoSize: 'auto',
        ignores: ['time','replay']
    });
    
    return !0;
}
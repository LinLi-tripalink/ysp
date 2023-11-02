(function(){

	$("input[name='type']").on('click',function(){
		var val=$(this).val();
		if(val==1){
			$("#swf_area").show();
		}else{
			$("#swf_area").hide();
		}
	});

    $("#swftype label.radio-inline").on('click',function(){
        var v=$("input",this).val();
        //console.log(v);
        var b=$("#swftype_bd_"+v);
        b.siblings().hide();
        if(v==0){
        	$("#swftype_cancel_0").show();
        }else{
        	$("#swftype_cancel_0").hide();
        }

        b.show();
    })
    
    
})()
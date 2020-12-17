// JavaScript Document
function suggest(inputString ,id,type){
	if(inputString.length == 0) {
		$('#suggestions_'+id).fadeOut();
	} else {
	$('#'+id).addClass('load');
		$.post("../../aids/autosuggest.php", {queryString: ""+inputString+"",id:""+id+"",type:""+type+""}, function(data){
			if(data.length >0) {
				$('#suggestions_'+id).fadeIn();
				$('#suggestionsList_'+id).html(data);
				//alert('#suggestionsList_'+id);
				$('#'+id).removeClass('load');
			}
		});
	}
	$('#suggestions_'+id).mouseleave(function() {
		$('#suggestions_'+id).fadeOut();
	});
}

function fill(thisValue ,id) {
	//alert('#suggestions_'+id);
	$('#'+id).val(thisValue);
	setTimeout("$('#suggestions_"+id+"').fadeOut();", 200);
}


function suggest_front(inputString ,id,type,parent){
	if(inputString.length == 0) {
		$('#suggestions_'+id).fadeOut();
	} else {
	$('#'+id).addClass('load');
		$.post("aids/autoSuggest_front.php", {queryString: ""+inputString+"",id:""+id+"",type:""+type+"",parent:""+parent+""}, function(data){
			if(data.length >0) {
				$('#suggestions_'+id).fadeIn();
				$('#suggestionsList_'+id).html(data);
				//alert('#suggestionsList_'+id);
				$('#'+id).removeClass('load');
			}
		});
	}
	$('#suggestions_'+id).mouseleave(function() {
		$('#suggestions_'+id).fadeOut();
	});
}
function votez(folder,voteQ,requiredMSG){
	selected=0;
	formm=document.getElementById('pollF');
	radio=formm.poll_answer;
	// checking wich element is seleced
	if(radio.length==undefined){ if(radio.checked)selected=radio.value;}
	else
	for(i=0;i<=radio.length-1;i++)
		if(radio[i].checked)
			selected=radio[i].value;
	//finish checking
	if(selected==0) document.getElementById('pollR').innerHTML=requiredMSG;
		else{
			document.getElementById('pollR').innerHTML='';
		$.ajax({
			url:folder+"vote.php",
			data:"id="+selected+"&voteQ="+voteQ,
			type:"POST",
			beforeSend:function(){
				document.getElementById('pollR').innerHTML='<img src="images/vote/loader.gif" />';
				$("#pollA").slideToggle("slow");
			},
			success:function(msg){
				document.getElementById('pollR').innerHTML=''; 
				document.getElementById('pollA').innerHTML=msg;
				$("#pollA").slideToggle("slow");
			}
		});
	}
	return false;
}
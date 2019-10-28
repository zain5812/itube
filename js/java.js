$(document).ready(function(){
	$('p i').click(function(){
		$('.play-video-desc').slideToggle('slow');
	});
});
function search_video(){
	var skey=document.getElementById('skey').value;
	if(!skey==""){
		var http=new new XMLHttpRequest();
		http.onreadystatechange=function(){
			if(http.readyState=="4" && http.status=="200"){
				
			}
		};
	}
}

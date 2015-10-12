$(document).ready(function() {
	$('.message').scrollTop(100000);

	$('.list-group-item').click(function(){
		if(typeof id_room !== "undefined") $('#room-'+id_room).css("background","#fff");
		id_room = $(this).attr("data-id");
		$.post("/chat/ajax_post",{id_room: id_room}, function(data){
			$('.message').html(data);
			$('.title_room').text( $(this).attr("data-name") );
			$('.box').css("display","block");
			$('.select').css("display","none");
		});
		$(this).children('span').text('');
		$(this).css("background","#DFFDEE");
		$('.message').scrollTop(100000);
	});

	$('#send').submit(function(event){
		var text = $('#text').val();
		var reader = $('#reader').attr("data-reader");
		$.post("/chat/ajax_add_post",{id_room: id_room, message: text, reader: reader}, function(data){
			$('#text').val('');
		});
		event.preventDefault();
	});
	function reload(){
		if(typeof id_room !== "undefined")
			$.post("/chat/ajax_post",{id_room: id_room}, function(data){
				$('.message').html(data);
				$('.message').scrollTop(100000);
			});	
	}
	function reload_new_post(){
		if(typeof id_room !== "undefined")
			$.post("/chat/ajax_new_post",{id_room: id_room}, function(data){
				var new_post = $.parseJSON( data );
				for(var i=0; i<new_post.length; i++){
					if(new_post[i]['Count']>0)
						$('#room-' + new_post[i]['id'] + ' span').text( new_post[i]['Count'] );
				}
			});
	}
	//setInterval(reload_new_post,3000);
	setInterval(reload, 1000);
});
	function del_post(id_post){
		$.post("/chat/ajax_delete_post",{id_post: id_post}, function(data){
		});
	};
	function send_to(id_user, login){
		$('#reader').attr("data-reader", id_user);
		$('#reader').html(login +": ");
	}
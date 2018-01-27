$(document).ready(function() {
	updateCounter();
	$(document).on('click', '.check-role', function(){
		var button=$(this);
		var roleID=Number(button.data('id'));
		var projID=Number(button.data('id2'));
		$.ajax({
			url: 'upvote_server.php',
			type: 'POST',
			data: {
				'check_role': 1,
				'roleID': roleID,
				'projID': projID,
			},
			success: function(data){
				button.closest('div').remove();
				
				if(Number(data)==0){
					$('#no-roles').html("No roles available at this moment");
				}
			}

		});
	});

	$(document).on('click', '.remove-role', function(){
		var button=$(this);
		var roleID=Number(button.data('id'));
		var projID=Number(button.data('id2'));
		$.ajax({
			url: 'upvote_server.php',
			type: 'POST',
			data: {
				'del_role': 1,
				'roleID': roleID,
				'projID': projID,
			},
			success: function(data){
				button.closest('div').remove();
				
				if(Number(data)==0){
					$('#no-roles').html("No roles available at this moment");
				}
			}

		});
	});
	$('#upvote').parent().on('click', '#upvote', function(){
		
		var interest=Number($('#interest').html());
		var butText=$('#upvote').html();
		if(butText!=="posted!"){

			$.ajax({
				url: 'upvote_server.php',
				type: 'POST',
				data: {
					'up': 1,
					'usr_id': usr_id,
					'proj_id': proj_id,
				},
				success: function(response){
					interest+=1;
					
					var tText=interest+" people interested to join";
					
					$('#interest').html(interest);
					$('#interest').attr('data-tooltip', tText);
					$('#upvote').html("posted!");
					
				}
			});
		}
		else{
			$.ajax({
				url: 'upvote_server.php',
				type: 'POST',
				data: {
					'down': 1,
					'usr_id': usr_id,
					'proj_id': proj_id,
				},
				success: function(response){
					interest-=1;
					
					var tText=interest+" people interested to join";
					
					$('#interest').html(interest);
					$('#interest').attr('data-tooltip', tText);
					$('#upvote').html('<i class="fa fa-hand-o-up" aria-hidden="true"></i>Keep me posted');
					
				}
			});


		}
		
	});


	
});
function updateCounter(){
	$.ajax({
		type: 'GET',
		url: 'upvote_server.php',
		dataType: 'json',
		data:{
			'update': 1,
			'usr_id': usr_id,
			'proj_id': proj_id,
		},
		timeout: 10000,
		success: function(data){
			
			$('#interest').html(data.count);
			$('#interest').attr('data-tooltip', data.count+" people interested to join");
			if(data.present){
				$('#upvote').html("posted!");
			}
			window.setTimeout(updateCounter, 10000);

		},

	});
}
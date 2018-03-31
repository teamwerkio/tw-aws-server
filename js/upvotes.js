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

	$(document).on('click', '.rejbutt', function(){
		var button=$(this);
		var reqID=Number(button.data('reqid'));
		var name=button.data('name');
		
		
		$.ajax({
			url: 'join_proj_acc_rej.php',
			type: 'POST',
			data: {
				'rej': 1,
				'reqID': reqID,
			},
			success: function(data){
				
				
				
				if(Number(data)==0){

					button.closest('table').remove();
					swal('Invitation Declined', name+' will not be a part of your team', 'error');
				}
				else{
					button.closest('tr').remove();
				}
			}

		});
	});

	$(document).on('click', '.accbutt', function(){
		var button=$(this);
		var reqID=Number(button.data('reqid'));
		var name=button.data('name');
		$.ajax({
			url: 'join_proj_acc_rej.php',
			type: 'POST',
			data: {
				'acc': 1,
				'reqID': reqID,
			},
			success: function(data){
				var json=JSON.parse(data);
				
				
				if(Number(json.rows)==0){
					$("#teamprof").append(json.html);
					button.closest('table').remove();
					swal('Invitation Accpeted', name+' is now a part of your team', 'success');
				}
				else{
					$("#teamprof").append(json.html);
					button.closest('tr').remove();
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
$(document).ready(function(){
	$(document).on('click', '.check-up', function(){
		var button=$(this);
		var upID=Number(button.data('id'));
		var projID=Number(button.data('id2'));
		$.ajax({
			url: 'update_server.php',
			type: 'POST',
			data: {
				'check': 1,
				'upID': upID,
				'projID': projID,
			},
			success: function(data){
				button.closest('li').remove();
				
				if(Number(data)==0){
					$('#no-updates').html("No updates available");
				}
			}

		});
	});
	$(document).on('click', '.del-up', function(){
		var button=$(this);
		var upID=Number(button.data('id'));
		var projID=Number(button.data('id2'));
		$.ajax({
			url: 'update_server.php',
			type: 'POST',
			data: {
				'del': 1,
				'upID': upID,
				'projID': projID,
			},
			success: function(data){
				button.closest('li').remove();
				
				if(Number(data)==0){
					$('#no-updates').html("No updates available");
				}
			}

		});
	});
})
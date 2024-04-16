

$(document).ready(function() {

	load_folder_list();
	function load_folder_list(){
		var action = 'fetch';
		//alert($("input[name=_token]").val());
		$.ajax({
			url: 'filemanager',
			method: 'POST',
			data: {
		        "_token": $("input[name=_token]").val(),
		        "action": action
		        },
			success:function(data){
				//console.log(data);
				$("#folder_table").html(data);
			}
		});
		
	}
});
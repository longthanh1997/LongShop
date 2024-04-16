$(document).ready(function(){
	//submit form filter product

	$("#edit_list_product_for").change(function(event) {
		$("#edit_list_product").val($(this).val());
	});
	
	$("#submit_form_product_edit_list").click(function(event) {

		$("#form_product_edit_list").submit();

	});

$("#create_account").click(function(event) {
    /* Act on the event */
    $("#modal_create_account").modal("show");
  });

	
	$("#add_avatar").click(function() {
		/* Act on the event */
		$("#product_avatar").click();
	});
	$("#add_product_gallery").click(function() {
		/* Act on the event */
		//$("#show_product_gallery").html('');
		//$("#product_gallery").val('').clone(true);
		
		$("#product_gallery").click();

	});
	$("#product_avatar").change(function(event) {
		/* Act on the event */
		if (this.files && this.files[0]) {
    	var reader = new FileReader();
    
	    reader.onload = function(e) {
	      $('#add_avatar').attr('src', e.target.result);
	    }
    
    	reader.readAsDataURL(this.files[0]); // convert to base64 string
    	}	
	});

	$("#product_gallery").change(function(event) {
		/* Act on the event */
		$('#show_product_gallery').empty('');
		
		var files = event.target.files;

		var filecollection = new Array();
		$.each(files, function(index, el) {
			filecollection.push(el);

			var reader1 = new FileReader();
			reader1.readAsDataURL(el);
			reader1.onload = function(e) {
				var template = '<div class="col-xs-12 col-sm-4 mb-2"><img src="'+e.target.result+'" width="100%" height="100%"/></div>';
		      
		      $('#show_product_gallery').append(template);

		    };
		});


	});



  $(".nav-tabs a").click(function(){
    $(this).tab('show');
  });

	$('.check_all').change(function(event) {
		$(".check_list").prop('checked', $(this).prop('checked'));
		if($(this).prop('checked') == true){
			$('.check_all').prop('checked', true);
		}
		else{
			$('.check_all').prop('checked', false);
		}
	});
	$('.check_list').change(function(event) {
		if($(this).prop('checked') == false){
			$('.check_all').prop('checked', false);
		}
		if($('.check_list:checked').length == $('.check_list').length){
			$('.check_all').prop('checked', true);
		}
	});








	$('#category_table').dataTable({
        "aaSorting": [],
        "columnDefs": [
        { "orderable": false, "targets": [3] },
        ]
    });
  
    $('#brand_table').dataTable({
       "columnDefs": [
        { "orderable": false, "targets": [0, 4] },
    ]
    });

    $('#variation_type_table').dataTable({
       "columnDefs": [
        { "orderable": false, "targets": [0, 3] },
    ]
    });

    $('#bubble_title_table').dataTable({
       "columnDefs": [
        { "orderable": false, "targets": [0, 2] },
    ]
    });
    $('#product_table').dataTable({
       "columnDefs": [
        { "orderable": false, "targets": [0, 9] },
    ]
    });


    $('#banner_table').dataTable({
    	"aaSorting": [],
      	"columnDefs": [
        { "orderable": false, "targets": [0, 2, 5] },
    ]
    });



});
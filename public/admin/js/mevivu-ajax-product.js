
var count_variation = 0;


$(document).on('click', '.result_search_product', function(){
	var id = $(this).data('id');
	$.ajax({
			url: 'choosesearchproduct/'+id,
			type: 'get',
			dataType: 'json',
			success: function(data){
				//alert(value);
				//alert(data[0]['variation_name']);
				// $.each(data, function(index, el) {
					
				// });
				var  html = '';
				if(data.length == 1){
					html +='<li class="list-group-item list-group-item-action">'+
						'<span class="name_product">'+data[0]["product_name"]+'</span>'+
						'<span class="name_variation" data-type="0">'+data[0]["product_group_name"]+'</span>'+
						'<input type="hidden" class="product_group" name="product_group[]" value="'+data[0]["id"]+'">'+
					'</li>';
				}
				else{
					for(var i = 0; i < data.length; i ++){
					html +='<li class="list-group-item list-group-item-action">'+
						'<span class="name_product">'+data[i]["product_name"]+'</span>'+
						'<span class="name_variation" data-type="0">'+data[i]["product_group_name"]+'</span>'+
						'<input type="hidden" class="product_group" name="product_group[]" value="'+data[i]["id"]+'">'+
					'</li>';
					}
				}
				$("#show_result_search").fadeOut('slow');
				$("#show_result_search").html(html);
				$("#show_result_search").fadeIn('slow');
				$("#add_product_search").val('');

			}

		});
});

$(document).on('keyup', '#add_product_search', function(){
	var key = $(this).val();
	if(key == ''){
    	key = '!@';
    }
	$.ajax({
			url: 'searchproduct/'+key,
			type: 'get',
			dataType: 'json',
			success: function(data){
				//alert(value);
				//alert(data[0]['variation_name']);
				// $.each(data, function(index, el) {
					
				// });
				$("#result_search").html('<li class="text-center list-group-item list-group-item-action"><i class="text-lg fas fa-spinner fa-pulse"></i></li>');
				var  html = '';
				if (data.length == 0) {
					html = '<li class="list-group-item list-group-item-action">Không tìm thấy</li>';
				}
				for(var i = 0; i < data.length; i ++){
					html +='<li data-id="'+data[i]["id"]+'" class="check_product'+data[i]["id"]+' result_search_product list-group-item list-group-item-action">'+data[i]["product_name"]+'</li>';
				}
				setTimeout(function() {
                $("#result_search").html(html);	
            }, 1000);
				
				var id = $("#id_product").val();
				$(".check_product"+id).css('display', 'none');
			}

		});

	
});
$(document).on('focusin', '#add_product_search', function(){
    var key = $(this).val();
    if(key == ''){
    	key = '!@';
    	$.ajax({
			url: 'searchproduct/'+key,
			type: 'get',
			dataType: 'json',
			success: function(data){
				//alert(value);
				//alert(data[0]['variation_name']);
				// $.each(data, function(index, el) {
					
				// });
				$("#result_search").html('<li class="text-center list-group-item list-group-item-action"><i class="text-lg fas fa-spinner fa-pulse"></i></li>');
				var  html = '';
				if (data.length == 0) {
					html = '<li class="list-group-item list-group-item-action">Không tìm thấy</li>';
				}
				for(var i = 0; i < data.length; i ++){
					if(data[i]["id"] == $('#id_product').val()){
						html +='<li style="display:none;" data-id="'+data[i]["id"]+'" class="result_search_product list-group-item list-group-item-action">'+data[i]["product_name"]+'</li>';
					}
					else{
						html +='<li data-id="'+data[i]["id"]+'" class="result_search_product list-group-item list-group-item-action">'+data[i]["product_name"]+'</li>';
					}
					
				}
				setTimeout(function() {
                $("#result_search").html(html);	
            }, 1000);
							

			}

		});
    }
	
  });



$(document).on('focusout', '#add_product_search', function(){
	setTimeout(function() {
                $("#result_search").html('');
            }, 700);
    
  });




$(document).ready(function(){


	//delete gallery image
	$(".edit_product_delete_gallery").click(function(event) {
		/* Act on the event */
		var id = $(this).data('id');
		var id_product = $("#id_product").val();
		//alert(id_product);
		$.get('deleteproductgallery/'+id+'/'+id_product, function(data) {
			/*optional stuff to do after success */
			$(".edit_product_gallery"+data).remove();




		});
	});








	$("#click_delete_product").click(function(){
    var id = $("#id_delete").val();
    //alert(id);
    $.get('deleteproduct/'+id, function(data) {
            /*optional stuff to do after success */
            //alert(data);
        $('.post'+data).addClass('bg-gradient-danger');
        
        $('#delete_product').modal('hide');
        setTimeout(function() {
                $('.post'+data).remove();
            }, 1000);
    });

});


	$(document).on('click', '.delete_modal_product', function(){

	    //status

	    var t = 'Bạn có chắc muốn xóa sản phẩm <b>'+$(this).data('title')+'</b> ?';
	    $("#content_delete").html(t);
	    $("#id_delete").val($(this).data('id'));
	    $("#delete_product").modal('show');


	});

	$("#product_variation_status").change(function() {
		/* Act on the event */
		if($(this).val() == 1){
			$("#yes_variation").css("display", "unset");
		}
		else{
			$("#yes_variation").css("display", "none");
		}
	});













});














// var count_variationtype = 0;
// var count_variation = 0;


// $(document).on('click', '#id_product_multi_variation', function(){
// 	var value = $(this).data('vt1');
// 	$.ajax({
// 			url: 'getajaxvariation/'+value,
// 			type: 'get',
// 			dataType: 'json',
// 			success: function(data){
// 				//alert(value);
// 				//alert(data[0]['variation_name']);

// 			}

// 		});
// });


// $(document).on('click', '#add_product_variationtype', function(){
// 	var value = $("#product_variationtype_choose option:selected").val();
// 	var text = $( "#product_variationtype_choose option:selected" ).text();
// 	if(value != 0 ){
		
// 		$("#add_variationtype .list-group").append('<li class="type'+value+' list-group-item list-group-item-action">'+
// 			'<span>'+text+'</span>'+
// 			'<span class="variationtype_close" data-type="'+value+'"><i class="fas fa-times"></i></span>'+
// 			'</li>');

// 		$('#product_variationtype_choose option[value="'+value+'"]').attr("disabled", "disabled");

// 		$('#product_variationtype_choose option[value="0"]').prop('selected', true);

		
// 		count_variationtype += 1;
// 		$("#id_product_multi_variation").css('display', 'unset');
// 		if(count_variationtype == 1){
// 			$("#id_product_multi_variation").attr('data-vt1', value);
// 		}else if(count_variationtype == 2){
// 			$("#id_product_multi_variation").attr('data-vt2', value);
// 		}



		

// var option = ''; 
// 				for(var i = 0; i < data.length; i ++){
// 					option +='<option value="'+data[i]["id"]+'">'+data[i]["variation_name"]+'</option>';
// 				}
// 				//console.log(option);
// 				$("#id_product_variation .list-group").prepend('<li class="count_variation'+count_variation+' list-group-item list-group-item-action" data-toggle="collapse" data-target="#variation_price"'+count_variation+'>'+
// 				'<span class="add_variationtype_jquery"><select class="form-control" name="variation1[]">'+option+'</select>'+
// 				'</span>'+
// 				'<span class="variation_close" data-variation="'+count_variation+'"><i class="fas fa-times"></i></span>'+
// 				'<div id="variation_price"'+count_variation+'" class="collapse show">'+
//     			'<div class="row">'+
// 					'<div class="col-xs-12 col-sm-4 form-group">'+
// 					    '<label for="product_price">Product Price:</label>'+
// 					    '<input type="nnumber" class="form-control" placeholder="Product price" name="product_price_variation[]" id="product_price_variation">'+
// 					'</div>'+
// 					'<div class="col-xs-12 col-sm-4 form-group">'+
// 					    '<label for="product_promotion">Discount</label>'+
// 					    '<input type="text" class="form-control" placeholder="% reduction" name="product_promotion_variation[]" id="product_promotion_variation">'+
// 					'</div>'+
// 					'<div class="col-xs-12 col-sm-4 form-group">'+
// 					    '<label for="price_installment">Installment:</label>'+
// 					    '<input type="text" class="form-control" placeholder="% Installment" name="price_installment_variation[]" id="price_installment_variation[]">'+
// 					'</div>'+
// 				'</div>'+
//   				'</div>'+
// 				'</li>');
// 				$("#id_product_multi_variation").css('display', 'unset');

// 				count_variation += 1;



// 	}
// 	else{
// 		alert('Bạn phải chọn loại biến thể');
// 	}
	
// });


// $(document).on('click', '.variation_close', function(){
// 	$('.count_variation'+$(this).data('variation')).remove();
// 	count_variation -= 1;
// 	if(count_variation == 0 || count_variationtype == 0){
// 		$("#id_product_multi_variation").css('display', 'none');
// 	}
// });

// $(document).on('click', '.variationtype_close', function(){
// 	count_variationtype -= 1;
// 	var value = $(this).data('type');
// 	$('.type'+value).remove();
// 	$('#product_variationtype_choose option[value="'+value+'"]').removeAttr("disabled");
// 	if(count_variationtype == 0){
// 		$("#id_product_multi_variation").css('display', 'none');
// 	}
// });




// $(document).ready(function(){
	





// 	$("#product_variation_status").change(function() {
// 		/* Act on the event */
// 		if($(this).val() == 1){
// 			$("#yes_variation").css("display", "unset");
// 			$("#no_variation").css("display", "none");
// 		}
// 		else{
// 			$("#yes_variation").css("display", "none");
// 			$("#no_variation").css("display", "flex");
// 		}
// 	});
// });


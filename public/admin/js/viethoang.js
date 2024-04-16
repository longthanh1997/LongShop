// Viet Hoang =====================================================
$('#createCouponCode').click(function () {
	var randonmCode = Math.random().toString(36).substring(2) + Math.random().toString(36).substring(2) ;
	randonmCode =  randonmCode.substring(0,10);
	$('#coupon_code').val(randonmCode);
});
$('#coupon_type').change(function () {
	var valueSelected = $('#coupon_type').find(":selected").val();
	if (valueSelected == 1) {
		$('#sanphamuudai').css("display", "none");
		$('#danhmucuudai').css("display", "unset");
		$('#lblUuDai').html('Mức Ưu Đãi (%)')
	}
	else {
		$('#danhmucuudai').css("display", "none");
		$('#sanphamuudai').css("display", "unset");
		$('#lblUuDai').html('Mức Ưu Đãi (VNĐ)')
	}
});
$(document).on('change', '.custom-select',function(e) {


	var id = $(this).val();
	var idBill = $(this).data('value');

	// let id = $(this).val();
	// var action = $('#status').attr('action');
	// action = action.replace('value-new', id);
	// // $('#status').attr('action', action);
	// // $('#status').submit();
	// // alert(action)
	
	$.get('changestatus/' + id + '/' + idBill, function(data){
		alert(data);
	});
});
// End Viet Hoang =====================================================
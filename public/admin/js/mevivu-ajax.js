


//banner
$(document).on('click', '.add_modal_banner', function(){

    //status

    $("#add_banner").modal('show');


});
$(document).on('click', '.click_add_img', function(){

    //status

    $("#image").click();


});

$(document).on('change', '#image', function(){

    //status
    if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.click_add_img').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]); // convert to base64 string
    }

});

$(document).on('click', '.click_edit_banner', function(){

    //status
    $("#id_edit_banner").val($(this).data('id'));

    $("#edit_note").val($(this).data('note'));

    $("#edit_number_order").val($(this).data('number_order'));

    $("#edit_location").val($(this).data('location'));
    $(".click_edit_img").attr('src', $(this).data('image'));
    $("#edit_id_image").val($(this).data('id_image'));

    $("#edit_banner").modal('show');


});
$(document).on('click', '.click_edit_img', function(){

    //status

    $("#edit_image").click();


});
$(document).on('change', '#edit_image', function(){

    //status
    if (this.files && this.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('.click_edit_img').attr('src', e.target.result);
    }

    reader.readAsDataURL(this.files[0]); // convert to base64 string
    }

});






//banner





//---------------danh muc------------------
$(document).on('click', '.edit_modal_category', function(){
//category_sku_edit, category_name_edit, category_status_edit

    $("#edit_category").modal('show');
    $("#id_edit").val($(this).data('id'));
    $("#category_name_edit").val($(this).data('title'));
    $("#category_sku_edit").val($(this).data('code'));
    $("#category_slug_edit").val($(this).data('slug'));

    // For some browsers, `attr` is undefined; for others,
    // `attr` is false.  Check for both.
    // var attr = $("#hien").attr('selected');
    // if (typeof attr !== typeof undefined && attr !== false) {
    //     // ...
    //     $("#hien").removeAttr("selected");
    // }
    // attr = $("#an").attr('selected');
    // if (typeof attr !== typeof undefined && attr !== false) {
    //     // ...removeAttr
    //     $("#an").removeAttr("selected");
    // }
    $('#category_parent_edit option').removeAttr('style');
    var id = $(this).data('id');

    $('#category_parent_edit option[value="'+id+'"]').css('display', 'none');

    var parent = $(this).data('parent');
    $('#category_parent_edit option[value="'+parent+'"]').prop('selected', true);

     var category_type = $(this).data('category_type');
    $('#category_type_edit option[value="'+category_type+'"]').prop('selected', true);

    if($(this).data('status') == 1){
        $('#category_status_edit option[value="1"]').prop('selected', true);
    }
    if($(this).data('status') == 0){


        $('#category_status_edit option[value="0"]').prop('selected', true);
    }

});

$(document).on('click', '.delete_modal_category', function(){

    //status

    var t = 'Bạn có chắc muốn xóa danh mục <b>'+$(this).data('title')+'</b> ?';
    $("#content_delete").html(t);
    $("#id_delete").val($(this).data('id'));
    $("#delete_category").modal('show');


});

$(document).on('submit', '#form_add_category',function(e) {
    // $.$.ajaxSetup({
    //  headers: {
    //      'X-CSRF-TOKEN': $('[name=_token]').attr('value')
    //  }
    // });


    var route = $(this).data('route');
    // var form_data = $(this);
    //alert(route);
    //alert($("#category_parent").val());
    e.preventDefault();
    $.ajax({
        url: route,
        type: 'post',
        data: $('#form_add_category').serialize(),
        dataType:"json",

        success: function(data){
            // console.log(data);
            // alert(data['category_name']);

            $('#category_parent_edit').append(data['html']);
            $('#category_parent').append(data['html']);
            $("#category_name").val('');
            $("#category_sku").val('');
            if(data["category_status"] == 1){
                var tt = '<span class="btn btn-success">Show</span>';

            }
            else{
                var tt = '<span class="btn btn-secondary">Hide</span>';
            }

            if(data["category_sku"] == null){
                var id_of = '';
            }
            else{
                var id_of = data["category_sku"];
            }

             $('#category_table > tbody:last-child').prepend('<tr class="post'+data["id"]+' bg-gradient-warning">'+
                 '<td><input type="checkbox" class="check_list" value="'+data["id"]+'" name="check_list_category[]"></td>'+
                 '<td>'+data["category_name"]+'</td>'+
                 '<td>'+tt+'</td>'+
                 '<td>'+id_of+'</td>'+
                 '<td>'+
                 '<button type="button" class="edit_modal_category btn btn-warning btn-icon-split" data-id="'+data["id"]+'" data-category_type="'+data["category_type"]+'" data-title="'+data["category_name"]+'" data-status='+data["category_status"]+' data-code="'+id_of+'" data-parent="'+data["category_parent"]+'" data-slug="'+data["category_slug"]+'">'+
                 '<span class="icon text-white-50"><i class="fas fa-tools"></i></span><span class="text">Sửa</span></button>'+
                 ' <button type="button" class="delete_modal_category btn btn-danger btn-icon-split" data-id='+data["id"]+' data-title="'+data["category_name"]+'" data-status='+data["category_status"]+' data-code="'+id_of+'" data-parent="'+data["category_parent"]+'" data-slug="'+data["category_slug"]+'">'+
                 '<span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Xóa</span></button>'+
                 '</td>'+
                 '</tr>');
            setTimeout(function() {
                $('.post'+data["id"]).removeClass('bg-gradient-warning');
            }, 500);
    }

    });



});

//category_sku, category_name, category_status


//category_sku, category_name, category_status
//category_sku_edit, category_name_edit, category_status_edit
$(document).on('submit', '#form_edit_category',function(e) {
    var route = $(this).data('route');
    e.preventDefault();
    $.ajax({
        url: route,
        type: 'post',
        data: $('#form_edit_category').serialize(),
        success: function(data){
            if(data == 1){
                alert('Đường dẫn bị trùng');
            }
            else{

                $('#category_parent_edit option[value="'+data["id"]+'"]').replaceWith(data['html']);
                $('#category_parent option[value="'+data["id"]+'"]').replaceWith(data['html']);
                $('#edit_category').modal('hide');
                $("#category_name_edit").val('');
                $("#category_sku_edit").val('');
                if(data["category_status"] == 1){
                    var tt = '<span class="btn btn-success">Show</span>';

                }
                else{
                    var tt = '<span class="btn btn-secondary">Hide</span>';
                }
                if(data["category_sku"] == null){
                    var id_of = '';
                }
                else{
                    var id_of = data["category_sku"];
                }

                 $('.post'+data["id"]).replaceWith('<tr class="post'+data["id"]+' bg-gradient-warning">'+
                     '<td><input type="checkbox" class="check_list" value="'+data["id"]+'" name="check_list_category[]"></td>'+
                     '<td>'+data["category_name"]+'</td>'+
                     '<td>'+tt+'</td>'+
                     '<td>'+id_of+'</td>'+
                     '<td>'+
                     '<button type="button" class="edit_modal_category btn btn-warning btn-icon-split" data-id="'+data["id"]+'" data-category_type="'+data["category_type"]+'" data-title="'+data["category_name"]+'" data-status="'+data["category_status"]+'" data-code="'+id_of+'" data-parent="'+data["category_parent"]+'" data-slug="'+data["category_slug"]+'">'+
                     '<span class="icon text-white-50"><i class="fas fa-tools"></i></span><span class="text">Sửa</span></button>'+
                     ' <button type="button" class="delete_modal_category btn btn-danger btn-icon-split" data-id='+data["id"]+' data-title="'+data["category_name"]+'" data-status="'+data["category_status"]+'" data-code="'+id_of+'" data-parent="'+data["category_parent"]+'">'+
                     '<span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Xóa</span></button>'+
                     '</td>'+
                     '</tr>');
                setTimeout(function() {
                    $('.post'+data["id"]).removeClass('bg-gradient-warning');
                }, 500);


            }


    }

    });
});
$(document).on('click', '#click_delete_category', function(){
    var id = $("#id_delete").val();
    //alert(id);
    $.get('deletecategory/'+id, function(data) {
            /*optional stuff to do after success */
            //alert(data);
        $('#delete_category').modal('hide');
        $('#category_parent_edit option[value="'+data+'"]').remove();
        $('#category_parent option[value="'+data+'"]').remove();

        $('.post'+id).addClass('bg-gradient-danger');
        setTimeout(function() {
                $('.post'+id).remove();
            }, 500);

    });

});





//---------------danh muc------------------


//---------------thuong hieu------------------

// brand_name_edit, brand_sku_edit, brand_status_edit, id_edit

$(document).on('click', '.edit_modal_brand', function(){

    $("#edit_brand").modal('show');
    $("#id_edit").val($(this).data('id'));
    $("#brand_name_edit").val($(this).data('title'));
    $("#brand_sku_edit").val($(this).data('code'));




    if($(this).data('status') == 1){

        //$("#brand_status_sua option[value='1']").attr('selected', 'selected');
        $('#brand_status_edit option[value="1"]').prop('selected', true);

    }


    if($(this).data('status') == 0){


        $('#brand_status_edit option[value="0"]').prop('selected', true);


    }

});


//brand_name, brand_sku, brand_status
$(document).on('click', '.delete_modal_brand', function(){

    //status
    var t = 'Bạn có chắc muốn xóa thương hiệu <b>'+$(this).data('title')+'</b> ?';
    $("#content_delete").html(t);
    $("#delete_brand").modal('show');

    $("#id_delete").val($(this).data('id'));
});
//---------------thuong hieu------------------

$(document).on('click', '.edit_bubble_title', function(){

    $("#modal_edit_bubble_title").modal('show');
    $("#id_edit").val($(this).data('id'));
    $("#bubble_title_name_edit").val($(this).data('title'));

});

//brand_name, brand_sku, brand_status
$(document).on('click', '.delete_bubble_title', function(){

    //status
    var t = 'Bạn có chắc muốn xóa thương hiệu <b>'+$(this).data('title')+'</b> ?';
    $("#content_delete").html(t);
    $("#modal_delete_bubble_title").modal('show');

    $("#id_delete").val($(this).data('id'));
});


$(document).ready(function(){
//alert('hello');

$("#click_delete_bubble_title").click(function(){
    var id = $("#id_delete").val();
    //alert(id);
    $.get('deletebubletitle/'+id, function(data) {
            /*optional stuff to do after success */
            //alert(data);
        $("#modal_delete_bubble_title").modal('hide');
        $('#delete_brand').modal('hide');
        $('.post'+data).addClass('bg-gradient-danger');
        setTimeout(function() {
                $('.post'+data).remove();
            }, 500);
    });

});


//variation_name, variation_sku
$("#form_edit_bubble_title").submit(function(e) {
    // $.$.ajaxSetup({
    //  headers: {
    //      'X-CSRF-TOKEN': $('[name=_token]').attr('value')
    //  }
    // });

    var route = $(this).data('route');
    // var form_data = $(this);
    //alert(route);
    e.preventDefault();
    $.ajax({
        url: route,
        type: 'post',
        data: $('#form_edit_bubble_title').serialize(),
        dataType:"json",

        success: function(data){
            //location.reload(true);
            //console.log(data);
            //alert(data['variation_name']);
             $("#modal_edit_bubble_title").modal('hide');
             $('.post'+data["id"]).replaceWith('<tr class="post'+data["id"]+' bg-gradient-warning">'+
                '<td><input type="checkbox" class="check_list" value="'+data["id"]+'" name="check_list_bubble[]"></td>'+
                '<td>'+data["name"]+'</td>'+
                '<td>'+
                '<button type="button" class="edit_bubble_title btn btn-warning btn-icon-split" data-id="'+data["id"]+'" data-title="'+data["name"]+'" >'+
                '<span class="icon text-white-50"><i class="fas fa-tools"></i></span><span class="text">Sửa</span></button>'+
                ' <button type="button" class="delete_bubble_title btn btn-danger btn-icon-split" data-id='+data["id"]+' data-title="'+data["name"]+'" >'+
                '<span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Xóa</span></button>'+
                '</td>'+
                '</tr>');
            setTimeout(function() {
                $('.post'+data["id"]).removeClass('bg-gradient-warning');
            }, 500);
     }

    });


//  $.post(route, function(data) {
//  // console.log(data);
//  alert(data);
// });

});




//variation_name, variation_sku
$("#form_add_bubble_title").submit(function(e) {
    // $.$.ajaxSetup({
    //  headers: {
    //      'X-CSRF-TOKEN': $('[name=_token]').attr('value')
    //  }
    // });

    var route = $(this).data('route');
    // var form_data = $(this);
    //alert(route);
    e.preventDefault();
    $.ajax({
        url: route,
        type: 'post',
        data: $('#form_add_bubble_title').serialize(),
        dataType:"json",

        success: function(data){
            //location.reload(true);
            //console.log(data);
            //alert(data['variation_name']);
            $("#bubble_title_name").val('');

             $('#bubble_title_table > tbody:last-child').prepend('<tr class="post'+data["id"]+' bg-gradient-warning">'+
                '<td><input type="checkbox" class="check_list" value="'+data["id"]+'" name="check_list_bubble[]"></td>'+
                '<td>'+data["name"]+'</td>'+
                '<td>'+
                '<button type="button" class="edit_bubble_title btn btn-warning btn-icon-split" data-id="'+data["id"]+'" data-title="'+data["name"]+'" >'+
                '<span class="icon text-white-50"><i class="fas fa-tools"></i></span><span class="text">Sửa</span></button>'+
                ' <button type="button" class="delete_bubble_title btn btn-danger btn-icon-split" data-id='+data["id"]+' data-title="'+data["name"]+'" >'+
                '<span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Xóa</span></button>'+
                '</td>'+
                '</tr>');
            setTimeout(function() {
                $('.post'+data["id"]).removeClass('bg-gradient-warning');
            }, 500);
     }

    });


//  $.post(route, function(data) {
//  // console.log(data);
//  alert(data);
// });

});



//brand_name, brand_sku, brand_status
$("#form_add_brand").submit(function(e) {

    var route = $(this).data('route');
    // var form_data = $(this);
    //alert(route);
    e.preventDefault();
    $.ajax({
        url: route,
        type: 'post',
        data: $('#form_add_brand').serialize(),
        dataType:"json",

        success: function(data){
            //console.log(data);
            //alert(data['category_name']);
            $("#brand_name").val('');
            $("#brand_sku").val('');
            if(data["brand_status"] == 1){
                var tt = '<span class="btn btn-success">Show</span>';

            }
            else{
                var tt = '<span class="btn btn-secondary">Hide</span>';
            }

            if(data["brand_sku"] == null){
                var id_of = '';
            }
            else{
                var id_of = data["brand_sku"];
            }
            var thuonghieu = data["brand_name"];
            ;
             $('#brand_table > tbody:last-child').prepend('<tr class="post'+data["id"]+' bg-gradient-warning">'+
                 '<td><input type="checkbox" class="check_list" value="'+data["id"]+'" name="check_list_brand[]"></td>'+
                 '<td>'+data["brand_name"]+'</td>'+
                 '<td>'+tt+'</td>'+
                 '<td>'+id_of+'</td>'+
                 '<td>'+
                 '<button type="button" class="edit_modal_brand btn btn-warning btn-icon-split" data-id="'+data["id"]+'" data-title="'+thuonghieu+'" data-status='+data["brand_status"]+' data-code='+id_of+'>'+
                 '<span class="icon text-white-50"><i class="fas fa-tools"></i></span><span class="text">Sửa</span></button>'+
                 ' <button type="button" class="delete_modal_brand btn btn-danger btn-icon-split" data-id='+data["id"]+' data-title="'+data["brand_name"]+'" data-status='+data["brand_status"]+' data-code='+id_of+'>'+
                 '<span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Xóa</span></button>'+
                 '</td>'+
                 '</tr>');
            setTimeout(function() {
                $(".post"+data["id"]).removeClass('bg-gradient-warning');
            }, 500);
    }

    });


//  $.post(route, function(data) {
//  // console.log(data);
//  alert(data);
// });

});






// brand_name_edit, brand_sku_edit, brand_status_edit, id_edit
$("#form_edit_brand").submit(function(e) {
    // $.$.ajaxSetup({
    //  headers: {
    //      'X-CSRF-TOKEN': $('[name=_token]').attr('value')
    //  }
    // });


    var route = $(this).data('route');
    // var form_data = $(this);
    //alert(route);
    e.preventDefault();
    $.ajax({
        url: route,
        type: 'post',
        data: $('#form_edit_brand').serialize(),
        dataType:"json",

        success: function(data){
            //console.log(data);
            //alert(data['category_name']);
            $('#edit_brand').modal('hide');

            if(data["brand_status"] == 1){
                var tt = '<span class="btn btn-success">Show</span>';

            }
            else{
                var tt = '<span class="btn btn-secondary">Hide</span>';
            }

            if(data["brand_sku"] == null){
                var id_of = '';
            }
            else{
                var id_of = data["brand_sku"];
            }

             $('.post'+data["id"]).replaceWith('<tr class="post'+data["id"]+' bg-gradient-warning">'+
                 '<td><input type="checkbox" class="check_list" value="'+data["id"]+'" name="check_list_brand[]"></td>'+
                 '<td>'+data["brand_name"]+'</td>'+
                 '<td>'+tt+'</td>'+
                 '<td>'+id_of+'</td>'+
                 '<td>'+
                 '<button type="button" class="edit_modal_brand btn btn-warning btn-icon-split" data-id='+data["id"]+' data-title="'+data["brand_name"]+'" data-status='+data["brand_status"]+' data-code='+id_of+'>'+
                 '<span class="icon text-white-50"><i class="fas fa-tools"></i></span><span class="text">Sửa</span></button>'+
                 ' <button type="button" class="delete_modal_brand btn btn-danger btn-icon-split" data-id='+data["id"]+' data-title="'+data["brand_name"]+'" data-status='+data["brand_status"]+' data-code='+id_of+'>'+
                 '<span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Xóa</span></button>'+
                 '</td>'+
                 '</tr>');
            setTimeout(function() {
                $('.post'+data["id"]).removeClass('bg-gradient-warning');
            }, 500);
    }

    });


//  $.post(route, function(data) {
//  // console.log(data);
//  alert(data);
// });

});



$("#click_delete_brand").click(function(){
    var id = $("#id_delete").val();
    //alert(id);
    $.get('deletebrand/'+id, function(data) {
            /*optional stuff to do after success */
            //alert(data);

        $('#delete_brand').modal('hide');
        $('.post'+data).addClass('bg-gradient-danger');
        setTimeout(function() {
                $('.post'+data).remove();
            }, 500);
    });

});







});
$(document).on('keyup', '#in_search_all_product', function(){
    var key = $(this).val();
    if(key == ''){
        key = '!@';
    }
    $.ajax({
            url: 'search-product/'+key,
            type: 'get',
            success: function(data){

                $("#show_search_all_product").html(data);


            }

        });


});
$(document).on('focusout', '#in_search_all_product', function(){
	setTimeout(function() {
                $("#show_search_all_product").html('');
            }, 700);

  });


<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GiohangController;
use App\Http\Controllers\SanphamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LichsumuahangController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminhomeController;
use App\Http\Controllers\AdminSanphamController;
use App\Http\Controllers\AdminFileManagerController;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DonhangController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// tich hop vn pay - cong thanh toan
Route::post('/vnpay_payment',[PaymentController::class,'vnpay_payment']);

// tich hop vn pay - cong thanh toan ----end

Route::get('admin/testmodel', [AdminSanphamController::class, 'testModel']);


Route::get('/search',[SanphamController::class,'search']);
// Route::get('/search?key={name}',[SanphamController::class,'getLink']);

Route::get('/chinhsachbaomat', function () {
    return view('pub.chinhsachbaomat');
});

Route::get('/chinhsachbaohanh', function () {
    return view('pub.chinhsachbaohanh');
});

Route::get('/chinhsachvanchuyen', function () {
    return view('pub.chinhsachvanchuyen');
});

Route::get('/chinhsachdoitra', function () {
    return view('pub.chinhsachdoitra');
});

Route::get('/chinhsachthekhtt', function () {
    return view('pub.chinhsachthekhtt');
});

Route::get('/chinhsachthanhtoan', function () {
    return view('pub.chinhsachthanhtoan');
});
//admin
// Route::get('admin/create', [AdminHomeController::class, 'create']);
Route::get('admin/login', [AdminHomeController::class, 'getLogin']);
Route::post('admin/login', [AdminHomeController::class, 'postLogin']);
Route::get('fix-bug', [AdminSanphamController::class, 'fixBug']);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function(){

	Route::get('/dashboard', [AdminHomeController::class, 'getDashboard']);
	Route::get('/logout', [AdminHomeController::class, 'getLogout']);

	Route::get('/editmainmenu', [AdminHomeController::class, 'getEditMegaMenu']);

	Route::post('/posteditmainmenu', [AdminHomeController::class, 'postEditMegaMenu']);


	Route::get('/comment', [AdminHomeController::class,'getDuyetComment']);

	Route::get('/duyet-comment', [AdminHomeController::class, 'acceptComment']);

	Route::get('/huy-comment', [AdminHomeController::class, 'cancelComment']);

	Route::get('/xoa-comment', [AdminHomeController::class, 'deleteComment']);


	Route::get('filemanager', [AdminFileManagerController::class, 'showFileManager'])->name('filemanager');
	Route::post('filemanager', [AdminFileManagerController::class, 'postFileManager'])->name('postfilemanager');

	Route::get('banner', [AdminSanphamController::class, 'getBanner']);

        Route::post('change-password', [AdminFileManagerController::class, 'postchangePasswordAdmin'])->name('post.changepassword');
        Route::get('manager-admin', [AdminFileManagerController::class, 'getAdminManager']);
        Route::post('create-admin', [AdminFileManagerController::class, 'postCreateAccountAdmin'])->name('post.createAccountAdmin');
	Route::get('delete-account-admin/{id}', [AdminFileManagerController::class, 'getDeleteAccountAdmin']);
        Route::post('add-banner', [AdminSanphamController::class, 'postAddBanner'])->name('post.addBanner');
	Route::post('edit-banner', [AdminSanphamController::class, 'postEditBanner'])->name('post.editBanner');
	Route::get('delete-banner/{id}', [AdminSanphamController::class, 'getDeleteBanner']);

	//danh mục sản phẩm
	Route::group(['prefix' => 'product-category'], function(){


		Route::get('/themdanhmuc', [AdminHomeController::class, 'getThemDanhMuc']);

		Route::post('/themdanhmuc', [AdminHomeController::class, 'postThemDanhMuc']);
		Route::post('/themdanhmucsingle', [AdminHomeController::class, 'postThemDanhMucSingle']);
		Route::post('/suadanhmuc', [AdminHomeController::class, 'postSuaDanhMuc']);

		Route::get('/hienthidanhmuc', [AdminHomeController::class, 'getHienThiDanhMuc']);
		Route::get('/xoadanhmuc/{id}', [AdminHomeController::class, 'getXoaDanhMuc']);

		Route::get('addcategory', [AdminHomeController::class, 'getAddCategory']);

		Route::post('/addcategory', [AdminHomeController::class, 'postAddCategory']);
		Route::post('/addcategorysingle', [AdminHomeController::class, 'postAddCategorySingle']);
		Route::post('editcategory', [AdminHomeController::class, 'postEditCategory']);

		Route::post('editcategorylist', [AdminHomeController::class, 'postEditCategoryList']);

		Route::get('showcategory', [AdminHomeController::class, 'getShowCategory']);
		Route::get('/deletecategory/{id}', [AdminHomeController::class, 'getDeleteCategory']);







	});
	//-------------danh mục sản phẩm--------------------



	//-----------thương hiệu sản phẩm-------------------
	Route::group(['prefix' => 'product-brand'], function(){

		//thương hiệu sản phẩm
		Route::get('/hienthithuonghieu', [AdminHomeController::class, 'getHienThuongHieu']);
		Route::get('/themthuonghieu', [AdminHomeController::class, 'getThemThuongHieu']);
		Route::post('/themthuonghieusingle', [AdminHomeController::class, 'postThemThuongHieuSingle']);

		Route::post('/themthuonghieu', [AdminHomeController::class, 'postThemThuongHieu']);
		Route::post('/suathuonghieu', [AdminHomeController::class, 'postSuaThuongHieu']);
		Route::get('showbrand', [AdminHomeController::class, 'getShowBrand']);
		Route::get('addbrand', [AdminHomeController::class, 'getAddBrand']);
		Route::post('addbrandsingle', [AdminHomeController::class, 'postAddBrandSingle']);

		Route::post('addbrand', [AdminHomeController::class, 'postAddBrand']);
		Route::post('editbrand', [AdminHomeController::class, 'postEditBrand']);

		Route::get('deletebrand/{id}', [AdminHomeController::class, 'getDeleteBrand']);

		Route::post('editbrandlist', [AdminHomeController::class, 'postEditBrandList']);

	});
	//-----------thương hiệu sản phẩm-------------------

	//-------------sản phẩm--------------------

	Route::group(['prefix' => 'product'], function(){

		//sản phẩm
		Route::get('hienthisanpham', [AdminHomeController::class, 'getHienThiSanPham']);

		Route::get('themsanpham', [AdminHomeController::class, 'getThemSanPham']);
		Route::get('showproduct', [AdminSanphamController::class, 'getShowProduct']);

		Route::get('addproduct', [AdminSanphamController::class, 'getAddProduct']);

		Route::post('addproduct', [AdminSanphamController::class, 'postAddProduct']);

		Route::get('editproduct/{id}', [AdminSanphamController::class, 'getEditProduct']);

		Route::post('editproduct', [AdminSanphamController::class, 'postEditProduct']);

		Route::post('editproductlist', [AdminSanphamController::class, 'postEditProductList']);

		Route::get('deleteproduct/{id}', [AdminSanphamController::class, 'getDeleteProduct']);

		Route::get('deleteproductsingle/{id}', [AdminSanphamController::class, 'getDeleteProductSingle']);

		Route::get('editproduct/editproductdeletevariationtype/{id}', [AdminSanphamController::class, 'editProductDeleteVariationtype']);

		Route::get('editproduct/deleteproductgallery/{id}/{id_product}', [AdminSanphamController::class, 'deleteProductGallery']);


		Route::get('editproduct/deleteproductgallery/{id}/{id_product}', [AdminSanphamController::class, 'deleteProductGallery']);

		Route::get('filterproduct', [AdminSanphamController::class, 'postFilterProduct']);

		Route::get('searchproduct/{key}', [AdminSanphamController::class, 'getSearchProduct']);
		Route::get('choosesearchproduct/{id}', [AdminSanphamController::class, 'getChooseSearchProduct']);

		Route::get('editproduct/searchproduct/{key}', [AdminSanphamController::class, 'getSearchProduct']);
		Route::get('editproduct/choosesearchproduct/{id}', [AdminSanphamController::class, 'getChooseSearchProduct']);

                Route::get('search-product/{id}', [AdminSanphamController::class, 'getSearchAllProduct']);




		Route::get('showbubble', [AdminSanphamController::class, 'getShowBubble']);

		Route::post('addbubbletitle', [AdminSanphamController::class, 'postAddBubbleTitle']);
		Route::post('editbubbletitle', [AdminSanphamController::class, 'postEditBubbleTitle']);
		Route::get('deletebubletitle/{id}', [AdminSanphamController::class, 'deleteBubbleTitle']);
		Route::post('editlistbubbletitle', [AdminSanphamController::class, 'postEditListBubbleTitle']);
Route::get('export-excel', [AdminSanphamController::class, 'exportExcel']);
		Route::post('import-excel', [AdminSanphamController::class, 'importExcel']);


	});
	//-----------sản phẩm-------------------


	Route::group(['prefix' => 'bai-viet'], function(){
		Route::get('/tatcachuyenmuc', [BlogController::class, 'getTatCaChuyenMuc']);
		Route::get('/tatcabaiviet', [BlogController::class, 'getTatCaBaiViet']);


		Route::get('xoachuyenmuc/{id}', [BlogController::class, 'getXoaChuyenMuc']);
		Route::get('xoabaiviet/{id}', [BlogController::class, 'getXoaBaiViet']);



		Route::get('suabaiviet/{id}', [BlogController::class, 'suaBaiViet']);
		Route::post('/postsuabaiviet', [BlogController::class, 'postSuaBaiViet']);

		Route::get('thembaiviet', [BlogController::class, 'getThemBaiViet']);
		Route::post('postthembaiviet', [BlogController::class, 'postThemBaiViet']);
	});
	Route::group(['prefix' => 'don-hang'], function(){
		Route::get('/tatcadonhang', [DonhangController::class, 'getTatCaDonHang']) -> name('donhang');
		Route::get('/mauudai', [DonhangController::class, 'getTatCaMaUuDai']) -> name('coupon');
		Route::get('/themmauudai', [DonhangController::class, 'getThemMaUuDai']);

		Route::get('/xoamauudai/{id}', [DonhangController::class, 'getXoaMaUuDai']);
		Route::get('/xoadonhang/{id}', [DonhangController::class, 'getXoaDonHang']);

		Route::get('/suamauudai/{id}', [DonhangController::class, 'getSuaMaUuDai']);
		Route::post('/postthemmauudai', [DonhangController::class, 'postThemMaUuDai']);

		Route::get('/suadonhang/{id}', [DonhangController::class, 'getSuaDonHang']);

		Route::post('/postsuamauudai', [DonhangController::class, 'postSuaMaUuDai']);
		Route::post('/postsuadonhang', [DonhangController::class, 'postSuaDonHang']);
		Route::get('/changestatus/{status}/{id}', [DonhangController::class, 'changStatus']);
		Route::get('/sendmail/{id}', [DonhangController::class, 'sendMail']);

	});

});


// MINH HERE
Route::get('/gio-hang', [GiohangController::class, 'showGioHang'])->name('cart.index');

Route::post('/add-to-cart', [GiohangController::class, 'add'])->name('cart.add');

Route::post('/add-cart-ajax', [GiohangController::class, 'addAjax'])->name('cart.addAjax');

Route::delete('/delete-item', [GiohangController::class, 'delete'])->name('cart.delete');

Route::post('/update-increase-item', [GiohangController::class, 'updateIncrease'])->name('cart.updateIncrease');

Route::post('/update-decrease-item', [GiohangController::class, 'updateDecrease'])->name('cart.updateDecrease');

Route::post('/gio-hang',[GiohangController::class, 'moveToCheckOut'])->name('cart.moveToCheckOut');

Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');

Route::delete('/coupon', [CouponController::class, 'destroy'])->name('coupon.delete');

Route::get('/get_location', [GiohangController::class, 'getLocation'])->name('getLocation');

//Home
Route::get('/',  [HomeController::class,'getHome']);

//blog-post
Route::get('/bai-viet', [HomeController::class, 'getBlogCategory']);

Route::get('/bai-viet/{slug}', [HomeController::class, 'getBlogDetail']);
//loadproductab
Route::get('/loadfeatureproducts', [HomeController::class,'loadFeatureProducts']);
//loadmoreproduct
Route::get('/loadmoreproducts', [HomeController::class,'loadmoreProducts']);
Route::get('/loadmoresearchproducts', [SanphamController::class,'loadmoreSearchProducts']);


//seach product
Route::get('/searchproduct', [SanphamController::class, 'searchProduct']);

//post-comment
Route::post('/postcomment', [SanphamController::class,'postComment']);
Route::post('/uploadimgcmt', [SanphamController::class,'postImgCmt']);


// CHECKOUT

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

Route::get('/huy-don-hang', [CheckoutController::class, 'huyDonHang'])->name('checkout.destroy');

Route::get('/mua-them', [CheckoutController::class, 'muaThem'])->name('checkout.muaThem');

// LICH SU MUA HANG

Route::prefix('lich-su-mua-hang')->group(function () {
    Route::get('/', [LichsumuahangController::class,'index'])->name('history.index');

    Route::get('/dang-nhap', [LichsumuahangController::class,'logIn'])->name('history.login');

    Route::post('/dang-nhap', [LichsumuahangController::class,'checkLogIn'])->name('history.checkLogIn');

    Route::get('/don-hang-{id}', [LichsumuahangController::class,'detailBill'])->name('history.detail');

    Route::post('/cap-nhat-nguoi-nhan', [LichsumuahangController::class,'updateNhanHang'])->name('history.update');
});
//reply-comment
Route::post('/post-reply-comment', [SanphamController::class,'postReplyComment']);
//product-detail
Route::get('/{slug_category}', [SanphamController::class,'getProductCategory']);

Route::get('/{slug_category}/{slug_product}', [SanphamController::class,'getProductdetail']);

//product-category


//Route::get('/{$slug_resultSearch}/{slug_product}', [SearchController::class,'getProductdetail']);





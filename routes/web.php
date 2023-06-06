<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('Project/Ismart.vn', 'IndexController@project');
Route::get('/', 'IndexController@index')->name('home_index');
// Route::get('/', function () {
//     return view('welcome');
// });
#-------------------------------------Admin-----------------------------------#
Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/admin', 'HomeController@index')->name('home');
    Route::get('dashboard', 'DashboardController@show');
    Route::get('admin/user/list', 'AdminUserController@list');
    Route::get('admin/user/add', 'AdminUserController@add');
    Route::post('admin/user/store', 'AdminUserController@store');
    Route::get('admin/user/delete/{id}', 'AdminUserController@delete');
    Route::get('admin/post/action', 'AdminUserController@action');
    Route::get('admin/user/edit/{id}', 'AdminUserController@edit');
    Route::post('admin/user/update/{id}', 'AdminUserController@update');

    #--------------COMMENT----------#
    Route::get('admin/comment/list', 'AdminCommentController@list_comment');
    Route::post('update-comment', 'AdminCommentController@update_comment');
    Route::post('reply-comment', 'AdminCommentController@reply_comment');
    Route::post('rating-insert', 'ProductController@rating_insert');
    #---------PAGE---------#
    Route::get('admin/page/list', 'AdminPageController@list');
    Route::get('admin/page/add', 'AdminPageController@add');
    Route::post('admin/page/store', 'AdminPageController@store');
    Route::get('admin/page/action', 'AdminPageController@action');
    Route::get('admin/page/delete/{id}', 'AdminPageController@delete');
    Route::get('admin/page/edit/{id}', 'AdminPageController@edit');
    Route::post('admin/page/update/{id}', 'AdminPageController@update');

    #-----POST----#
    Route::get('admin/post/action', 'AdminPostController@action');
    Route::post('admin/post/add_post', 'AdminPostController@add_post');
    Route::get('admin/post/list', 'AdminPostController@list');
    Route::get('admin/post/add', 'AdminPostController@add');
    Route::get('admin/post/edit/{id}', 'AdminPostController@edit');
    Route::get('admin/post/delete/{id}', 'AdminPostController@delete');
    Route::get('admin/post/category', 'AdminPostController@category');
    Route::post('admin/post/store', 'AdminPostController@store');
    Route::get('admin/post/delete_cat/{id}', 'AdminPostController@delete_cat');
    Route::get('admin/post/edit_cat/{id}', 'AdminPostController@edit_cat');
    Route::post('admin/post/update_cat/{id}', 'AdminPostController@update_cat');
    Route::post('admin/post/update/{id}', 'AdminPostController@update');
    #-----product----#
    Route::get('admin/product/list', 'AdminProductController@list');
    Route::get('admin/product/add', 'AdminProductController@add');
    Route::get('admin/product/category', 'AdminProductController@category');
    Route::post('admin/product/add_cat', 'AdminProductController@add_cat');
    Route::get('admin/product/edit_cat/{id}', 'AdminProductController@edit_cat');
    Route::get('admin/product/delete_cat/{id}', 'AdminProductController@delete_cat');
    Route::post('admin/product/update_cat/{id}', 'AdminProductController@update_cat');
    Route::post('admin/product/add_product', 'AdminProductController@add_product');
    Route::get('admin/product/edit/{id}', 'AdminProductController@edit_product');
    Route::get('admin/product/delete/{id}', 'AdminProductController@delete_product');
    Route::post('admin/product/update_product/{id}', 'AdminProductController@update_product');
    Route::get('admin/product/action', 'AdminProductController@action');
    #------------display product reviews using ajax -----------#
    Route::post('load-comment-product', 'ProductController@comment');
    Route::post('sent-comment', 'ProductController@sent_comment');
    Route::get('/delete-comment/{id}', 'AdminCommentController@delete_comment');
    #----------Gallery-------------#
    Route::get('admin/view/gallery/{id}', 'GalleryController@view');
    Route::post('select-gallery', 'GalleryController@select_gallery');
    //
    Route::post('insert-gallery/{pro_id}', 'GalleryController@insert_gallery');
    //
    Route::post('update-gallery-name', 'GalleryController@update_gallery_name');
    Route::post('delete-gallery', 'GalleryController@delete_gallery');
    Route::post('update-gallery', 'GalleryController@update_gallery');
    #----Oder---#
    Route::get('admin/order/list_order', 'AdminOrderController@list_order');
    Route::get('admin/order/detail_order', 'AdminOrderController@detail_order');
    Route::get('admin/dashboard', 'AdminOrderController@dashboard');
    #slider
    Route::get('slider', 'AdminSliderController@slider');
    Route::post('admin/slider/add', 'AdminSliderController@add');
    Route::get('delete/{id}', 'AdminSliderController@delete');
    Route::get('edit/slider/{id}', 'AdminSliderController@slider_edit');
    #----------Media---------#
    Route::get('media', 'AdminMediaController@media');
    Route::post('admin/media/add', 'AdminMediaController@add_media');
    Route::get('admin/media/list', 'AdminMediaController@list_media');
    Route::get('delete/media/{id}', 'AdminMediaController@delete');
    #-----Order Sản Phẩm----#
    Route::get('list_order', 'AdminOrderController@list_order')->name('list_order');
    Route::get('admin/list_order/action', 'AdminOrderController@action');
    Route::get('admin/order/delete/{id}', 'AdminOrderController@delete');
    Route::get('admin/order/order_detail/{id}', 'AdminOrderController@detail_order');
    Route::get('admin/detail/order/update/status/{id}', 'AdminOrderController@update_status');
    #MENU ADMIN
    Route::get('menu/admin', 'AdminMenuController@menu');
    #LIỆT KÊ DANH SAHCS ĐƠN HÀNG THÀNH CÔNG-HỦY-ĐANG VẬN CHUYỂNvv..
    Route::get('admin/list/successful/order', 'DashboardController@list_success_order');
    Route::get('admin/list/processing/order', 'DashboardController@list_processing_order');
    Route::get('admin/list/being_transported/order', 'DashboardController@list_being_transported_order');
    Route::get('admin/list/cancel/order', 'DashboardController@list_cancel_order');
});
###################--------------------TRANG NGƯỜI DÙNG-------------------------------#####################


#------------------Trang chủ-----------#
Route::get('trang-chu', 'IndexController@index')->name('home_index');

#--------------------------blog-----------------#
Route::get('bai--viet/{nameCat}', 'BlogController@detail_blog')->name('detail_blog');
Route::get('bai-viet/{slug}', 'BlogController@post_list')->name('post.list');
Route::get('blog-cong-nghe', 'BlogController@blog')->name('blog');
Route::get('gioi-thieu.html', 'PageController@introduce')->name('introduce');
Route::get('lien-he.html', 'PageController@contact')->name('contact');

#-----------------------Product client---------------#
Route::get('san-pham', 'ProductController@category_product')->name('category_product');
#danh mục sản phẩm
Route::get('danh-muc/{slug}', 'ProductController@product_list')->name('product_list');
Route::get('san-pham/{nameCat}/{nameProduct}', 'ProductController@detail_product')->name('detail_product');
#----------sắp xếp sản phẩm ---------#
Route::get('sap-xep-san-pham', 'ProductController@filter_product');

#------------------thanh toán giỏ hàng --------------#
Route::get('thanh-toan.html', 'ProductController@payment')->name('payment');


#-------------------cập nhật giỏ hàng bằng ajax jquery--------------#
Route::get('update_price', 'ProductController@update_price')->name('update_price');


#-----------------------Shopping_Cart---------------------#
Route::get('them-san-pham/{nameCat}/{nameProduct}', 'CartController@add_cart')->name('add-cart');
Route::get('mua-ngay/{nameCat}/{nameProduct}', 'CartController@buy_now')->name('buy_now');
Route::get('gio-hang.html', 'CartController@show_cart')->name('show_cart');
Route::get('remove/cart/{rowId}', 'CartController@remove')->name('remove.cart');
Route::get('gio-hang.html', 'ProductController@cart')->name('cart');


#-------------------------tim kiem san pham theo name---------------#
Route::post('tim-kiem-san-pham.html', 'IndexController@search_product')->name('search_product');


#----------------------xóa toàn bộ giỏ hàng------------------#
Route::get('detroy/cart', 'CartController@detroy')->name('detroy.cart');


#------------------------cập nhật giỏ hàng-----------------------#
Route::post('cart/update', 'CartController@update')->name('cart.update');
Route::post('add-to-cart-ajax', 'CartController@add_cart_ajax');
Route::get('gio-hang', 'CartController@gio_hang');

#------------------ajax cập nhật thaydooi gia sản phaarmntrong giỏ hàng bằng ajax------------#
Route::post('update-to-cart', 'CartController@updatetocart')->name('update_to_cart_ajax');
Route::post('ajax_shopping_cart', 'CartController@ajax_shopping_cart')->name('ajax_shopping_cart');


#------------------Thanh toán giỏ hàng và tên người đã mua------------------#
Route::get('checkout', 'CartController@checkout')->name('checkout');
Route::post('dat-hang-thanh-cong.html', 'ProductController@insert_info_client')->name('insert_info_client');
#------------------Login và register--------------------# 
#----ĐANG BỔ SUNG SAU KHI LÀM XONG ĐỒ ÁN---------#


#-------------GỬI MAIL KHÁCH HÀNG--------------#
Route::get('dat-hang-thanh-cong.html', 'ProductController@thank_your')->name('thanh_your');
Route::get('sendmail', 'DemoMailController@sendmail')->name('senmail');
Route::post('getProvince','ProductController@get_province');

#----Lọc GIÁ SẢN PHẨM -----#
Route::get('loc-san-pham', 'ProductController@filter_price')->name('price');
#------ckfinder--
Route::get('ckfinder', 'AdminProductController@ckfinder');

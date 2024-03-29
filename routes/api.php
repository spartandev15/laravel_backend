<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\ResourseController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\InstructorDashboardController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VerifyRegisterUserController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\RatingReviewController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\FrontendController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/******************************************************************************
 ****************************************route FrontendController  info related************
 *********************************************************************************
 *****************************/

Route::post('/frontend_resourse_list', [FrontendController::class, 'allfrontendResourse']);
Route::get('/all_testimonial', 
[FrontendController::class,'fetchAllTestimonial']);
Route::post('/contact_us', [FrontendController::class, 'contactUs']);
Route::post('/frontend_search', [FrontendController::class, 'globalSearch']);
Route::post('/get_single_product', 
[FrontendController::class,'getSingleProductPage']);
Route::post('/user/course_rating_average', 
    [FrontendController::class,'course_rating_avg']);
Route::post('/user/course_rating_progress_count', 
    [FrontendController::class,'ratingProgressBar']);
Route::post('/user/course_total_rate_review', 
    [FrontendController::class,'totalRating']);
Route::post('/user/get_course_Rating_Review', 
    [FrontendController::class,'get_course_Rating_Review']);
 /******************************************************************************
 ****************************************route subscribe and visitor info related************
 *********************************************************************************
 *****************************/

Route::post('/subscribe', [SubscribeController::class, 'createSubscribe']);
Route::post('/add_visitor', [VisitorController::class, 'createVisitor']);


 /******************************************************************************
 ****************************************route UserAuth info related************
 *********************************************************************************
 *****************************/

Route::post('/seller_register', [UserAuth::class,'register']);
Route::post('/buyer_register', [UserAuth::class,'userRegister']);
Route::post('/user_login', [UserAuth::class,'login']);
Route::get('auth/google', [UserAuth::class, 'redirectToGoogle']);
Route::get('callback/google', [UserAuth::class, 'handleCallback']);
Route::post('/forgot_password', [UserAuth::class, 'forgot_password']);
Route::post('/reset_password', [UserAuth::class, 'reset_assword']);



//middleware 

Route::group(['middleware' => 'jwt.verify'], function () {

Route::get('/logout', [UserAuth::class, 'logout']);
Route::post('/upload_user_profile_image', [UserAuth::class, 'uploadProfileImage']);


/******************************************************************
****************************************************
route basic information related****************************************
**********************************************************************************/

Route::post('/basic_create', 
    [BasicInformationController::class,'basicCreate']);
Route::post('/basic_edit/{id}', 
    [BasicInformationController::class,'basicEdit']);
Route::post('/basic_update', 
    [BasicInformationController::class,'basicUpdate']);
Route::post('/basic_delete/{id}', 
    [BasicInformationController::class,'basicDelete']);
Route::get('/all_info', 
    [BasicInformationController::class,'allInfo']);

 /******************************************************************************
 ****************************************route Category info related************
 *********************************************************************************
 *****************************/
Route::post('/create_category', 
    [CategoryController::class,'createCategory']);
Route::post('/edit_category',  
    [CategoryController::class,'editCategory']);
Route::post('/update_category',  
    [CategoryController::class,'updateCategory']);
Route::get('/all_category',  
    [CategoryController::class,'fetchAllCategory']);
    
         /******************************************************************************
 ****************************************route Language info related************
 *********************************************************************************
 *****************************/
Route::post('/add_language', 
[LanguageController::class,'addLanguage']);
Route::post('/edit_language',  
[LanguageController::class,'editLanguage']);
Route::post('/update_language',  
[LanguageController::class,'updateLanguage']);
Route::get('/all_language',  
[LanguageController::class,'fetchAllLanguage']);

/******************************************************************************
 ****************************************route course info related************
 *********************************************************************************
 *****************************/
Route::post('/create_course', 
[CourseController::class,'createCourse']);
Route::post('/edit_course', 
[CourseController::class,'editCourse']);
Route::post('/update_course', 
[CourseController::class,'updateCourse']);
Route::post('/remove_content', 
[CourseController::class,'removeContent']);
Route::get('/all_course', 
[CourseController::class,'fetchAllCourse']);
Route::get('/unpublish_course', 
[CourseController::class,'fetchUnpublishCourse']);
Route::post('/update_course_publish_status', 
[CourseController::class,'updatePublishStatus']);
Route::get('/all_resourse', 
[CourseController::class,'fetchAllResourse']);
Route::post('/add_course_content', 
[CourseController::class,'addCoursecontent']);
Route::post('/add_course_gallery', 
[CourseController::class,'addCourseBanner']);

/******************************************************************************
 ****************************************route cart info related************
 *********************************************************************************
 *****************************/
Route::post('/add_to_cart', 
[CartController::class,'cartAdd']);
Route::get('/cart_items', 
[CartController::class,'cartItem']);
Route::post('/cart_item_delete', 
[CartController::class,'cartDelete']);
Route::post('/checkout', 
[CartController::class,'checkoutOrder']);

/******************************************************************************
 ****************************************route TestimonialController info related************
 *********************************************************************************
 *****************************/
Route::post('/add_testimonial', 
[TestimonialController::class,'createTestimonial']);
Route::post('/edit_testimonial', 
[TestimonialController::class,'editTestimonial']);
Route::post('/update_testimonial', 
[TestimonialController::class,'updateTestimonial']);
Route::post('/update_testimonal_image', 
[TestimonialController::class,'updateImage']);
Route::post('/admin/get_testimonial_date_wise', 
[TestimonialController::class,'getTestimonialDateWise']);
/******************************************************************************
 ****************************************route cart info related************
 *********************************************************************************
 *****************************/
Route::post('/add_bank', 
[SellerDashboardController::class,'addBankAccount']);
Route::post('/seller/delete_product', 
[SellerDashboardController::class,'sellerProductDelete']);
Route::post('/seller/delete_order', 
[SellerDashboardController::class,'sellerOrderDeleteAction']);
Route::post('/seller/top_products', 
[SellerDashboardController::class,'topProducts']);
Route::post('/seller/seller_order', 
[SellerDashboardController::class,'fetchSellerOrder']);
Route::post('/seller/get_order_items', 
[SellerDashboardController::class,'fetchOrderItems']);
Route::post('/seller/get_seller_products', 
[SellerDashboardController::class,'getSellerProducts']);
Route::get('/seller/sold_products', 
[SellerDashboardController::class,'soldProducts']);
Route::post('/seller/all_buyers', 
[SellerDashboardController::class,'allBuyer']);
Route::post('/seller/user_profile', 
[SellerDashboardController::class,'viewProfile']);
Route::post('/seller/user_orders', 
[SellerDashboardController::class,'fetchUserOrders']);
Route::post('/seller/user_order_items', 
[SellerDashboardController::class,'user_OrderItems']);
Route::get('/seller/seller_profile', 
[SellerDashboardController::class,'sellerProfile']);
Route::post('/seller/change_password', 
[SellerDashboardController::class,'changePassword']);
// Route::post('/seller/update_profile_basicinfo', 
// [SellerDashboardController::class,'updateBasicInfo']);
// Route::post('/seller/update_profile_teachinginfo', 
// [SellerDashboardController::class,'teachingInfo']);
Route::post('/seller/seller_notifications', 
[NavigationController::class,'seller_notification']);
Route::get('/user/user_notification', 
[NavigationController::class,'get_user_notification']);

//graph api for seller
 
Route::get('/seller/total_products', 
[SellerDashboardController::class,'total_products']);
Route::get('/seller/sold_products_count', 
[SellerDashboardController::class,'products_sold']);
Route::get('/seller/total_order', 
[SellerDashboardController::class,'total_order']);
Route::post('/seller/total_sales', 
[SellerDashboardController::class,'getTotalOrderCountByMonth']);
Route::get('/seller/today_sales', 
[SellerDashboardController::class,'todaySales']);
Route::post('/seller/visitor_graph', 
[SellerDashboardController::class,'visitorGraph']);
Route::post('/seller/rating_graph', 
[SellerDashboardController::class,'ratingGraph']);
// graph section for productPage

Route::get('/seller/total_sales_order_profit', 
 [SellerDashboardController::class,'totalSalesOrderAndProfit']);
Route::get('/seller/today_sales_product_section', 
 [SellerDashboardController::class,'todaySalesProductSection']);
 Route::get('/seller/total_product_sold_product', 
 [SellerDashboardController::class,'totalProductAndProductSold']);
/******************************************************************************
 ****************************************route admin info related************
 *********************************************************************************
 *****************************/
Route::get('/admin/fetch_all_order', 
[AdminController::class,'fetchAllOrders']);
Route::get('/admin/fetch_all_products', 
[AdminController::class,'fetchAllproduct']);
Route::get('/admin/single_product', 
[AdminController::class,'singleProductPage']);
Route::get('/admin/all_buyer', 
[AdminController::class,'fetchBuyers']);
Route::get('/admin/view_profile', 
[AdminController::class,'viewUserProfile']);
Route::get('/admin/user_order_history', 
[AdminController::class,'userOrderHistory']);
Route::get('/admin/fetch_user_orderItems', 
[AdminController::class,'userOrderItem']);
Route::get('/admin/all_seller', 
[AdminController::class,'fetchSellers']);
Route::get('/admin/seller_profile', 
[AdminController::class,'viewSellerProfile']);
Route::get('/admin/seller_products', 
[AdminController::class,'sellerProducts']);
Route::get('/admin/all_users', 
[AdminController::class,'all_users']);
Route::get('/admin/unapproved_sellers', 
[AdminController::class,'unapproved_sellers']);
Route::post('/admin/request_for_seller_approve', 
[AdminController::class,'approvedRequest']);
Route::get('/admin/approved_sellers', 
[AdminController::class,'fetchApprovedSeller']);
Route::post('/admin/request_for_seller_unapprove', 
[AdminController::class,'unapprovedRequest']);
Route::get('/admin/all_payments', 
[AdminController::class,'allPayments']);
Route::get('/admin/top_products', 
[AdminController::class,'topProducts']);
Route::get('/admin/top_seller', 
[AdminController::class,'topSeller']);
Route::post('/admin/add_stripe_keys', 
[AdminController::class,'addStripeKey']);
Route::post('/admin/update_stripe_keys', 
[AdminController::class,'updateStripeKeys']);
Route::get('/admin/edit_stripe_keys', 
[AdminController::class,'editStripeKey']);
Route::get('/admin/today_orders', 
[AdminController::class,'orderToday']);
Route::get('/admin/today_sales', 
[AdminController::class,'todaySales']);
Route::get('/admin/total_revenue', 
[AdminController::class,'totalRevenue']);
Route::get('/admin/get_seller_count_by_month', 
[AdminController::class,'getSellersCountByMonth']);
Route::get('/admin/get_user_count_by_month', 
[AdminController::class,'getUserCountByMonth']);
Route::post('/admin/delete_users', 
    [AdminController::class,'deleteUser']);
Route::post('/admin/delete_order', 
    [AdminController::class,'OrderDeleteAction']);
Route::post('/admin/delete_product', 
    [AdminController::class,'productDelete']);
Route::post('/admin/delete_category', 
    [AdminController::class,'categoryDelete']);
Route::post('/admin/delete_testimonial', 
    [AdminController::class,'testimonialDelete']);
Route::post('/admin/sale_overview', 
    [AdminController::class,'saleOverview']);
Route::post('/admin/order_overview', 
    [AdminController::class,'orderOverview']);
Route::post('/admin/get_subscriber_count_by_month', 
    [AdminController::class,'getSubscriberCountByMonth']);
Route::post('/admin/today_order', 
    [AdminController::class,'todayOrder']);
Route::post('/admin/total_order', 
    [AdminController::class,'TotalOrderCountByMonth']);
Route::post('/admin/resourse_count_by_month', 
    [AdminController::class,'resourseCounting']);

/******************************************************************************
 ****************************************route visitor basic info related************
 *********************************************************************************
 *****************************/
    Route::get('/admin/get_today_visitor', [VisitorController::class, 'getTodayVisitor']);
 /******************************************************************************
 ****************************************route stripe basic info related************
 *********************************************************************************
 *****************************/

Route::get('/fetch_stripe_publish_keys', 
[StripeController::class,'fetchStripePublishKeys']);


/******************************************************************************
 ****************************************route user basic info related************
 *********************************************************************************
 *****************************/
 
 
Route::post('/userinfo_create', 
    [UserDashboardController::class,'createUserinfo']);
Route::post('/userinfo_update', 
    [UserDashboardController::class,'updateUserinfo']);
Route::post('/userinfo_edit/{id}', 
    [UserDashboardController::class,'editUserinfo']);
Route::post('/userinfo_delete/{id}', 
    [UserDashboardController::class,'deleteUserinfo']);
Route::get('/all_userinfo', 
    [UserDashboardController::class,'getAllUserinfo']); 
Route::get('/user/buyer_profile', 
    [UserDashboardController::class,'buyerProfile']);
Route::post('/common/update_basic_info_profile', 
    [UserDashboardController::class,'updateProfileBasicInfo']);
Route::post('/common/update_teaching_setting_profile', 
    [UserDashboardController::class,'updateTeachingSettingsProfile']);
Route::post('/common/update_seller_info_profile', 
    [UserDashboardController::class,'updateSellerInfoProfile']);
Route::post('/common/update_course_instructor_profile', 
    [UserDashboardController::class,'courseInstructorProfile']);
Route::post('/change_password', 
    [UserDashboardController::class,'changePassword']);
Route::get('/user/user_all_products', 
    [UserDashboardController::class,'All_user_Product']);

Route::get('/user/user_all_order', 
    [UserDashboardController::class,'user_allOrders']);

Route::get('/user/user_succeeded_order', 
    [UserDashboardController::class,'statusPaidOrders']);
Route::post('/user/add_rate_review', 
    [RatingReviewController::class,'create_Rating']);
Route::post('/user/product_detail_rate_page', 
    [UserDashboardController::class,'product_details_rate_page']);
Route::get('/switch_permission', 
    [UserDashboardController::class,'switchModule']);

Route::post('/user/seller_Store', 
    [UserDashboardController::class,'seller_Store']);
/*****************************************************************************************
*****************************route Payment deatils****************************************
**********************************************************************************/

Route::post('/payment_create', 
    [PaymentController::class,'createPayment']);
Route::post('/payment_update', 
    [PaymentController::class,'updatePayment']);
Route::post('/payment_edit/{id}', 
    [PaymentController::class,'editPayment']);
Route::post('/payment_delete/{id}', 
    [PaymentController::class,'deletePayment']);
Route::get('/all_payment', 
    [PaymentController::class,'allPaymentDetails']);                                                                   
});




 // Route::get('/products/{id}', [CategorieController::class,'index']);
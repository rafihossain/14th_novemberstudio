<?php

use Illuminate\Support\Facades\Route;
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

// Autho Routes
require __DIR__ . '/auth.php';

// Language Switch
Route::get('language/{language}', 'LanguageController@switch')->name('language.switch');

 // Route::group(['middleware' => ['cors']], function () {  
//Route::group(['middleware' => ['cors']], function () {
    Route::post('ulogin', 'ApiController@loginUser')->name('ulogin');
    Route::get('getevents/{id}', 'ApiController@getevents')->name('getevents');
    Route::get('getuserinfo/{id}', 'ApiController@getuserinfo')->name('getuserinfo');
    Route::get('getglobal/{id}', 'ApiController@getglobal')->name('getglobal');
    Route::get('getpayment/{id}', 'ApiController@getpayment')->name('getpayment');
    Route::get('getpackage', 'ApiController@getPackage')->name('getpackage');
    Route::post('apssavecontact', 'ApiController@saveContact')->name('savecontact');
    Route::get('getcinema', 'ApiController@getCinema')->name('getcinema');
    Route::post('postmessage', 'ApiController@postMessage')->name('postmessage');
    Route::get('getmessage/{id}', 'ApiController@getMessage')->name('getmessage');

   
  ///});  



    
    
   // Route::post('test', 'ApiController@texttest')->name('test');
   // Route::post('test', 'ApiController@texttest')->name('test');
/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', 'FrontendController@index')->name('index');
    Route::post('savecontact', 'FrontendController@saveContactInfo')->name('save-contact');
    Route::get('home', 'FrontendController@index')->name('home');
    Route::get('about', 'FrontendController@about')->name('about');
    Route::get('cinema', 'FrontendController@cinema')->name('cinema');
    Route::get('package', 'FrontendController@package')->name('package');
    Route::get('privacy', 'FrontendController@privacy')->name('privacy');
    Route::get('contatus', 'FrontendController@contatus')->name('contatus');
    Route::get('faq', 'FrontendController@faq')->name('faq');
    Route::get('terms', 'FrontendController@terms')->name('terms');
    Route::post('getcinema', 'FrontendController@getcinema')->name('getcinema');
    
    Route::post('getpackage', 'FrontendController@getpackage')->name('get-package');
    
//     Route::get('newest', 'FrontendController@newest')->name('newest');
    
//     Route::get('test', function () {
//     event(new App\Events\StatusLiked('Someone'));
//     return "Event has been sent!";
// });

        Route::get('test', function () {
            event(new App\Events\StatusLiked('my-channel'));
            return "Event has been sent!";
        });
        
        Route::get('/newest', function () {
            return view('welcome');
        });

    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        Route::get('profile/{id}', ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
        Route::get('profile/{id}/edit', ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
        Route::patch('profile/{id}/edit', ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
        Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
        Route::get('profile/changePassword/{username}', ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
        Route::patch('profile/changePassword/{username}', ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
        Route::delete('users/userProviderDestroy', ['as' => 'users.userProviderDestroy', 'uses' => 'UserController@userProviderDestroy']);
    });
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {

    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    // Route::get('chat', 'ChatsController@index');
    // Route::get('messages', 'ChatsController@fetchMessages');
    // Route::post('messages', 'ChatsController@sendMessage');
    
    //users-----------
    Route::get('users/add', ['as' => "create-users", 'uses' => "UserManageController@createUsers"]);
    Route::get('users/list', ['as' => "manage-users", 'uses' => "UserManageController@manageUsers"]);
    Route::post('users/save', ['as' => 'save-users', 'uses' => 'UserManageController@saveUsers']);
    Route::get('users/edit/{id}', ['as' => 'edit-users', 'uses' => 'UserManageController@editUsers']);
    Route::post('users/update', ['as' => 'update-users', 'uses' => 'UserManageController@updateUsers']);
    Route::get('users/delete/{id}', ['as' => 'delete-users', 'uses' => 'UserManageController@deleteUsers']);
    Route::get('users/details/{id}', ['as' => "usersdetails", 'uses' => "UserManageController@usersdetails"]);
    Route::get('users/datetime/{id}', ['as' => "user_datetime", 'uses' => "UserManageController@user_datetime"]);
    Route::post('users/timezone/save/{id}', ['as' => "user_timezone_save", 'uses' => "UserManageController@user_timezone_save"]);
    
    Route::get('load-latest-messages', ['as' => "load-latest-messages", 'uses' => "MessagesController@getLoadLatestMessages"]);
    Route::get('fetch-old-messages', ['as' => "fetch-old-messages", 'uses' => "MessagesController@getOldMessages"]);
    Route::post('send', ['as' => "send", 'uses' => "MessagesController@postSendMessage"]);
    
    Route::get('order/list', "OrderController@orderList")->name("order-list");
    Route::get('order/delete/{id}', "OrderController@orderDelete")->name("order-delete");
    
   // Route::get('/load-latest-messages', [MessagesController::class, 'getLoadLatestMessages']);
  //  Route::post('/send', [MessagesController::class, 'postSendMessage']);
  //  Route::get('/fetch-old-messages', [MessagesController::class, 'getOldMessages']);
    
    Route::get('/emit', function () {
       \App\Events\MessageSent::broadcast(\App\Models\User::find(1));
    });

    
    Route::post('delete-ammendment', ['as' => 'delete_ammendment_image', 'uses' => 'UserManageController@deleteAmmendment']);

    //Events
    Route::get('event/list', "EventController@eventList")->name("event-list");
    Route::get('event/add', "EventController@eventAdd")->name("event-add");
    Route::post('event/save', "EventController@eventSave")->name("event-save");
    Route::get('event/edit/{id}', "EventController@eventEdit")->name("event-edit");
    Route::post('event/update', "EventController@eventUpdate")->name("event-update");
    Route::get('event/delete/{id}', "EventController@eventDelete")->name("event-delete");
    
    //Package 
    Route::get('package/list', "PackageController@packageList")->name("package-list");
    Route::get('package/add', "PackageController@packageAdd")->name("package-add");
    Route::post('package/save', "PackageController@packageSave")->name("save-package");
    Route::get('package/edit/{id}', "PackageController@packageEdit")->name("edit-package");
    Route::post('package/update', "PackageController@packageUpdate")->name("update-package");
    Route::get('package/delete/{id}', "PackageController@packageDelete")->name("delete-package");
    
    Route::get('announcement/list', "AnnouncementController@announcementList")->name("announcement-list");
    Route::get('announcement/add', "AnnouncementController@announcementAdd")->name("announcement-add");
    Route::post('announcement/save', "AnnouncementController@announcementSave")->name("announcement-save");
    Route::get('announcement/edit/{id}', "AnnouncementController@announcementEdit")->name("announcement-edit");
    Route::post('announcement/update', "AnnouncementController@announcementUpdate")->name("announcement-update");
    Route::get('announcement/delete/{id}', "AnnouncementController@announcementDelete")->name("announcement-delete");
    
    Route::get('setting', "SettingController@index")->name("setting");
    Route::post('settings', "SettingController@social_link_update")->name("post-setting");
    
    
    Route::get('faq/list', "FaqController@faqList")->name("faq-list");
    Route::get('faq/add', "FaqController@faqAdd")->name("faq-add");
    Route::post('faq/save', "FaqController@faqSave")->name("faq-save");
    Route::get('faq/edit/{id}', "FaqController@faqEdit")->name("faq-edit");
    Route::post('faq/update', "FaqController@faqUpdate")->name("faq-update");
    Route::get('faq/delete/{id}', "FaqController@faqDelete")->name("faq-delete");
    
    
    Route::get('settings', "PaymentController@settings")->name("settings");

    Route::get('payment', "PaymentController@paymentlist")->name("payment-list");
    Route::get('payment/edit/{id}', "PaymentController@paymentedit")->name("payment-edit");
    Route::post('payment/update', "PaymentController@paymentUpdate")->name("payment-update");
    
    Route::get('videoprogress', "VideoProgressController@videoprogress")->name("videoprogress-list");
    Route::get('videoprogress/edit/{id}', "VideoProgressController@videoprogressedit")->name("videoprogress-edit");
    Route::post('videoprogress/update', "VideoProgressController@videoprogressUpdate")->name("videoprogress-update");
    
    
    // Route::get('banner', "FrontController@banner")->name("banner-list");
    // Route::get('banner/edit/{id}', "FrontController@banneredit")->name("banner-edit");
    // Route::post('banner/update', "FrontController@bannerUpdate")->name("banner-update");
    
     //Pages
    Route::get('add/page', ['as' => "addpage", 'uses' => "PageController@addpage"]);
    Route::post('save/page', ['as' => "savepage", 'uses' => "PageController@savepage"]);
    Route::get('all/page', ['as' => "allpages", 'uses' => "PageController@allpages"]);
    Route::get('page/delete/{id}', ['as' => "page_delete", 'uses' => "PageController@page_delete"]);
    Route::get('page/edit/{id}', ['as' => "page_edit", 'uses' => "PageController@page_edit"]);
    Route::post('page/update', ['as' => "pageupdate", 'uses' => "PageController@page_update"]);
    
    //section
    Route::get('section/add', ['as' => 'add-section','uses' => 'SectionController@addSection']);
    Route::get('section/list', ['as' => 'manage-section','uses' => 'SectionController@manageSection']);
    Route::post('section/save', ['as' => 'save-section','uses' => 'SectionController@saveSection']);
    Route::get('section/edit/{id}', ['as' => 'section_edit','uses' => 'SectionController@editSection']);
    Route::post('section/update', ['as' => 'update_section','uses' => 'SectionController@updateSection']);
    Route::get('section/delete/{id}', ['as' => 'delete-section','uses' => 'SectionController@deleteSection']);
    
    Route::get('page/image/{id}', 'PageController@managepageimage')->name('manage-pageimage');
    Route::get('page/image', 'PageController@managepageimage')->name('manage-pageimage');
    Route::post('page/image/update', 'PageController@pageimageupdate')->name('pageimage-update');


    // Blog Category
    Route::get('cinema/category/add', ['as' => 'add-category','uses' => 'CinemaController@addCategory']);
    Route::get('cinema/category/list', ['as' => 'manage-category','uses' => 'CinemaController@manageCategory']);
    Route::post('cinema/category/save', ['as' => 'save-category','uses' => 'CinemaController@saveCategory']);
    Route::get('cinema/category/edit/{id}', ['as' => 'edit-category','uses' => 'CinemaController@editCategory']);
    Route::post('cinema/category/update', ['as' => 'update-category','uses' => 'CinemaController@updateCategory']);
    Route::get('cinema/category/delete/{id}', ['as' => 'delete-category','uses' => 'CinemaController@deleteCategory']);


    Route::get('cinema/type/add', ['as' => 'add-type','uses' => 'CinemaController@addType']);
    Route::get('cinema/type/list', ['as' => 'manage-type','uses' => 'CinemaController@manageType']);
    Route::post('cinema/type/save', ['as' => 'save-type','uses' => 'CinemaController@saveType']);
    Route::get('cinema/type/edit/{id}', ['as' => 'edit-type','uses' => 'CinemaController@editType']);
    Route::post('cinema/type/update', ['as' => 'update-type','uses' => 'CinemaController@updateType']);
    Route::get('cinema/type/delete/{id}', ['as' => 'delete-type','uses' => 'CinemaController@deleteType']);

    // Blog Section
    Route::get('cinema/add', ['as' => 'add-cinema','uses' => 'CinemaController@addcinema']);
    Route::get('cinema/list', ['as' => 'manage-cinema','uses' => 'CinemaController@managecinema']);
    Route::post('cinema/save', ['as' => 'save-cinema','uses' => 'CinemaController@savecinema']);
    Route::get('cinema/edit/{id}', ['as' => 'edit-cinema','uses' => 'CinemaController@editcinema']);
    Route::post('cinema/update', ['as' => 'update-cinema','uses' => 'CinemaController@updatecinema']);
    Route::get('cinema/delete/{id}', ['as' => 'delete-cinema','uses' => 'CinemaController@deletecinema']);
    Route::get('cinema/view/{id}', ['as' => 'view-cinema','uses' => 'CinemaController@viewcinema']);
    Route::get('cinema/unpublished/{id}', ['as' => 'unpublished-cinema','uses' => 'CinemaController@unpublishedcinema']);
    Route::get('cinema/published/{id}', ['as' => 'published-cinema','uses' => 'CinemaController@publishedcinema']);
    
    // Testimonial Section
    Route::get('testimonial/add', ['as' => 'add-testimonial','uses' => 'TestimonialController@addTestimonial']);
    Route::get('testimonial/list', ['as' => 'manage-testimonial','uses' => 'TestimonialController@manageTestimonial']);
    Route::post('testimonial/save', ['as' => 'save-testimonial','uses' => 'TestimonialController@saveTestimonial']);
    Route::get('testimonial/edit/{id}', ['as' => 'edit-testimonial','uses' => 'TestimonialController@editTestimonial']);
    Route::post('testimonial/update', ['as' => 'update-testimonial','uses' => 'TestimonialController@updateTestimonial']);
    Route::get('testimonial/delete/{id}', ['as' => 'delete-testimonial','uses' => 'TestimonialController@deleteTestimonial']);
    Route::get('testimonial/view/{id}', ['as' => 'view-testimonial','uses' => 'TestimonialController@viewTestimonial']);
    
    // General Setting
    Route::get('general/edit/', ['as' => 'edit-general','uses' => 'SettingController@editGeneral']);
    Route::post('general/update', ['as' => 'update-general','uses' => 'SettingController@updateGeneral']);

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    // Route::group(['middleware' => ['permission:edit_settings']], function () {
    //     $module_name = 'settings';
    //     $controller_name = 'SettingController';
    //     Route::get("$module_name", "$controller_name@index")->name("$module_name");
    //     Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
    // });

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/markAllAsRead", ['as' => "$module_name.markAllAsRead", 'uses' => "$controller_name@markAllAsRead"]);
    Route::delete("$module_name/deleteAll", ['as' => "$module_name.deleteAll", 'uses' => "$controller_name@deleteAll"]);
    Route::get("$module_name/{id}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::get("$module_name/download/{file_name}", ['as' => "$module_name.download", 'uses' => "$controller_name@download"]);
    Route::get("$module_name/delete/{file_name}", ['as' => "$module_name.delete", 'uses' => "$controller_name@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("$module_name", "$controller_name");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("$module_name/profile/{id}", ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
    Route::get("$module_name/profile/{id}/edit", ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
    Route::patch("$module_name/profile/{id}/edit", ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
    Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
    Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    Route::get("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePassword", 'uses' => "$controller_name@changeProfilePassword"]);
    Route::patch("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePasswordUpdate", 'uses' => "$controller_name@changeProfilePasswordUpdate"]);
    Route::get("$module_name/changePassword/{id}", ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
    Route::patch("$module_name/changePassword/{id}", ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::resource("$module_name", "$controller_name");
    Route::patch("$module_name/{id}/block", ['as' => "$module_name.block", 'uses' => "$controller_name@block", 'middleware' => ['permission:block_users']]);
    Route::patch("$module_name/{id}/unblock", ['as' => "$module_name.unblock", 'uses' => "$controller_name@unblock", 'middleware' => ['permission:block_users']]);
});

Route::group(['namespace' => 'Api', 'prefix' => 'admin', 'as' => 'backend.'], function () {
    //subscription & stripe & paypal
    Route::get('stripe/{id}', ['as' => "stripe", 'uses' => "StripePaymentController@stripe"]);
    Route::post('stripe', ['as' => "stripe.post", 'uses' => "StripePaymentController@stripePost"]);

    Route::get('paypal/{id}', 'PayPalPaymentController@paypal')->name('paypal');

    // Route::get('payment', 'PayPalPaymentController@payment')->name('payment');
    // Route::get('cancel', 'PayPalPaymentController@cancel')->name('payment.cancel');
    // Route::get('payment/success', 'PayPalPaymentController@success')->name('payment.success');
});


// new route
// Route::get('/events', function () {
//     return view('/backend/events/events');
// });
// Route::get('/addevent', function () {
//     return view('/backend/events/addevent');
// });
// Route::get('/videoprogress', function () {
//     return view('/backend/videoprogress/videoprogress');
// });
// Route::get('/addvideoprogress', function () {
//     return view('/backend/videoprogress/addvideoprogress');
// });
// Route::get('/payment', function () {
//     return view('/backend/payment/payment');
// });
// Route::get('/addpayment', function () {
//     return view('/backend/payment/addpayment');
// });
// Route::get('/setting', function () {
//     return view('/backend/setting/setting');
// });



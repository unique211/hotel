<?php

use Illuminate\Http\Request;


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

// Route::get('/', function () {
//     // return view('welcome');
//     // return view('transaction');
//     return view('login');
// });



// Route::get('dashboard', function () {
//     // return view('welcome');
//     return view('dashboard');
//     //   return view('login');
// });

Route::resource('user_manage', 'UserController');
Route::get('get_all', 'UserController@get_users');
Route::post('login_check', 'UserController@check_login');
Route::get('get_email/{id}', 'UserController@chk_email');
Route::get('get_userid/{id}', 'UserController@chk_userid');


Route::resource('login_manage', 'LoginController');

Route::resource('/', 'LoginController');
//Route::get('/logout', function (Request $request)

Route::get('/logout', function (Request $request) {


    header("cache-Control: no-store, no-cache, must-revalidate");
      header("cache-Control: post-check=0, pre-check=0", false);
      header("Pragma: no-cache");
      header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
      Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Session::flash('succ_message', 'Logged out Successfully');
       // Redirect::back();
        return redirect('/');

});

//category
Route::resource('category','Categorymaster');
Route::post('category/update','Categorymaster@update')->name('category.update');
Route::get('showall','Categorymaster@showalldata');
Route::get('category/destroy/{id}', 'Categorymaster@destroy');
Route::get('checkcategoryname/{categoryname}', 'Categorymaster@checkexistcatname');
Route::get('checkcategortnameexist/{categoryname}/{id}', 'Categorymaster@checkeditexistcatename');
//for room
Route::resource('room','Roommaster');
Route::resource('visiter','Visitermaster');
Route::post('getcategory', 'Roommaster@getcategorydata');
Route::get('getroomdata','Roommaster@getallroomdata');
Route::post('room/update','Roommaster@update')->name('room.update');
Route::get('room/destroy/{id}', 'Roommaster@destroy');
Route::get('checkroomno/{roomo}', 'Roommaster@checkexistroomno');
Route::get('checkroomnoexist/{roomo}/{id}', 'Roommaster@checkeditexistroomno');
Route::get('checkroomname/{roomame}', 'Roommaster@checkexistroomname');
Route::get('checkroomnameexist/{roomo}/{id}', 'Roommaster@checkeditexistroomname');



//for visiter
Route::resource('visiter','Visitermaster');
Route::post('getcategory', 'Roommaster@getcategorydata');
Route::get('getroomdata','Roommaster@getallroomdata');
Route::post('room/update','Roommaster@update')->name('room.update');
Route::get('room/destroy/{id}', 'Roommaster@destroy');
Route::match(['get', 'post'], 'uploadingdoc', 'Visitermaster@uploadingdoc');
Route::resource('visitercheckin','Visitercheckincontroller');
Route::post('visiter/update', 'Visitermaster@update')->name('visiter.update');
Route::get('visiter/destroy/{id}', 'Visitermaster@destroy');
Route::get('getvisitersearch/{content}','Visitermaster@searchvisiterdata');
Route::resource('docuploaddata','Documentmaster');
Route::post('employ/update', 'Employ@update')->name('employ.update');
Route::get('employ/destroy/{id}', 'Employ@destroy');
Route::get('docuploaddata/destroy/{id}', 'Documentmaster@destroy');
Route::match(['get', 'post'], 'uploadingfile', 'Employ@uploadingfile');
Route::match(['get', 'post'], 'profileuploadingfile', 'Visitermaster@profileimguploadingfile');
Route::get('getvisitorallinfo/{visitorid}', 'Visitermaster@getholeinformation');



//for visitor check in
Route::get('getvisiterdata','Visitermaster@allvisiterdata');
Route::get('avalibleroomdata','Visitermaster@avalible_roomdata');
Route::resource('allocateroom','Allocateroom');
Route::get('allocateroom/destroy/{id}/{visterid}', 'Allocateroom@destroy');
Route::get('showallrecord','Visitercheckincontroller@showalldata');
Route::post('visterallocateroom/{visiterid}/{id}', 'Allocateroom@getvisallocateroom');
Route::get('allocateroom/', 'Allocateroom@getvistercheckout');
Route::get('getvistercheckout/{rid}/{visiterid}', 'Allocateroom@getvistercheckoutentry');
Route::post('visiter/update', 'Visitermaster@update')->name('visiter.update');
Route::post('visitercheckin/update','Visitercheckincontroller@update')->name('visitercheckin.update');
Route::resource('visitercheckout','Visiterchecoutcontroller');
Route::get('checkmobilenoexist/{mobileno}', 'Visitermaster@checkmobileno');
Route::get('allocateroomdelte/{id}', 'Allocateroom@deleteallocateroom');
Route::post('deletevisitorcheckin', 'Visitercheckincontroller@deletevisitorcheckin');



Route::get('getcheckinvisitor','Visiterchecoutcontroller@getlastcheckinvisiter');
Route::get('getvisitorserviceinformation/{id}','Visiterchecoutcontroller@getvisitorserviceinformation');

/*----for fetching vister-----------*/
Route::get('checkingetvisiterdata/{vid}','Visiterchecoutcontroller@getcheckinvisiterdata');

//----for room wise search-------------------
Route::get('roomwisesearch/{roomno}','Visiterchecoutcontroller@checkoutroomwise');

//---for getting visiter checking time information
Route::get('getvisterchecktime/{visterid}','Visiterchecoutcontroller@checkoutvistertime');

//----for updating vister allocate room
Route::get('visitercheckoutupdate/{roomid}/{visiterid}/{checkoutid}','Visiterchecoutcontroller@updateallocateroom');


Route::get('showallcheckoutuser','Visiterchecoutcontroller@getallcheckoutuser');


//for ------Edit getalllocateroom-----------------*/

Route::get('geteditallocateroom/{visterid}/{checkoutid}','Visiterchecoutcontroller@geteditallocateroom');


Route::resource('allocateroom','Allocateroom');
Route::get('allocateroom/destroy/{id}/{visterid}', 'Allocateroom@destroy');
Route::get('showallrecord','Visitercheckincontroller@showalldata');


//for user management-----
Route::resource('usermanagement','Usermanagementcontroller');
Route::get('getalluser','Usermanagementcontroller@alluser');
Route::get('checkuserid/{userid}','Usermanagementcontroller@checkuserid');
Route::get('usermanagement/destroy/{id}', 'Usermanagementcontroller@destroy');
Route::get('checkusermobileno/{mobileno}','Usermanagementcontroller@checkusermobile');
Route::get('checkusermobileno/{mobileno}{id}','Usermanagementcontroller@editcheckusermobile');
Route::get('checkexistemail/{mobileno}','Usermanagementcontroller@checkexistemail');
Route::get('checkexistemail/{mobileno}{id}','Usermanagementcontroller@editcheckexistemail');

//for extra service
Route::resource('service','Servicecontroller');
Route::get('getservice','Servicecontroller@getallservice');
Route::get('service/destroy/{id}', 'Servicecontroller@destroy');


//for change Languages
Route::resource('changelanguges', 'Changelanguages');
Route::post('/languges',array(
    'Middleware'=>'LanguageSwitcher',
    //'as'=>'language-chooser',
    'uses'=>'LanguagesController@index'
));


//for check out screen----




//for checkin report
Route::resource('checkinreport', 'CheckinreportController');
Route::get('getcustomercheck/{fromdate}/{todate}', 'CheckinreportController@getcheckcustomer');
Route::post('getvisitorfullinforamtion', 'CheckinreportController@getvisitorfullinforamtion');


//for checkoutreport
Route::resource('chechoutreport', 'Checkoutreportcontroller');
Route::get('getcustomercheckout/{fromdate}/{todate}', 'Checkoutreportcontroller@getcheckoutvisitor');

//for extraservice report
Route::resource('extraitemreport', 'Extraitemreportcontroller');
Route::get('extraitemreportdata/{fromdate}/{todate}', 'Extraitemreportcontroller@getextraitemdata');

//invoicereport
Route::resource('invoicereport', 'Invoicereportcontroller');
Route::get('invoicereportdata/{fromdate}/{todate}/{visitor}', 'Invoicereportcontroller@getinvoicedata');
Route::get('getallvisitorname', 'Invoicereportcontroller@getallvisitor');


Route::get('checkroomno/{roomno}', 'Roommaster@checkexistroomno');

//for invoice

Route::resource('invoice','Invoicecontroller');

Route::resource('service','Servicecontroller');
Route::get('getservice','Servicecontroller@getallservice');
Route::get('service/destroy/{id}', 'Servicecontroller@destroy');

Route::get('searchroom/{roomno}/{visiterid}','Invoicecontroller@searchroomdata');
Route::get('dropdowndata','Invoicecontroller@getdropdown');
Route::resource('invoicedetalis','Invoicedetaliscontroller');
Route::get('getallinvoice','Invoicecontroller@getallinvicedata');
Route::post('invoice/update', 'Invoicecontroller@update')->name('invoice.update');
Route::get('geteditsearch/{roomno}/{visiterid}','Invoicecontroller@searcheditroomdata');
Route::get('invoice/destroy/{id}', 'Invoicecontroller@destroy');
Route::get('getvisitorbookedroomdata/{id}','Invoicecontroller@getallbookedinfo');
Route::get('getroomwiseservices/{id}','Invoicecontroller@getroomwiseservicelist');
Route::get('geteditvisitor/{id}','Invoicecontroller@geteditvisitorinvoice');
Route::get('getvisallocateroom/{id}','Invoicecontroller@getvisallocateinfo');
Route::get('geteditserviceinfodata/{id}','Invoicecontroller@geteditserviceinfodetalis');
Route::get('roomwiseinvoice/{visiterid}/{id}','Invoicecontroller@getroomwiseinvoice');
Route::get('roomservicedetalis/{visiterid}/{id}','Invoicecontroller@getroomservice');
Route::get('editroomnoinfo/{id}','Invoicecontroller@geteditinroomnno');
Route::get('checkinvoicenoexists/{invoiceno}','Invoicecontroller@checkinvoicenoexists');
Route::get('checkeditinvoicenoexists/{invoiceno}/{inid}','Invoicecontroller@checkeditinvoicenoexists');

//---for Extra Service Allocation----
Route::resource('allocationservice','Allocationservicecontroller');
Route::get('getallocateroom','Allocationservicecontroller@allallocateroom');
Route::get('getservice','Allocationservicecontroller@getallservice');
Route::get('servicerate/{id}','Allocationservicecontroller@getservicerate');
Route::get('getvistiterinformation/{roomno}','Allocationservicecontroller@getroomvisterinfo');
Route::resource('allocateservicedetalisdata','Allocateservicedetailscontroller');
Route::get('getserviceintb','Allocationservicecontroller@getroomwiseservice');

Route::get('allocateservicedetalisdata/destroy/{id}', 'Allocateservicedetailscontroller@destroy');
Route::post('allocationservice/update', 'Allocationservicecontroller@update')->name('allocationservice.update');
Route::get('allocationservice/destroy/{id}', 'Allocationservicecontroller@destroy');

//for advance Booking
Route::resource('advancebooking','Advancebooking');
Route::resource('advanceallocateroom','Advaceroomallocate');
Route::get('advancebookshowallrecord','Advancebooking@showalladvancebook');
//Route::post('advancebooking/update','Advancebooking@update')->name('Advancebooking.update');
Route::post('advanceallocateroomdata/{visiterid}/{id}', 'Advaceroomallocate@advancegetvisallocateroom');
Route::post('advancebooking/update', 'Advancebooking@update')->name('advancebooking.update');
Route::get('canclebooking/{id}', 'Advancebooking@cancleadvancebooking');
Route::post('cancellationbooking', 'Advancebooking@cancellationbooking');

//for getting Advance Booking information
Route::get('getadvancecheckin/{id}', 'Advancebooking@getadvancebookinginfo');

//for Change Time
Route::resource('settime','ChangeTimeController');
Route::post('settime/update', 'ChangeTimeController@update')->name('settime.update');


//for getting allroom of category
Route::get('getallroominformation/{cateidid}', 'Visitercheckincontroller@getallroomdatainfo');

//for check out information
Route::get('getcheckoutscreen/{checkinid}', 'Visitercheckincontroller@getcheckout');
Route::get('vistorcheckininfo/{checkinid}', 'Visitercheckincontroller@getvischeckinginformation');
Route::get('updatestatus/{checkinid}', 'Visitercheckincontroller@checkinupdatestatus');
Route::post('roomwiseservices', 'Visiterchecoutcontroller@roomwiseservices');


//for getting dashboard

Route::get('gettodaycountofall', 'Dashboardcontroller@getdashboarddata');
Route::get('dashboard', 'Dashboardcontroller@index');










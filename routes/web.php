<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Training\TrainingApplicationController;
use App\Http\Controllers\Training\TrainingController;
use App\Http\Controllers\Funding\FundingController;
use App\Http\Controllers\Applicant\ApplicantController;

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
Route::get('/', function () {    return view('welcome'); });
Route::get('loginpage',['uses'=>'App\Http\Controllers\Admin\UserController@loginpage','as'=>'loginpage']);

//Route::get('/', function () {    return view('auth.login'); });
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboardadmin', function () {
 return view('dashboard');
})->name('dashboardadmin');

Route::get('register',['uses'=>'App\Http\Controllers\Admin\UserController@register','as'=>'register']);
Route::post('add_user',['uses'=>'App\Http\Controllers\Admin\UserController@add_user','as'=>'add_user']);

/////////////////////////MASTERS///////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Route for the roles
Route::get('role',['uses'=>'App\Http\Controllers\Admin\RoleController@index','as'=>'view_role']);
Route::post('role.add',['uses'=>'App\Http\Controllers\Admin\RoleController@postRole','as'=>'add_role']);
Route::get('role/destroy/{id}',['as'=>'role.destroy','uses'=>'App\Http\Controllers\Admin\RoleController@destroy_role']);

//Route for the ICT
Route::get('view_ictemail',['uses'=>'App\Http\Controllers\Admin\RoleController@ictemail','as'=>'view_ictemail']);
Route::post('update_ictmail',['uses'=>'App\Http\Controllers\Admin\RoleController@update_ictmail','as'=>'update_ictmail']);
Route::get('ict/view', 'App\Http\Controllers\Admin\RoleController@ictview')->name('ictedit');

//Route for the DHI CEO
Route::get('view_dhiceo',['uses'=>'App\Http\Controllers\Admin\RoleController@dhiceo','as'=>'view_dhiceo']);
Route::post('update_ceo',['uses'=>'App\Http\Controllers\Admin\RoleController@update_ceo','as'=>'update_ceo']);
Route::get('ceo/view', 'App\Http\Controllers\Admin\RoleController@ceoview')->name('ceoedit');

//Route for the Bank
Route::get('view_bank',['uses'=>'App\Http\Controllers\Admin\RoleController@bank','as'=>'view_bank']);
Route::post('update_bank',['uses'=>'App\Http\Controllers\Admin\RoleController@update_bank','as'=>'update_bank']);
Route::get('bank/view', 'App\Http\Controllers\Admin\RoleController@bankview')->name('bankedit');



//user creation//
Route::get('user',['uses'=>'App\Http\Controllers\Admin\UserController@index','as'=>'view_user']);
Route::post('user_add',['uses'=>'App\Http\Controllers\Admin\UserController@postUser','as'=>'insert_user']);
Route::get('user/view', 'App\Http\Controllers\Admin\UserController@view')->name('useredit');
Route::post('update_user',['uses'=>'App\Http\Controllers\Admin\UserController@updateUser','as'=>'update_user']);
Route::get('delete_user/{id}',['uses'=>'App\Http\Controllers\Admin\UserController@deleteUser','as'=>'delete_user']);

//Apply Application
Route::get('apply',[TrainingApplicationController::class, 'applicationlist'])->name('apply'); //modified

//Training Routes
Route::get('training',['uses'=>'App\Http\Controllers\Training\TrainingController@index','as'=>'training']);
Route::post('trainingadd',['uses'=>'App\Http\Controllers\Training\TrainingController@addtrainingnotification','as'=>'trainingadd']);
Route::get('training/edit', 'App\Http\Controllers\Training\TrainingController@editview')->name('trainingedit');
Route::post('update_training',['uses'=>'App\Http\Controllers\Training\TrainingController@updateTraining','as'=>'update_training']);
Route::get('delete_training/{id}',['uses'=>'App\Http\Controllers\Training\TrainingController@deleteTraining','as'=>'delete_training']);
//Training Provider Routes
Route::get('trainingprovider',['uses'=>'App\Http\Controllers\Training\TrainingController@trainingprovider','as'=>'trainingprovider']);
Route::post('trainingprovideradd',['uses'=>'App\Http\Controllers\Training\TrainingController@trainingprovideradd','as'=>'trainingprovideradd']);
Route::get('trainingprovider/edit', 'App\Http\Controllers\Training\TrainingController@tpview')->name('tpedit');
Route::post('update_trainingprovider',['uses'=>'App\Http\Controllers\Training\TrainingController@updateTrainingProvider','as'=>'update_trainingprovider']);
Route::get('delete_tp/{id}',['uses'=>'App\Http\Controllers\Training\TrainingController@deleteTrainingProvider','as'=>'delete_tp']);

//Interview Panel Routes
Route::get('shortpanels',['uses'=>'App\Http\Controllers\Training\TrainingController@shortpanels','as'=>'shortpanels']);
Route::post('shortpaneladd',['uses'=>'App\Http\Controllers\Training\TrainingController@shortlistpaneladd','as'=>'shortpaneladd']);
Route::get('slpanel/edit', 'App\Http\Controllers\Training\TrainingController@sledit')->name('sledit');
Route::post('update_slmember',['uses'=>'App\Http\Controllers\Training\TrainingController@update_slmember','as'=>'update_slmember']);
Route::get('delete_sl/{id}',['uses'=>'App\Http\Controllers\Training\TrainingController@deleteSLPanel','as'=>'delete_sl']);


Route::get('fshortpanels',['uses'=>'App\Http\Controllers\Training\TrainingController@fshortpanels','as'=>'fshortpanels']);
Route::post('fshortpaneladd',['uses'=>'App\Http\Controllers\Training\TrainingController@fshortlistpaneladd','as'=>'fshortpaneladd']);
Route::get('fslpanel/edit', 'App\Http\Controllers\Training\TrainingController@fsledit')->name('fsledit');
Route::post('fupdate_slmember',['uses'=>'App\Http\Controllers\Training\TrainingController@fupdate_slmember','as'=>'fupdate_slmember']);
Route::get('delete_fsl/{id}',['uses'=>'App\Http\Controllers\Training\TrainingController@deleteFSLPanel','as'=>'delete_fsl']);

Route::get('interviewpanels',['uses'=>'App\Http\Controllers\Training\TrainingController@interviewpanels','as'=>'interviewpanels']);
Route::post('interviewpaneladd',['uses'=>'App\Http\Controllers\Training\TrainingController@interviewpaneladd','as'=>'interviewpaneladd']);
Route::get('interviewpanel/edit', 'App\Http\Controllers\Training\TrainingController@interviewedit')->name('interviewedit');
Route::post('update_panelmember',['uses'=>'App\Http\Controllers\Training\TrainingController@update_panelmember','as'=>'update_panelmember']);
Route::get('delete_ip/{id}',['uses'=>'App\Http\Controllers\Training\TrainingController@deleteInterviewPanel','as'=>'delete_ip']);

//Presentation Panel Routes
Route::get('pptpanels',['uses'=>'App\Http\Controllers\Training\TrainingController@pptpanels','as'=>'pptpanels']);
Route::post('pptpaneladd',['uses'=>'App\Http\Controllers\Training\TrainingController@pptpaneladd','as'=>'pptpaneladd']);
Route::get('pptpanel/edit', 'App\Http\Controllers\Training\TrainingController@pptedit')->name('pptpanel');
Route::post('updateppt_panelmember',['uses'=>'App\Http\Controllers\Training\TrainingController@update_pptpanelmember','as'=>'updateppt_panelmember']);
Route::get('delete_pp/{id}',['uses'=>'App\Http\Controllers\Training\TrainingController@deletePptPanel','as'=>'delete_pp']);

//Application Form
Route::get('tapplication/{id}',[TrainingApplicationController::class, 'index'])->name('tapplication'); //modified

Route::post('applytraining',[TrainingApplicationController::class, 'applytraining'])->name('applytraining'); //modified

Route::post('updatetraining',['uses'=>'App\Http\Controllers\Training\TrainingApplicationController@updatetraining','as'=>'updatetraining']);
//screening
Route::get('screening',['uses'=>'App\Http\Controllers\Training\TrainingController@screening','as'=>'screening']);
/*n*/Route::post('tscreensearch',['uses'=>'App\Http\Controllers\Training\TrainingController@screeningsearch','as'=>'tscreensearch']);
/*n*/Route::get('tscreensearchid/{sid}',['uses'=>'App\Http\Controllers\Training\TrainingController@screeningsearchid','as'=>'tscreensearchid']);
Route::get('app_details/{id}/{sid}',['uses'=>'App\Http\Controllers\Training\TrainingController@view_application','as'=>'app_details']);

Route::get('app_pdf/{id}',[TrainingController::class, 'generateApplicationPDF'])->name('app_pdf'); //modified

Route::post('screeningupdate',['uses'=>'App\Http\Controllers\Training\TrainingController@ScreeningStatus','as'=>'screeningupdate']);
Route::post('s_update',['uses'=>'App\Http\Controllers\Training\TrainingController@ScreeningStatusFast','as'=>'s_update']);
Route::get('appeditdhi/{appid}',['uses'=>'App\Http\Controllers\Training\TrainingController@appeditdhi','as'=>'appeditdhi']);

// shortlisting
Route::get('shortlist',[TrainingController::class, 'shortlist'])->name('shortlist'); //modified
/*n*/Route::post('tshortsearch',[TrainingController::class, 'shortlistsearch'])->name('tshortsearch'); //modified

/*n*/Route::get('tshortsearchid/{sid}',['uses'=>'App\Http\Controllers\Training\TrainingController@shortlistsearchid','as'=>'tshortsearchid']);
Route::post('sl_update',[TrainingController::class, 'SlStatusFast'])->name('sl_update'); //modified

Route::get('short_app_details/{id}', [TrainingController::class, 'view_application_short'])->name('short_app_details'); //modified

Route::post('shortlistupdate', [TrainingController::class, 'ShortlistStatus'])->name('shortlistupdate'); //modified

Route::get('shortlistlink/{cohortopen}/{no}',['uses'=>'App\Http\Controllers\Training\TrainingController@shortlistedlist','as'=>'shortlistlink']);

Route::get('tsl_mail/{cohortopen}/{no}',[TrainingController::class, 'sendshortlistmail'])->name('tsl_mail');  //modified

Route::get('checkshortlistscore/{app_id}', [TrainingController::class, 'getShortlistScoreStatus'])->name('checkshortlistscore'); //newely added

//interview
Route::get('interview',[TrainingController::class, 'interview'])->name('interview'); //modified

/*n*/Route::post('tintsearch',[TrainingController::class, 'interviewsearch'])->name('tintsearch'); //modified

/*n*/Route::get('tintsearchid/{sid}',['uses'=>'App\Http\Controllers\Training\TrainingController@interviewsearchid','as'=>'tintsearchid']);
Route::post('generateshortlist',['uses'=>'App\Http\Controllers\Training\TrainingController@generateshortlist','as'=>'generateshortlist']);

Route::get('interview_app_details/{id}',[TrainingController::class, 'view_application_interview'])->name('interview_app_details'); //modified

Route::post('interviewupdatescore',[TrainingController::class, 'interviewUpdatescore'])->name('interviewupdatescore'); //modified

// Route::get('interview/add', 'App\Http\Controllers\Training\TrainingController@addInterviewTime')->name('interviewtime'); //commented

Route::post('idateadd',[TrainingController::class, 'addInterviewDateTime'])->name('idateadd'); //modified

// Route::get('interview/edit', 'App\Http\Controllers\Training\TrainingController@addInterviewTimeEdit')->name('interviewtimeEdit'); //commented

Route::post('interviewupdate',[TrainingController::class, 'updateInterviewDate'])->name('interviewupdate'); //modified

Route::post('sendinterviewmail',[TrainingController::class, 'interviewmail'])->name('sendinterviewmail'); //modified

Route::get('sendmail_t/{interview_id}/{appid}',[TrainingController::class, 'sendmail_t'])->name('sendmail_t'); //modified

Route::post('sendmail_iselect',[TrainingController::class, 'sendmail_iselect'])->name('sendmail_iselect'); //modified

//ranking
Route::get('ranking',[TrainingController::class, 'ranking'])->name('ranking'); //modified

/*n*/Route::post('ranksearch',[TrainingController::class, 'rankingsearch'])->name('ranksearch'); //modified

/*n*/Route::get('ranksearchid/{sid}',['uses'=>'App\Http\Controllers\Training\TrainingController@rankingsearchid','as'=>'ranksearchid']);

Route::get('ranking_details/{id}',[TrainingController::class, 'view_ranking_details'])->name('ranking_details'); //modified

Route::post('r_update',[TrainingController::class, 'RankingStatusFast'])->name('r_update'); //modified

Route::post('shortlistupdate',[TrainingController::class, 'ShortlistStatus',])->name('shortlistupdate'); //modified

Route::get('selectedlink/{cohortopen}/{no}',['uses'=>'App\Http\Controllers\Training\TrainingController@selectedlist','as'=>'selectedlink']);

Route::get('tsltd_mail/{cohortopen}/{no}',[TrainingController::class, 'sendselectedmail'])->name('tsltd_mail');

//completion
Route::get('completion',[TrainingController::class, 'completion'])->name('completion'); //modified

/*n*/Route::post('completionsearch',[TrainingController::class, 'completionsearch'])->name('completionsearch'); //modified

/*n*/Route::get('completionsearchid/{sid}',['uses'=>'App\Http\Controllers\Training\TrainingController@completionsearchid','as'=>'completionsearchid']);

Route::post('posttraining_update',[TrainingController::class, 'posttraining_update'])->name('posttraining_update'); //modified

//Funding announcement Routes
Route::get('funding',[FundingController::class, 'index'])->name('funding'); //modified

Route::post('fundingadd',[FundingController::class, 'addfunding'])->name('fundingadd'); //modified

Route::get('announcement/edit', 'App\Http\Controllers\Funding\FundingController@editview')->name('announcementedit');
Route::post('update_funding',[FundingController::class, 'updateFunding'])->name('update_funding');  //modified
Route::get('delete_funding/{id}',[FundingController::class, 'deleteFunding'])->name('delete_funding');  //modified

//Apply funding
Route::get('applyfund',[FundingController::class, 'applicationlist'])->name('applyfund'); //modified

Route::get('viewfund/{id}',['uses'=>'App\Http\Controllers\Funding\FundingController@viewfund','as'=>'viewfund']);

Route::get('fapplication/{id}',[FundingController::class, 'fundapplicationform'])->name('fapplication');  //modified

Route::post('applydhifunding',['uses'=>'App\Http\Controllers\Funding\FundingController@applyDhiFunding','as'=>'applydhifunding']);
Route::post('editdhifunding',['uses'=>'App\Http\Controllers\Funding\FundingController@editdhifunding','as'=>'editdhifunding']);

//screeningfund
Route::get('screeningfund',['uses'=>'App\Http\Controllers\Funding\FundingController@screening','as'=>'screeningfund']);
/*n*/Route::post('fs_search',['uses'=>'App\Http\Controllers\Funding\FundingController@screeningsearch','as'=>'fs_search']);
/*n*/Route::get('fs_searchid/{sid}',['uses'=>'App\Http\Controllers\Funding\FundingController@screeningsearchid','as'=>'fs_searchid']);
Route::get('fapp_details/{id}/{key}',['uses'=>'App\Http\Controllers\Funding\FundingController@view_application','as'=>'fapp_details']);

Route::get('fapp_pdf/{id}',[FundingController::class, 'generateApplicationPDF'])->name('fapp_pdf');  //modified

Route::post('fscreeningupdate',['uses'=>'App\Http\Controllers\Funding\FundingController@ScreeningStatus','as'=>'fscreeningupdate']);
Route::post('fs_update',['uses'=>'App\Http\Controllers\Funding\FundingController@ScreeningStatusFast','as'=>'fs_update']);
Route::get('fundeditdhi/{appid}',['uses'=>'App\Http\Controllers\Funding\FundingController@fundeditdhi','as'=>'fundeditdhi']);

//shortlistingfund
Route::get('shortlistfund',[FundingController::class, 'shortlist'])->name('shortlistfund');  //modified

/*n*/Route::post('fsl_search',[FundingController::class, 'shortlistsearch'])->name('fsl_search');  //modified

/*n*/Route::get('fsl_searchid/{sid}',['uses'=>'App\Http\Controllers\Funding\FundingController@shortlistsearchid','as'=>'fsl_searchid']);

Route::post('fsl_update',[FundingController::class, 'SlStatusFast'])->name('fsl_update'); //modified

Route::get('fshort_app_details/{id}',[FundingController::class, 'view_application_shortlist'])->name('fshort_app_details'); //modified

Route::post('fshortlistupdate',[FundingController::class, 'ShortlistStatus'])->name('fshortlistupdate');  //modified

Route::get('sl_pdf/{cohortopen}/{no}',['uses'=>'App\Http\Controllers\Funding\FundingController@generateShortListPDF','as'=>'sl_pdf']);

Route::get('fsl_mail/{cohortopen}/{no}',[FundingController::class,'sendshortlistmail'])->name('fsl_mail');  //modified

Route::get('sllink/{cohortopen}/{no}',['uses'=>'App\Http\Controllers\Funding\FundingController@funshortlistlink','as'=>'sllink']);

//Fund presentation
Route::get('presentation',[FundingController::class, 'presentation'])->name('presentation');  //modified

/*n*/Route::post('fppt_search',[FundingController::class, 'presentationsearch'])->name('fppt_search');

/*n*/Route::get('fppt_searchid/{sid}',['uses'=>'App\Http\Controllers\Funding\FundingController@presentationsearchid','as'=>'fppt_searchid']);

Route::get('p_app_details/{id}',[FundingController::class, 'presentation_view'])->name('p_app_details');  //modified

Route::post('pptupdatescore',[FundingController::class, 'pptUpdatescore'])->name('pptupdatescore');  //modified

// Route::get('ppt/add', 'App\Http\Controllers\Funding\FundingController@addPPT')->name('interviewtime1'); //commented

Route::post('pdateadd',[FundingController::class, 'addPPTDateTime'])->name('pdateadd'); 

// Route::get('ppt/edit', 'App\Http\Controllers\Funding\FundingController@addPPTEdit')->name('interviewtimeEdit1'); //commented

Route::post('pptupdate',[FundingController::class, 'updatePPTDate'])->name('pptupdate');

Route::post('sendpptmail',[FundingController::class, 'interviewmail'])->name('sendpptmail');

Route::post('mailattachment',['uses'=>'App\Http\Controllers\Funding\FundingController@mailattachment','as'=>'mailattachment']);
Route::get('removeattach/{id}/{fid}/{cohortopen}/{no}/{key}',['uses'=>'App\Http\Controllers\Funding\FundingController@deleteattachment','as'=>'removeattach']);
Route::get('mplist/{fid}/{cohortopen}/{no}/{key}',['uses'=>'App\Http\Controllers\Funding\FundingController@mail_list','as'=>'mplist']);
Route::get('sendmail_p/{email}/{date}/{time}/{appid}/{fid}/{cohortopen}/{no}/{key}',
['uses'=>'App\Http\Controllers\Funding\FundingController@sendmail_p','as'=>'sendmail_p']);
Route::post('sendmail_pselect',['uses'=>'App\Http\Controllers\Funding\FundingController@sendmail_pselect','as'=>'sendmail_pselect']);


//presentation Score
Route::get('presentationscore',[FundingController::class, 'pscore'])->name('presentationscore');  //modified

/*n*/Route::post('fpptscore_search',[FundingController::class, 'pscoresearch'])->name('fpptscore_search'); //modified

/*n*/Route::get('fpptscore_searchid/{sid}',['uses'=>'App\Http\Controllers\Funding\FundingController@pscoresearchid','as'=>'fpptscore_searchid']);

Route::get('score_details/{id}',[FundingController::class, 'pptscore_view'])->name('score_details'); //modified

Route::post('f_select',[FundingController::class, 'Selection'])->name('f_select'); //modified

Route::get('fselect_mail/{cohortopen}/{no}',[FundingController::class, 'sendselectedmail'])->name('fselect_mail');

Route::get('fundsellink/{cohortopen}/{no}',['uses'=>'App\Http\Controllers\Funding\FundingController@fundselectedlink','as'=>'fundsellink']);

//Contract schedule
Route::get('contractschedule',[FundingController::class, 'contractschedule'])->name('contractschedule');  //modified

/*n*/Route::post('cs_search',[FundingController::class, 'cssearch'])->name('cs_search');  //modified

/*n*/Route::get('cs_searchid/{sid}',['uses'=>'App\Http\Controllers\Funding\FundingController@cssearchid','as'=>'cs_searchid']);

// Route::get('ct/add', 'App\Http\Controllers\Funding\FundingController@addCT')->name('contract1');  //commented

Route::post('contractdateadd',[FundingController::class, 'ContractDateTime'])->name('contractdateadd'); //modified

// Route::get('ct/edit', 'App\Http\Controllers\Funding\FundingController@CtEdit')->name('contract');  //commented

Route::post('ctupdate',[FundingController::class, 'updateCT'])->name('ctupdate');  //modified

Route::post('sendcontractmail',[FundingController::class, 'contractemail'])->name('sendcontractmail');  //modified

Route::get('sendmail_c/{email}/{date}/{time}/{appid}/{fid}/{cohortopen}/{no}/{key}',
['uses'=>'App\Http\Controllers\Funding\FundingController@sendmail_c','as'=>'sendmail_c']);
Route::post('sendmail_cselect',['uses'=>'App\Http\Controllers\Funding\FundingController@sendmail_cselect','as'=>'sendmail_cselect']);
Route::get('mclist/{fid}/{cohortopen}/{no}',['uses'=>'App\Http\Controllers\Funding\FundingController@mail_clist','as'=>'mclist']);



//Contract Sign
Route::get('contractsign',[FundingController::class, 'contractsign'])->name('contractsign');  //modified

/*n*/Route::post('contractsignsearch',[FundingController::class, 'csignsearch'])->name('contractsignsearch');  //modified

/*n*/Route::get('contractsignsearchid/{sid}',['uses'=>'App\Http\Controllers\Funding\FundingController@csignsearchid','as'=>'contractsignsearchid']);

Route::get('gcontract/{id}/{sstatus}/{slstatus}',[FundingController::class, 'generatecontract'])->name('gcontract');  //modified

Route::get('contract_pdf/{id}',['uses'=>'App\Http\Controllers\Funding\FundingController@generateContractPDF','as'=>'contract_pdf']);

Route::post('uploadcontract',[FundingController::class, 'ContractUpload'])->name('uploadcontract');  //modified

//FundRequest
Route::get('updateinfo',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@updateinfo','as'=>'updateinfo']);
Route::post('postupdate',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@postupdate','as'=>'postupdate']);

Route::get('fundrequest',[ApplicantController::class, 'approvedbusiness'])->name('fundrequest'); //modified

Route::get('fundapp/{id}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@fundapp','as'=>'fundapp']);
Route::post('releasefund',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@releasefund','as'=>'releasefund']);

//FundRequest REview
Route::get('fundreview',[ApplicantController::class, 'fundreview'])->name('fundreview'); //modified

Route::post('fundrequest_search',[ApplicantController::class, 'fundreviewsearch'])->name('fundrequest_search'); //modified

Route::get('fundrequest_searchid/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@fundreviewsearchid','as'=>'fundrequest_searchid']);

Route::get('fundappreview/{id}',[ApplicantController::class, 'fundappreview'])->name('fundappreview'); //modified

Route::post('postfundreview',[ApplicantController::class, 'postfundreview'])->name('postfundreview');  //modified

Route::post('updatefundreview',[ApplicantController::class, 'updatefundreview'])->name('updatefundreview');  //modified

Route::get('reviewach/{id}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@reviewach','as'=>'reviewach']);
Route::post('postreviewach',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@postreviewach','as'=>'postreviewach']);
Route::get('reviewasd/{id}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@reviewasd','as'=>'reviewasd']);
Route::get('viewdetailasd/{id}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@fundappreviewasd','as'=>'viewdetailasd']);
Route::post('postreviewasd',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@postreviewasd','as'=>'postreviewasd']);

Route::get('disbursement',[ApplicantController::class, 'disbursement'])->name('disbursement');  //modified

Route::post('disburse_search',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@disbursementsearch','as'=>'disburse_search']);
Route::get('disburse_searchid/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@disbursementsearchid','as'=>'disburse_searchid']);

Route::post('upload_disbursement',[ApplicantController::class, 'DisbursementUpload'])->name('upload_disbursement');

Route::post('disburseimport',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@importdisbursement','as'=>'disburseimport']);
Route::get('saveimportdisburse',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@saveimportdisburse','as'=>'saveimportdisburse']);
Route::get('disbursed',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@disbursed','as'=>'disbursed']);
Route::get('disbursementview/{id}/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@disbursementview','as'=>'disbursementview']);
Route::get('disbursementpdf/{id}/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@disbursementviewPDF','as'=>'disbursementpdf']);
Route::get('bankview/{id}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@bankview','as'=>'bankview']);
Route::post('postbankreview',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@postbankreview','as'=>'postbankreview']);
Route::post('upload_receipt',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@ReceiptUpload','as'=>'upload_receipt']);




//Repayment
Route::get('repayment',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@repayment','as'=>'repayment']);
Route::get('allrepayment/{fundid}/{cid}/{tfd}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@allrepayment','as'=>'allrepayment']);
Route::get('updatepayment/{fundid}/{cid}/{tfd}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@updatepayment','as'=>'updatepayment']);
Route::post('insertpayment',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@insertpayment','as'=>'insertpayment']);
Route::get('viewpayment/{fundid}/{year}/{month}/{emi}/{ddate}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@viewpayment','as'=>'viewpayment']);

Route::get('repaymentdhi',[ApplicantController::class, 'repaymentdhi'])->name('repaymentdhi');  //modified

Route::post('payment_search',[ApplicantController::class, 'repaymentdhisearch'])->name('payment_search');  //modified

Route::get('payment_searchid/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@repaymentdhisearchid','as'=>'payment_searchid']);
Route::post('cidsearch',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@cidsearch','as'=>'cidsearch']);
Route::post('paymentimport',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@import','as'=>'paymentimport']);

Route::get('allrepaymentdhi/{fundid}/{cid}',[ApplicantController::class, 'allrepaymentdhi'])->name('allrepaymentdhi');  //modified

Route::get('updatepaymentdhi/{fundid}/{cid}',[ApplicantController::class, 'updatepaymentdhi'])->name('updatepaymentdhi');  //midified

Route::get('refund/{fundid}/{cid}/{tfd}',[ApplicantController::class, 'refundpaymentdhi'])->name('refund'); //midified

Route::post('insertpaymentdhi',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@insertpaymentdhi','as'=>'insertpaymentdhi']);
Route::post('insertrefund',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@insertrefund','as'=>'insertrefund']);

Route::get('viewpaymentdhi/{id}/{fundid}/{cid}',[ApplicantController::class, 'viewpaymentdhi'])->name('viewpaymentdhi'); //modified

Route::post('paymentreview',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@paymentreview','as'=>'paymentreview']);
Route::get('delayall',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@delayall','as'=>'delayall']);

//Site Visit
Route::get('sitevisit',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@sitevisit','as'=>'sitevisit']);
Route::post('sitevist_search',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@sitevisitsearch','as'=>'sitevist_search']);
Route::get('sitevist_searchid/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@sitevisitsearchid','as'=>'sitevist_searchid']);
Route::get('scheduleindi/{fid}/{key}', 'App\Http\Controllers\Applicant\ApplicantController@updatesitevisit')->name('scheduleindi');
Route::post('sitevisitadd',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@sitevisitadd','as'=>'sitevisitadd']);
Route::get('ctst/edit', 'App\Http\Controllers\Applicant\ApplicantController@CtEdit')->name('ctstedit');
Route::post('svupdate',['uses'=>'App\Http\Controllers\Funding\FundingController@updatesitevisitdatetime','as'=>'svupdate']);
Route::get('delete_sitevist/{id}/{fundid}/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@deletesitevist','as'=>'delete_sitevist']);
Route::get('delete_sitevistupdate/{id}/{fundid}/{key}',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@deletesitevistupdate','as'=>'delete_sitevistupdate']);
Route::get('scheduleindient/{fid}', 'App\Http\Controllers\Applicant\ApplicantController@updatesitevisitent')->name('scheduleindient');
Route::post('virtualforment',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@virtualforment','as'=>'virtualforment']);

//Route::get('updatesitevisit',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@updatesitevisit','as'=>'updatesitevisit']);
Route::get('svid/add', 'App\Http\Controllers\Applicant\ApplicantController@svid')->name('svid');
Route::post('addsitevisitactivity',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@addsitevisitactivity','as'=>'addsitevisitactivity']);
Route::get('svid/edit', 'App\Http\Controllers\Applicant\ApplicantController@SvEdit')->name('svidedit');
Route::get('esitevisit',['uses'=>'App\Http\Controllers\Applicant\ApplicantController@esitevisit','as'=>'esitevisit']);

//Mentoring
Route::get('mentoring',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@index','as'=>'mentoring']);
Route::get('adnewmentoring',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@adnewmentoring','as'=>'adnewmentoring']);
Route::post('addmentoring',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@addmentoring','as'=>'addmentoring']);
Route::get('mentoringview/{id}',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@mentoringview','as'=>'mentoringview']);
Route::get('mentoringviewent/{id}',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@mentoringviewent','as'=>'mentoringviewent']);
Route::post('updatementoring',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@updatementoring','as'=>'updatementoring']);
Route::post('addmentorgrp',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@addmentorgrp','as'=>'addmentorgrp']);
Route::get('deletementor/{id}',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@deletementor','as'=>'deletementor']);
Route::get('mentoringmail/{id}',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@mentoringmail','as'=>'mentoringmail']);
Route::get('sendmail_m/{mid}/{email}',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@sendmail','as'=>'sendmail_m']);
Route::post('sendmail_mselect',['uses'=>'App\Http\Controllers\Mentoring\MentoringController@sendmail_select','as'=>'sendmail_mselect']);


//Budget
Route::get('budgethead',['uses'=>'App\Http\Controllers\Budget\BudgetController@index','as'=>'budgethead']);
Route::post('budgetheadadd',['uses'=>'App\Http\Controllers\Budget\BudgetController@budgetheadadd','as'=>'budgetheadadd']);
Route::get('bdgethead/edit', 'App\Http\Controllers\Budget\BudgetController@editview')->name('bdgetheadedit');
Route::post('update_bhead',['uses'=>'App\Http\Controllers\Budget\BudgetController@update_bhead','as'=>'update_bhead']);
Route::get('delete_bhead/{id}',['uses'=>'App\Http\Controllers\Budget\BudgetController@deleteBhead','as'=>'delete_bhead']);

Route::get('expenseheads',['uses'=>'App\Http\Controllers\Budget\BudgetController@expensehead','as'=>'expenseheads']);
Route::post('expenseheadadd',['uses'=>'App\Http\Controllers\Budget\BudgetController@expheadadd','as'=>'expenseheadadd']);
Route::get('exphead/edit', 'App\Http\Controllers\Budget\BudgetController@editviewexpense')->name('exphead');
Route::post('update_exphead',['uses'=>'App\Http\Controllers\Budget\BudgetController@update_exphead','as'=>'update_exphead']);
Route::get('delete_exphead/{id}',['uses'=>'App\Http\Controllers\Budget\BudgetController@deleteExphead','as'=>'delete_exphead']);

Route::get('budgetdetails',['uses'=>'App\Http\Controllers\Budget\BudgetController@budgetdetails','as'=>'budgetdetails']);
Route::post('budgetyear',['uses'=>'App\Http\Controllers\Budget\BudgetController@searchbudget','as'=>'budgetyear']);
Route::post('budgetdetailadd',['uses'=>'App\Http\Controllers\Budget\BudgetController@budgetdetailadd','as'=>'budgetdetailadd']);
Route::get('bgdetail/edit', 'App\Http\Controllers\Budget\BudgetController@editviewbgdetail')->name('bgdetail');
Route::post('update_budgetdetails',['uses'=>'App\Http\Controllers\Budget\BudgetController@update_budgetdetails','as'=>'update_budgetdetails']);
Route::get('deleteBudgetDetail/{id}',['uses'=>'App\Http\Controllers\Budget\BudgetController@deleteBudgetDetail','as'=>'deleteBudgetDetail']);

Route::get('expensedetails',['uses'=>'App\Http\Controllers\Budget\BudgetController@expensedetails','as'=>'expensedetails']);
Route::post('expenseyear',['uses'=>'App\Http\Controllers\Budget\BudgetController@searcexpenses','as'=>'expenseyear']);
Route::get('updateexpensedetails/{budgetdetailid}',['uses'=>'App\Http\Controllers\Budget\BudgetController@updateexpensedetails','as'=>'updateexpensedetails']);
Route::post('update_expdetails',['uses'=>'App\Http\Controllers\Budget\BudgetController@update_expdetails','as'=>'update_expdetails']);
Route::get('deleteExpDetail/{id}/{budgetdetailid}',['uses'=>'App\Http\Controllers\Budget\BudgetController@deleteExpDetail','as'=>'deleteExpDetail']);

//Register
Route::get('registration_type',['uses'=>'App\Http\Controllers\Register\RegisterController@register_type','as'=>'registration_type']);
Route::post('bhutaneseregister',['as'=>'bhutaneseregister','uses'=>'App\Http\Controllers\Register\RegisterController@bhutaneseregister']);
Route::get('registration_fetch',['uses'=>'App\Http\Controllers\Register\RegisterController@registration_fetch','as'=>'registration_fetch']);
Route::post('save_bhutaneseregistration',['as'=>'save_bhutaneseregistration','uses'=>'App\Http\Controllers\Register\RegisterController@save_bhutaneseregistration']);
Route::post('email_check',['as'=>'email_check','uses'=>'App\Http\Controllers\Register\RegisterController@ajaxRequestPost']);

Route::get('registration_requests',['uses'=>'App\Http\Controllers\Register\RegisterController@registration_requests','as'=>'registration_requests']);
Route::get('registration_request_review/{reg_id}',['as'=>'registration_request_review','uses'=>'App\Http\Controllers\Register\RegisterController@registration_request_review']);
Route::post('approve_registration_request/{reg_id}',['as'=>'approve_registration_request','uses'=>'App\Http\Controllers\Register\RegisterController@approve_registration_request']);

Route::get('export/{trainingid}',['uses'=>'App\Http\Controllers\Training\TrainingController@export','as'=>'export']);
Route::post('import',['uses'=>'App\Http\Controllers\Training\TrainingController@import','as'=>'import']);

Route::get('exportfund/{fundid}',['uses'=>'App\Http\Controllers\Funding\FundingController@export','as'=>'exportfund']);
Route::post('fundimport',['uses'=>'App\Http\Controllers\Funding\FundingController@import','as'=>'fundimport']);

//Reports
Route::get('reporttraining',['uses'=>'App\Http\Controllers\Report\ReportController@training','as'=>'reporttraining']);
Route::get('reportfunding',['uses'=>'App\Http\Controllers\Report\ReportController@funding','as'=>'reportfunding']);
Route::post('reportsearch',['uses'=>'App\Http\Controllers\Report\ReportController@fundsearch','as'=>'reportsearch']);
Route::get('repaydetails/{id}',['uses'=>'App\Http\Controllers\Report\ReportController@details','as'=>'repaydetails']);
Route::post('reporttsearch',['uses'=>'App\Http\Controllers\Report\ReportController@tsearch','as'=>'reporttsearch']);
Route::get('tdetails/{id}',['uses'=>'App\Http\Controllers\Report\ReportController@tdetails','as'=>'tdetails']);

Route::get('reportfundingedd',['uses'=>'App\Http\Controllers\Report\ReportController@fundingedd','as'=>'reportfundingedd']);
Route::get('repaydetailsedd/{id}',['uses'=>'App\Http\Controllers\Report\ReportController@detailsedd','as'=>'repaydetailsedd']);



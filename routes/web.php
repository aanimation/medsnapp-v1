<?php

use Illuminate\Support\Facades\{Config, Route};

/*https://posthog.com/tutorials/event-tracking-guide*/
use PostHog\PostHog;

use App\Http\Middleware\{AdminMiddleware, OnBoardMiddleware /*, ProfileMiddleware*/};

use App\Http\Gamification\Auth\{ForgotPassword, Login, LoginOauth, Logout, Register, ResetPassword};
use App\Http\Gamification\Question\{QuestionStart, QuestionSession, QuestionList, QuestionDetail, QuestionForm};
use App\Http\Gamification\{Dashboard as UserDashboard, Help, Invite, Offer};
use App\Http\Gamification\Patient\{Questboard, QuestFinish, QuestLobby};
use App\Http\Gamification\Shop\{Shop, Payment};
use App\Http\Gamification\Admin\{Dashboard as AdminDashboard, User as AdminUser, UserLogs, UserForm, UserDetail, Inventory, InventoryForm, Notification, Notifs, Patient, PatientForm, Question as AdminQuestion, Transaction, Operator};
use App\Http\Gamification\Admin\Blog\{PostList, PostForm};
use App\Http\Gamification\Admin\Master\{Badge, Profession, Specialty, Student, Country, School};
use App\Http\Gamification\User\{Bills, Profile, Learnboard, Security as UserSecurity};
use App\Http\Controllers\{BlogController as Blog, PlayerController as Player};

if(Config::get('app.env') === 'production') {
    $domainMain = 'main';
    $domainApp = 'platform';
}elseif(Config::get('app.env') === 'staging') {
    $domainMain = 'staging';
    $domainApp = 'staging';
}else{
    $domainMain = 'development';
    $domainApp = 'development';
}

/**
 * MULTISITE Reference
 */
//https://welcm.uk/blog/laravel-multisite

/**
 * ERROR HANDLER
 */
Route::fallback(function () { return redirect()->route('homepage'); });
Route::get('/oauth/google/callback', LoginOauth::class);
Route::get('/logout', [Logout::class, 'destroy'])->name('logout');

/**
 * LANDING HOMEPAGE on Main
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainMain)], function () {
    Route::get('/', function(){ return view('landing'); })->name('homepage');
    Route::get('/pricing', function(){ return view('pricing'); })->name('pricing');
    Route::get('/testimonials', function(){ return view('testimonials'); })->name('testimonials');
    Route::get('/affiliate-programme', function(){ return view('affiliate'); })->name('affiliate');
    Route::get('/terms-and-conditions', function(){ return view('toc'); })->name('toc');
});

/**
 * BLOG on Main
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainMain)], function () {
    Route::get('/medicine', [Blog::class, 'medicinePage'])->name('medicine');
    Route::get('/guides', [Blog::class, 'guidesPage'])->name('guides');
    Route::get('/applications', [Blog::class, 'applicationsPage'])->name('applications');
    Route::get('/post/detail/{type}/{slug}', [Blog::class, 'show'])->name('post-detail');
});

/**
 * AUTHENTICATION on Platform
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainApp)], function () {

    // Route::get('/', Login::class)->middleware('guest')->name('home');
    Route::get('/signin', Login::class)->middleware('guest')->name('login');
    Route::get('/signup', Register::class)->middleware('guest')->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
    Route::get('/reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');
});

/**
 * OFFER on platform
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainApp), 'prefix' => 'offer', 'middleware' => ['auth', 'verified', OnBoardMiddleware::class]], function () {
    Route::get('subscription', Offer::class)->name('subscription');
});

/**
 * PLAYER on platform
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainApp), 'prefix' => 'player', 'middleware' => ['auth', 'verified', OnBoardMiddleware::class]], function () {

    Route::get('game-stats', UserDashboard::class)->name('player-dashboard');
    Route::get('learning-stats', Learnboard::class)->name('player-learnboard');
    Route::get('profile/settings', Profile::class)->name('player-profile');
    Route::get('profile/security', UserSecurity::class)->name('player-security');
    Route::get('profile/bills', Bills::class)->name('player-bills');
    Route::get('shop', Shop::class)->name('shop');
    Route::get('help', Help::class)->name('help');
    Route::get('invite', Invite::class)->name('invite');
    
    Route::get('lobby', QuestLobby::class)->name('lobby');
    Route::get('patient/{key?}', Questboard::class)->name('questboard');
    Route::get('patient/finish/{key?}', QuestFinish::class)->name('questfinish');

    Route::get('questions', QuestionStart::class)->name('questions');
    Route::get('questions/session/{code}', QuestionSession::class)->name('question-session');
    Route::get('questions/user', QuestionList::class)->name('question-user');
    Route::get('questions/user/{key}', QuestionDetail::class)->name('question-detail');
});

/**
 * VERIFICATION on Platform
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainApp)], function () {
    Route::get('/verify/player/{verifyCode}/{type}', [Player::class, 'verifyPlayer'])->middleware('guest')->name('verify-player');
    Route::get('/i/{id}', [Player::class, 'invitePlayer'])->middleware('guest')->name('invite-player');
});


/**
 * ADMIN
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainApp), 'prefix' => 'manage', 'middleware' => ['auth', 'verified', AdminMiddleware::class]], function () {
    Route::get('dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('push-notification', Notification::class)->name('notification');
    Route::get('user-notifs', Notifs::class)->name('notifs');
    Route::get('transactions', Transaction::class)->name('user-transaction');

    Route::get('users', AdminUser::class)->name('user-list');
    Route::get('users/logs/{key}', UserLogs::class)->name('user-logs');
    Route::get('users/detail/{key}', UserDetail::class)->name('user-detail');
    Route::get('users/form/{key?}', UserForm::class)->name('user-form');
    Route::get('patients', Patient::class)->name('patient-list');
    Route::get('patients/form/{key?}', PatientForm::class)->name('patient-form');
    Route::get('inventories', Inventory::class)->name('inventory-list');
    Route::get('inventories/form/{key?}', InventoryForm::class)->name('inventory-form'); 
    Route::get('questions', AdminQuestion::class)->name('question-list');
    Route::get('questions/detail/{key}', QuestionDetail::class)->name('question-review');
    Route::get('questions/form/{key?}', QuestionForm::class)->name('question-form');

    Route::get('posts', PostList::class)->name('post-list');
    Route::get('posts/{slug}', PostForm::class)->name('post-form');

    Route::get('ops', Operator::class)->name('operator-list');

    Route::get('badges', Badge::class)->name('badge-list');
    Route::get('students', Student::class)->name('student-list');
    Route::get('specialties', Specialty::class)->name('specialty-list');
    Route::get('professions', Profession::class)->name('profession-list');
    Route::get('countries', Country::class)->name('country-list');
    Route::get('universities', School::class)->name('school-list');
});

/**
 * Payment
 */
Route::group(['domain' => Config::get('sites.urls.'.$domainApp), 'prefix' => 'payment'], function () {
    Route::get('stripe/{status}', Payment::class)->name('payment-status');
    // Route::get('stripe/success', function(){ return view('payments.success'); })->name('stripe-success');
    // Route::get('stripe/cancel', function(){ return view('payments.cancel'); })->name('stripe-cancel');
});


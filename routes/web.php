<?php

use App\Livewire\Home;
use App\Livewire\Testnovalui;
use App\Livewire\Home\SetYear;
use App\Livewire\Notif\Notification;
use App\Livewire\Settings\MyProfile;
use App\Livewire\Settings\Psettings;
use App\Livewire\Settings\ClientData;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dareq\DareqClientIndex;
use App\Livewire\Dareq\DareqClientDetail;
use App\Livewire\Dareq\DareqClientNotifWa;
use App\Livewire\Dashboard\DashboardAdmin;
use App\Livewire\Dashboard\DashboardKlien;
use App\Livewire\Dashboard\DashboardAuditor;
use App\Livewire\Settings\ClientDataDetails;
use App\Livewire\Dareq\DareqClientDetailCycle;
use App\Livewire\Dashboard\DashboardAuditorExport;
use App\Livewire\Dashboard\DashboardAuditorSendWa;
use App\Livewire\Report\ReportClient;


// Home / Dashboard Route
Route::get('/', SetYear::class)->name('home.set-year');
Route::get('/dashboard', SetYear::class)->name('dashboard');
Route::get('dashboard-auditor', DashboardAuditor::class)->name('dashboard.auditor');
Route::get('dashboard-auditor-export', DashboardAuditorExport::class)->name('dashboard.auditor-export');
Route::get('dashboard-auditor-send', DashboardAuditorSendWa::class)->name('dashboard.auditor-send-wa');

Route::get('dashboard-klien', DashboardKlien::class)->name('dashboard.klien');
Route::get('dashboard-admin', DashboardAdmin::class)->name('dashboard.admin');


Route::get('/dareqIndex', DareqClientIndex::class)->name('dareq.dareq-client-index');
Route::get('/dareqClientNotifWa', DareqClientNotifWa::class)->name('dareq.dareq-client-notif-wa');

Route::get('/dareqdetail', DareqClientDetail::class)->name('dareq.dareq-client-detail');
Route::get('/dareqdetailcycle', DareqClientDetailCycle::class)->name('dareq.dareq-client-detail-cycle');

Route::get('/notification',Notification::class)->name('notif.notification');

Route::get('/report-client',ReportClient::class)->name('report.report-client');




// Development: Allow access without login (comment out in production)
// Production: Require authentication (uncomment in production)
// Route::middleware('auth')->group(function () {
//     Route::get('/', SetYear::class)->name('home.set-year');
//     Route::get('/dashboard', SetYear::class)->name('dashboard');
// });

Route::get('/psettings', Psettings::class)->name('settings.psettings');
Route::get('my-profile',MyProfile::class)->name('settings.my-profile');
Route::get('/test',Testnovalui::class)->name('test.novalui');


require __DIR__.'/auth.php';

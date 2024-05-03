<?php

use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DaftarPeminjamanBarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PeminjamanBarangDikonfirmasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\Peminjam\HistoryPeminjamanBarangController;
use App\Http\Controllers\Peminjam\PeminjamanBarangController;
use App\Http\Controllers\tables\Basic as TablesBasic;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::post('/login', [LoginBasic::class, 'store']);
    Route::get('/register', [RegisterBasic::class, 'index'])->name('auth-register-basic');
    Route::post('/register', [RegisterBasic::class, 'store']);
    Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => 'role:Admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori-index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori-create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori-store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori-edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori-update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori-destroy');
        
        Route::get('/barang', [BarangController::class, 'index'])->name('barang-index');
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang-create');
        Route::post('/barang', [BarangController::class, 'store'])->name('barang-store');
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang-edit');
        Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang-update');
        Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang-destroy');
        
        Route::get('/daftar-peminjaman-barang', [DaftarPeminjamanBarangController::class, 'index'])->name('daftar-peminjaman-barang-index');
        Route::put('/daftar-peminjaman-barang/{id}', [DaftarPeminjamanBarangController::class, 'update']);
        
        Route::get('/peminjaman-barang-dikonfirmasi', [PeminjamanBarangDikonfirmasiController::class, 'index'])->name('peminjaman-barang-dikonfirmasi-index');
        Route::put('/alasan-pembatalan-barang/{id}', [PeminjamanBarangDikonfirmasiController::class, 'update']);
        Route::put('/pengembalian-barang/{id}', [PeminjamanBarangDikonfirmasiController::class, 'pengembalianBarang']);
        
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan-index');
    });
    
    Route::group(['middleware' => 'role:Peminjam'], function () {
        Route::get('/peminjaman-barang', [PeminjamanBarangController::class, 'index'])->name('peminjaman-barang');
        Route::get('/form-peminjaman-barang/{id}', [PeminjamanBarangController::class, 'form']);
        Route::post('/peminjaman-barang', [PeminjamanBarangController::class, 'store']);
        
        Route::get('/history-peminjaman-barang', [HistoryPeminjamanBarangController::class, 'index'])->name('history-peminjaman-barang');
    });
    
    // layout
    Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
    Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
    Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
    Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
    Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');
    
    // pages
    Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
    Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
    Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
    Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
    Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');
    
    // cards
    Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');
    
    // User Interface
    Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
    Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
    Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
    Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
    Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
    Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
    Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
    Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
    Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
    Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
    Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
    Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
    Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
    Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
    Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
    Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
    Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
    Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
    Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');
    
    // extended ui
    Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
    Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');
    
    // icons
    Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');
    
    // form elements
    Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
    Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');
    
    // form layouts
    Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
    Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');
    
    // tables
    Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');
    
    Route::post('/logout', [LoginBasic::class, 'destroy']);
});

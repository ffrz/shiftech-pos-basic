<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CashAccountController;
use App\Http\Controllers\Admin\CashTransactionCategoryController;
use App\Http\Controllers\Admin\CashTransactionController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\Report\SalesReportController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\Report\ExpenseController as ReportExpenseController;
use App\Http\Controllers\Admin\Report\IndexController;
use App\Http\Controllers\Admin\Report\InventoryController;
use App\Http\Controllers\Admin\SalesOrderController;
use App\Http\Controllers\Admin\ServiceOrderController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StockAdjustmentController;
use App\Http\Controllers\Admin\StockUpdateController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\UserActivityController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Controllers\Public\TrackServiceController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\OnlyGuest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

setlocale(LC_TIME, 'id_ID');
Carbon::setLocale('id_ID');

Route::redirect('/', '/admin');
Route::redirect('/admin', '/admin/dashboard');
Route::get('/track-service-order/{key}', [TrackServiceController::class, 'track']);

Route::middleware([OnlyGuest::class])->group(function () {
    Route::get('admin/login', [AuthController::class, 'login'])->name('login');
    Route::post('admin/login', [AuthController::class, 'authenticate']);
    Route::controller(TrackServiceController::class)->prefix('track-service')->group(function () {
        Route::get('', 'index');
    });
});

Route::middleware([Authenticate::class, OnlyAdmin::class])->prefix('admin')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::prefix('report')->group(function() {
        Route::get('', [IndexController::class, 'index']);

        Route::controller(InventoryController::class)->prefix('inventory')->group(function () {
            Route::get('stock', 'stock');
            Route::get('minimum-stock', 'minimumStock');
            Route::get('stock-recap-by-category', 'stockRecapByCategory');
            Route::get('stock-detail-by-category', 'stockDetailByCategory');
        });

        Route::controller(ReportExpenseController::class)->prefix('expense')->group(function () {
            Route::get('monthly-expense-detail', 'monthlyExpenseDetail');
            Route::get('monthly-expense-recap', 'monthlyExpenseRecap');
        });

        Route::controller(SalesReportController::class)->prefix('sales')->group(function () {
            Route::get('net-income-statement', 'netIncomeStatement');
            Route::get('detail', 'detail');
            Route::get('recap', 'recap');
            Route::get('sales-detail2', 'salesDetail2');
        });
    });

    Route::controller(ServiceOrderController::class)->prefix('service-order')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('duplicate/{id}', 'duplicate');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
        Route::post('action/{id}', 'action');
        Route::get('restore/{id}', 'restore');
        Route::get('print/{id}', 'print');
    });

    Route::controller(SalesOrderController::class)->prefix('sales-order')->group(function () {
        Route::get('', 'index');
        Route::get('create', 'create');
        Route::get('reopen/{id}', 'reopen');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
    });

    Route::controller(PurchaseOrderController::class)->prefix('purchase-order')->group(function () {
        Route::get('', 'index');
        Route::get('create', 'create');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
    });

    Route::controller(SupplierController::class)->prefix('supplier')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
    });

    Route::controller(CustomerController::class)->prefix('customer')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
    });

    Route::controller(ProductCategoryController::class)->prefix('product-category')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
        Route::get('detail/{id}', 'detail');
        Route::get('duplicate/{id}', 'duplicate');
    });

    Route::controller(SettingsController::class)->prefix('settings')->group(function () {
        Route::get('', 'edit');
        Route::post('save', 'save');
    });

    Route::controller(UserGroupController::class)->prefix('user-group')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::match(['get', 'post'], 'delete/{id}', 'delete');
        Route::match(['get', 'post'], 'profile', 'profile');
    });

    Route::controller(UserActivityController::class)->prefix('user-activity')->group(function () {
        Route::get('', 'index');
        Route::get('show/{id}', 'show');
        Route::get('delete/{id}', 'delete');
        Route::match(['get', 'post'], 'clear', 'clear');
    });

    Route::controller(StockUpdateController::class)->prefix('stock-update')->group(function () {
        Route::get('', 'index');
        Route::get('detail/{id}', 'detail');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(StockAdjustmentController::class)->prefix('stock-adjustment')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'create', 'create');
        Route::get('print/{id}', 'print');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
    });

    Route::controller(ExpenseCategoryController::class)->prefix('expense-category')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(ExpenseController::class)->prefix('expense')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(CashTransactionCategoryController::class)->prefix('cash-transaction-category')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(CashTransactionController::class)->prefix('cash-transaction')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::controller(CashAccountController::class)->prefix('cash-account')->group(function () {
        Route::get('', 'index');
        Route::match(['get', 'post'], 'edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });

    Route::get('refresh-csrf', function () {
        return csrf_token();
    });

    Route::controller(AjaxController::class)->prefix('ajax')->group(function () {
        Route::post('add-expense-category', 'addExpenseCategory');
        Route::post('add-product-category', 'addProductCategory');
        Route::post('add-cash-transaction-category', 'addCashTransactionCategory');
        Route::post('add-supplier', 'addSupplier');
    });
});

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [ArticleController::class, 'adminOverview'])->name('admin.dashboard');
    Route::get('/admin/verifikasi', [ArticleController::class, 'admin'])->name('admin.verifikasi');
    Route::post('/admin/approve/{id}', [ArticleController::class, 'approve'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [ArticleController::class, 'reject'])->name('admin.reject');
    Route::get('/admin/published', [ArticleController::class, 'published'])->name('admin.published');
    Route::post('/admin/unpublish/{id}', [ArticleController::class, 'unpublish'])->name('admin.unpublish');
    Route::delete('/admin/articles/{id}', [ArticleController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/set-featured/{id}', [ArticleController::class, 'setFeatured'])->name('admin.setFeatured');
    Route::post('/admin/toggle-spotlight/{id}', [ArticleController::class, 'toggleSpotlight'])->name('admin.toggleSpotlight');
    Route::get('/admin/articles/{id}/edit', [ArticleController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/articles/{id}', [ArticleController::class, 'update'])->name('admin.update');
    Route::get('/admin/unpublished', [ArticleController::class, 'unpublished'])->name('admin.unpublished');
    Route::post('/admin/republish/{id}', [ArticleController::class, 'republish'])->name('admin.republish');
    Route::get('/admin/trash', [ArticleController::class, 'trash'])->name('admin.trash');
    Route::post('/admin/restore/{id}', [ArticleController::class, 'restore'])->name('admin.restore');
    Route::delete('/admin/trash/{id}', [ArticleController::class, 'permanentDelete'])->name('admin.permanentDelete');

    // Bulk Admin Actions
    Route::post('/admin/bulk-trash', [ArticleController::class, 'bulkTrash'])->name('admin.bulkTrash');
    Route::delete('/admin/bulk-destroy', [ArticleController::class, 'bulkDestroy'])->name('admin.bulkDestroy');

    // Admin Category Routes
    Route::get('/admin/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories');
    Route::post('/admin/categories', [App\Http\Controllers\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/admin/categories/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('admin.categories.destroy');

});

Route::middleware(['auth'])->group(function () {

    Route::get('/my-articles', [ArticleController::class, 'myArticles'])->name('artikel.my-articles');
    Route::get('/submit', [ArticleController::class, 'create'])->name('artikel.create');
    Route::post('/submit', [ArticleController::class, 'store'])->name('artikel.store');
    Route::post('/artikel/{id}/like', [ArticleController::class, 'like'])->name('artikel.like');
    
    // Comments
    Route::post('/artikel/{id}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllRead');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artikel/{id}', [ArticleController::class, 'show'])->name('artikel.show');
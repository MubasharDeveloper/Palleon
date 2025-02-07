<?php

use App\Http\Controllers\BackgroundRemoverController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
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

Route::get('/', [HomeController::class,'index']);
Route::get('/GetTemplateLinks', [HomeController::class,'GetTemplateLinks']);
Route::get('/GetTemplateLink/{name}', [HomeController::class,'GetTemplateLink']);

Route::post('/remove-background', [BackgroundRemoverController::class,'index']);
Route::get('/download-image/{filename}', [BackgroundRemoverController::class, 'download'])->name('download.image');

Route::get('/template/{id}', function () {
    $data = [];
$files = scandir(public_path('files/templates'));

foreach ($files as $file) {
    // Only consider .png files
    if (pathinfo($file, PATHINFO_EXTENSION) === 'png') {
        // Check if corresponding .json file exists
        $jsonFile = pathinfo($file, PATHINFO_FILENAME) . '.json';
        if (file_exists(public_path('files/templates/' . $jsonFile))) {
            $data[] = [
                'name' => pathinfo($file, PATHINFO_FILENAME), // Template name
                'image' => asset('files/templates/' . $file), // Image URL
                'json' => 'files/templates/' . $jsonFile, // JSON file URL
            ];
        }
    }
}
    $categories = Category::all();
    return view('index',compact('categories','data'));
});



Route::get('/test', function () {
    return view('test');
});
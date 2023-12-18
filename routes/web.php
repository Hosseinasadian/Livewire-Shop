<?php

use App\Http\Controllers\LocalizationController;
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
Route::get('locale/{locale}', [LocalizationController::class, 'index'])->name('locale');

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::group([
    'prefix' => 'upload'
], function () {
    Route::get('', [\App\Http\Controllers\UploadController::class, 'index']);
    Route::post('', [\App\Http\Controllers\UploadController::class, 'upload'])->name('upload');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::post('template/list', [\App\Http\Controllers\Admin\TemplateController::class, 'list'])->name('template.list');
    Route::post('template/{template}/sync-properties', [\App\Http\Controllers\Admin\TemplateController::class, 'syncProperties'])->name('template.properties.sync');
    Route::resource('template', \App\Http\Controllers\Admin\TemplateController::class);
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::get('test-form', function () {
        $data = [
            'test_select' => 'y',
            'test_text_1' => 'test!!',
            'test_text_2' => 'test2!!',
            'test_list_item' => [
                [
                    'select_item' => 'b',
                    'text_item' => 'dddddddddddddd'
                ],
                [
                    'select_item' => 'a',
                    'text_item' => 'wwwwwwwwww'
                ],
            ]
        ];
        $structure = [
            [
                'id' => 'test_text_1',
                'label' => 'text first test component',
                'type' => 'text',
            ],
            [
                'id' => 'test_select',
                'label' => 'select test component',
                'type' => 'select',
                'options' => [
                    'x' => 'x label',
                    'y' => 'y label'
                ],
            ],
            [
                'id' => 'test_text_2',
                'label' => 'text second test component',
                'type' => 'text',
            ],
            [
                'id' => 'test_list_item',
                'label' => 'list item test component',
                'type' => 'list-item',
                'items' => [
                    [
                        'id' => 'select_item',
                        'label' => 'select item label',
                        'type' => 'select',
                        'options' => [
                            'a' => 'a label',
                            'b' => 'b label'
                        ],
                    ],
                    [
                        'id' => 'text_item',
                        'label' => 'text item label',
                        'type' => 'text',
                    ],
                ]
            ]
        ];
        return view('admin.pages.test.index', compact('data', 'structure'));
    });
    Route::post('test-form',function (){
        dd(request()->all());
    });
});

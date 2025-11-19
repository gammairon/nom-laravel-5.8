<?php
/**
 * User: Gamma-iron
 * Date: 25.03.2020
 */

Route::get('/robots.txt', function () {
    return response( file_get_contents(public_path('news_public/robots.txt')) , 200, [
        'Content-Type' => 'text/plain'
    ]);
});

Route::get('/sitemap-index.xml', function () {
    return response( file_get_contents(public_path('news_public/sitemap-index.xml')) , 200, [
        'Content-Type' => 'application/xml'
    ]);
});

Route::middleware('ajax')->post('/ajax/{action}', 'Front\AjaxController@index');

Route::get('/', 'Front\CategoryController@all')->name('news');

Route::group(
    [
        'prefix' => 'categories',
        'as' => 'categories.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/{slug}', 'CategoryController@single')->name('single');
    }
);


Route::group(
    [
        'prefix' => 'tag',
        'as' => 'tag.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/{slug}', 'TagController@single')->name('single');
    }
);

Route::group(
    [
        'prefix' => 'author',
        'as' => 'author.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/{slug}', 'AuthorController@single')->name('single');
    }
);

Route::get('/{slug}/amp', 'HomeController@showAmp')->name('amp.page');
Route::get('/{slug}', function ($slug){
    if(\App\Entity\Blog\Page::whereSlug($slug)->public()->first())
        return redirect()->route('page', ['slug' => $slug], 301);
})->name('page');
Route::get('/{slug}', 'HomeController@show')->name('page_news');


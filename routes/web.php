<?php

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

use App\Entity\Blog\Post;

Route::get('/sitemap-index.xml', function () {
    return response( file_get_contents(public_path('main_public/sitemap-index.xml')) , 200, [
        'Content-Type' => 'application/xml'
    ]);
});

Route::get('/robots.txt', function () {
    return response( file_get_contents(public_path('main_public/robots.txt')) , 200, [
        'Content-Type' => 'text/plain'
    ]);
});

//Redirects====================

Route::get('/kreditnye-karty-v-ukraine', function(){
    return redirect( '/kreditnye-karty', 301);
});

Route::get('/kredit-nalichnymi-v-ukraine', function(){
    return redirect( '/kredit-nalichnymi', 301);
});



//=============================

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);



Route::get('/', 'HomeController@index')->name('home');

//Route::get('/redirect-to-referral', 'HomeController@referral')->name('redirect-to-referral');

Route::get('/search', 'HomeController@search')->name('search');

//Route::get('/37905.html', 'HomeController@iformer');

Route::get('/custom-test-page-landing.html', 'HomeController@customTestPage');

Route::group(
    [
        'prefix' => 'rss',
        'as' => 'rss.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/ukr-net-channel.rss', 'RssController@ukrNetChannel')->name('ukr.net.channel');
    }
);

Route::get('/news', function (){
    return redirect(config('app.news_url'), 301);
});//name('news');

Route::group(
    [
        'prefix' => 'categories',
        'as' => 'categories.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/{slug}', function ($slug){
            return redirect()->route('categories.single', ['slug' => $slug], 301);
        });//name('single');
    }
);

Route::group(
    [
        'prefix' => 'tag',
        'as' => 'tag.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/{slug}', function ($slug){
            return redirect()->route('tag.single', ['slug' => $slug], 301);
        });//name('single');
    }
);

Route::group(
    [
        'prefix' => 'author',
        'as' => 'author.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/{slug}', function ($slug){
            return redirect()->route('author.single', ['slug' => $slug], 301);
        });//name('single');
    }
);

Route::group(
    [
        'prefix' => 'banks',
        'as' => 'banks.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/', 'BankController@all')->name('all');
        Route::get('/{slug}', 'BankController@single')->name('single');
    }
);



Route::group(
    [
        'prefix' => 'kredit-online',
        'as' => 'mfo.',
        'namespace' => 'Front',
    ],
    function () {
        Route::get('/', 'MfoController@all')->name('all');
        Route::get('/{slug}', 'MfoController@single')->name('single');
    }
);

Route::redirect('/mfo', '/kredit-online', 301);

Route::group(
    [
        //'prefix' => 'products',
        'as' => 'products.',
        'namespace' => 'Front',
    ],
    function () {
        Route::group(
            [
                'prefix' => 'kreditnye-karty',
                'as' => 'cards.',
            ],
            function () {
                Route::get('/', 'CreditCardController@all')->name('all');
                Route::get('/{slug}', 'CreditCardController@single')->name('single');
            }
        );

        Route::group(
            [
                'prefix' => 'kredit-nalichnymi',
                'as' => 'cash.',
            ],
            function () {
                Route::get('/', 'CreditCashController@all')->name('all');
                Route::get('/{slug}', 'CreditCashController@single')->name('single');
            }
        );
    }
);


Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['auth', 'role:admin|editor'],
    ],
    function () {

        Route::get('/', 'HomeController@index')->name('dashboard');

        Route::get('/edit-account', 'AccountController@edit')->name('account.edit');
        Route::put('/edit-account', 'AccountController@update');


        Route::get('/seo', 'SeoController@edit')->name('seo.edit');
        Route::put('/seo', 'SeoController@update');

        Route::get('/comments/new', 'CommentController@newComments')->name('comments.new_list');
        Route::post('/comments/delete-all', 'CommentController@all')->name('comments.delete.all');
        Route::resource('comments', 'CommentController');


        Route::middleware(['role:admin'])->resource('users', 'UsersController');

        Route::group(['prefix' => 'blog', 'as' => 'blog.', 'namespace' => 'Blog'], function () {

            Route::resource('pages', 'PageController');
            Route::post('/pages/action/all', 'PageController@all')->name('pages.all');

            Route::resource('posts', 'PostController');
            Route::post('/posts/action/all', 'PostController@all')->name('posts.all');

            Route::resource('posts', 'PostController');
            Route::post('/posts/action/all', 'PostController@all')->name('posts.all');

            Route::resource('categories', 'CategoryController');
            Route::post('/categories/action/all', 'CategoryController@all')->name('categories.all');

            Route::resource('tags', 'TagController');
            Route::post('/tags/action/all', 'TagController@all')->name('tags.all');
        });

        Route::group(['prefix' => 'lists', 'as' => 'lists.', 'namespace' => 'Lists'], function () {

            Route::resource('mfo', 'ListMfoController')->parameters([
                'mfo' => 'list_mfo'
            ]);;
            Route::post('/mfo/action/all', 'ListMfoController@all')->name('mfo.all');

        });

        Route::group(['prefix' => 'organizations', 'as' => 'organizations.', 'namespace' => 'Organization'], function () {

            Route::resource('mfo', 'MfoController');
            Route::post('/mfo/action/all', 'MfoController@all')->name('mfo.all');

            Route::resource('banks', 'BankController');
            Route::post('/banks/action/all', 'BankController@all')->name('banks.all');
        });

        Route::group(['prefix' => 'products', 'as' => 'products.', 'namespace' => 'Product'], function () {

            /*Route::resource('mfo', 'MfoController');
            Route::post('/mfo/action/all', 'MfoController@all')->name('mfo.all');*/

            Route::resource('credit-cards', 'CreditCardController');
            Route::post('/credit-cards/action/all', 'CreditCardController@all')->name('credit.cards.all');

            Route::resource('credit-cash', 'CreditCashController');
            Route::post('/credit-cash/action/all', 'CreditCashController@all')->name('credit.cash.all');
        });

    }
);

Route::middleware('ajax')->post('/ajax/{action}', 'Front\AjaxController@index');

Route::get('/{slug}/amp', function ($slug){
    return redirect()->route('amp.page', ['slug' => $slug], 301);
});//name('amp.page');

//Route::get('/{slug}', 'HomeController@show')->name('page');
Route::get('/{slug}', function ($slug){
    if(Post::whereSlug($slug)->public()->first())
        return redirect()->route('page_news', ['slug' => $slug], 301);

    $app = app();
    $controller = $app->make('App\Http\Controllers\HomeController');
    return $controller->callAction('show', ['slug' => $slug]);
})->name('page');

/*Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});*/


/*Route::get('/.well-known/pki-validation/0D8CFB50A9F4927867760BDD219E6123.txt', function(){
    return "73f6b3d5d04a49c368ac234b595b7c3c16803a13f9968d41f68d39f3f38274c8\n".PHP_EOL."comodoca.com\n".PHP_EOL."CettLUm6Hw1iZ6qM3zLX";
});*/

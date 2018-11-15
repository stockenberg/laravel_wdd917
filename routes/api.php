<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/news', function () {
    return \App\News::all();
});

Route::delete('news/{id}', function ($id) {
    \App\News::destroy($id);
    return response('delete sucessfull');
});

Route::post('/news', function (Request $request) {
    $request->validate(
        [
            'headline' => 'required|min:5',
            'content' => 'required'
        ]
    );

    $news = new \App\News();
    $news->headline = $request->headline;
    $news->content = $request->content;
    $news->img_name = 'coming soon';
    $news->author_id = 1;

    $news->save();
    return response('News wurde erfolgreich erstellt', 200);
});

Route::put('/news/{id}', function (Request $request, $id) {
    $request->validate(
        [
            'headline' => 'required|min:5',
            'content' => 'required'
        ]
    );

    $news = \App\News::find($id);
    $news->headline = $request->headline;
    $news->content = $request->content;
    $news->img_name = 'coming soon';
    $news->author_id = 1;

    $news->save();
    return response('News wurde erfolgreich editiert', 200);
});
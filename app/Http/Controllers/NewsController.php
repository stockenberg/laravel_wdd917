<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = \App\News::all();
        return view('blog', ['news' => $news]);
    }

    /**
     * Show all News to Manage them
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function manage()
    {
        $news = \App\News::all();
        return view('news.manage', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'headline' => 'required|min:5',
                'img' => 'required|image',
                'content' => 'required'
            ],
            [
                'headline.required' => 'Bitte fülle den Titel aus',
                'headline.min' => 'Die Überschrift muss mindestens 5 Zeichen haben',
                'img.required' => 'Bitte gib ein Bild mit an',
                'content.required' => 'Bitte gib einen Text ein'
            ]
        );

        // Validation OK
        $path = $request->img->storeAs('public/images', $request->img->getClientOriginalName());
        $path = str_replace('public/', '', $path);

        $news = new News();
        $news->headline = $request->headline;
        $news->img_name = $path;
        $news->content = $request->content;

        // TODO : FIXME
        $news->author_id = 1;

        $news->save();
        return redirect()->back()->with('status', 'Blog Eintrag wurde erfolgreich erstellt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('news.edit', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'headline' => 'required|min:5',
                'content' => 'required'
            ],
            [
                'headline.required' => 'Bitte fülle den Titel aus',
                'headline.min' => 'Die Überschrift muss mindestens 5 Zeichen haben',
                'content.required' => 'Bitte gib einen Text ein'
            ]
        );

        $news = News::find($id);
        // Validation OK
        $path = $news->img_name;

        if($request->has('img')){
            $path = $request->img->storeAs('public/images', $request->img->getClientOriginalName());
            $path = str_replace('public/', '', $path);
        }

        $news->headline = $request->headline;
        $news->content = $request->content;
        $news->img_name = $path;

        // TODO : FIXME
        $news->author_id = 1;

        $news->save();

        return redirect()->back()->with('status', 'Blog Eintrag wurde erfolgreich erstellt!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
        return redirect()->back()->with('status', 'News mit der ID: '.$id.' wurde gelöscht');
    }
}

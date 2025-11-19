<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Entity\Blog\Page;
use App\Entity\Seo\Seo;
use App\Entity\User\User;
use App\Http\Requests\Admin\Blog\Page\CreateRequest;
use App\Http\Requests\Admin\Blog\Page\UpdateRequest;
use App\Http\Requests\Admin\Blog\PageRequest;
use App\UseCases\Admin\Blog\PageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    protected $service;

    public function __construct(PageService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Page::with('user');

        if($search = $request->input('search'))
            $query->where('name', 'like', '%'.$search.'%');

        $pages = $query->paginate(config('settings.perPage'));

        return view('admin.blog.pages.list', compact('pages'));
    }

    public function create()
    {
        return view('admin.blog.pages.create', [
            'faqs' => [],
            'statuses' => Page::getStatuses(),
            'seo' => new Seo(),
            'pages' => Page::pluck('name', 'id')->all(),
            'users' => User::pluck('name', 'id')->all(),
        ]);
    }


    public function store(PageRequest $request)
    {
        if($page = $this->service->create($request->all()))
            return redirect()->route('admin.blog.pages.index')->with('success', 'Страница была удачно создана!');
        else
            return back()->with('error', 'Не удалось создать страницу, попробуйте ещё раз!')->withInput();
    }


    public function show(Page $page)
    {
        //
    }

    public function edit(Page $page)
    {
        return view('admin.blog.pages.edit', [
            'page' => $page,
            'faqs' => $page->faqs,
            'seo' => $page->seo,
            'statuses' => Page::getStatuses(),
            'pages' => Page::whereKeyNot($page->id)->pluck('name', 'id')->all(),
            'users' => User::pluck('name', 'id')->all(),
        ]);
    }

    public function update(PageRequest $request, Page $page)
    {
        if($page = $this->service->update($page, $request->all()))
            return back()->with('success', 'Страница была удачно обновлена!');
        else
            return back()->with('error', 'Не удалось обновить страницу, попробуйте ещё раз!')->withInput();
    }

    public function destroy(Page $page)
    {
        $name = $page->name;

        if ($page->delete())
            return redirect()->route('admin.blog.pages.index')->with('success', 'Страница: '.$name.' была удалена!');
        else
            return redirect()->route('admin.blog.pages.index')->with('error', 'Не удалось удалить страницу: '.$name.'! Попробуйте ещё раз!');

    }

    public function all(Request $request)
    {
        if($this->service->deleteItems($request->input('ids', [])))
            return back()->with('success', 'Страницы были удачно удалены!');
        else
            return back()->with('error', 'Не удалось удалить все страницы, попробуйте ещё раз!');
    }
}

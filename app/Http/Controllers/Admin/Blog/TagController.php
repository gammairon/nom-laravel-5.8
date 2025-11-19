<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Entity\Blog\Tag;
use App\Entity\Seo\Seo;
use App\Http\Requests\Admin\Blog\TagRequest;
use App\UseCases\Admin\Blog\TagService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TagController extends Controller
{

    protected $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Tag::withCount('posts');

        if($search = $request->input('search'))
            $query->where('name', 'like', '%'.$search.'%');

        $tags = $query->paginate(config('settings.perPage'));

        return view('admin.blog.tags.list', compact('tags'));
    }

    public function create()
    {
        return view('admin.blog.tags.create', [
            'seo' => new Seo(),
        ]);
    }

    public function store(TagRequest $request)
    {
        if($this->service->create($request->all()))
            return redirect()->route('admin.blog.tags.index')->with('success', 'Тег был удачно создан!');
        else
            return back()->with('error', 'Не удалось создать тег, попробуйте ещё раз!')->withInput();
    }


    public function show(Tag $tag)
    {
        //
    }


    public function edit(Tag $tag)
    {
        return view('admin.blog.tags.edit', [
            'tag' => $tag,
            'seo' => $tag->seo
        ]);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        if($this->service->update($tag, $request->all()))
            return back()->with('success', 'Тег был удачно обновлен!');
        else
            return back()->with('error', 'Не удалось обновить тег, попробуйте ещё раз!')->withInput();
    }


    public function destroy(Tag $tag)
    {
        $name = $tag->name;

        if ($tag->delete())
            return redirect()->route('admin.blog.tags.index')->with('success', 'Тег: '.$name.' был удален!');
        else
            return redirect()->route('admin.blog.tags.index')->with('error', 'Не удалось удалить тег: '.$name.'! Попробуйте ещё раз!');
    }

    public function all(Request $request)
    {
        if($this->service->deleteItems($request->input('ids', [])))
            return back()->with('success', 'Теги были удачно удалены!');
        else
            return back()->with('error', 'Не удалось удалить все теги, попробуйте ещё раз!');
    }
}

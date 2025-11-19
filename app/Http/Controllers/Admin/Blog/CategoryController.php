<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Entity\Blog\Category;
use App\Entity\Seo\Seo;
use App\Http\Requests\Admin\Blog\CategoryRequest;
use App\UseCases\Admin\Blog\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{

    protected $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = Category::query();

        if($search = $request->input('search'))
            $query->where('name', 'like', '%'.$search.'%');

        $categories = $query->paginate(config('settings.perPage'));

        return view('admin.blog.categories.list', compact('categories'));
    }


    public function create()
    {
        return view('admin.blog.categories.create', [
            'categories' => Category::pluck('name', 'id')->all(),
            'seo' => new Seo(),
        ]);
    }

    public function store(CategoryRequest $request)
    {
        if($this->service->create($request->all())){
            $this->service->flushCache();
            return redirect()->route('admin.blog.categories.index')->with('success', 'Категория была удачно создана!');
        } else {
            return back()->with('error', 'Не удалось создать категорию, попробуйте ещё раз!')->withInput();
        }

    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return view('admin.blog.categories.edit', [
            'category' => $category,
            'seo' => $category->seo,
            'categories' => Category::whereKeyNot($category->id)->pluck('name', 'id')->all(),
        ]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        if($this->service->update($category, $request->all())){
            $this->service->flushCache();
            return back()->with('success', 'Категория была удачно обновлена!');
        } else {
            return back()->with('error', 'Не удалось обновить категорию, попробуйте ещё раз!')->withInput();
        }

    }

    public function destroy(Category $category)
    {
        $name = $category->name;

        if ($category->delete()){
            $this->service->flushCache();
            return redirect()->route('admin.blog.categories.index')->with('success', 'Категория: '.$name.' была удалена!');
        } else {
            return redirect()->route('admin.blog.categories.index')->with('error', 'Не удалось удалить категорию: '.$name.'! Попробуйте ещё раз!');
        }


    }

    public function all(Request $request)
    {
        if($this->service->deleteItems($request->input('ids', []))){
            $this->service->flushCache();
            return back()->with('success', 'Категории были удачно удалены!');
        } else {
            return back()->with('error', 'Не удалось удалить все категории, попробуйте ещё раз!');
        }
            
    }

}

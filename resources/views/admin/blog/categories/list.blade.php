@extends('layouts.admin')


@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4 class="py-4">Список Категорий</h4>
      <p class="mb-4">
        <a href="{{ route('admin.blog.categories.create') }}" class="btn btn-success" >
            <i class="fa fa-plus" aria-hidden="true"></i>
            <span class="hidden-sm-down">Add New Category</span>
        </a>
      </p>
        <form id="search" class="my-4" action="{{ route('admin.blog.categories.index') }}">
            <div class="input-group col-md-4">
                <input class="form-control py-2" type="text" placeholder="Найти" id="search" name="search" value="{{request('search')}}" >
                <span class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
      <form id="all-action" action="{{ route('admin.blog.categories.all') }}" method="POST">
        @csrf
        @method('POST')
        <div class="row align-items-center mb-2">
            <label for="status" class="col-md-2 mb-0">С выделенными</label>

            <div class="col-md-3">
                <button type="submit" class="btn btn-delete btn-danger" data-title="Delete" data-form="#all-action">Удалить</button>
            </div>
        </div>
      </form>
        <div class="table-responsive">
          <table id="category_list" class="table table-bordred table-striped">

            <thead>

              <th><input type="checkbox" class="checkall" /></th>
              <th>Title</th>
              <th>Slug</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              @foreach ($categories as $category)
                 <tr>
                  <td><input type="checkbox" form="all-action" class="checkthis" name="ids[]" value="{{$category->id}}" /></td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->slug}}</td>
                    <td>
                      <a href="{{ route('admin.blog.categories.edit', $category) }}" class="btn btn-primary btn-xs" data-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    <td>
                      <a href="javascript:void(0);" class="btn btn-danger btn-xs btn-delete" data-title="Delete" data-form="#form-delete-{{$category->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      {!! Form::open([
                          'method' => 'DELETE',
                          'route' => ['admin.blog.categories.destroy', $category->id],
                          'id' => 'form-delete-' . $category->id
                        ]) !!}
                      {!! Form::close() !!}
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="pagination">
            {{ $categories->appends(['search' => request('search')])->links() }}
        </div>
    </div>
  </div>
</div>
@endsection
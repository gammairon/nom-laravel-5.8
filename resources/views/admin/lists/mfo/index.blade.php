@extends('layouts.admin')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h4 class="py-4">Списки МФО</h4>
                <p class="my-4">
                    <a href="{{ route('admin.lists.mfo.create') }}" class="btn btn-success" >
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New List MFO</span>
                    </a>
                </p>
                <form id="search" class="my-4" action="{{ route('admin.lists.mfo.index') }}">
                    <div class="input-group col-md-4">
                        <input class="form-control py-2" type="text" placeholder="Найти" id="search" name="search" value="{{request('search')}}" >
                        <span class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                    </div>
                </form>
                <form id="all-action" action="{{ route('admin.lists.mfo.all') }}" method="POST">
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
                    <table id="banks_list" class="table table-bordred table-striped">

                        <thead>

                        <th><input type="checkbox" class="checkall" /></th>
                        <th>Name</th>
                        <th>Shortcode</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        </thead>
                        <tbody>
                        @foreach ($lists as $list)
                            <tr>
                                <td><input type="checkbox" form="all-action" class="checkthis" name="ids[]" value="{{$list->id}}" /></td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->getShortcode()}}</td>
                                <td>
                                    <a href="{{ route('admin.lists.mfo.edit', $list) }}" class="btn btn-primary btn-xs" data-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-xs btn-delete" data-title="Delete" data-form="#form-delete-{{$list->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['admin.lists.mfo.destroy', $list->id],
                                        'id' => 'form-delete-' . $list->id
                                      ]) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination">
                    {{ $lists->appends(['search' => request('search')])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

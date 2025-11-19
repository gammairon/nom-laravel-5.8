@extends('layouts.admin')


@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">

      <h4 class="py-4">Список Коментариев</h4>
      <p class="my-4 alert alert-primary d-inline-block">
          Показано: <strong>{{$comments->count()}}</strong> из <strong>{{$comments->total()}}</strong> коментариев
      </p>
      <form id="all-action" action="{{ route('admin.comments.delete.all') }}" method="POST">
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
              <th>Имя</th>
              <th>Сообщение</th>
              <th>Email</th>
              <th>Для какого поста</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              @foreach ($comments as $comment)
                 <tr>
                  <td><input type="checkbox" form="all-action" class="checkthis" name="ids[]" value="{{$comment->id}}" /></td>
                    <td>{{$comment->name}}</td>
                    <td>{{$comment->getShortMessage()}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->commentable->name}}</td>
                    <td>
                      <a href="{{ route('admin.comments.edit', $comment) }}" class="btn btn-primary btn-xs" data-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    <td>
                      <a href="javascript:void(0);" class="btn btn-danger btn-xs btn-delete" data-title="Delete" data-form="#form-delete-{{$comment->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      {!! Form::open([
                          'method' => 'DELETE',
                          'route' => ['admin.comments.destroy', $comment->id],
                          'id' => 'form-delete-' . $comment->id
                        ]) !!}
                      {!! Form::close() !!}
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="pagination">
            {{ $comments->links() }}
        </div>
    </div>
  </div>
</div>
@endsection
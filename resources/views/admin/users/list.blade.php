@extends('layouts.admin')


@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h4 class="py-4">Список пользователей</h4>
      <p class="my-4">
        <a href="{{ route('admin.users.create') }}" class="btn btn-success" >
          <i class="fa fa-plus" aria-hidden="true"></i>
          <span class="hidden-sm-down">Add New User</span>
        </a>
      </p>
      <form id="search" class="my-4" action="{{ route('admin.users.index') }}">
        <div class="input-group col-md-4">
          <input class="form-control py-2" type="text" placeholder="Найти" id="search" name="search" value="{{request('search')}}" >
          <span class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
        </div>
      </form>
      <form id="all-action" action="" method="POST">
        <div class="table-responsive">
          <table id="user_list" class="table table-bordred table-striped">

            <thead>

              <th><input type="checkbox" class="checkall" /></th>
              <th>Display Name</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Edit</th>
              <th>Delete</th>
            </thead>
            <tbody>
              @foreach ($users as $user)
                 <tr>
                  <td><input type="checkbox" class="checkthis" name="item[{{$user->id}}]" /></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->first_name}}</td>
                    <td>{{$user->last_name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                      <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-xs" data-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    <td>
                      <a href="javascript:void(0);" class="btn btn-danger btn-xs btn-delete" data-title="Delete" data-form="#form-delete-{{$user->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                      {!! Form::open([
                          'method' => 'DELETE',
                          'route' => ['admin.users.destroy', $user->id],
                          'id' => 'form-delete-' . $user->id
                        ]) !!}
                      {!! Form::close() !!}
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </form>
      <div class="pagination">
        {{ $users->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
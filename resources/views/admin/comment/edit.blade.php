
@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header"><h3>{{ __('Редактирование Коментария') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.comments.update', $comment) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="row">

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Имя отправителя') }}</label>

                                        <div>
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $comment->name) }}" required>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label text-md-right">{{ __('Email отправителя') }}</label>

                                        <div>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $comment->email) }}" >

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label text-md-right">{{ __('Статус') }}</label>

                                        <div>
                                            <select id="status" name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                @foreach ($statuses as $key => $name)
                                                    <option value="{{$key}}" {{selected(old('status', $comment->status), $key)}}>{{ucfirst($name)}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('status'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="message" class="col-form-label text-md-right">{{ __('Сообщение') }}</label>

                                        <div>
                                            <textarea name="message" id="message" class="form-control" required>{{old('description', $comment->message)}}</textarea>

                                            @if ($errors->has('message'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col">
                                    <p>Дата создания: <strong>{{$comment->created_at->format('d/m/Y H:i')}}</strong></p>
                                </div>
                            </div>




                            <div class="form-group row mb-0 mt-4">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Обновить') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

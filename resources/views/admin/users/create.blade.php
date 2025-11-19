
@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Создание Пользователя') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xs-12 col-md-8 offset-md-2">
                                    <div class="form-group photo-wrap">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder" class="photo btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Выбрать фото
                                                 </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="primary_media[url]" value="{{old('primary_media.url')}}">

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <img id="holder" class="holder" src="{{old('primary_media.url')}}">
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <div class="mb-3">
                                                    <label for="alt_logo" class="col-form-label text-md-right">{{ __('Alt') }}</label>
                                                    <input id="alt_logo" class="form-control" type="text" name="primary_media[alt]" value="{{old('primary_media.alt')}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title_logo" class="col-form-label text-md-right">{{ __('Title') }}</label>
                                                    <input id="title_logo" class="form-control" type="text" name="primary_media[title]" value="{{old('primary_media.title')}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Имя для показа') }}</label>

                                        <div>
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first_name" class="col-form-label text-md-right">{{ __('Имя') }}</label>

                                        <div>
                                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>

                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="last_name" class="col-form-label text-md-right">{{ __('Фамилия') }}</label>

                                        <div>
                                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>

                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="password" class="col-form-label text-md-right">{{ __('Пароль') }}</label>

                                        <div>
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Повторить пароль') }}</label>

                                        <div>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="role" class="col-form-label text-md-right">{{ __('Роль') }}</label>

                                        <div>
                                            <select id="role" name="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}">{{ucfirst($role->name)}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('role'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="slug" class="col-form-label text-md-right">{{ __('Slug') }}</label>

                                        <div>
                                            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" required>

                                            @if ($errors->has('slug'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label text-md-right">{{ __('Description') }}</label>

                                        <div>
                                            <textarea name="description" id="description" class="form-control html-editor">{{old('description')}}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('admin.partials.seo_block', ['seo' => $seo])

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Создать') }}
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


@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Создание Поста') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blog.posts.store') }}" enctype="multipart/form-data">
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
                                    <div class="form-check mb-3 mt-3 h5">
                                        <input type="hidden" name="top" value="0" >
                                        <input class="form-check-input" type="checkbox" id="top" name="top" value="1" {{checked(1, old('top', 0) )}}>
                                        <label class="form-check-label" for="top">Топ новость</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Title Поста') }}</label>

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
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="slug" class="col-form-label text-md-right">{{ __('Slug Поста') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >{{ config('app.news_url').'/' }}</span>
                                            </div>
                                            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" >

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
                                        <label for="content" class="col-form-label text-md-right">{{ __('Content') }}</label>

                                        <div>
                                            <textarea name="content" id="content" class="form-control html-editor">{{old('content')}}</textarea>

                                            @if ($errors->has('content'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="excerpt" class="col-form-label text-md-right">{{ __('Краткое содержание') }}</label>

                                        <div>
                                            <textarea name="excerpt" id="excerpt" class="form-control">{{old('excerpt')}}</textarea>

                                            @if ($errors->has('excerpt'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('excerpt') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('admin.partials.faq_block', ['faqs' => $faqs, 'enable_faq' => 0])

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <h3>Выберите категории</h3>
                                    <div class="tree-wraper">
                                        {!!buildCheckboxTree($categories, 'categories', [14])!!}
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <h3>Выберите Теги</h3>
                                    <select name="tags[]" class="select2-multi" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}" >{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label text-md-right">{{ __('Статус') }}</label>

                                        <div>
                                            <select id="status" name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" required>
                                                @foreach ($statuses as $key => $name)
                                                    <option value="{{$key}}">{{ucfirst($name)}}</option>
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

                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="public_date" class="col-form-label text-md-right">{{ __('Дата публикации') }}</label>
                                        <!-- <aria-label="Recipient's username"  -->


                                        <div class="input-group mb-3 date date-field from-current-date">
                                            <input id="public_date" type="text" class=" form-control{{ $errors->has('public_date') ? ' is-invalid' : '' }}" name="public_date" value="{{ old('public_date') }}" >
                                            <div class="input-group-append input-group-addon">
                                                <span class="input-group-text" ><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                            </div>

                                            @if ($errors->has('public_date'))
                                                <span class="invalid-feedback show" role="alert">
                                                <strong>{{ $errors->first('public_date') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="status" class="col-form-label text-md-right">{{ __('Родительская страница') }}</label>

                                        <div>
                                            <select id="parent_id" name="parent_id" class="form-control{{ $errors->has('parent_id') ? ' is-invalid' : '' }}" >
                                                <option value="">Нет родительской</option>
                                                @foreach ($posts as $id => $name)
                                                    <option value="{{$id}}">{{$name}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('parent_id'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('parent_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-3">
                                    <div class="form-group">
                                        <label for="user_id" class="col-form-label text-md-right">{{ __('Автор') }}</label>

                                        <div>
                                            <select id="user_id" name="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" required>
                                                @foreach ($users as $id => $username)
                                                    <option value="{{$id}}" {{selected($currentUser->id, $id)}}>{{$username}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('user_id'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @include('admin.partials.seo_block', ['seo' => $seo])

                            <div class="form-group row mb-0 mt-4">
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

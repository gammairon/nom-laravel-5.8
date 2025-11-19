
@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Создание Тега') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.blog.tags.store') }}" enctype="multipart/form-data">
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

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Имя Тега') }}</label>

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
                                        <label for="slug" class="col-form-label text-md-right">{{ __('Slug Тега') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >{{ config('app.news_url').'/tag/' }}</span>
                                            </div>
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
                                        <label for="description" class="col-form-label text-md-right">{{ __('Краткое описание') }}</label>

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

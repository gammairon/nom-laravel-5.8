
@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="my-4">
                      <a href="{{ route('admin.organizations.banks.create') }}" class="btn btn-success" >
                          <i class="fa fa-plus" aria-hidden="true"></i>
                          <span class="hidden-sm-down">Add New Bank</span>
                      </a>
                  </p>
                <div class="card">
                    <div class="card-header"><h3>{{ __('Создание Банка') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.organizations.banks.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group photo-wrap">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder" class="photo btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Выбрать логотип
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
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group photo-wrap">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail_president" data-preview="holder_president" class="photo btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Фото президента
                                                 </a>
                                            </span>
                                            <input id="thumbnail_president" class="form-control" type="text" name="president_photo[url]" value="{{old('president_photo.url')}}">

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <img id="holder_president" class="holder" src="{{old('president_photo.url')}}">
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <div class="mb-3">
                                                    <label for="alt_logo" class="col-form-label text-md-right">{{ __('Alt') }}</label>
                                                    <input id="alt_logo" class="form-control" type="text" name="president_photo[alt]" value="{{old('president_photo.alt')}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title_logo" class="col-form-label text-md-right">{{ __('Title') }}</label>
                                                    <input id="title_logo" class="form-control" type="text" name="president_photo[title]" value="{{old('president_photo.title')}}">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <h3>Общая информация</h3>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Название Банка') }}</label>

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
                                        <label for="slug" class="col-form-label text-md-right">{{ __('Slug Банка') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >{{ config('app.url').'/banks/' }}</span>
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
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="president_name" class="col-form-label text-md-right">{{ __('ФИО председателя') }}</label>

                                        <div>
                                            <input id="president_name" type="text" class="form-control{{ $errors->has('president_name') ? ' is-invalid' : '' }}" name="president_name" value="{{ old('president_name') }}" required>

                                            @if ($errors->has('president_name'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('president_name') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="rating" class="col-form-label text-md-right">{{ __('Рейтинг от 0 - 100 балов') }}</label>

                                        <div>
                                            <input id="rating" type="text" class="numeric form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" name="rating" value="{{ old('rating') }}" required>

                                            @if ($errors->has('rating'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rating') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="mfo" class="col-form-label text-md-right">{{ __('МФО') }}</label>

                                        <div>
                                            <input id="mfo" type="text" class="form-control{{ $errors->has('mfo') ? ' is-invalid' : '' }}" name="mfo" value="{{ old('mfo') }}" required>

                                            @if ($errors->has('mfo'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mfo') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="swift" class="col-form-label text-md-right">{{ __('SWIFT') }}</label>

                                        <div>
                                            <input id="swift" type="text" class="form-control{{ $errors->has('swift') ? ' is-invalid' : '' }}" name="swift" value="{{ old('swift') }}" required>

                                            @if ($errors->has('swift'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('swift') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="egrdpou" class="col-form-label text-md-right">{{ __('ЕГРДПОУ') }}</label>

                                        <div>
                                            <input id="egrdpou" type="text" class="form-control{{ $errors->has('egrdpou') ? ' is-invalid' : '' }}" name="egrdpou" value="{{ old('egrdpou') }}" required>

                                            @if ($errors->has('egrdpou'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('egrdpou') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <h3>Свидетельство о регистрации</h3>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="number_reg" class="col-form-label text-md-right">{{ __('Номер') }}</label>

                                        <div>
                                            <input id="number_reg" type="text" class="form-control{{ $errors->has('number_reg') ? ' is-invalid' : '' }}" name="number_reg" value="{{ old('number_reg') }}" required>

                                            @if ($errors->has('number_reg'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('number_reg') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="date_reg" class="col-form-label text-md-right">{{ __('Дата') }}</label>

                                        <div>
                                            <input id="date_reg" type="text" class="date-field edit-date form-control{{ $errors->has('date_reg') ? ' is-invalid' : '' }}" name="date_reg" value="{{ old('date_reg') }}" required>

                                            @if ($errors->has('date_reg'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date_reg') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <h3>Лицензия НБУ</h3>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="number_license" class="col-form-label text-md-right">{{ __('Номер') }}</label>

                                        <div>
                                            <input id="number_license" type="text" class="form-control{{ $errors->has('number_license') ? ' is-invalid' : '' }}" name="number_license" value="{{ old('number_license') }}" required>

                                            @if ($errors->has('number_license'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('number_license') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="date_license" class="col-form-label text-md-right">{{ __('Дата') }}</label>

                                        <div>
                                            <input id="date_license" type="text" class="date-field edit-date form-control{{ $errors->has('date_license') ? ' is-invalid' : '' }}" name="date_license" value="{{ old('date_license') }}" required>

                                            @if ($errors->has('date_license'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date_license') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>





                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="description" class="col-form-label text-md-right">{{ __('Описание') }}</label>

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


                            <div class="row">
                                <div class="col">
                                    <h3>Контакты</h3>
                                </div>
                            </div>


                             <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="head_office" class="col-form-label text-md-right">{{ __('Главный офис') }}</label>

                                        <div>
                                            <input id="head_office" type="text" class="form-control{{ $errors->has('head_office') ? ' is-invalid' : '' }}" name="head_office" value="{{ old('head_office') }}" required>

                                            @if ($errors->has('head_office'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('head_office') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="col-form-label text-md-right">{{ __('Телефон') }}</label>

                                        <div>
                                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>

                             <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>

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

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="web_site" class="col-form-label text-md-right">{{ __('Web Site') }}</label>

                                        <div>
                                            <input id="web_site" type="text" class="form-control{{ $errors->has('web_site') ? ' is-invalid' : '' }}" name="web_site" value="{{ old('web_site') }}" required>

                                            @if ($errors->has('web_site'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('web_site') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="preview" class="col-form-label text-md-right">{{ __('Анонс') }}</label>

                                        <div>
                                            <textarea name="preview" id="preview" class="form-control">{{old('preview')}}</textarea>

                                            @if ($errors->has('preview'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('preview') }}</strong>
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

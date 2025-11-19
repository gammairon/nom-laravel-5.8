@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="my-4">
                      <a href="{{ route('admin.products.credit-cash.create') }}" class="btn btn-success" >
                          <i class="fa fa-plus" aria-hidden="true"></i>
                          <span class="hidden-sm-down">Add New Credit Cash</span>
                      </a>
                  </p>
                <div class="card">
                    <div class="card-header"><h3>{{ __('Создание Продукта "Кредит Наличными"') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.products.credit-cash.update', $creditCash) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-xs-12 col-md-8 offset-md-2">
                                    <div class="form-group photo-wrap">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder" class="photo btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Выбрать фото
                                                 </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="primary_media[url]" value="{{old('primary_media.url', $creditCash->getPrimaryUrl())}}">

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-4">
                                                <img id="holder" class="holder" src="{{old('primary_media.url', $creditCash->getPrimaryUrl())}}">
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <div class="mb-3">
                                                    <label for="alt_logo" class="col-form-label text-md-right">{{ __('Alt') }}</label>
                                                    <input id="alt_logo" class="form-control" type="text" name="primary_media[alt]" value="{{old('primary_media.alt', $creditCash->getPrimaryAlt())}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="title_logo" class="col-form-label text-md-right">{{ __('Title') }}</label>
                                                    <input id="title_logo" class="form-control" type="text" name="primary_media[title]" value="{{old('primary_media.title',  $creditCash->getPrimaryTitle())}}">
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
                                        <label for="name" class="col-form-label text-md-right required">{{ __('Название') }}</label>

                                        <div>
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $creditCash->name) }}" required>

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
                                        <label for="slug" class="col-form-label text-md-right required">{{ __('Slug') }}</label>
                                        <div class="input-group mb-3">

                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >{{ config('app.url').'/'.$creditCash->getSlugPrefix() }}</span>
                                            </div>
                                            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug', $creditCash->slug) }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><a href="{{ route('products.cash.single', ['slug' => $creditCash->slug]) }}" target="_blank">Просмотреть</a></span>
                                            </div>

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
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="president_name" class="col-form-label text-md-right required">{{ __('Банк') }}</label>

                                        <div>
                                            <select id="organization_id" class="form-control{{ $errors->has('organization_id') ? ' is-invalid' : '' }}" name="organization_id" required>
                                                <option value="">Выберите Банк</option>
                                                @foreach ($banks as $id => $name)
                                                    <option value="{{$id}}" {{selectedOld('organization_id', $id, $creditCash->organization_id)}}>{{$name}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('organization_id'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('organization_id') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="ref_link" class="col-form-label text-md-right required">{{ __('Реф. ссылка') }}</label>

                                        <div>
                                            <input id="ref_link" type="text" class="form-control{{ $errors->has('ref_link') ? ' is-invalid' : '' }}" name="ref_link" value="{{ old('ref_link', $creditCash->ref_link) }}" required>

                                            @if ($errors->has('ref_link'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ref_link') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="rating" class="col-form-label text-md-right required">{{ __('Рейтинг от 0 - 100 балов') }}</label>

                                        <div>
                                            <input id="rating" type="text" class="numeric form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" name="rating" value="{{ old('rating', $creditCash->rating) }}" required>

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
                                <div class="col">
                                    <h3>Сумма</h3>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="min_amount" class="col-form-label text-md-right required">{{ __('Мин. сумма') }}</label>

                                        <div>
                                            <input id="min_amount" type="text" class="numeric form-control{{ $errors->has('min_amount') ? ' is-invalid' : '' }}" name="min_amount" value="{{ old('min_amount', $creditCash->min_amount) }}" required>

                                            @if ($errors->has('min_amount'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('min_amount') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="max_amount" class="col-form-label text-md-right required">{{ __('Макс. сумма') }}</label>

                                        <div>
                                            <input id="max_amount" type="text" class="numeric form-control{{ $errors->has('max_amount') ? ' is-invalid' : '' }}" name="max_amount" value="{{ old('max_amount', $creditCash->max_amount) }}" required>

                                            @if ($errors->has('max_amount'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('max_amount') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="income_max_amount" class="col-form-label text-md-right required">{{ __('Макс. сумма без справки о доходах') }}</label>

                                        <div>
                                            <input id="income_max_amount" type="text" class="numeric form-control{{ $errors->has('income_max_amount') ? ' is-invalid' : '' }}" name="income_max_amount" value="{{ old('income_max_amount', $creditCash->income_max_amount) }}" required>

                                            @if ($errors->has('income_max_amount'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('income_max_amount') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <h3>Срок</h3>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="min_term" class="col-form-label text-md-right required">{{ __('Мин. срок') }}</label>

                                        <div>
                                            <input id="min_term" type="number" class="numeric form-control{{ $errors->has('min_term') ? ' is-invalid' : '' }}" name="min_term" value="{{ old('min_term', $creditCash->min_term) }}" required>

                                            @if ($errors->has('min_term'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('min_term') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="max_term" class="col-form-label text-md-right required">{{ __('Макс. срок') }}</label>

                                        <div>
                                            <input id="max_term" type="number" class="numeric form-control{{ $errors->has('max_term') ? ' is-invalid' : '' }}" name="max_term" value="{{ old('max_term', $creditCash->max_term) }}" required>

                                            @if ($errors->has('max_term'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('max_term') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col">
                                    <h3>Процентная ставка</h3>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="percent_new_individual" class="col-form-label text-md-right required">{{ __('Новым клиентам физ.лицо') }}</label>

                                        <div>
                                            <input id="percent_new_individual" type="text" class="numeric form-control{{ $errors->has('percent_new_individual') ? ' is-invalid' : '' }}" name="percent_new_individual" value="{{ old('percent_new_individual', $creditCash->percent_new_individual) }}" required>

                                            @if ($errors->has('percent_new_individual'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('percent_new_individual') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="percent_new_legal" class="col-form-label text-md-right required">{{ __('Новым клиентам ФОП') }}</label>

                                        <div>
                                            <input id="percent_new_legal" type="text" class="numeric form-control{{ $errors->has('percent_new_legal') ? ' is-invalid' : '' }}" name="percent_new_legal" value="{{ old('percent_new_legal', $creditCash->percent_new_legal) }}" required>

                                            @if ($errors->has('percent_new_legal'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('percent_new_legal') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="percent_client" class="col-form-label text-md-right required">{{ __('Клиентам банка') }}</label>

                                        <div>
                                            <input id="percent_client" type="text" class="numeric form-control{{ $errors->has('percent_client') ? ' is-invalid' : '' }}" name="percent_client" value="{{ old('percent_client', $creditCash->percent_client) }}" required>

                                            @if ($errors->has('percent_client'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('percent_client') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <h3>Документы</h3>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="docs_individual" class="col-form-label text-md-right">{{ __('Для физ.лица') }}</label>

                                        <div>
                                            <textarea name="docs_individual" id="docs_individual" class="form-control ">{{old('docs_individual', $creditCash->docs_individual)}}</textarea>

                                            @if ($errors->has('docs_individual'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('docs_individual') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="docs_legal" class="col-form-label text-md-right">{{ __('Для ФОП') }}</label>

                                        <div>
                                            <textarea name="docs_legal" id="docs_legal" class="form-control ">{{old('docs_legal', $creditCash->docs_legal)}}</textarea>

                                            @if ($errors->has('docs_legal'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('docs_legal') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="experience" class="col-form-label text-md-right">{{ __('Стаж') }}</label>

                                        <div>
                                            <textarea name="experience" id="experience" class="form-control ">{{old('experience', $creditCash->experience)}}</textarea>

                                            @if ($errors->has('experience'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('experience') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group multi-fields">
                                        <label for="advantages" class="col-form-label text-md-right">{{ __('Преимущества') }}</label>
                                            @if (old('advantages', $advantages))
                                                @foreach (old('advantages', $advantages) as $advantage)
                                                    @if ($loop->first)
                                                        <div class="multi-field">
                                                            <textarea name="advantages[]" class="form-control ">{{$advantage}}</textarea>
                                                        </div>
                                                    @else
                                                        <div class="multi-field">
                                                            <div class="mt-4 mb-4"><a href="javascrit:void(0);" class="remove_multi_field btn btn-danger">Удалить</a></div>
                                                            <textarea name="advantages[]" class="form-control ">{{$advantage}}</textarea>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="multi-field">
                                                     <textarea name="advantages[]" class="form-control "></textarea>
                                                </div>
                                            @endif


                                        <div class="multi-fields-container">

                                        </div>
                                        <div class="mt-4 mb-4">
                                            <a href="javascrit:void(0);" class="add_multi_field btn btn-success" data-template="#advantage">Добавить преимущество</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @include('admin.partials.seo_block', ['seo' => $seo])

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

    <script type="text/template" id="advantage">
        <div class="multi-field">
            <div class="mt-4 mb-4"><a href="javascrit:void(0);" class="remove_multi_field btn btn-danger">Удалить</a></div>
            <textarea name="advantages[]" class="form-control "></textarea>
        </div>
    </script>

@endsection

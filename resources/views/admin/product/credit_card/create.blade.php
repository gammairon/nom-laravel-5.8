@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3>{{ __('Создание Продукта "Кредитная Карта"') }}</h3></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.products.credit-cards.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xs-12 col-md-8 offset-md-2">
                                    <div class="form-group photo-wrap">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <a data-input="thumbnail" data-preview="holder" class="photo btn btn-primary">
                                                    <i class="fa fa-picture-o"></i> Выбрать Логотип
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
                                    <h3>Общая информация</h3>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right required">{{ __('Название') }}</label>

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
                                        <label for="slug" class="col-form-label text-md-right required">{{ __('Slug') }}</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >{{ config('app.url').'/kreditnye-karty/' }}</span>
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
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="president_name" class="col-form-label text-md-right required">{{ __('Банк') }}</label>

                                        <div>
                                            <select id="organization_id" class="form-control{{ $errors->has('organization_id') ? ' is-invalid' : '' }}" name="organization_id" required>
                                                <option value="">Выберите Банк</option>
                                                @foreach ($banks as $id => $name)
                                                    <option value="{{$id}}" {{selectedOld('organization_id', $id)}}>{{$name}}</option>
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
                                            <input id="ref_link" type="text" class="form-control{{ $errors->has('ref_link') ? ' is-invalid' : '' }}" name="ref_link" value="{{ old('ref_link') }}" required>

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
                                        <label for="max_limit" class="col-form-label text-md-right required">{{ __('Макс. кредитный лимит') }}</label>

                                        <div>
                                            <input id="max_limit" type="text" class="numeric form-control{{ $errors->has('max_limit') ? ' is-invalid' : '' }}" name="max_limit" value="{{ old('max_limit') }}" required>

                                            @if ($errors->has('max_limit'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('max_limit') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="income_max_limit" class="col-form-label text-md-right required">{{ __('Макс. кредитный лимит без справки о доходах') }}</label>

                                        <div>
                                            <input id="income_max_limit" type="text" class="numeric form-control{{ $errors->has('income_max_limit') ? ' is-invalid' : '' }}" name="income_max_limit" value="{{ old('income_max_limit') }}" required>

                                            @if ($errors->has('income_max_limit'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('income_max_limit') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="grace_period" class="col-form-label text-md-right required">{{ __('Льготный период, дней') }}</label>

                                        <div>
                                            <input id="grace_period" type="number" class="numeric form-control{{ $errors->has('grace_period') ? ' is-invalid' : '' }}" name="grace_period" value="{{ old('grace_period') }}" required>

                                            @if ($errors->has('grace_period'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('grace_period') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="rate_in" class="col-form-label required">{{ __('Процентная ставка во время льготного периода') }}</label>

                                        <div>
                                            <input id="rate_in" type="text" class="numeric form-control{{ $errors->has('rate_in') ? ' is-invalid' : '' }}" name="rate_in" value="{{ old('rate_in') }}" required>

                                            @if ($errors->has('rate_in'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rate_in') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="rate_after" class="col-form-label text-md-right required">{{ __('Процентная ставка после льготного периода') }}</label>

                                        <div>
                                            <input id="rate_after" type="text" class="numeric form-control{{ $errors->has('rate_after') ? ' is-invalid' : '' }}" name="rate_after" value="{{ old('rate_after') }}" required>

                                            @if ($errors->has('rate_after'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rate_after') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="service" class="col-form-label text-md-right">{{ __('Обслуживание') }}</label>

                                        <div>
                                            <input id="service" type="text" class="form-control{{ $errors->has('service') ? ' is-invalid' : '' }}" name="service" value="{{ old('service') }}">

                                            @if ($errors->has('service'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('service') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="row">

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="cash_back" class="col-form-label text-md-right">{{ __('Кешбек') }}</label>

                                        <div>
                                            <input id="cash_back" type="text" class="numeric form-control{{ $errors->has('cash_back') ? ' is-invalid' : '' }}" name="cash_back" value="{{ old('cash_back') }}">

                                            @if ($errors->has('cash_back'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('cash_back') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label for="loan" class="col-form-label text-md-right">{{ __('Россрочка') }}</label>

                                        <div>
                                            <input id="loan" type="text" class="numeric form-control{{ $errors->has('loan') ? ' is-invalid' : '' }}" name="loan" value="{{ old('loan') }}">

                                            @if ($errors->has('loan'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('loan') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-12">
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

                            <div class="row">
                                <div class="col-xs-12 col-md-4">
                                    <div class="form-group">
                                        <label for="currency" class="col-form-label">{{ __('Валюта') }}</label>

                                        <div>
                                            <input id="currency" type="text" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency" value="{{ old('currency') }}">

                                            @if ($errors->has('currency'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('currency') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-4">
                                     <div class="form-group">
                                        <label for="min_age" class="col-form-label required">{{ __('Возраст от:') }}</label>

                                        <div>
                                            <input id="min_age" type="text" class="numeric form-control{{ $errors->has('min_age') ? ' is-invalid' : '' }}" name="min_age" value="{{ old('min_age') }}" required>

                                            @if ($errors->has('min_age'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('min_age') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                 <div class="col-xs-12 col-md-4">
                                     <div class="form-group">
                                        <label for="max_age" class="col-form-label required">{{ __('Возраст до:') }}</label>

                                        <div>
                                            <input id="max_age" type="text" class="numeric form-control{{ $errors->has('max_age') ? ' is-invalid' : '' }}" name="max_age" value="{{ old('max_age') }}" required>

                                            @if ($errors->has('max_age'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('max_age') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                       <label for="list_documents" class="col-form-label text-md-right">{{ __('Перечень документов') }}</label>

                                       <div>
                                           <textarea name="list_documents" id="list_documents" class="form-control">{{old('list_documents')}}</textarea>

                                           @if ($errors->has('list_documents'))
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('list_documents') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                       <label for="terms_repayment" class="col-form-label text-md-right">{{ __('Условия погашения задолженности') }}</label>

                                       <div>
                                           <textarea name="terms_repayment" id="terms_repayment" class="form-control">{{old('terms_repayment')}}</textarea>

                                           @if ($errors->has('terms_repayment'))
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('terms_repayment') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                       <label for="fines_penalties" class="col-form-label text-md-right">{{ __('Штрафы и пеня') }}</label>

                                       <div>
                                           <textarea name="fines_penalties" id="fines_penalties" class="form-control">{{old('fines_penalties')}}</textarea>

                                           @if ($errors->has('fines_penalties'))
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('fines_penalties') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                       <label for="insurance" class="col-form-label text-md-right">{{ __('Страхование') }}</label>

                                       <div>
                                           <textarea name="insurance" id="insurance" class="form-control">{{old('insurance')}}</textarea>

                                           @if ($errors->has('insurance'))
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('insurance') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-md-6 pt-4 pb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="chip" name="chip" value="1" {{checked(1, old('chip', 0) )}}>
                                        <label class="form-check-label" for="chip">Чип</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="pay_wave" name="pay_wave" value="1" {{checked(1, old('pay_wave', 0) )}}>
                                        <label class="form-check-label" for="pay_wave">PayWave/PayPass</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="visa" name="visa" value="1" {{checked(1, old('visa', 0) )}}>
                                        <label class="form-check-label" for="visa">Платежная система Visa</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="master_card" name="master_card" value="1" {{checked(1, old('master_card', 0) )}}>
                                        <label class="form-check-label" for="master_card">Платежная система MasterCard</label>
                                    </div>

                                </div>
                                <div class="col-xs-12 col-md-6">
                                     <div class="form-group multi-fields">
                                        <label for="advantages" class="col-form-label text-md-right">{{ __('Преимущества') }}</label>
                                        @foreach (old('advantages', ['']) as $advantage)

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

    <script type="text/template" id="advantage">
        <div class="multi-field">
            <div class="mt-4 mb-4"><a href="javascrit:void(0);" class="remove_multi_field btn btn-danger">Удалить</a></div>
            <textarea name="advantages[]" class="form-control "></textarea>
        </div>
    </script>

@endsection

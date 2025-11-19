@include('admin.partials.primary_media', ['model' => $organization])

<div class="row">

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="name" class="col-form-label text-md-right">{{ __('Название МФО') }}</label>

            <div>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $organization->name) }}" required>

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
            <label for="slug" class="col-form-label text-md-right">{{ __('Slug МФО') }}</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >{{ config('app.url').'/mfo/' }}</span>
                </div>
                <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug', $organization->slug) }}" required>
                <div class="input-group-append">
                    <span class="input-group-text"><a href="{{ route('mfo.single', ['slug' => $organization->slug]) }}" target="_blank">Просмотреть</a></span>
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
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="ref_link" class="col-form-label text-md-right">{{ __('Реф.ссылка') }}</label>

            <div>
                <input id="ref_link" type="text" class="form-control{{ $errors->has('ref_link') ? ' is-invalid' : '' }}" name="ref_link" value="{{ old('ref_link', $organization->ref_link) }}" required>

                @if ($errors->has('ref_link'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ref_link') }}</strong>
                    </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="ref_link_2" class="col-form-label text-md-right">{{ __('Реф.ссылка 2') }}</label>

            <div>
                <input id="ref_link_2" type="text" class="form-control{{ $errors->has('ref_link_2') ? ' is-invalid' : '' }}" name="ref_link_2" value="{{ old('ref_link_2', $organization->ref_link_2) }}" >

                @if ($errors->has('ref_link_2'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('ref_link_2') }}</strong>
                    </span>
                @endif

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="rating" class="col-form-label text-md-right">{{ __('Рейтинг от 0 - 100 балов') }}</label>

            <div>
                <input id="rating" type="text" class="numeric form-control{{ $errors->has('rating') ? ' is-invalid' : '' }}" name="rating" value="{{ old('rating', $organization->rating) }}" required>

                @if ($errors->has('rating'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('rating') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="first_credit" class="col-form-label text-md-right">{{ __('Первый кредит') }}</label>

            <div>
                <input id="first_credit" type="text" class="numeric form-control{{ $errors->has('first_credit') ? ' is-invalid' : '' }}" name="first_credit" value="{{ old('first_credit', $organization->first_credit) }}" required>

                @if ($errors->has('first_credit'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('first_credit') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="repeat_credit_bid" class="col-form-label text-md-right">{{ __('Ставка для повторного займа') }}</label>

            <div>
                <input id="repeat_credit_bid" type="text" class="numeric form-control{{ $errors->has('repeat_credit_bid') ? ' is-invalid' : '' }}" name="repeat_credit_bid" value="{{ old('repeat_credit_bid', $organization->repeat_credit_bid) }}" required>

                @if ($errors->has('repeat_credit_bid'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('repeat_credit_bid') }}</strong>
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
                <textarea name="preview" id="preview" class="form-control ">{{old('preview', $organization->preview)}}</textarea>

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
    <div class="col">
        <h3>Бесплатный кредит</h3>
    </div>
</div>
<div class="row">



    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="free_credit_bid" class="col-form-label text-md-right">{{ __('Ставка') }}</label>

            <div>
                <input id="free_credit_bid" type="text" class="numeric form-control{{ $errors->has('free_credit_bid') ? ' is-invalid' : '' }}" name="free_credit_bid" value="{{ old('free_credit_bid', $organization->free_credit_bid) }}" >

                @if ($errors->has('free_credit_bid'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('free_credit_bid') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="free_credit_amount" class="col-form-label text-md-right">{{ __('Сумма') }}</label>

            <div>
                <input id="free_credit_amount" type="text" class="numeric form-control{{ $errors->has('free_credit_amount') ? ' is-invalid' : '' }}" name="free_credit_amount" value="{{ old('free_credit_amount', $organization->free_credit_amount) }}" >

                @if ($errors->has('free_credit_amount'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('free_credit_amount') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="free_credit_description" class="col-form-label text-md-right">{{ __('Описание') }}</label>

            <div>
                <textarea name="free_credit_description" id="free_credit_description" class="form-control html-editor">{{ old('free_credit_description', $organization->free_credit_description) }}</textarea>

                @if ($errors->has('free_credit_description'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('free_credit_description') }}</strong>
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

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="min_amount" class="col-form-label text-md-right">{{ __('Мин. сумма') }}</label>

            <div>
                <input id="min_amount" type="text" class="numeric form-control{{ $errors->has('min_amount') ? ' is-invalid' : '' }}" name="min_amount" value="{{ old('min_amount', $organization->min_amount) }}" required>

                @if ($errors->has('min_amount'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('min_amount') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="max_amount" class="col-form-label text-md-right">{{ __('Макс. сумма') }}</label>

            <div>
                <input id="max_amount" type="text" class="numeric form-control{{ $errors->has('max_amount') ? ' is-invalid' : '' }}" name="max_amount" value="{{ old('max_amount', $organization->max_amount) }}" required>

                @if ($errors->has('max_amount'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('max_amount') }}</strong>
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
            <label for="min_term" class="col-form-label text-md-right">{{ __('Мин. срок') }}</label>

            <div>
                <input id="min_term" type="text" class="numeric form-control{{ $errors->has('min_term') ? ' is-invalid' : '' }}" name="min_term" value="{{ old('min_term', $organization->min_term) }}" required>

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
            <label for="max_term" class="col-form-label text-md-right">{{ __('Макс. срок') }}</label>

            <div>
                <input id="max_term" type="text" class="numeric form-control{{ $errors->has('max_term') ? ' is-invalid' : '' }}" name="max_term" value="{{ old('max_term', $organization->max_term) }}" required>

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
        <h3>Возраст</h3>
    </div>
</div>
<div class="row">

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="min_age" class="col-form-label text-md-right">{{ __('Мин. Возраст') }}</label>

            <div>
                <input id="min_age" type="text" class="numeric form-control{{ $errors->has('min_age') ? ' is-invalid' : '' }}" name="min_age" value="{{ old('min_age', $organization->min_age) }}" required>

                @if ($errors->has('min_age'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('min_age') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="max_age" class="col-form-label text-md-right">{{ __('Макс. Возраст') }}</label>

            <div>
                <input id="max_age" type="text" class="numeric form-control{{ $errors->has('max_age') ? ' is-invalid' : '' }}" name="max_age" value="{{ old('max_age', $organization->max_age) }}" required>

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

    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="time_review" class="col-form-label text-md-right">{{ __('Время рассмотрения') }}</label>

            <div>
                <input id="time_review" type="text" class="numeric form-control{{ $errors->has('time_review') ? ' is-invalid' : '' }}" name="time_review" value="{{ old('time_review', $organization->time_review) }}" required>

                @if ($errors->has('time_review'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('time_review') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-2">
        <div class="form-group">
            <label class="col-form-label text-md-right">Способы получения: </label>
            <div class="form-check">
                <input type="hidden" name="receiving_method_card" value="0">
                <input class="form-check-input" type="checkbox" value="1" name="receiving_method_card" id="receiving_method_card" {{checked($organization->receiving_method_card, '1')}}>
                <label class="form-check-label" for="receiving_method_card">
                    Карта
                </label>
            </div>
            <div class="form-check">
                <input type="hidden" name="receiving_method_cash" value="0">
                <input class="form-check-input" type="checkbox" value="1" id="receiving_method_cash" name="receiving_method_cash" {{checked($organization->receiving_method_cash, '1')}}>
                <label class="form-check-label" for="receiving_method_cash">
                    Наличными
                </label>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="special_offer" class="col-form-label text-md-right">{{ __('Специальное предложение') }}</label>

            <div>
                <textarea name="special_offer" id="special_offer" class="form-control">{{ old('special_offer', $organization->special_offer) }}</textarea>

                @if ($errors->has('special_offer'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('special_offer') }}</strong>
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

    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="web_site" class="col-form-label text-md-right">{{ __('Веб-сайт') }}</label>

            <div>
                <input id="web_site" type="text" class="form-control{{ $errors->has('web_site') ? ' is-invalid' : '' }}" name="web_site" value="{{ old('web_site', $organization->web_site) }}" required>

                @if ($errors->has('web_site'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('web_site') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="phone" class="col-form-label text-md-right">{{ __('Телефоны') }}</label>

            <div>
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', $organization->phone) }}" required>

                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                @endif

            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-4">
        <div class="form-group">
            <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>

            <div>
                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $organization->email) }}">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="address" class="col-form-label text-md-right">{{ __('Адрес') }}</label>

            <div>
                <textarea name="address" id="address" class="form-control">{{ old('address', $organization->address) }}</textarea>

                @if ($errors->has('address'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                @endif
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="work_time" class="col-form-label text-md-right">{{ __('Время работы поддержки') }}</label>

            <div>
                <input id="work_time" type="text" class="form-control{{ $errors->has('work_time') ? ' is-invalid' : '' }}" name="work_time" value="{{ old('work_time', $organization->work_time) }}" required>

                @if ($errors->has('work_time'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('work_time') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="nfs_license" class="col-form-label text-md-right">{{ __('Лицензия Нацкомфинуслуг') }}</label>

            <div>
                <input id="nfs_license" type="text" class="form-control{{ $errors->has('nfs_license') ? ' is-invalid' : '' }}" name="nfs_license" value="{{ old('nfs_license', $organization->nfs_license) }}" >

                @if ($errors->has('nfs_license'))
                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nfs_license') }}</strong>
                                            </span>
                @endif

            </div>
        </div>
    </div>
</div>

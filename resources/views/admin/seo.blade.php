
@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
           <div class="col-md-12">
               <h1 class="my-3">SEO Settings</h1>
               <div class="seo-block p-3">
                   <ul class="nav nav-pills mb-3" id="seo-tab" role="tablist">
                       <li class="nav-item">
                           <a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link success" id="pills-front-tab" data-toggle="pill" href="#pills-front" role="tab" aria-controls="pills-front" aria-selected="false">Front Page</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link success" id="pills-category-tab" data-toggle="pill" href="#pills-news" role="tab" aria-controls="pills-news" aria-selected="false">News Archive</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link success" id="pills-category-tab" data-toggle="pill" href="#pills-category" role="tab" aria-controls="pills-category" aria-selected="false">Category Archive</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link success" id="pills-tag-tab" data-toggle="pill" href="#pills-tag" role="tab" aria-controls="pills-tag" aria-selected="false">Tag Archive</a>
                       </li>

                       <li class="nav-item">
                           <a class="nav-link success" id="pills-credit-cards-tab" data-toggle="pill" href="#pills-credit-cards" role="tab" aria-controls="pills-credit-cards" aria-selected="false">Credit Cards Archive</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link success" id="pills-credit-cash-tab" data-toggle="pill" href="#pills-credit-cash" role="tab" aria-controls="pills-credit-cash" aria-selected="false">Credit Cash Archive</a>
                       </li>

                       <li class="nav-item">
                           <a class="nav-link success" id="pills-mfo-tab" data-toggle="pill" href="#pills-mfo" role="tab" aria-controls="pills-mfo" aria-selected="false">МФО Archive</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link success" id="pills-banks-tab" data-toggle="pill" href="#pills-banks" role="tab" aria-controls="pills-banks" aria-selected="false">Banks Archive</a>
                       </li>
                       <li class="nav-item">
                           <a class="nav-link success" id="pills-search-tab" data-toggle="pill" href="#pills-search" role="tab" aria-controls="pills-search" aria-selected="false">Search</a>
                       </li>

                   </ul>
                   <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                   <div class="tab-content" id="pills-tabContent">
                       <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
                           <div class="row">
                               <div class="col-xs-12 col-md-12">
                                   <div class="form-group">
                                       <label for="global[site_name]" class="col-form-label">{{ __('Site Name') }}</label>

                                       <div>
                                           <input id="global[site_name]" type="text" class="form-control{{ $errors->has('seo.title') ? ' is-invalid' : '' }}" name="global[site_name]" value="{{ old('global.site_name', $siteName->val) }}">

                                           @if ($errors->has('global.site_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('global.site_name') }}</strong>
                                                </span>
                                           @endif

                                       </div>
                                   </div>
                               </div>
                               <div class="col-xs-12 col-md-12">
                                   <div class="form-group">
                                       <label for="global[site_description]" class="col-form-label text-md-right">{{ __('Site Description') }}</label>

                                       <div>
                                           <textarea name="global[site_description]" id="global[site_description]" class="form-control">{{old('global.site_description', $siteDescription->val)}}</textarea>

                                           @if ($errors->has('global.site_description'))
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('global.site_description') }}</strong>
                                               </span>
                                           @endif
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                              <div class="col-xs-12 col-md-12" >
                                  <button type="submit" class="btn  btn-success">Сохранить все настройки</button>
                              </div>
                           </div>
                       </div>
                       <div class="tab-pane fade" id="pills-front" role="tabpanel" aria-labelledby="pills-front-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'front', 'seoModel' => $frontSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-news" role="tabpanel" aria-labelledby="pills-news-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'news', 'seoModel' => $newsSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'categories', 'seoModel' => $categoriesSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-tag" role="tabpanel" aria-labelledby="pills-tag-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'tags', 'seoModel' => $tagsSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-credit-cards" role="tabpanel" aria-labelledby="pills-credit-cards-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'credit_cards', 'seoModel' => $creditCardsSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-credit-cash" role="tabpanel" aria-labelledby="pills-credit-cash-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'credit_cash', 'seoModel' => $creditCashSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-mfo" role="tabpanel" aria-labelledby="pills-mfo-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'mfo', 'seoModel' => $mfoSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-banks" role="tabpanel" aria-labelledby="pills-banks-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'banks', 'seoModel' => $banksSeo])
                       </div>
                       <div class="tab-pane fade" id="pills-search" role="tabpanel" aria-labelledby="pills-search-tab">
                           @include('admin.partials.setting_seo_block', ['name' => 'search', 'seoModel' => $search])
                       </div>
                   </div>
                   </form>
               </div>

           </div>
        </div>
    </div>

@endsection

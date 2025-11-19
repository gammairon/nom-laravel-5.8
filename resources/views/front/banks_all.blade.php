@extends('layouts.app')



@section('content')
    <div class="container container-page d-md-flex page-all-banks">
        <div class="col-xl-9 main-column contributions-page">
            <div class="content-wrap-item contributions-details-item search-box">
                <div class="row">
                    <div class="col-12">
                        <ul class="breadcrumbs-list">
                            <li class="breadcrumbs-item"><a href="{{ route('home') }}" class="breadcrumbs-link " title="Home"></a></li>
                            <li class="breadcrumbs-item">Банки</li>
                        </ul>
                    </div>
                </div>
                <div id="search-bank" class="search-box__item">

                    <div class="row">
                        <div class="col-12 col-md-9 form-group">
                            <input  type="text" class="form-control" placeholder="Поиск" id="bank_name">
                        </div>
                        <div class="col-12 col-md-3 form-group">
                            <a href="javascript:void(0);" class="form-control yellBtn btn btn-result">Найти банк</a>
                        </div>

                    </div>

                    <div class="row d-md-block letters-desktop">
                        <div class="col-12 in">
                            <ul class="list-letters list-inline">
                                @foreach ($banks as $latter => $groupBanks)
                                    <li class="list-inline-item"><a href="javascript:void(0);" class="search-letter" data-letter="{{$latter}}">{{$latter}}</a></li>
                                @endforeach
                                <li class="list-inline-item"><a class="search-letter" href="javascript:void(0);" data-letter="all">Все банки</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-center my-3">Список банков Украины</h1>
            <ul id="all_banks" class="banks-list animated fadeInLeft">
                @include('front.partials.bank_list', ['banks' => $banks])
            </ul>
            <div class="content-wrap-item contributions-details-item content-part">

                <h3>В этом разделе собран список всех банков Украины и представлен в алфавитном порядке, здесь содержится краткая информация, а вся полная информация находится непосредственно на официальных сайтах банков.</h3>

            </div>

        </div>
        @include('front.partials.sidebar_bank')
    </div>
@endsection

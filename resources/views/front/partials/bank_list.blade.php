@if ($banks->isNotEmpty())
    @foreach ($banks as $latter => $groupBanks)
        <li id="later_{{$latter}}" class="letter">
            <span class="character-letter">{{$latter}}</span>
            @foreach ($groupBanks as $bank)
                <div class="row content-wrap-item contributions-details-item">
                    <div class="col-3 col-md-2 logo-bank">
                        <a href="{{ route('banks.single', ['slug' => $bank->slug]) }}" title="{{$bank->name}}">
                            @if($bank->hasPrimary())
                                <img class="lazyload" data-src="{{$bank->getPrimary()->getUrl('thumb')}}" alt="{{$bank->getPrimaryAlt()}}" title="{{$bank->getPrimaryTitle()}}">
                            @endif
                        </a>
                    </div>
                    <div class="col-9 col-md-8 name-bank">
                        <a href="{{ route('banks.single', ['slug' => $bank->slug]) }}">{{$bank->name}}</a>
                        <div class="row name-bank__item">
                            <a href="" class="col-12 col-sm-4">Отделения (<span>0</span>)</a>
                            <a href="" class="col-12 col-sm-4">Предложения (<span>0</span>)</a>
                            <a href="" class="col-12 col-sm-4">Отзывы (<span>0</span>)</a>
                        </div>
                    </div>
                    <div class="col-md-2 d-none d-md-block bank-advantages">
                        <a href="{{ route('banks.single', ['slug' => $bank->slug]) }}" title="{{$bank->name}}" class="bank-more">Перейти</a>
                    </div>
                </div>
            @endforeach
        </li>
    @endforeach
@else
    <li class="letter">
        <div class="row content-wrap-item contributions-details-item">
            <div class="col-12">
                <strong>Ничего не найдено.</strong>
            </div>
        </div>
    </li>
@endif

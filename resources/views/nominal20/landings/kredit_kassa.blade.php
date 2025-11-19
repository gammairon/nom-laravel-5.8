<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Lending Nominal</title>

    <link rel="stylesheet" href="{{asset('/landing_assets/1/style.css')}}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<body>
<header class="header">
    <div class="container-page">
        <div class="header-top">
            <a href="https://nominal.com.ua" class="logo">
                <img src="{{asset('/storage/images/nominal20/landings/1/logo.png')}}" alt="Nominal">
            </a>
        </div>
    </div>
</header>
<main>
    <div class="primary-full">
        <span>Под 0,01% в день* 💳</span>
    </div>
    <section class="main-info">
        <div class="container-page">
            <div class="main-info__block">
                <div class="main-info__block-colLeft">
                    <h1 class="h1 leading-title">
                        Кредиты онлайн на
                        <span class="text-primary">выгодных условиях</span>
                    </h1>
                    <ul class="mt-8 list-benefits">
                        <li class="text-base"> До 15 000 грн под 0,01%</li>
                        <li class="mt-4 text-base"> За 15 минут</li>
                        <li class="mt-4 text-base"> Получите деньги на карту</li>
                    </ul>
                </div>
                <div class="main-info__block-colRight">
                    <form method="POST" action="" class="w-full">
                        <input type="hidden" name="_token" value="">
                        <div class="formWrap p-8 bg-white rounded">
                            <div class="mb-8">
                                <div class="form-items d-none d-md-flex flex-column">
                                    <div class="flex w-full mb-8 items-center">
                                        <span class="text-bold">Мне нужно: </span>
                                        <input type="text" class="input input-price ml-2 text-bold text-big" name="amount-money" id="amount-money" placeholder="2000 грн"/>
                                    </div>
                                    <div id="slider-range-min__kredit-all"></div>
                                </div>
                                <div class="price flex justify-between items-center">
                                    <input type="hidden" id="term" name="term">
                                    <span class="text-base">500 грн.</span>
                                    <span class="text-base">15000 грн.</span>
                                </div>
                            </div>
                            <div class="flex flex-col">
                                <span class="mb-4 form-text text-left">Зарегистрируйтесь:</span>
                                <label>
                                    <input id="name" name="name" type="text" inputmode="text" autocomplete="name" placeholder="Имя" class="px-4 py-3 border rounded appearance-none">
                                </label>
<!--                                <label>
                                    <input id="email" name="email" type="email" inputmode="email" autocomplete="email" placeholder="Электронная почта" class="mt-2 px-4 py-3 bg-white border rounded appearance-none">
                                </label>-->
                                <div class="mt-2 flex items-center w-full bg-white border rounded">
                                    <span class="px-4 py-3 text-base select-none border-r">+380</span>
                                    <label class="w-full">
                                        <input id="phone" name="phone" type="text" placeholder="Ваш номер телефона" minlength="9" class="px-4 py-3 rounded appearance-none border-none">
                                    </label>
                                </div>
                                <div class="mt-4 flex flex-wrap justify-between items-center">
                                    <span class="text-small">До (включительно):</span>
                                    <span class="text-base text-bold" id="repaymentDate">24 Декабрь, 2020</span>
                                </div>
                                <button type="submit" class="px-4 py-3 mt-4 bg-red rounded text-center w-full">ПОЛУЧИТЬ
                                    <span id="buttonAmount">2000</span> грн.
                                </button>
                                <span class="mt-2 text-base text-center info-text">Я ознакомлен <a href="#" class="text-primary">с правилами предоставления информации</a> и подтверждаю согласие на обработку своих персональных данных</span>
                                <div class="mt-4 flex flex-col justify-center items-center text-gray">
                                    <svg class="w-6 h-6" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M12 13a1.49 1.49 0 0 0-1 2.61V17a1 1 0 0 0 2 0v-1.39A1.49 1.49 0 0 0 12 13zm5-4V7A5 5 0 0 0 7 7v2a3 3 0 0 0-3 3v7a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-7a3 3 0 0 0-3-3zM9 7a3 3 0 0 1 6 0v2H9zm9 12a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1z"></path>
                                    </svg>
                                    <span class="mt-1 ml-2 text-small text-center">Повышенная безопасность данных</span>
                                </div>
                            </div>
                        </div>
                        <p class="mt-2 text-small text-gray text-center">*Беспроцентный кредит 2000 грн., проценты 6 грн., сумма к оплате составит 2006 грн. APR 3.65%. Участие в программе лояльности 5000 грн. на 3 месяца, комиссия составит 5869 грн. и общие затраты на займ составляют 10869 грн., APR 620.5%. Беспроцентный кредит 2000 грн., проценты 6 грн., сумма к оплате составит 2006 грн. APR 3.65%.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-24">
        <div class="container-page flex-col">
            <div class="mb-8 flex flex-col justify-center items-center">
                <h2 class=" h2 text-center">
                    Почему
                    <span class="text-primary">Nominal</span>
                </h2>
                <p class="mt-4 text-base text-center">
                    Онлайн сервис, который Вам позволяет получить кредит.
                </p>
            </div>

            <div class="flex flex-wrap">
                <div class="block-item flex flex-col justify-start items-center">
                    <div class="flex justify-center items-center w-32 h-32 shadow-lg rounded-lg bg-white">
                        <svg class="text-primary fill-current w-16 h-16">
                            <path d="M18.667 40h8a2.667 2.667 0 0 0 0-5.333h-8a2.667 2.667 0 0 0 0 5.333zm32-26.667H13.333a8 8 0 0 0-8 8v24a8 8 0 0 0 8 8h37.334a8 8 0 0 0 8-8v-24a8 8 0 0 0-8-8zm2.666 32A2.666 2.666 0 0 1 50.667 48H13.333a2.667 2.667 0 0 1-2.666-2.667v-16h42.666v16zm0-21.333H10.667v-2.667a2.667 2.667 0 0 1 2.666-2.666h37.334a2.667 2.667 0 0 1 2.666 2.666V24z"></path>
                        </svg>
                    </div>
                    <div class="relative">
                        <h4 class="mt-3 text-center">До 15 000 грн под 0% на карту </h4>
                    </div>
                </div>
                <div class="block-item flex flex-col justify-start items-center mt-8-xs">
                    <div class="flex justify-center items-center w-32 h-32 shadow-lg rounded-lg bg-white">
                        <svg class="text-primary fill-current w-16 h-16">
                            <path d="M50.645 56.005h-2.667V51.56a13.333 13.333 0 0 0-.799-4.474 2.98 2.98 0 0 0-.096-.225 13.272 13.272 0 0 0-1.772-3.298l-3.733-4.98a8.05 8.05 0 0 1-1.6-4.802V31.09a8.056 8.056 0 0 1 2.342-5.657l1.753-1.752a13.189 13.189 0 0 0 3.723-7.57c.002-.036.022-.067.022-.105l-.008-.036a13.36 13.36 0 0 0 .168-1.716V8.005h2.667a2.667 2.667 0 0 0 0-5.333H13.31a2.667 2.667 0 0 0 0 5.333h2.667v6.248c.019.575.075 1.148.167 1.716l-.007.036c0 .038.02.069.021.106a13.188 13.188 0 0 0 3.724 7.569l1.752 1.752a8.056 8.056 0 0 1 2.343 5.657v2.692a8.06 8.06 0 0 1-1.6 4.802l-3.735 4.98a13.288 13.288 0 0 0-1.771 3.299 2.589 2.589 0 0 0-.095.223 13.34 13.34 0 0 0-.8 4.475v4.445H13.31a2.667 2.667 0 0 0 0 5.334h37.334a2.667 2.667 0 0 0 0-5.334zM21.31 13.34V8.005h21.334v5.334H21.31zm2.343 6.57a7.92 7.92 0 0 1-1.005-1.237h18.658c-.293.445-.63.86-1.005 1.237l-1.752 1.753a13.228 13.228 0 0 0-3.792 7.677h-5.56a13.227 13.227 0 0 0-3.792-7.678l-1.752-1.752zm2.992 21.872a13.432 13.432 0 0 0 2.635-7.109h5.394a13.422 13.422 0 0 0 2.636 7.11l2.667 3.557h-16l2.669-3.558zm15.998 14.224H21.312V51.56a7.88 7.88 0 0 1 .073-.888h21.188c.04.294.065.59.072.888v4.445z"></path>
                        </svg>
                    </div>
                    <div class="relative">
                        <h4 class="mt-3 text-center">Быстрое решение, кредит за 15 минут</h4>
                    </div>
                </div>
                <div class="block-item flex flex-col justify-start items-center mt-8-md mt-8-xs">
                    <div class="flex justify-center items-center w-32 h-32 shadow-lg rounded-lg bg-white">
                        <svg class="text-primary fill-current w-16 h-16">
                            <path d="M57.77 27.34l-24-21.333a2.664 2.664 0 0 0-3.54 0l-24 21.333a2.666 2.666 0 1 0 3.54 3.987l.897-.796V56a2.666 2.666 0 0 0 2.666 2.667h37.334A2.666 2.666 0 0 0 53.333 56V30.53l.896.797a2.664 2.664 0 0 0 3.764-.223 2.667 2.667 0 0 0-.222-3.764zM24.492 53.333a7.953 7.953 0 0 1 15.018 0H24.49zM28 38.667a4 4 0 1 1 8 0 4 4 0 0 1-8 0zm20 14.666h-2.936a13.335 13.335 0 0 0-6.023-8.608 9.25 9.25 0 0 0 2.292-6.058 9.334 9.334 0 1 0-18.666 0 9.25 9.25 0 0 0 2.292 6.058 13.335 13.335 0 0 0-6.023 8.608H16V25.79l16-14.222L48 25.79v27.543z"></path>
                        </svg>
                    </div>
                    <div class="relative">
                        <h4 class="mt-3 text-center">Без справок, не выходя из дома</h4>
                    </div>
                </div>
                <div class="block-item flex flex-col justify-start items-center mt-8-md mt-8-xs">
                    <div class="flex justify-center items-center w-32 h-32 shadow-lg rounded-lg bg-white">
                        <svg class="text-primary fill-current w-16 h-16">
                            <path d="M20.688 28.687a8 8 0 1 0-8-8 8.008 8.008 0 0 0 8 8zm0-10.666a2.667 2.667 0 1 1 0 5.333 2.667 2.667 0 0 1 0-5.333zm22.625 17.291a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8zm0 10.667a2.667 2.667 0 1 1 0-5.333 2.667 2.667 0 0 1 0 5.333zm9.239-34.531a2.667 2.667 0 0 0-3.77 0L11.447 48.781a2.668 2.668 0 0 0 1.882 4.564 2.665 2.665 0 0 0 1.889-.793l37.333-37.333a2.665 2.665 0 0 0 0-3.771z"></path>
                        </svg>
                    </div>
                    <div class="relative">
                        <h4 class="mt-3 text-center">Бесплатно! Высокий процент одобрения</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-24">
        <div class="container-page flex-col">
            <div class="mb-8 justify-center items-center">
                <h2 class="h2 text-center">
                    Как получить
                    <span class="text-primary">кредит</span>
                </h2>
            </div>

            <div class="flex flex-wrap block-steps">
                <div class="block-steps__item flex flex-col justify-start items-center w-full">
                    <div class="flex justify-center items-center w-32 h-32 shadow-lg rounded-lg bg-white">
                        <svg class="text-primary fill-current w-16 h-16">
                            <path d="M42.667 37.333H21.333a2.667 2.667 0 0 0 0 5.334h21.334a2.667 2.667 0 1 0 0-5.334zm0-10.666h-16a2.667 2.667 0 0 0 0 5.333h16a2.667 2.667 0 0 0 0-5.333zm10.666-16h-8V8A2.667 2.667 0 1 0 40 8v2.667h-5.333V8a2.667 2.667 0 0 0-5.334 0v2.667H24V8a2.667 2.667 0 0 0-5.333 0v2.667h-8A2.667 2.667 0 0 0 8 13.333v37.334a8 8 0 0 0 8 8h32a8 8 0 0 0 8-8V13.333a2.667 2.667 0 0 0-2.667-2.666zm-2.666 40A2.667 2.667 0 0 1 48 53.333H16a2.667 2.667 0 0 1-2.667-2.666V16h5.334v2.667a2.667 2.667 0 1 0 5.333 0V16h5.333v2.667a2.667 2.667 0 0 0 5.334 0V16H40v2.667a2.667 2.667 0 0 0 5.333 0V16h5.334v34.667z"></path>
                        </svg>
                    </div>
                    <div class="relative ">
                        <h4 class="mt-3 leading-none text-center">1. Заполните заявку </h4>
                        <p class="mt-2 text-center">После регистрации выберите лучшее предложение и заполните форму заявки.</p>
                    </div>
                </div>
                <div class="block-steps__item flex flex-col justify-start items-center w-full mt-8-xs">
                    <div class="flex justify-center items-center w-32 h-32 shadow-lg rounded-lg bg-white">
                        <svg class="text-primary fill-current w-16 h-16">
                            <path d="M53.333 23.84a3.488 3.488 0 0 0-.16-.72v-.24a2.854 2.854 0 0 0-.506-.747l-16-16a2.854 2.854 0 0 0-.747-.506.853.853 0 0 0-.24 0 2.347 2.347 0 0 0-.88-.294H18.667a8 8 0 0 0-8 8v37.334a8 8 0 0 0 8 8h26.666a8 8 0 0 0 8-8V23.84zm-16-9.413l6.907 6.906H40a2.667 2.667 0 0 1-2.667-2.666v-4.24zM48 50.667a2.667 2.667 0 0 1-2.667 2.666H18.667A2.666 2.666 0 0 1 16 50.667V13.333a2.667 2.667 0 0 1 2.667-2.666H32v8a8 8 0 0 0 8 8h8v24zm-9.893-17.894l-8.774 8.8-3.44-3.466a2.678 2.678 0 0 0-3.786 3.786l5.333 5.334a2.666 2.666 0 0 0 3.787 0L41.893 36.56a2.678 2.678 0 1 0-3.786-3.787z"></path>
                        </svg>
                    </div>
                    <div class="relative">
                        <h4 class="mt-3  text-center">2. Получите  одобрение</h4>
                        <p class="mt-2 text-center">Решение можно получить в среднем в течение 5 минут после заполнения формы заявки.</p>
                    </div>
                </div>
                <div class="block-steps__item flex flex-col justify-start items-center w-full mt-8-xs">
                    <div class="flex justify-center items-center w-32 h-32 shadow-lg rounded-lg bg-white">
                        <svg class="text-primary fill-current w-16 h-16">
                            <path d="M16 29.334a2.667 2.667 0 1 0 0 5.333 2.667 2.667 0 0 0 0-5.334zm32 0a2.667 2.667 0 1 0 0 5.333 2.667 2.667 0 0 0 0-5.334zm5.333-16H10.667a8 8 0 0 0-8 8v21.333a8 8 0 0 0 8 8h42.666a8 8 0 0 0 8-8V21.333a8 8 0 0 0-8-8zM56 42.666a2.667 2.667 0 0 1-2.667 2.666H10.667A2.667 2.667 0 0 1 8 42.668V21.333a2.667 2.667 0 0 1 2.667-2.666h42.666A2.667 2.667 0 0 1 56 21.333v21.334zM32 24a8 8 0 1 0 0 16.001 8 8 0 0 0 0-16zm0 10.667a2.667 2.667 0 1 1 0-5.334 2.667 2.667 0 0 1 0 5.334z"></path>
                        </svg>
                    </div>
                    <div class="relative">
                        <h4 class="mt-3 text-center">3. Получите деньги </h4>
                        <p class="mt-2 text-center">Вы получите деньги на свою карту в течение нескольких минут после одобрения заявки на кредит.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-24">
        <div class="container-page">
            <p class="text-add text-small text-left">Nominal предлагает своим клиентам специализированный сервис для поиска и заимствования средств cо страниц других юридических фирм по выдачи кредитов. Услуга подходит для любой возрастной группы от 18 лет, для любых целей и ею могут воспользоваться как частные лица, так и юридические. Nominal может получать комиссионные от представляемых финансовых компаний. Комиссия может повлиять на способ отображения кредитных продуктов, например на их расположение. Комиссия даёт возможность посетителям сайта пользоваться услугами Nominal бесплатно.</p>
        </div>
    </section>
    <section class="w-full bg-red block-credit">
        <div class="container-page">
            <div class="flex justify-center items-center m-auto flex-col-md">
                <p class="text-white text-center">Получите до 15,000 грн на вашу карту, первые 30 дней - БЕСПЛАТНО!</p>
                <a href="#" class="mt-4 rounded text-center px-4 py-3 btn-take">
                    ПОЛУЧИТЬ
                    <span id="lowerButtonAmount">2000</span> грн.
                </a>
            </div>
        </div>
    </section>
</main>
<footer class="py-16 bg-dark">
    <div class="hr">
        <div class="container-page flex-col">
            <div class="menu-footer flex justify-center__md items-center flex-row justify-between">
                <ul class="flex justify-center items-center flex-wrap text-center">
                    <li class="mx-4">
                        <a href="#" class="text-base">Вопросы и ответы</a>
                    </li>
                    <li class="mx-4">
                        <a href="#" class="text-base">О нас</a>
                    </li>
                    <li class="mx-4">
                        <a href="#" class="text-base">Защита данных</a>
                    </li>
                    <li class="mx-4">
                        <a href="#" class="text-base">Использование</a>
                    </li>
                    <li class="mx-4">
                        <a href="#" class="text-base">Cookies</a>
                    </li>
                    <li class="mx-4">
                        <a href="#" class="text-base">Push уведомления</a>
                    </li>
                    <li class="mx-4">
                        <a href="#" class="text-base">Условия SMS</a>
                    </li>
                    <li class="mx-4">
                        <a href="#" class="text-base">Эл. почта</a>
                    </li>
                </ul>
                <div class="footer-logo">
                    <a href="#" class="flex justify-center items-end">
                        <img src="{{asset('/storage/images/nominal20/landings/1/logo-white.png')}}" alt="Logo" class="h-6 w-auto">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="hr">
        <div class="container-page flex-col">
            <a href="#" target="_blank" class="copyright text-base">© 2000–2020 Номинал.
                Адрес: улица Набережная Победы, 10К, Днепр, Днепропетровская область, 49094, Украина
            </a>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container-page">
            <div class="text-small text-justify">
                <p class="mb-2">Мы работаем онлайн 24/7</p>
                <p class="mb-2">Адрес: улица Набережная Победы, 10К, Днепр, Днепропетровская область, 49094, Украина</p>
                <p class="mb-2">
                    <a href="#" class="hover:text-primary_hover">Nominal</a> не является финансовым учреждением, банком или кредитором, не несет ответственности за кредитные договора или их условия. Предложения сайта не включают все финансовые компании или их продукты. Срок кредита (minimum and maximum period for repayment) от 62 дней до 1 года. Примеры являются только информативными.            </p>
                <p class="mb-2 mt-4">Годовая процентная ставка (Annual Percentage Rate APR)</p>
                <p class="mb-2">Максимальная годовая процентная ставка может составлять (annual percentage rate APR) 730%.</p>
                <p class="mb-2">Пример расчета (representative example) при взятии 5000 грн. на 3 месяца, комиссия составит 5869 грн. и общие затраты 10869 грн., APR 620,5%.</p>
                <p class="mb-2">Годовая процентная ставка выражена в процентах и включает в себя все общие затраты по кредиту, за исключением расходов, связанных с невыполнением обязательств по кредиту.</p>
                <p class="mb-2 mt-4">Штрафные платежи или информация политики возобновления</p>
                <p class="mb-2">Если получатель кредита не уплачивает кредитору сумму кредита и проценты за использование кредита в указанный договором срок, то кредитодатель может взимать штраф за каждый просроченный день. Большинство кредиторов предлагают клиентам дополнительные 3 дня, за которые не взимаются штрафы.</p>
                <p class="mb-2 mt-4">Если нет возможности своевременно вернуть кредит</p>
                <p class="mb-2">Если возникла ситуация, когда невозможно своевременно вернуть кредит, свяжитесь с кредитором, это поможет избежать штрафных процентов, которые рассчитываются в случае неуплаты кредита.</p>
                <p class="mb-2 mt-4">Занимай ответственно</p>
                <p class="mb-2">Кредит онлайн будет приемлем, если возникли непредвиденные расходы, оплатить услуги или доставку товара необходимо сейчас, если нет долгов по кредитным платежам, если кредитный платеж не превышает 40% от Твоих ежемесячных доходов. Кредит онлайн не будет приемлем, если цель получения кредита, оплата других кредитных обязательств, если планируется покупка, которая не соответствует Твоему финансовому положению, если точно знаешь, что не сможешь выплатить кредит в указанный срок.</p>
                <p class="mb-2">Занимай ответственно, оценив возможность вернуть кредит. Перед тем как занять, ознакомься с условиями кредитного договора, убедись, что сможешь их выполнить.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script src="{{asset('/landing_assets/1/main.js')}}"></script>


</body>
</html>



let Gamma = {

    init: function(){
        this.sidebarToolgle();

        this.commonEvents();

        this.share.init();

        this.creditCalculator.init();

        this.mfoFilter.init();

        this.bankFilter.init();

        this.creditCashFilter.init();

        this.creditCardsFilter.init();

        this.ajaxPagination.init();

        this.loadScrollPost.init();

        this.comments.init();

        this.faq.init();
    },


    block: function($element){
        $element.prepend('<div class="block-loader"><div class="block-loader-content"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></div></div>');
    },

    unblock: function($element){
        $element.find('.block-loader').remove();
    },

    commonEvents: function(){
        //Delete events
        $('.btn-delete').on('click', function(event) {
            event.preventDefault();
            var form_id = $(this).data('form');
            bootbox.confirm({
                message: "Вы уверены?",
                buttons: {
                    confirm: {
                        label: 'Да',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Нет',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if(!result)
                        return;

                    $( form_id ).submit();
                }
            });


        });

        //Numeric fields
        $('.numeric').on('input propertychange', function(event) {
            var str = $.trim($(this).val());
            if(!$.isNumeric(str)){
                $(this).val(str.substring(0, str.length - 1));
            }
            else{
                $(this).val(str);
            }
        });

        //Чекбоксы в таблицах списков
        $('table .checkall').on('change', function(event) {
            let self = $(this);
            self.closest('table').find('.checkthis').each(function(index, el) {
                $(el).prop('checked', self.prop('checked'));
            });
        });

        //Date fields

        $('.date-field.from-current-date').each(function(index, el) {
            $(el).datetimepicker({
                locale: 'ru',
                format: 'DD/MM/YYYY',
                defaultDate: moment.now(),
                minDate: moment.now()
            });
        });

        $('.date-field.edit-date').each(function(index, el) {
            $(el).datetimepicker({
                locale: 'ru',
                format: 'DD/MM/YYYY',
            });
        });

        $('.add_multi_field').on('click', function(event) {
            event.preventDefault();

            let template = _.template($($(this).data('template')).html());

            $(this).closest('.multi-fields').find('.multi-fields-container').append(template());
        });

        $('.multi-fields').on('click', '.remove_multi_field', function(event) {
            event.preventDefault();

            $(this).closest('.multi-field').remove();
        });

         $('.photo').filemanager('image');

        $('.select2').select2();

        $('.select2-multi').select2();

        $('#list-credit-cards').on('click', '.another-card', function(event) {
            event.preventDefault();
            $(this).children('span').toggleClass('hidden');
            $(this).closest('.contributions-details-item').find('.another-credit-cards').slideToggle(500);
            /* Act on the event */
        });

        //Tooltips
        $('body').on('mouseenter', '.admin-lists .list', function (event) {
            $('.tooltip').remove();
            $('[data-toggle="tooltip"]', this).tooltip();
        });
    },

    creditCalculator: {

        inputAmount: {},

        inputDays: {},

        amountSlider: {},

        daysSlider: {},

        first_credit_overpayment: 0,

        first_credit_return: 0,

        repeat_credit_overpayment: 0,

        repeat_credit_return: 0,

        first_credit_bid: 0,

        repeat_credit_bid: 0,

        first_credit_amount: 0,

        init: function(){

            if(!$('.credit-calculator').length)
                return;

            this.setProperies();
            //Sliders
            this.amountSlider.slider();

            this.daysSlider.slider();

            this.events();
        },

        setProperies: function(){

            this.inputAmount = $('.credit-calculator .material__input.amount');

            this.inputDays = $('.credit-calculator .material__input.days');

            this.amountSlider = $(".credit-calculator input.slider.amount");

            this.daysSlider = $(".credit-calculator input.slider.days");

            this.first_credit_overpayment = $(".credit-calculator .first_credit .overpayment");

            this.first_credit_return = $(".credit-calculator .first_credit .to_return");

            this.repeat_credit_overpayment = $(".credit-calculator .repeat_credit .overpayment");

            this.repeat_credit_return = $(".credit-calculator .repeat_credit .to_return");

            this.first_credit_bid = free_credit_bid;

            this.repeat_credit_bid = repeat_credit_bid;

            this.first_credit_amount = first_credit_amount;
        },

        events: function(){
            let self = this;

            $('.credit-calculator .material__input.amount, .credit-calculator .material__input.days').focus(function(event) {
                $(this).val('');
            });

            this.inputAmount.blur(function(event) {
                self.setAmount();
                self.calculate();
            });

            this.inputDays.blur(function(event) {
                self.setDays();
                self.calculate();
            });

            this.amountSlider.on('change', function(event) {
                self.setAmount();
                self.calculate();
            });

            this.daysSlider.on('change', function(event) {
                self.setDays();
                self.calculate();
            });

        },

        setAmount: function(){
            var inputVal = this.inputAmount.val();
            var sliderVal = this.amountSlider.slider('getValue');

            var min = this.amountSlider.slider('getAttribute', 'min');
            var max = this.amountSlider.slider('getAttribute', 'max');

            this.setValues(inputVal, sliderVal, min, max, 'amount');
        },

        setDays: function(){
            var inputVal = this.inputDays.val();
            var sliderVal = this.daysSlider.slider('getValue');

            var min = this.daysSlider.slider('getAttribute', 'min');
            var max = this.daysSlider.slider('getAttribute', 'max');

            this.setValues(inputVal, sliderVal, min, max, 'days');
        },

        setValues: function(inputVal, sliderVal, min, max, type){
            var value = 0;
            if(inputVal == '' || !$.isNumeric(inputVal) || inputVal < min){
                value = numeral(sliderVal).format('0');
            }
            else if(inputVal > max){
                value = numeral(max).format('0');
            }
            else{
                value = numeral(inputVal).format('0');
            }


            if(type == 'amount'){
                this.inputAmount.val(value+' грн.');
                this.amountSlider.slider('setValue', value);
                //Затемняем калькулятор
                this.first_credit_amount < value ? $('.credit-calculator-result').addClass('grey'):$('.credit-calculator-result').removeClass('grey');
            }

            if(type == 'days'){
                this.inputDays.val(value+this.getDayPostfix(value));
                this.daysSlider.slider('setValue', value);
            }
        },

        getDayPostfix: function(day){
            var plural_days = [' день', ' дня', ' дней'];
            var num = (day%10==1 && day%100!=11 ? 0 : (day%10>=2 && day%10<=4 && (day%100<10 || day%100>=20) ? 1 : 2));
            return plural_days[num];
        },

        calculate: function(){

            var amount = this.amountSlider.slider('getValue');
            var days = this.daysSlider.slider('getValue');

            var first_overpayment = numeral((amount * this.first_credit_bid * days)/100);
            var repeat_overpayment = numeral((amount * this.repeat_credit_bid * days)/100);

            this.first_credit_overpayment.text(first_overpayment.format('0.00'));
            this.first_credit_return.text(first_overpayment.add(amount).format('0.00'));

            this.repeat_credit_overpayment.text(repeat_overpayment.format('0.00'));
            this.repeat_credit_return.text(repeat_overpayment.add(amount).format('0.00'));
        },


    },

    mfoFilter: {

        inputAmount: {},

        inputDays: {},

        amountSlider: {},

        daysSlider: {},

        data: {
            'amount' : 0,
            'days' : 0,
            'no_procent' : 0,
            'age_from' : 0,
            'age_to' : 0,
            'order' : 'percent_desc',
            'type': 'full',
            'list': 0,
        },

        init: function(){
            if(!$('.mfo-filter').length)
                return;

            this.setProperties();
            //Sliders
            this.amountSlider.slider();

            this.daysSlider.slider();

            this.events();

        },

        events: function(){
            let self = this;

            $('.filter-slider .material__input.amount, .filter-slider .material__input.days').focus(function(event) {
                $(this).val('');
            });

            this.inputAmount.blur(function(event) {
                self.setAmount();
            });

            this.inputDays.blur(function(event) {
                self.setDays();
            });

            this.amountSlider.on('change', function(event) {
                self.setAmount();
            });

            this.daysSlider.on('change', function(event) {
                self.setDays();
            });


            $('.mfo-filter .btn-result').on('click', function(event) {
                $('#catalog-mfo').removeClass('fadeInLeft');
                self.parseData();

                axios.post('/ajax/mfo-filter', self.data)
                    .then(function (response) {

                        $('#catalog-mfo').html(response.data);
                        $('#catalog-mfo').addClass('fadeInLeft');

                    })
                    .catch(function (error) {
                        alert('Не удалось загрузить данные. Попробуйте ещё раз!');
                        console.log(error);
                    });
            });

            $('.mfo-filter .btn-clear').on('click', function(event) {
                self.clear();
            });
        },

        setProperties: function(){

            this.inputAmount = $('.filter-slider .material__input.amount');

            this.inputDays = $('.filter-slider .material__input.days');

            this.amountSlider = $(".filter-slider input.slider.amount");

            this.daysSlider = $(".filter-slider input.slider.days");

        },

        setAmount: function(){
            var inputVal = this.inputAmount.val();
            var sliderVal = this.amountSlider.slider('getValue');

            var min = this.amountSlider.slider('getAttribute', 'min');
            var max = this.amountSlider.slider('getAttribute', 'max');

            this.setValues(inputVal, sliderVal, min, max, 'amount');
        },

        setDays: function(){
            var inputVal = this.inputDays.val();
            var sliderVal = this.daysSlider.slider('getValue');

            var min = this.daysSlider.slider('getAttribute', 'min');
            var max = this.daysSlider.slider('getAttribute', 'max');

            this.setValues(inputVal, sliderVal, min, max, 'days');
        },

        setValues: function(inputVal, sliderVal, min, max, type){
            var value = 0;

            if(inputVal == '' || !$.isNumeric(inputVal)){
                value = numeral(sliderVal).format('0');
            }
            else if(inputVal > max){
                value = numeral(max).format('0');
            }
            else if(inputVal < min){
                value = numeral(min).format('0');
            }
            else{
                value = numeral(inputVal).format('0');
            }


            if(type == 'amount'){
                this.inputAmount.val(value+' грн.');
                this.amountSlider.slider('setValue', value);
            }

            if(type == 'days'){
                this.inputDays.val(value+this.getDayPostfix(value));
                this.daysSlider.slider('setValue', value);
            }
        },

        getDayPostfix: function(day){
            var plural_days = [' день', ' дня', ' дней'];
            var num = (day%10==1 && day%100!=11 ? 0 : (day%10>=2 && day%10<=4 && (day%100<10 || day%100>=20) ? 1 : 2));
            return plural_days[num];
        },

        parseData: function(){
            this.data.amount = this.amountSlider.slider('getValue');

            this.data.days =  this.daysSlider.slider('getValue');

            this.data.no_procent = $('.mfo-filter input[name=no_procent]').prop('checked');

            this.data.age_from = $('.mfo-filter input[name=age_from]').prop('checked');

            this.data.age_to = $('.mfo-filter input[name=age_to]').prop('checked');

            this.data.order = $('.mfo-filter select[name=order]').val();

            this.data.type = $('.mfo-filter input[name=type]').val();

            this.data.list = $('.mfo-filter input[name=list]').val();
        },

        clear: function(){
            this.data = {
                'amount' : 0,
                'days' : 0,
                'no_procent' : 0,
                'age_from' : 0,
                'age_to' : 0,
                'order' : 'percent_desc',
            };


            this.inputAmount.val(0);
            this.setAmount();

            this.inputDays.val(0);
            this.setDays();

            $('.mfo-filter input[name=no_procent]').prop('checked', false);

            $('.mfo-filter input[name=age_from]').prop('checked', false);

            $('.mfo-filter input[name=age_to]').prop('checked', false);

            $('.mfo-filter select[name=order]').val('percent_desc');


        }

    },

    bankFilter: {

        init: function(){
            if(!$('#search-bank').length)
                return;

            this.events();

        },

        events: function(){
            var self = this;


            $('#search-bank .btn-result').on('click', function(event) {
                self.search({
                    name: $('#search-bank #bank_name').val()
                });
            });

            $('#search-bank .search-letter').on('click', function(event) {
                self.search({
                    letter: $(this).data('letter')
                });
            });
        },

        search: function(data){
            console.log(data);
            $('#all_banks').removeClass('fadeInLeft');

            axios.post('/ajax/bank-filter', data)
            .then(function (response) {

                $('#all_banks').html(response.data);
                $('#all_banks').addClass('fadeInLeft');

            })
            .catch(function (error) {
                alert('Не удалось загрузить данные. Попробуйте ещё раз!');
                console.log(error);
            });
        },

    },

    creditCashFilter: {

        $filterContainer: {},
        $listContainer: {},

        inputAmount: {},

        inputDays: {},

        amountSlider: {},

        daysSlider: {},

        data: {
            'amount' : 0,
            'days' : 0,
        },

        init: function(){
            this.$filterContainer = $('#credit-cash-filter');

            if(!this.$filterContainer.length)
                return;

            this.$listContainer = $('#catalog-credit-cash');

            this.setProperties();
            //Sliders
            this.amountSlider.slider();

            this.daysSlider.slider();

            this.events();

        },

        events: function(){
            var self = this;

            $('.filter-slider .material__input.amount, .filter-slider .material__input.days').focus(function(event) {
                $(this).val('');
            });

            this.inputAmount.blur(function(event) {
                self.setAmount();
            });

            this.inputDays.blur(function(event) {
                self.setDays();
            });

            this.amountSlider.on('change', function(event) {
                self.setAmount();
            });

            this.daysSlider.on('change', function(event) {
                self.setDays();
            });


            this.$filterContainer.on('click', '.btn-result', function(event) {
                self.$listContainer.removeClass('fadeInLeft');
                self.parseData();

                axios.post('/ajax/credit-cash-filter', self.data)
                .then(function (response) {

                    self.$listContainer.html(response.data);
                    self.$listContainer.addClass('fadeInLeft');

                })
                .catch(function (error) {
                    alert('Не удалось загрузить данные. Попробуйте ещё раз!');
                    console.log(error);
                });
            });

            this.$filterContainer.on('click', '.btn-clear', function(event) {
                self.clear();
            });
        },

        setProperties: function(){

            this.inputAmount = $('.filter-slider .material__input.amount');

            this.inputDays = $('.filter-slider .material__input.days');

            this.amountSlider = $(".filter-slider input.slider.amount");

            this.daysSlider = $(".filter-slider input.slider.days");

        },

        setAmount: function(){
            var inputVal = this.inputAmount.val();
            var sliderVal = this.amountSlider.slider('getValue');

            var min = this.amountSlider.slider('getAttribute', 'min');
            var max = this.amountSlider.slider('getAttribute', 'max');

            this.setValues(inputVal, sliderVal, min, max, 'amount');
        },

        setDays: function(){
            var inputVal = this.inputDays.val();
            var sliderVal = this.daysSlider.slider('getValue');

            var min = this.daysSlider.slider('getAttribute', 'min');
            var max = this.daysSlider.slider('getAttribute', 'max');

            this.setValues(inputVal, sliderVal, min, max, 'days');
        },

        setValues: function(inputVal, sliderVal, min, max, type){
            var value = 0;

            if(inputVal == '' || !$.isNumeric(inputVal)){
                value = numeral(sliderVal).format('0');
            }
            else if(inputVal > max){
                value = numeral(max).format('0');
            }
            else if(inputVal < min){
                value = numeral(min).format('0');
            }
            else{
                value = numeral(inputVal).format('0');
            }


            if(type == 'amount'){
                this.inputAmount.val(value+' грн.');
                this.amountSlider.slider('setValue', value);
            }

            if(type == 'days'){
                this.inputDays.val(value+this.getDayPostfix(value));
                this.daysSlider.slider('setValue', value);
            }
        },

        getDayPostfix: function(day){
            var plural_days = [' месяц', ' месяца', ' месяцев'];
            var num = (day%10==1 && day%100!=11 ? 0 : (day%10>=2 && day%10<=4 && (day%100<10 || day%100>=20) ? 1 : 2));
            return plural_days[num];
        },

        parseData: function(){
            this.data.amount = this.amountSlider.slider('getValue');

            this.data.days = this.daysSlider.slider('getValue');
        },

        clear: function(){
            this.data = {
                'amount' : 0,
                'days' : 0,
            };

            this.inputAmount.val(0);
            this.setAmount();

            this.inputDays.val(0);
            this.setDays();

        }

    },

    creditCardsFilter: {

        $filterContainer: {},
        $listContainer: {},
        data: {
            'bank' : 0,
            'free_service' : false,
            'cashback' : false,
            'paypass' : false,
            'chip' : false,
            'mastercard' : false,
            'visa' : false,
        },


        init: function(){
            this.$filterContainer = $('#credit-cards-filter');

            if(!this.$filterContainer.length)
                return;

            this.$listContainer = $('#list-credit-cards');

            this.events();

        },

        events: function(){
            var self = this;


            this.$filterContainer.on('click', '.btn-result', function(event) {
                self.$listContainer.removeClass('fadeInLeft');
                self.parseData();

                axios.post('/ajax/credit-cards-filter', self.data)
                .then(function (response) {

                    self.$listContainer.html(response.data);
                    self.$listContainer.addClass('fadeInLeft');

                })
                .catch(function (error) {
                    alert('Не удалось загрузить данные. Попробуйте ещё раз!');
                    console.log(error);
                });
            });

            this.$filterContainer.on('click', '.btn-clear', function(event) {
                self.clear();
            });
        },

        parseData: function(){
            this.data.bank = $('#bank').val();
            this.data.free_service = $('#free_service').prop('checked');
            this.data.cashback = $('#cashback').prop('checked');
            this.data.paypass = $('#paypass').prop('checked');
            this.data.chip = $('#chip').prop('checked');
            this.data.mastercard = $('#mastercard').prop('checked');
            this.data.visa = $('#visa').prop('checked');
        },
    },

    share : {

        init: function(){
            this.events();
        },

        events: function(){
            self = this;
            $('body').on('click', '.share-btn', function(event) {
                event.preventDefault();

                if($(this).hasClass('facebook'))
                    self.facebook($(this));

                if($(this).hasClass('twitter'))
                    self.twitter($(this));

                if($(this).hasClass('telegram'))
                    self.telegram($(this));
            });
        },

        facebook: function($this){

            var data = this.data($this);

            var url  = "https://www.facebook.com/sharer/sharer.php?";

            if(data){
                    url += "p[title]="     + encodeURIComponent(data.title);
                    url += "&p[summary]="   + encodeURIComponent(data.text);
                    url += "&p[url]="       + encodeURIComponent(data.url);
                    url += "&p[images][0]=" + encodeURIComponent(data.img);

                this.popup(url);
            }
            else{
                url += "u="+ encodeURIComponent(location.href);
                this.popup(url);
            }

            return false;
        },

        twitter: function($this){

            var data = this.data($this);

            // https://twitter.com/intent/tweet?
            var url  = "https://twitter.com/share?";
            if(data){


                    url += "text="      + encodeURIComponent(data.text);
                    url += "&url="      + encodeURIComponent(data.url);
                    url += "&hashtags=" + "";
                    url += "&counturl=" + encodeURIComponent(data.url);

                this.popup(url);
            }
            else{
                url += "url="+location.href;
                this.popup(url);
            }

            return false;
        },
        vk: function($this){

            var data = this.data($this);

            var url  = "https://vkontakte.ru/share.php?";

            if(data){


                    url += "url="          + encodeURIComponent(data.url);
                    url += "&title="       + encodeURIComponent(data.title);
                    url += "&description=" + encodeURIComponent(data.text);
                    url += "&image="       + encodeURIComponent(data.img);
                    url += "&noparse=true";

                this.popup(url);
            }
            else{
                url += "url="+location.href;
                this.popup(url);
            }

            return false;
        },


        telegram:function($this){
            //https://telegram.me/share/url?url=$Link&text=$Title
            var data = this.data($this);
            var url  = "https://telegram.me/share/url?";
            if(data){
                    url += "url"       + encodeURIComponent(data.url);
                    url += "&text="     + encodeURIComponent(data.title);
                this.popup(url);
            }
            else{
                url  += "url="+location.href;
                this.popup(url);
            }

            return false;
        },

        data: function($this){

            if($this && $this.parent("div").attr("data-share-data") !== undefined){

                return $.parseJSON($this.parent("div").attr("data-share-data"));
            };

            return false;
        },
        popup: function(url){

            window.open(url, "", "toolbar=0, status=0, width=626, height=436");

            return false;
        }
    },


    ajaxPagination:{
        nextPageUrl: '',

        init: function(){
            if(!$('.load-more').length)
                return;

            this.nextPageUrl = nextPageUrl;
            this.events();
        },

        events: function(){
            let self = this;

            $('.load-more').on('click', function(event) {
                event.preventDefault();
                $(this).addClass('active');
                self.request();
            });
        },

        request: function(){
            let self = this;
            axios.get(this.nextPageUrl)
                .then(function (response) {
                    //console.log(response);
                    if(response.data.paginator.next_page_url === null){
                        $('.load-more').hide();
                    }

                    self.nextPageUrl = response.data.paginator.next_page_url;

                    $('.load-container').append(response.data.content);

                    $('.load-more').removeClass('active');
                    /*$('#catalog-mfo').html(response.data);
                    $('#catalog-mfo').addClass('fadeInLeft');*/
                })
                .catch(function (error) {
                    alert('Не удалось загрузить данные. Попробуйте ещё раз!');
                });
        }
    },

    loadScrollPost: {
        nothingLoad: false,
        bottomOffset : 3500,// отступ от нижней границы сайта, до которого должен доскроллить пользователь, чтобы подгрузились новые посты
        data: {
            except: {},//id постов + url + seo которые не загружать
            last_post: 0,//id последнего поста в списке
        },

        init: function(){
            if(!$('.post-list').length)
                return;

            this.data.except = $.parseJSON(loadedPosts);

            this.events();
        },

        events: function(){
            let self = this;
            $(document).scroll(function(){
                var docScrollTop = $(document).scrollTop();

                var winHeight = $(window).height();

                var winHeightHalf = winHeight/2;

                var fullHeight = docScrollTop + winHeight;

                var pointChange = docScrollTop + winHeightHalf;

                if( docScrollTop  > ($(document).height() - self.bottomOffset) && !$('body').hasClass('loading') && !self.nothingLoad){
                    self.loadPosts();
                }

                $.each( $('.post-list .single-post'), function(index, post) {
                    var $postBlock = $(post);
                    var postId = $postBlock.data('id');

                    var postBlockTopOffset = $postBlock.offset().top;

                    var postBlockBottomOffset = ($postBlock.height() + $postBlock.offset().top);

                    if(postBlockTopOffset > docScrollTop && postBlockTopOffset < pointChange){
                        self.changeUrl(postId);
                    }

                    if(postBlockBottomOffset > pointChange && postBlockBottomOffset < fullHeight){
                        self.changeUrl(postId);
                    }
                });

            });
        },

        changeUrl: function(postId){
            // Если url уже изменен выходим
            if (this.data.except[postId]['url'] == location.href)
                return;

            //Change page seo
            $('title').text(this.data.except[postId]['seo_title']);

            if(!$('meta[name = description]').length)
                $('head').append('<meta name="description" content="">');

            if(!$('meta[property="og:description"]').length)
                $('head').append('<meta property="og:description" content="">');


            //SEO
            $('meta[name = description]').attr('content', this.data.except[postId]['seo_description']);
            $('meta[name = keywords]').attr('content', this.data.except[postId]['seo_keywords']);
            $('link[rel = canonical]').attr('href', this.data.except[postId]['seo_canonical']);
            $('meta[name = robots]').attr('content', this.data.except[postId]['seo_robots']);

            //OpenGraph
            $('meta[property="og:title"]').attr('content', this.data.except[postId]['og_title']);
            $('meta[property="og:description"]').attr('content', this.data.except[postId]['og_description']);
            $('meta[property="og:url"]').attr('content', this.data.except[postId]['og_url']);


            //Change post url
            $.router.go(this.data.except[postId]['url'], 'post_id_'+postId);

            //Add to Google analitics
            //console.log(window.ga);
            if (window.ga) {

                ga('create', 'UA-143376033-2', 'news.nominal.com.ua');
                //ga('set', 'page', location.pathname);
                ga('send', 'pageview', location.pathname);
            }
        },


        loadPosts: function(){
            let self = this;
            $('body').addClass('loading');
            this.data.last_post = $('#post-list .single-post').last().data('id');
            axios.post('/ajax/load-more-posts', this.data)
            .then(function (response) {
                if(response.data.content == ''){
                    self.nothingLoad = true;
                    return;
                }
                $('#post-list').append(response.data.content);
                self.data.except = response.data.except;

                $('body').removeClass('loading');

            })
            .catch(function (error) {

                console.log(error);
                $('body').removeClass('loading');
            });
        }
    },


    comments: {
        container: {},

        data:{
            id: 0,
            type: '',
            parent_id: 0,
            message: '',
            email: '',
            name_sender: '',
        },

        valid: true,

        init: function(){
            this.container = $('#comments');

            if(!this.container.length)
                return;

            this.data.id = this.container.data('id');
            this.data.type = this.container.data('type');

            this.events();
        },

        events: function(){
            let self = this;

            this.container.on('submit', '#comment-form', function(event) {
                event.preventDefault();
                self.parseData();
                self.sendMessage();
            });

            this.container.on('click', '.write-comment-btn', function(event) {
                event.preventDefault();
                self.data.parent_id = 0;
                self.relocateForm($(this).closest('.comment-block-write'));
            });

            this.container.on('click', '.close-comment-btn', function(event) {
                event.preventDefault();
                $('#comment-form-block').slideUp(500);
            });

            this.container.on('click', '.answer-comment-btn', function(event) {
                event.preventDefault();
                var commentContainer = $(this).closest('.comment-block-view');
                self.data.parent_id = commentContainer.data('id');
                self.relocateForm(commentContainer);
            });
        },


        relocateForm: function($callElement){
            if($callElement.next('#comment-form-block').length){
                $('#comment-form-block').slideDown(500);
                return;
            }

            $formBlock = $('#comment-form-block').hide().remove();
            $callElement.after($formBlock);
            $formBlock.slideDown(500);
        },

        parseData: function(){
            this.data.message = this.container.find('#message').val();
            this.data.email = this.container.find('#email').val();
            this.data.name_sender = this.container.find('#name_sender').val();
        },

        hideErrors: function(){
            this.container.find('#message').removeClass('is-invalid');
            this.container.find('#email').removeClass('is-invalid');
            this.container.find('#name_sender').removeClass('is-invalid');
        },

        showErrors: function(errors){
            var messages = {
                'email' : 'Это поле должно содержать коректный Email адресс',
                'name_sender' : 'Это поле обязательно для заполнения',
                'message' : 'Это поле обязательно для заполнения'
            };

            for (var key in errors) {
                var field = this.container.find('#'+key);
                field.parent().find('.error-message').text(messages[key]);
                field.addClass('is-invalid');
            }

        },

        sendMessage: function(){
            let self = this;
            $commentForm = $('#comment-form');
            Gamma.block($commentForm);

            axios.post('/ajax/add-comment', this.data)
            .then(function (response) {
                self.hideErrors();

                if(response.data.errors !== false){
                    self.showErrors(response.data.errors);
                }
                else{
                    self.thanks();
                }
                $commentForm[0].reset();
                $('#comment-form-block').slideUp(500);
                Gamma.unblock($commentForm);
            })
            .catch(function (error) {
                alert('Не удалось отправить коментарий. Попробуйте ещё раз!');
                Gamma.unblock($commentForm);
                console.log(error);
            });
        },

        thanks: function(){
            bootbox.alert("<div class='mt-4'><strong >Ваш коментарий отправлен. Он появится после модерации.</strong></div>");
        }


    },

    faq: {
        multi_field_count: 0,

        init(){
            //Admin
            this.admin();
            //Front
            this.front();
        },

        admin(){
            var self = this;

            if(!$('#enable_faq').length)
                return;



            self.toggleAdminSlide($('#enable_faq').prop('checked'));

            self.multi_field_count = $('.faq-multi-field').length;

            $('#enable_faq').change(function (e){
                self.toggleAdminSlide($(this).prop('checked'));
            });

            //Multi fields
            $('.faq-multi-fields').on('click', '.faq-add_multi_field', function(event) {
                event.preventDefault();

                var template = _.template($($(this).data('template')).html());

                $(this).closest('.faq-multi-fields').find('.faq-multi-fields-container').append(template({
                    count : self.multi_field_count
                }));

                self.multi_field_count++;

                $('body').trigger('add_faq_field', this);
            });

            $('.faq-multi-fields').on('click', '.faq-remove_multi_field', function(event) {
                event.preventDefault();

                $(this).closest('.faq-multi-field').remove();
            });
        },

        toggleAdminSlide(slideToogle){
            slideToogle ? $('#collapseFaq').slideDown(500) : $('#collapseFaq').slideUp(500);
        },

        front(){

        }
    },

    sidebarToolgle: function(){
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });
    },





};

$(document).ready(function() {
    Gamma.init();
});

$(document).ready(function(){
    function getCookie(name) {
        var value = "; " + document.cookie;
        var parts = value.split("; " + name + "=");
        if (parts.length == 2) return parts.pop().split(";").shift();
    }

    if (getCookie('Nominal') == undefined){
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+ d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        //Parse URL
        var _GET = (function () {
            var _get = {};
            var re = /[?&]([^=&]+)(=?)([^&]*)/g;
            while (m = re.exec(location.search))
                _get[decodeURIComponent(m[1])] = (m[2] == '=' ? decodeURIComponent(m[3]) : !0);
            return _get
        })();
        var urlData = _GET;

        var cookieValue = getCookie('Nominal');
        var keyValue = getCookie('Nominal-GLG');

        if (urlData.sub1 == undefined){
            setCookie('Nominal', 'Organic', 1/5);

        } else if (cookieValue != 'undefined') {
            setCookie('Nominal', urlData.sub1, 1/5);
        };

        if (urlData.utm_term == undefined){
            setCookie('Nominal-GLG', 'NoKeyword', 1/5);
        } else if (keyValue != 'undefined') {
            setCookie('Nominal-GLG', urlData.utm_term, 1/5);
        };
    }
    //Рабочая версия(набрасывает автоматом параметры)
    /*$('.redirect').each(function () {
        $(this).attr('data-href', $(this).attr('data-href') + '&sub1=' + getCookie('Nominal') + '&sub2=' + getCookie('Nominal-GLG'));
    });*/
    //Временное решение
    $('.redirect').each(function () {
        $(this).attr('data-href', $(this).attr('data-href') + '&sub2=' + getCookie('Nominal-GLG'));
    });

    $('.redirect').click(function () {
        var url = $(this).data('href');
        if (url !== undefined) {

            var win = window.open(url, "_blank");
            setTimeout(function (){
                if(win.closed)
                    window.location.replace(url);
                else
                    win.focus();
            }, 1000);

            return false;
        }
    });
})

let Gamma = {

    init: function () {

        this.tabs();

        this.header();

        this.share.init();

        this.homePage.init();

        this.postPage.init();

    },

    block: function($element){
        $element.prepend('<div class="block-loader"><div class="block-loader-content"><i class="fa fa-cog fa-spin fa-3x fa-fw"></i></div></div>');
    },

    unblock: function($element){
        $element.find('.block-loader').remove();
    },



    tabs: function(){
        $('.tab').on('click', function (event) {
            event.preventDefault();

            if($(this).hasClass('tab-parent')){
                var $parent = $(this);
            }
            else{
                var $parent = $(this).closest('.tab-parent');
            }


            if($parent.hasClass('active'))
                return;

            var $container = $(this).closest('.tab-container');
            $container.find('.tab-parent').removeClass('active');
            $container.find('.tab-content').removeClass('active');

            $parent.addClass('active');

            $container.find($(this).data('target')).addClass('active');
        });
    },

    header: function(){
        $('.header-search a, .search-mob').on('click', function (event) {
            event.preventDefault();
            $('.header-search .fade-block').stop().fadeToggle(500);
        });

        $('.menu-mob').on('click', function (event) {
            $('.menu').stop().fadeToggle(500);
            $(this).toggleClass('open');
        });

        $('.menu-item.has-submenu').hover(function(){
                $(this).find('.dropdown-menu').fadeIn(300);
            },
            function(){
                $(this).find('.dropdown-menu').fadeOut(100);
            });
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

                if($(this).hasClass('tw'))
                    self.twitter($(this));

                if($(this).hasClass('tlg'))
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

    homePage: {
        init: function () {
            this.initSlider();
            this.subscribeNews.events();
        },

        initSlider: function () {
            $('#mfo-slider').slick({
                slidesToShow: 1,
                arrows: false,
                draggable: true,
            });
            $('#mfo-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                $('.nav-sl').removeClass('active');
                $('.nav-sl-'+nextSlide).addClass('active');
            });
            $('.prev-sl').on('click', function (event) {
                $('#mfo-slider').slick('slickPrev');
            });
            $('.next-sl').on('click', function (event) {
                $('#mfo-slider').slick('slickNext');
            });
            $('.nav-sl').on('click', function (event) {
                $('#mfo-slider').slick('slickGoTo', $(this).data('sl'));
            });
        },

        subscribeNews: {
            events: function(){
                var self = this;
                $('.subscription-email-btn').on('click', function (event) {
                    event.preventDefault();
                    $container = $(this).closest('.subscription-email');

                    var email = $container.find('.inp-email').val();

                    if(self.isEmail(email)){
                        $container.removeClass('error');
                        Gamma2.block($('.email-news'));
                        self.send(email);
                    }
                    else{
                        $container.addClass('error');
                    }
                });
            },
            isEmail: function(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            },
            send: function(email){
                axios.post('/ajax/subscribe-news', {'email':email})
                    .then(function (response) {

                        $('.subscription-email-msg').text(response.data.text);
                        Gamma2.unblock($('.email-news'));
                        $('.subscription-email-msg').fadeIn(500);
                        setTimeout(function () {
                            $('.subscription-email-msg').fadeOut(500);
                        }, 2000);
                    })
                    .catch(function (error) {
                        alert('Не удалось связаться с сервером. Попробуйте ещё раз!');
                        console.log(error);
                    });
            },
        }
    },

    postPage: {
        init: function (){
            this.loadScrollPost.init();
        },

        loadScrollPost: {
            nothingLoad: false,
            bottomOffset : 4500,// отступ от нижней границы сайта, до которого должен доскроллить пользователь, чтобы подгрузились новые посты
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

    }
};


$(document).ready(function() {
    Gamma.init();
});

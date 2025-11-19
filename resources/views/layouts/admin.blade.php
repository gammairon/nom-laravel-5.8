<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/storage/images/favicon.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/storage/images/favicon.png')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('css/app.css', 'assets') }}" rel="stylesheet">

</head>
<body  class="profile">
<section id="app-admin" class="wrapper">
    <nav id="sidebar" class="active">
        <div class="sidebar-header text-center">
            @if (Auth::user()->hasPrimary())
                <div class="avatar">
                    <img src="{{ Auth::user()->getPrimaryUrl()}}" alt="Avatar">
                </div>
            @endif
        </div>

        <ul class="list-unstyled navigation">
            <div class="list-group panel">
                <a href="{{ route('admin.account.edit') }}" class="list-group-item collapsed" data-parent="#sidebar"><i class="fa fa-address-card-o"></i> <span class="hidden-sm-down">Edit Account</span></a>

                <a href="{{ route('admin.seo.edit') }}" class="list-group-item collapsed" data-parent="#sidebar"><i class="fa fa-cogs" aria-hidden="true"></i> <span class="hidden-sm-down">SEO</span></a>


                <!-- USERS -->
                @role('admin')
                    <a href="#menu-users" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                        <i class="fa fa-users"></i>
                        <span class="hidden-sm-down">Users</span>
                    </a>
                    <div class="collapse" id="menu-users">
                        <a href="{{ route('admin.users.create') }}" class="list-group-item" data-parent="#menu-users">
                            <i class="fa fa-user-plus"></i>
                            <span class="hidden-sm-down">Add User</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="list-group-item" data-parent="#menu-users">
                            <i class="fa fa-list-alt"></i>
                            <span class="hidden-sm-down">User List</span>
                        </a>
                    </div>
                @endrole

                <!-- END  USERS -->

                <!-- COMMENTS -->
                <a href="#menu-comments" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-comments"></i>
                    <span class="hidden-sm-down">Comments</span>
                </a>
                <div class="collapse" id="menu-comments">
                    <a href="{{ route('admin.comments.new_list') }}" class="list-group-item" data-parent="#menu-comments">
                        <i class="fa fa-comments-o"></i>
                        <span class="hidden-sm-down">New Comments</span>
                    </a>
                    <a href="{{ route('admin.comments.index') }}" class="list-group-item" data-parent="#menu-comments">
                        <i class="fa fa-comments"></i>
                        <span class="hidden-sm-down">All Comments</span>
                    </a>
                </div>

                <!-- END  COMMENTS -->

                <!-- PAGES -->
                <a href="#menu-pages" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-file-powerpoint-o" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Pages</span>
                </a>
                <div class="collapse" id="menu-pages">
                    <a href="{{ route('admin.blog.pages.create') }}" class="list-group-item" data-parent="#menu-pages">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New Page</span>
                    </a>
                    <a href="{{ route('admin.blog.pages.index') }}" class="list-group-item" data-parent="#menu-pages">
                        <i class="fa fa-list-alt"></i>
                        <span class="hidden-sm-down">All Pages</span>
                    </a>
                </div>

                <!-- END  PAGES -->

                <!-- POSTS -->
                <a href="#menu-posts" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Posts</span>
                </a>
                <div class="collapse" id="menu-posts">
                    <a href="{{ route('admin.blog.posts.create') }}" class="list-group-item" data-parent="#menu-posts">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New Post</span>
                    </a>
                    <a href="{{ route('admin.blog.posts.index') }}" class="list-group-item" data-parent="#menu-posts">
                        <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                        <span class="hidden-sm-down">All Posts</span>
                    </a>

                    <!-- Category -->
                    <a href="{{ route('admin.blog.categories.create') }}" class="list-group-item" data-parent="#menu-posts">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New Category</span>
                    </a>
                    <a href="{{ route('admin.blog.categories.index') }}" class="list-group-item" data-parent="#menu-posts">
                        <i class="fa fa-list-alt"></i>
                        <span class="hidden-sm-down">All Categories</span>
                    </a>
                    <!--END Category -->

                    <!-- Tag -->
                    <a href="{{ route('admin.blog.tags.create') }}" class="list-group-item" data-parent="#menu-posts">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New Tag</span>
                    </a>
                    <a href="{{ route('admin.blog.tags.index') }}" class="list-group-item" data-parent="#menu-posts">
                        <i class="fa fa-tags" aria-hidden="true"></i>
                        <span class="hidden-sm-down">All Tags</span>
                    </a>
                    <!--END Tag -->

                </div>

                <!-- END  POSTS -->


                <!-- ORGANIZATIONS -->
                <a href="#menu-organizations" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-university" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Organizations</span>
                </a>
                <div class="collapse" id="menu-organizations">

                    <a href="{{ route('admin.organizations.mfo.index') }}" class="list-group-item" data-parent="#menu-organizations">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                        <span class="hidden-sm-down">All MFO</span>
                    </a>
                    <a href="{{ route('admin.organizations.mfo.create') }}" class="list-group-item" data-parent="#menu-organizations">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New MFO</span>
                    </a>
                    <a href="{{ route('admin.organizations.banks.index') }}" class="list-group-item" data-parent="#menu-organizations">
                        <i class="fa fa-university" aria-hidden="true"></i>
                        <span class="hidden-sm-down">All Banks</span>
                    </a>
                    <a href="{{ route('admin.organizations.banks.create') }}" class="list-group-item" data-parent="#menu-organizations">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New Bank</span>
                    </a>
                </div>

                <!-- END  ORGANIZATIONS -->

                <!-- PRODUCTS -->
                <a href="#menu-products" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-inbox" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Products</span>
                </a>
                <div class="collapse" id="menu-products">

                    @if (false)
                        <a href="{{ route('admin.products.mfo.index') }}" class="list-group-item" data-parent="#menu-products">
                            <i class="fa fa-usd" aria-hidden="true"></i>
                            <span class="hidden-sm-down">All MFO</span>
                        </a>
                        <a href="{{ route('admin.products.mfo.create') }}" class="list-group-item" data-parent="#menu-products">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span class="hidden-sm-down">Add New MFO</span>
                        </a>
                    @endif



                    <a href="{{ route('admin.products.credit-cards.index') }}" class="list-group-item" data-parent="#menu-products">
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                        <span class="hidden-sm-down">All Credit Cards</span>
                    </a>
                    <a href="{{ route('admin.products.credit-cards.create') }}" class="list-group-item" data-parent="#menu-products">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New Credit Card</span>
                    </a>

                    <a href="{{ route('admin.products.credit-cash.index') }}" class="list-group-item" data-parent="#menu-products">
                        <i class="fa fa-money" aria-hidden="true"></i>
                        <span class="hidden-sm-down">All Credit Cash</span>
                    </a>
                    <a href="{{ route('admin.products.credit-cash.create') }}" class="list-group-item" data-parent="#menu-products">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add New Credit Cash</span>
                    </a>
                </div>

                <!-- END  PRODUCTS -->

                <!-- LISTS -->
                <a href="#menu-lists" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="hidden-sm-down">Lists MFO</span>
                </a>
                <div class="collapse" id="menu-lists">

                    <a href="{{ route('admin.lists.mfo.index') }}" class="list-group-item" data-parent="#menu-lists">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span class="hidden-sm-down">All lists MFO</span>
                    </a>
                    <a href="{{ route('admin.lists.mfo.create') }}" class="list-group-item" data-parent="#menu-lists">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                        <span class="hidden-sm-down">Add new list MFO</span>
                    </a>
                </div>

                <!-- END  LISTS -->


                <!--  <a href="#menu1" class="list-group-item collapsed" data-toggle="collapse" data-parent="#sidebar" aria-expanded="false"><i class="fa fa-dashboard"></i> <span class="hidden-sm-down">Item 1</span> </a>
                <div class="collapse" id="menu1">
                    <a href="#menu1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 1 </a>
                    <div class="collapse" id="menu1sub1">
                        <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 1 a</a>
                        <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 2 b</a>
                        <a href="#menu1sub1sub1" class="list-group-item" data-toggle="collapse" aria-expanded="false">Subitem 3 c </a>
                        <div class="collapse" id="menu1sub1sub1">
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.1</a>
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub1">Subitem 3 c.2</a>
                        </div>
                        <a href="#" class="list-group-item" data-parent="#menu1sub1">Subitem 4 d</a>
                        <a href="#menu1sub1sub2" class="list-group-item" data-toggle="collapse"  aria-expanded="false">Subitem 5 e </a>
                        <div class="collapse" id="menu1sub1sub2">
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.1</a>
                            <a href="#" class="list-group-item" data-parent="#menu1sub1sub2">Subitem 5 e.2</a>
                        </div>
                    </div>
                    <a href="#" class="list-group-item" data-parent="#menu1">Subitem 2</a>
                    <a href="#" class="list-group-item" data-parent="#menu1">Subitem 3</a>
                </div> -->


            </div>

            </li>
        </ul>

    </nav>

    <div class="content ">
        <header class="header">
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
                <button type="button" id="sidebarCollapse" class="navbar-btn btn-primary active">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="content">
            @include('layouts.partials.flash')
            @yield('content')
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="{{ mix('js/app.js', 'assets') }}" ></script>

<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>

<script>
    var config = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        /*filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',*/
        removeDialogTabs: 'image:advanced',
    };

    getMethods = (obj) => Object.getOwnPropertyNames(obj).filter(item => typeof obj[item] === 'function')


    CKEDITOR.config.allowedContent = true;
    CKEDITOR.on('instanceReady', function(ev) {
        var editor = ev.editor;

        editor.dataProcessor.htmlFilter.addRules({
            elements : {
                a : function(element) {

                    if (!element.attributes.rel){
                        //gets content's a href values
                        var url = element.attributes.href;
                        //extract host names from URLs
                        var hostname = (new URL(url)).hostname;
                        if (hostname !== window.location.host && (hostname !=="nominal.com.ua" || hostname !=="news.nominal.com.ua") ) {
                            element.attributes.rel = 'nofollow';
                        }
                    }
                }
            }
        });
    });
    var ckeditor = jQuery('.html-editor').ckeditor(config);

    jQuery('body').bind('add_faq_field', function (event, field){
        $(field).closest('.faq-multi-fields').find('.faq-multi-fields-container').find('.faq-multi-field').last().find('.html-editor').ckeditor(config);
    });
    /*ckeditor.editor.on('insertElement', function(event) {
        //console.log(event);
        var element = event.data;
        /!*if (element.getName() == 'img') {
            element.addClass('lazyload');
        }*!/

    });*/

</script>
</body>
</html>

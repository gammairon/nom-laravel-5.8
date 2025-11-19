/*! lazysizes - v5.2.0-beta1 */
!function(a,b){var c=b(a,a.document);a.lazySizes=c,"object"==typeof module&&module.exports&&(module.exports=c)}("undefined"!=typeof window?window:{},function(a,b){"use strict";var c,d;if(function(){var b,c={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:!0,expFactor:1.5,hFac:.8,loadMode:2,loadHidden:!0,ricTimeout:0,throttleDelay:125};d=a.lazySizesConfig||a.lazysizesConfig||{};for(b in c)b in d||(d[b]=c[b])}(),!b||!b.getElementsByClassName)return{init:function(){},cfg:d,noSupport:!0};var e=b.documentElement,f=a.Date,g=a.HTMLPictureElement,h="addEventListener",i="getAttribute",j=a[h],k=a.setTimeout,l=a.requestAnimationFrame||k,m=a.requestIdleCallback,n=/^picture$/i,o=["load","error","lazyincluded","_lazyloaded"],p={},q=Array.prototype.forEach,r=function(a,b){return p[b]||(p[b]=new RegExp("(\\s|^)"+b+"(\\s|$)")),p[b].test(a[i]("class")||"")&&p[b]},s=function(a,b){r(a,b)||a.setAttribute("class",(a[i]("class")||"").trim()+" "+b)},t=function(a,b){var c;(c=r(a,b))&&a.setAttribute("class",(a[i]("class")||"").replace(c," "))},u=function(a,b,c){var d=c?h:"removeEventListener";c&&u(a,b),o.forEach(function(c){a[d](c,b)})},v=function(a,d,e,f,g){var h=b.createEvent("Event");return e||(e={}),e.instance=c,h.initEvent(d,!f,!g),h.detail=e,a.dispatchEvent(h),h},w=function(b,c){var e;!g&&(e=a.picturefill||d.pf)?(c&&c.src&&!b[i]("srcset")&&b.setAttribute("srcset",c.src),e({reevaluate:!0,elements:[b]})):c&&c.src&&(b.src=c.src)},x=function(a,b){return(getComputedStyle(a,null)||{})[b]},y=function(a,b,c){for(c=c||a.offsetWidth;c<d.minSize&&b&&!a._lazysizesWidth;)c=b.offsetWidth,b=b.parentNode;return c},z=function(){var a,c,d=[],e=[],f=d,g=function(){var b=f;for(f=d.length?e:d,a=!0,c=!1;b.length;)b.shift()();a=!1},h=function(d,e){a&&!e?d.apply(this,arguments):(f.push(d),c||(c=!0,(b.hidden?k:l)(g)))};return h._lsFlush=g,h}(),A=function(a,b){return b?function(){z(a)}:function(){var b=this,c=arguments;z(function(){a.apply(b,c)})}},B=function(a){var b,c=0,e=d.throttleDelay,g=d.ricTimeout,h=function(){b=!1,c=f.now(),a()},i=m&&g>49?function(){m(h,{timeout:g}),g!==d.ricTimeout&&(g=d.ricTimeout)}:A(function(){k(h)},!0);return function(a){var d;(a=!0===a)&&(g=33),b||(b=!0,d=e-(f.now()-c),d<0&&(d=0),a||d<9?i():k(i,d))}},C=function(a){var b,c,d=99,e=function(){b=null,a()},g=function(){var a=f.now()-c;a<d?k(g,d-a):(m||e)(e)};return function(){c=f.now(),b||(b=k(g,d))}},D=function(){var g,m,o,p,y,D,F,G,H,I,J,K,L=/^img$/i,M=/^iframe$/i,N="onscroll"in a&&!/(gle|ing)bot/.test(navigator.userAgent),O=0,P=0,Q=0,R=-1,S=function(a){Q--,(!a||Q<0||!a.target)&&(Q=0)},T=function(a){return null==K&&(K="hidden"==x(b.body,"visibility")),K||!("hidden"==x(a.parentNode,"visibility")&&"hidden"==x(a,"visibility"))},U=function(a,c){var d,f=a,g=T(a);for(G-=c,J+=c,H-=c,I+=c;g&&(f=f.offsetParent)&&f!=b.body&&f!=e;)(g=(x(f,"opacity")||1)>0)&&"visible"!=x(f,"overflow")&&(d=f.getBoundingClientRect(),g=I>d.left&&H<d.right&&J>d.top-1&&G<d.bottom+1);return g},V=function(){var a,f,h,j,k,l,n,o,q,r,s,t,u=c.elements;if((p=d.loadMode)&&Q<8&&(a=u.length)){for(f=0,R++;f<a;f++)if(u[f]&&!u[f]._lazyRace)if(!N||c.prematureUnveil&&c.prematureUnveil(u[f]))ba(u[f]);else if((o=u[f][i]("data-expand"))&&(l=1*o)||(l=P),r||(r=!d.expand||d.expand<1?e.clientHeight>500&&e.clientWidth>500?500:370:d.expand,c._defEx=r,s=r*d.expFactor,t=d.hFac,K=null,P<s&&Q<1&&R>2&&p>2&&!b.hidden?(P=s,R=0):P=p>1&&R>1&&Q<6?r:O),q!==l&&(D=innerWidth+l*t,F=innerHeight+l,n=-1*l,q=l),h=u[f].getBoundingClientRect(),(J=h.bottom)>=n&&(G=h.top)<=F&&(I=h.right)>=n*t&&(H=h.left)<=D&&(J||I||H||G)&&(d.loadHidden||T(u[f]))&&(m&&Q<3&&!o&&(p<3||R<4)||U(u[f],l))){if(ba(u[f]),k=!0,Q>9)break}else!k&&m&&!j&&Q<4&&R<4&&p>2&&(g[0]||d.preloadAfterLoad)&&(g[0]||!o&&(J||I||H||G||"auto"!=u[f][i](d.sizesAttr)))&&(j=g[0]||u[f]);j&&!k&&ba(j)}},W=B(V),X=function(a){var b=a.target;if(b._lazyCache)return void delete b._lazyCache;S(a),s(b,d.loadedClass),t(b,d.loadingClass),u(b,Z),v(b,"lazyloaded")},Y=A(X),Z=function(a){Y({target:a.target})},$=function(a,b){try{a.contentWindow.location.replace(b)}catch(c){a.src=b}},_=function(a){var b,c=a[i](d.srcsetAttr);(b=d.customMedia[a[i]("data-media")||a[i]("media")])&&a.setAttribute("media",b),c&&a.setAttribute("srcset",c)},aa=A(function(a,b,c,e,f){var g,h,j,l,m,p;(m=v(a,"lazybeforeunveil",b)).defaultPrevented||(e&&(c?s(a,d.autosizesClass):a.setAttribute("sizes",e)),h=a[i](d.srcsetAttr),g=a[i](d.srcAttr),f&&(j=a.parentNode,l=j&&n.test(j.nodeName||"")),p=b.firesLoad||"src"in a&&(h||g||l),m={target:a},s(a,d.loadingClass),p&&(clearTimeout(o),o=k(S,2500),u(a,Z,!0)),l&&q.call(j.getElementsByTagName("source"),_),h?a.setAttribute("srcset",h):g&&!l&&(M.test(a.nodeName)?$(a,g):a.src=g),f&&(h||l)&&w(a,{src:g})),a._lazyRace&&delete a._lazyRace,t(a,d.lazyClass),z(function(){var b=a.complete&&a.naturalWidth>1;p&&!b||(b&&s(a,"ls-is-cached"),X(m),a._lazyCache=!0,k(function(){"_lazyCache"in a&&delete a._lazyCache},9)),"lazy"==a.loading&&Q--},!0)}),ba=function(a){if(!a._lazyRace){var b,c=L.test(a.nodeName),e=c&&(a[i](d.sizesAttr)||a[i]("sizes")),f="auto"==e;(!f&&m||!c||!a[i]("src")&&!a.srcset||a.complete||r(a,d.errorClass)||!r(a,d.lazyClass))&&(b=v(a,"lazyunveilread").detail,f&&E.updateElem(a,!0,a.offsetWidth),a._lazyRace=!0,Q++,aa(a,b,f,e,c))}},ca=C(function(){d.loadMode=3,W()}),da=function(){3==d.loadMode&&(d.loadMode=2),ca()},ea=function(){if(!m){if(f.now()-y<999)return void k(ea,999);m=!0,d.loadMode=3,W(),j("scroll",da,!0)}};return{_:function(){y=f.now(),c.elements=b.getElementsByClassName(d.lazyClass),g=b.getElementsByClassName(d.lazyClass+" "+d.preloadClass),j("scroll",W,!0),j("resize",W,!0),j("pageshow",function(a){if(a.persisted){var c=b.querySelectorAll("."+d.loadingClass);c.length&&c.forEach&&l(function(){c.forEach(function(a){a.complete&&ba(a)})})}}),a.MutationObserver?new MutationObserver(W).observe(e,{childList:!0,subtree:!0,attributes:!0}):(e[h]("DOMNodeInserted",W,!0),e[h]("DOMAttrModified",W,!0),setInterval(W,999)),j("hashchange",W,!0),["focus","mouseover","click","load","transitionend","animationend"].forEach(function(a){b[h](a,W,!0)}),/d$|^c/.test(b.readyState)?ea():(j("load",ea),b[h]("DOMContentLoaded",W),k(ea,2e4)),c.elements.length?(V(),z._lsFlush()):W()},checkElems:W,unveil:ba,_aLSL:da}}(),E=function(){var a,c=A(function(a,b,c,d){var e,f,g;if(a._lazysizesWidth=d,d+="px",a.setAttribute("sizes",d),n.test(b.nodeName||""))for(e=b.getElementsByTagName("source"),f=0,g=e.length;f<g;f++)e[f].setAttribute("sizes",d);c.detail.dataAttr||w(a,c.detail)}),e=function(a,b,d){var e,f=a.parentNode;f&&(d=y(a,f,d),e=v(a,"lazybeforesizes",{width:d,dataAttr:!!b}),e.defaultPrevented||(d=e.detail.width)&&d!==a._lazysizesWidth&&c(a,f,e,d))},f=function(){var b,c=a.length;if(c)for(b=0;b<c;b++)e(a[b])},g=C(f);return{_:function(){a=b.getElementsByClassName(d.autosizesClass),j("resize",g)},checkElems:g,updateElem:e}}(),F=function(){!F.i&&b.getElementsByClassName&&(F.i=!0,E._(),D._())};return k(function(){d.init&&F()}),c={cfg:d,autoSizer:E,loader:D,init:F,uP:w,aC:s,rC:t,hC:r,fire:v,gW:y,rAF:z}});


(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
      localStorage.setItem('target_input', $(this).data('input'));
      localStorage.setItem('target_preview', $(this).data('preview'));
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (url, file_path) {
          //set the value of the desired input to image url
          var target_input = $('#' + localStorage.getItem('target_input'));
          target_input.val(file_path).trigger('change');

          //set or change the preview image src
          var target_preview = $('#' + localStorage.getItem('target_preview'));
          target_preview.attr('src', url).trigger('change');
      };
      return false;
    });
  }

})(jQuery);


/*
    plugin name: router
*/


(function($){

    var hasPushState = (history && history.pushState);
    var hasHashState = !hasPushState && ("onhashchange" in window) && false;
    var router = {};
    var routeList = [];
    var eventAdded = false;
    var currentUsedUrl = location.href; //used for ie to hold the current url
    var firstRoute = true;
    var errorCallback = function () {};

    // hold the latest route that was activated
    router.currentId = "";
    router.currentParameters = {};

    // Create a default error handler
    router.errorCallback = errorCallback;

    router.capabilities = {
        hash: hasHashState,
        pushState: hasPushState,
        timer: !hasHashState && !hasPushState
    };

    // reset all routes
    router.reset = function()
    {
        var router = {};
        var routeList = [];
        router.currentId = "";
        router.currentParameters = {};
    }

    router.add = function(route, id, callback)
    {

        /*if (typeof id == "function")
        {
            callback = id;
            delete id;
        }*/

        var isRegExp = typeof route == "object";

        if (!isRegExp)
        {

            // remove the last slash to unifiy all routes
            if (route.lastIndexOf("/") == route.length - 1)
            {
                route = route.substring(0, route.length - 1);
            }

            // if the routes where created with an absolute url ,we have to remove the absolut part anyway, since we cant change that much
            route = route.replace(location.protocol + "//", "").replace(location.hostname, "");
        }

        var routeItem = {
            route: route,
            callback: callback,
            type: isRegExp ? "regexp" : "string",
            id: id
        }

        routeList.push(routeItem);

        // we add the event listener after the first route is added so that we dont need to listen to events in vain
        if (!eventAdded)
        {
            bindStateEvents();
        }
    };

    router.addErrorHandler = function (callback)
    {
        this.errorCallback = callback;
    };

    function bindStateEvents()
    {
        eventAdded = true;

        // default value telling router that we havent replaced the url from a hash. yet.
        router.fromHash = false;


        if (hasPushState)
        {
            // if we get a request with a qualified hash (ie it begins with #!)
            if (location.hash.indexOf("#!/") === 0)
            {
                // replace the state
                var url = location.pathname + location.hash.replace(/^#!\//gi, "");
                history.replaceState({}, "", url);

                // this flag tells router that the url was converted from hash to popstate
                router.fromHash = true;
            }

            $(window).bind("popstate", handleRoutes);
        }
        else if (hasHashState)
        {
            $(window).bind("hashchange.router", handleRoutes);
        }
        else
        {
            // if no events are available we use a timer to check periodically for changes in the url
            setInterval(
                function()
                {
                    if (location.href != currentUsedUrl)
                    {
                        handleRoutes();
                        currentUsedUrl = location.href;
                    }
                }, 500
            );
        }

    }

    bindStateEvents();

    router.go = function(url, title)
    {
        if (hasPushState)
        {
            history.pushState({}, title, url);
            checkRoutes();
        }
        else
        {
            // remove part of url that we dont use
            url = url.replace(location.protocol + "//", "").replace(location.hostname, "");
            var hash = url.replace(location.pathname, "");

            if (hash.indexOf("!") < 0)
            {
                hash = "!/" + hash;
            }
            location.hash = hash;
        }
    };

    // do a check without affecting the history
    router.check = router.redo = function()
    {
        checkRoutes(true);
    };

    // parse and wash the url to process
    function parseUrl(url)
    {
        var currentUrl = url ? url : location.pathname;

        currentUrl = decodeURI(currentUrl);

        // if no pushstate is availabe we have to use the hash
        if (!hasPushState)
        {
            if (location.hash.indexOf("#!/") === 0)
            {
                currentUrl += location.hash.substring(3);
            }
            else
            {
                return '';
            }
        }

        // and if the last character is a slash, we just remove it
        currentUrl = currentUrl.replace(/\/$/, "");

        return currentUrl;
    }

    // get the current parameters for either a specified url or the current one if parameters is ommited
    router.parameters = function(url)
    {
        // parse the url so that we handle a unified url
        var currentUrl = parseUrl(url);

        // get the list of actions for the current url
        var list = getParameters(currentUrl);

        // if the list is empty, return an empty object
        if (list.length == 0)
        {
            router.currentParameters = {};
        }

        // if we got results, return the first one. at least for now
        else
        {
            router.currentParameters = list[0].data;
        }

        return router.currentParameters;
    }

    function getParameters(url)
    {

        var dataList = [];

       // console.log("ROUTES:");

        for(var i = 0, ii = routeList.length; i < ii; i++)
        {
            var route = routeList[i];

            // check for mathing reg exp
            if (route.type == "regexp")
            {
                var result = url.match(route.route);
                if (result)
                {
                    var data = {};
                    data.matches = result;

                    dataList.push(
                        {
                            route: route,
                            data: data
                        }
                    );

                    // saves the current route id
                    router.currentId = route.id;

                    // break after first hit
                    break;
                }
            }

            // check for mathing string routes
            else
            {
                var currentUrlParts = url.split("/");
                var routeParts = route.route.split("/");

                //console.log("matchCounter ", matchCounter, url, route.route)

                // first check so that they have the same amount of elements at least
                if (routeParts.length == currentUrlParts.length)
                {
                    var data = {};
                    var matched = true;
                    var matchCounter = 0;

                    for(var j = 0, jj = routeParts.length; j < jj; j++)
                    {
                        var isParam = routeParts[j].indexOf(":") === 0;
                        if (isParam)
                        {
                            data[routeParts[j].substring(1)] = decodeURI(currentUrlParts[j]);
                            matchCounter++;
                        }
                        else
                        {
                            if (routeParts[j] == currentUrlParts[j])
                            {
                                matchCounter++;
                            }
                        }
                    }

                    // break after first hit
                    if (routeParts.length == matchCounter)
                    {
                        dataList.push(
                            {
                                route: route,
                                data: data
                            }
                        );

                        // saved the current route id
                        router.currentId = route.id;
                        router.currentParameters = data;

                        break;
                    }

                }
            }

        }

        return dataList;
    }

    function checkRoutes()
    {
        var currentUrl = parseUrl(location.pathname);

        // check if something is catched
        var actionList = getParameters(currentUrl);

        // If no routes have been matched
        if (actionList.length == 0) {
            // Invoke error handler
            return router.errorCallback(currentUrl);
        }

        // ietrate trough result (but it will only kick in one)
        for(var i = 0, ii = actionList.length; i < ii; i++)
        {
            actionList[i].route.callback(actionList[i].data);
        }
    }


    function handleRoutes(e)
    {
        if (e != null && e.originalEvent && e.originalEvent.state !== undefined)
        {
            checkRoutes();
        }
        else if (hasHashState)
        {
            checkRoutes();
        }
        else if (!hasHashState && !hasPushState)
        {
            checkRoutes();
        }
    }



    if (!$.router)
    {
        $.router = router;
    }
    else
    {
        if (window.console && window.console.warn)
        {
            console.warn("jQuery.status already defined. Something is using the same name.");
        }
    }

})( jQuery );

document.addEventListener('lazybeforeunveil', function(e){
    var bg = e.target.getAttribute('data-bg');
    if(bg){
        e.target.style.backgroundImage = 'url(' + bg + ')';
    }
});

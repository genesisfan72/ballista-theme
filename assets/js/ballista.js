/**
 * ballista.js - the main js file for the Ballista theme.
 */
(jQuery)(function ($) {

    'use strict';

    var bodyEl = document.body,
        support = {transitions: Modernizr.csstransitions},

    // transition end event name
        transEndEventNames = {
            'WebkitTransition': 'webkitTransitionEnd',
            'MozTransition': 'transitionend',
            'OTransition': 'oTransitionEnd',
            'msTransition': 'MSTransitionEnd',
            'transition': 'transitionend'
        },
        transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
        onEndTransition = function (el, callback) {
            var onEndCallbackFn = function (ev) {
                if (support.transitions) {
                    if (ev.target != this) return;
                    this.removeEventListener(transEndEventName, onEndCallbackFn);
                }
                if (callback && typeof callback === 'function') {
                    callback.call(this);
                }
            };
            if (support.transitions) {
                el.addEventListener(transEndEventName, onEndCallbackFn);
            }
            else {
                onEndCallbackFn();
            }
        },
        gridEl = document.getElementById('theGrid'),
        sidebarEl = document.getElementById('theSidebar'),
        gridItemsContainer = gridEl.querySelector('section.grid'),
        topBar = document.querySelector('.top-bar'),
        gridItems = gridItemsContainer !== null ? gridItemsContainer.querySelectorAll('.grid__item') : null,
        menuCtrl = document.getElementById('menu-toggle'),
        menuCloseCtrl = sidebarEl.querySelector('.close-button'),
        $isoContainer = document.querySelector('.grid__item__container');


    function init() {
        initEvents();
        initIsotope();
        initSlider();

        if (classie.has(bodyEl, 'home')) {
            if (!!gridItems) {
                [].slice.call(gridItems).forEach(function (item, pos) {
                    setTimeout(function () {
                        classie.removeClass(item, 'transparent');
                        item.addEventListener('click', function (ev) {
                            ev.preventDefault();
                            var href = this.getAttribute('data-href');
                            var topBar = document.querySelector(".top-bar");
                            classie.remove(topBar, 'loaded');
                            onEndTransition(topBar, function () {
                                location.href = href;
                            });
                        });
                    }, 200 * pos);
                });
            }
        }

        var headers = document.querySelectorAll('.page__hero, .contact__hero, .header-image');
        [].slice.call(headers).forEach(function (item, pos) {
            setTimeout(function () {
                classie.removeClass(item, 'transparent');
            }, 300);
        });

        classie.addClass(topBar, 'loaded');
    }

    function initIsotope() {
        if ($isoContainer !== null) {
            jQuery($isoContainer).isotope({
                itemSelector: '.grid__item',
                layout: 'masonry'
            });
        }
    }

    function initSlider() {
        $('.flexslider').flexslider({
            slideshow: false,
            controlNav: false
        });
    }

    function initEvents() {
        // hamburger menu button (mobile) and close cross
        if (typeof menuCtrl !== 'undefined' && menuCtrl !== null) {
            menuCtrl.addEventListener('click', function () {
                if (!classie.has(sidebarEl, 'sidebar--open')) {
                    classie.add(sidebarEl, 'sidebar--open');
                }
            });
        }

        if (typeof menuCloseCtrl !== 'undefined' && menuCloseCtrl !== null) {
            menuCloseCtrl.addEventListener('click', function () {
                if (classie.has(sidebarEl, 'sidebar--open')) {
                    classie.remove(sidebarEl, 'sidebar--open');
                }
            });
        }

        document.addEventListener('click', function (e) {
            var csFilter = document.querySelectorAll('.case-study-filter'), i;
            for (i = 0; i < csFilter.length; i++) {
                classie.remove(csFilter[i], 'selected');
            }
            classie.add(e.target, 'selected');

            var filterValue = e.target.getAttribute('data-filter');
            if ($isoContainer !== null) {
                $($isoContainer).isotope({filter: filterValue});
            }
        }, false);

        document.addEventListener('change', function (e) {
            if (classie.has(e.target, 'input__field--nao')) {
                if (e.target.value.length > 0)
                    classie.add(e.target.parentElement, 'input--filled');
                else
                    classie.remove(e.target.parentElement, 'input--filled');
            }
        }, false);

    }

    // Kick things off
    init();

});
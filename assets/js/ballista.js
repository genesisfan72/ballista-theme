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
        sideBar = document.querySelector('.sidebar'),
        gridItems = gridItemsContainer !== null ? gridItemsContainer.querySelectorAll('.grid__item') : null,
        menuCtrl = document.getElementById('menu-toggle'),
        menuCloseCtrl = sidebarEl.querySelector('.close-button'),
        isoContainer = document.querySelector('.grid__item__container'),
        allSlides = document.querySelectorAll('.slides li');


    function init() {
        initEvents();
        initIsotope();
        initSlider();
        checkCommentAuthor();

        if (classie.has(bodyEl, 'home')) {
            if (!!gridItems) {
                [].slice.call(gridItems).forEach(function (item, pos) {
                    setTimeout(function () {
                        classie.removeClass(item, 'transparent');
                    }, 200 * pos);
                });
            }
        }

        setTimeout(function() {
            if (topBar) {
                classie.addClass(topBar, 'loaded');
            }
            classie.addClass(sideBar, 'loaded');
        }, 500);

        var headers = document.querySelectorAll('.page__hero, .contact__hero, .header-image');
        [].slice.call(headers).forEach(function (item, pos) {
            setTimeout(function () {
                classie.removeClass(item, 'transparent');
            }, 300);
        });
    }

    function initIsotope() {
        if (isoContainer !== null && classie.hasClass(bodyEl, 'home')) {
            jQuery(isoContainer).isotope({
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

    function checkCommentAuthor() {
        var comments = document.querySelectorAll('.comment-meta');
        [].slice.call(comments).forEach(function (comment) {
            console.log(comment);
            var editLinks = comment.querySelectorAll('.comment-edit-link');
            [].slice.call(editLinks).forEach(function (link) {
                var replyLinks = comment.querySelectorAll('.comment-reply');
                [].slice.call(replyLinks).forEach(function(reply) {
                    classie.add(reply, 'hidden');
                });
            });
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
            if (classie.has(e.target, 'case-study-filter')) {
                var filterValue = e.target.getAttribute('data-filter').substr(1);

                var csFilter = document.querySelectorAll('.case-study-filter'), i;
                for (i = 0; i < csFilter.length; i++) {
                    classie.remove(csFilter[i], 'selected');
                }
                classie.add(e.target, 'selected');

                if (document.querySelectorAll('.full-page-display').length > 0) {
                    var slidesNode = document.getElementById("flexSlides");
                    while (slidesNode.firstChild) {
                        slidesNode.removeChild(slidesNode.firstChild);
                    }

                    [].slice.call(allSlides).forEach(function (item, pos) {
                        if (filterValue === 'grid__item') { // all
                            slidesNode.appendChild(item);
                        }
                        else if (classie.hasClass(item, filterValue)) {
                                slidesNode.appendChild(item);
                        }
                    });

                    $('.flexslider').removeData("flexslider");
                    $('.flexslider').flexslider({
                        slideshow: false,
                        controlNav: false
                    });
                }
                else {
                    if (isoContainer !== null && classie.hasClass(bodyEl, 'home')) {
                        $(isoContainer).isotope({filter: "." + filterValue});
                    }
                }
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
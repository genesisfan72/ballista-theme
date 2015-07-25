/**
 * ballista.js - the main js file for the Ballista theme.
 */
(jQuery)(function($) {

    'use strict';

	var bodyEl = document.body,
		docElem = window.document.documentElement,
		support = { transitions: Modernizr.csstransitions },

		// transition end event name
		transEndEventNames = { 'WebkitTransition': 'webkitTransitionEnd', 'MozTransition': 'transitionend', 'OTransition': 'oTransitionEnd', 'msTransition': 'MSTransitionEnd', 'transition': 'transitionend' },
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		onEndTransition = function( el, callback ) {
			var onEndCallbackFn = function( ev ) {
				if( support.transitions ) {
					if( ev.target != this ) return;
					this.removeEventListener( transEndEventName, onEndCallbackFn );
				}
				if( callback && typeof callback === 'function' ) { callback.call(this); }
			};
			if( support.transitions ) {
				el.addEventListener( transEndEventName, onEndCallbackFn );
			}
			else {
				onEndCallbackFn();
			}
		},
		gridEl = document.getElementById('theGrid'),
		sidebarEl = document.getElementById('theSidebar'),
		gridItemsContainer = gridEl.querySelector('section.grid'),
		//contentItemsContainer = gridEl.querySelector('section.content'),
        //contentItemsScrollWrap = contentItemsContainer.querySelector('.scroll-wrap'),
        gridItems = gridItemsContainer !== null ? gridItemsContainer.querySelectorAll('.grid__item') : null,
		//contentItems = contentItemsContainer.querySelectorAll('.content__item'),
		//closeCtrl = contentItemsContainer.querySelector('.close-button'),
		//current = -1,
		lockScroll = false, xscroll, yscroll,
		//isAnimating = false,
		menuCtrl = document.getElementById('menu-toggle'),
		menuCloseCtrl = sidebarEl.querySelector('.close-button'),
        //topBar = gridEl.querySelector('.top-bar'),
        $isoContainer = document.querySelector('.grid__item__container');



	/**
	 * gets the viewport width and height
	 * based on http://responsejs.com/labs/dimensions/
	 */
	//function getViewport( axis ) {
	//	var client, inner;
	//	if( axis === 'x' ) {
	//		client = docElem['clientWidth'];
	//		inner = window['innerWidth'];
	//	}
	//	else if( axis === 'y' ) {
	//		client = docElem['clientHeight'];
	//		inner = window['innerHeight'];
	//	}
    //
	//	return client < inner ? inner : client;
	//}
	function scrollX() { return window.pageXOffset || docElem.scrollLeft; }
	function scrollY() { return window.pageYOffset || docElem.scrollTop; }

	function init() {
		initEvents();
        initIsotope();
        initSlider();

        if (classie.has( bodyEl, 'home')) {
            if (!!gridItems) {
                [].slice.call(gridItems).forEach(function (item, pos) {
                    setTimeout(function () {
                        classie.removeClass(item, 'transparent');
                        //$(self).removeClass('transparent');
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
        [].slice.call(headers).forEach(function(item, pos) {
            setTimeout(function () {
                classie.removeClass(item, 'transparent');
                //$(item).removeClass('transparent');
            }, 300);
        });
        //$('.page__hero, .contact__hero, .header-image').each(function(i) {
        //    var self = this;
        //    setTimeout(function () {
        //        $(self).removeClass('transparent');
        //    }, 300);
        //});

        $('.top-bar').addClass('loaded');
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
            controlNav : false
        });
    }

	function initEvents() {
        if (typeof gridItems !== 'undefined' && gridItems !== null) {
            [].slice.call(gridItems).forEach(function (item, pos) {
                // grid item click event
                /*
                item.addEventListener('click', function (ev) {

                    ev.preventDefault();
                    if (isAnimating || current === pos) {
                        return false;
                    }
                    isAnimating = true;
                    // index of current item
                    current = pos;
                    // simulate loading time..
                    classie.add(item, 'grid__item--loading');
                    classie.add(topBar, 'animate');

                    setTimeout(function () {
                        classie.add(item, 'grid__item--animate');
                        location.href = item.dataset.href;
                        //$.ajax({
                        //    type: 'POST',
                        //    data: {'post_id': item.dataset.id},
                        //    dataType: 'html',
                        //    url: '/wp-content/themes/ballista/post-loop-handler.php',
                        //    success: function (data) {
                        //        setTimeout(function () {
                        //            loadContent(item, data);
                        //        }, 500);
                        //    }
                        //});
                    }, 1000);
                });
                */
            });
        }

		// keyboard esc - hide content
		//document.addEventListener('keydown', function(ev) {
		//	if(!isAnimating) {
		//		var keyCode = ev.keyCode || ev.which;
		//		if( keyCode === 27 ) {
		//			ev.preventDefault();
		//			if ("activeElement" in document)
    		//			document.activeElement.blur();
		//			hideContent();
		//		}
		//	}
		//} );

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
                $($isoContainer).isotope({ filter: filterValue });
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

    //function loadCaseStudy(id) {
    //    $.ajax({
    //        type: 'POST',
    //        data: {'post_id': id},
    //        dataType: 'html',
    //        url: '/wp-content/themes/ballista/post-loop-handler.php',
    //        success: function (data) {
    //            setTimeout(function () {
    //                loadContent($(this).get(0), data);
    //            }, 500);
    //        }
    //    });
    //}

	//function loadContent(item, data) {
    //
     //   // set the content
     //   contentItemsScrollWrap.innerHTML = data;
     //   var contentItem = contentItemsContainer.querySelector('.content__item'),
     //       closeCtrl = contentItemsContainer.querySelector('.close-button');
    //
     //   closeCtrl.addEventListener('click', function() {
     //       // hide content
     //       hideContent();
     //   });
    //
	//	// add expanding element/placeholder
	//	var dummy = document.createElement('div');
	//	dummy.className = 'placeholder';
    //
	//	// set the width/height and position
	//	dummy.style.WebkitTransform = 'translate3d(' + (item.offsetLeft - 5) + 'px, ' + (item.offsetTop - 5) + 'px, 0px) scale3d(' + item.offsetWidth/gridItemsContainer.offsetWidth + ',' + item.offsetHeight/getViewport('y') + ',1)';
	//	dummy.style.transform = 'translate3d(' + (item.offsetLeft - 5) + 'px, ' + (item.offsetTop - 5) + 'px, 0px) scale3d(' + item.offsetWidth/gridItemsContainer.offsetWidth + ',' + item.offsetHeight/getViewport('y') + ',1)';
    //
	//	// add transition class
	//	classie.add(dummy, 'placeholder--trans-in');
    //
	//	// insert it after all the grid items
	//	gridItemsContainer.appendChild(dummy);
    //
	//	// body overlay
	//	classie.add(bodyEl, 'view-single');
    //
	//	setTimeout(function() {
	//		// expands the placeholder
	//		dummy.style.WebkitTransform = 'translate3d(-5px, ' + (scrollY() - 5) + 'px, 0px)';
	//		dummy.style.transform = 'translate3d(-5px, ' + (scrollY() - 5) + 'px, 0px)';
	//		// disallow scroll
	//		window.addEventListener('scroll', noscroll);
	//	}, 25);
    //
	//	onEndTransition(dummy, function() {
	//		// add transition class
	//		classie.remove(dummy, 'placeholder--trans-in');
	//		classie.add(dummy, 'placeholder--trans-out');
	//		// position the content container
	//		contentItemsContainer.style.top = scrollY() + 'px';
	//		// show the main content container
	//		classie.add(contentItemsContainer, 'content--show');
	//		// show content item:
	//		classie.add(contentItem, 'content__item--show');
	//		// show close control
	//		classie.add(closeCtrl, 'close-button--show');
	//		// sets overflow hidden to the body and allows the switch to the content scroll
	//		classie.addClass(bodyEl, 'noscroll');
    //
	//		isAnimating = false;
	//	});
    //
	//}

	//function hideContent() {
	//	var gridItem = gridItems[current],
     //       contentItem = contentItemsContainer.querySelector('.content__item'),
     //       closeCtrl = contentItemsContainer.querySelector('.close-button');
    //
	//	classie.remove(contentItem, 'content__item--show');
	//	classie.remove(contentItemsContainer, 'content--show');
	//	classie.remove(closeCtrl, 'close-button--show');
	//	classie.remove(bodyEl, 'view-single');
    //
	//	setTimeout(function() {
	//		var dummy = gridItemsContainer.querySelector('.placeholder');
    //
	//		classie.removeClass(bodyEl, 'noscroll');
    //
	//		dummy.style.WebkitTransform = 'translate3d(' + gridItem.offsetLeft + 'px, ' + gridItem.offsetTop + 'px, 0px) scale3d(' + gridItem.offsetWidth/gridItemsContainer.offsetWidth + ',' + gridItem.offsetHeight/getViewport('y') + ',1)';
	//		dummy.style.transform = 'translate3d(' + gridItem.offsetLeft + 'px, ' + gridItem.offsetTop + 'px, 0px) scale3d(' + gridItem.offsetWidth/gridItemsContainer.offsetWidth + ',' + gridItem.offsetHeight/getViewport('y') + ',1)';
    //
	//		onEndTransition(dummy, function() {
	//			// reset content scroll..
	//			contentItem.parentNode.scrollTop = 0;
	//			gridItemsContainer.removeChild(dummy);
	//			classie.remove(gridItem, 'grid__item--loading');
	//			classie.remove(gridItem, 'grid__item--animate');
     //           classie.remove(topBar, 'animate');
	//			lockScroll = false;
	//			window.removeEventListener( 'scroll', noscroll );
	//		});
    //
	//		// reset current
	//		current = -1;
	//	}, 25);
	//}

	function noscroll() {
		if(!lockScroll) {
			lockScroll = true;
			xscroll = scrollX();
			yscroll = scrollY();
		}
		window.scrollTo(xscroll, yscroll);
	}

    // Kick things off
	init();

});
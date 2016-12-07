/* globals $:false */
var width = $(window).width(),
    height = $(window).height(),
    content,
    ticker_title,
    flashTimeout,
    $slider = null,
    flkty = null,
    isMobile = false,
    $root = '/catsanddogs';
$(function() {
    var app = {
        init: function() {
            $(window).resize(function(event) {
                app.sizeSet();
            });
            $(document).ready(function($) {
                $body = $('body');
                $header = $('header');
                $container = $('#container');
                $page_title = $("#page-title");
                $ticker = $("#ticker");
                History.Adapter.bind(window, 'statechange', function() {
                    var State = History.getState();
                    console.log(State);
                    content = State.data;
                    if (content.type == 'project') {
                        $body.addClass('project loading');
                    }
                    app.loadContent(State.url, $container);
                });
                $body.on('click', '[data-target]', function(e) {
                    $el = $(this);
                    target = $el.data('target');
                    e.preventDefault();
                    if (target == "index") {
                        e.preventDefault();
                        app.goIndex();
                    } else if (target == "slide" && $slider) {
                        var slide = $el.data('slide');
                        $slider.flickity('selectCell', '[data-slide-id="' + slide + '"]', true, true);
                        $body.addClass('slider-mode');
                        app.sizeSet();
                    } else if (target == "sliderclose") {
                        $body.removeClass('slider-mode');
                        $body.removeClass('black-mode');
                        $el.addClass('to-black').removeClass('to-white');
                        app.sizeSet();
                    } else {
                        // History.pushState({
                        //     type: $el.data('target'),
                        //     title: $el.data('title'),
                        //     id: $el.data('id')
                        // }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                        app.loadContent($el.attr('href'), $container);
                    }
                    // //test push
                    // History.pushState({
                    //     type: 'page',
                    //     title: $el.data('title'),
                    //     id: $el.data('id')
                    // }, $el.data('title') + " | " + $sitetitle, $el.attr('href'));
                });
                $body.on('click', '#switch', function(e) {
                    $el = $(this);
                    e.preventDefault();
                    if ($el.hasClass('to-black')) {
                        $body.addClass('black-mode');
                        $el.removeClass('to-black').addClass('to-white');
                    } else {
                        $body.removeClass('black-mode');
                        $el.addClass('to-black').removeClass('to-white');
                    }
                });
                $body.on('click', '[data-filter]', function(e) {
                    $el = $(this);
                    filter = $el.data('filter');
                    e.preventDefault();
                    if (filter == 'all') {
                        if ($body.hasClass('portfolio-mode')) {
                            $body.addClass('slider-mode');
                        }
                    }
                });
                $body.on({
                    mouseenter: function() {
                        if (!isMobile) {
                            var id = $(this).data('hover-id');
                            var img = $(this).data('hover-image');
                            $('#artists-menu [data-hover-id="' + id + '"]').addClass('active');
                            if (img) {
                                $('#image-hover').show().attr('src', img);
                                if ($(this).parent().is(':last-of-type')) {
                                    $('#image-hover').css('top', -$('#image-hover').outerHeight());
                                } else {
                                    $('#image-hover').css('top', 0);
                                }
                            }
                        }
                    },
                    mouseleave: function() {
                        if (!isMobile) {
                            $('#artists-menu [data-hover-id]').removeClass('active');
                            $('#image-hover').hide().attr('src', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==');
                        }
                    }
                }, '#artists-list [data-hover-id]');
                $body.on({
                    mouseenter: function() {
                        if (!isMobile) {
                            var title = $(this).data('hover-title');
                            app.tickerChange(title, true);
                        }
                    },
                    mouseleave: function() {
                        if (!isMobile) {
                            app.tickerChange(ticker_title, true);
                        }
                    }
                }, '#container .project a');
                //esc
                $(document).keyup(function(e) {
                    if (e.keyCode === 27) app.goIndex();
                });
                //left
                $(document).keyup(function(e) {
                    if (e.keyCode === 37 && $slider) app.goPrev($slider);
                });
                //right
                $(document).keyup(function(e) {
                    if (e.keyCode === 39 && $slider) app.goNext($slider);
                });
                app.mouseNav();
                app.loadSlider();
                $(window).load(function() {
                    app.fitText();
                    app.tickerLoad();
                    // setTimeout(function(){
                    //   $(".loader").hide();
                    // },100);
                    setTimeout(function() {
                        $(".loader").hide();
                    }, 150);
                });
            });
        },
        sizeSet: function() {
            width = $(window).width();
            height = $(window).height();
            if (width <= 770 || Modernizr.touch) isMobile = true;
            app.fitTextContainer();
            app.positionContainer();
            if (isMobile) {
                if (width >= 770) {
                    //location.reload();
                }
            }
        },
        positionContainer: function() {
            var headerH = $header.outerHeight();
            var artistsMenuH = $('#artists-menu').css('top', headerH).outerHeight();
            $container.css('marginTop', headerH + artistsMenuH);
        },
        fitText: function() {
            setTimeout(function() {
                $page_title.bigtext({
                    maxfontsize: 250
                });
                window.dispatchEvent(new Event('resize'));
                app.fitTextContainer();
            }, 50);
        },
        fitTextContainer: function() {
            $page_title.height($page_title.find('span').height() * (1 - 0.07));
            setTimeout(function() {
                $page_title.height($page_title.find('span').height() * (1 - 0.07));
                app.positionContainer();
            }, 150);
        },
        tickerText: function(q, text, flash, reset) {
            var span;
            flash ? span = "<span class='banner_text flash'>" + text + "</span>" : span = "<span class='banner_text'>" + text + "</span>";
            var ticker_data = span.times(q);
            if (reset) {
                $('#ticker-inner').empty();
            }
            $('#ticker-inner').append(ticker_data);
            // if (flash) {
            //     clearTimeout(flashTimeout);
            //     $ticker.removeClass('flash').addClass('flash');
            //     flashTimeout = setTimeout(function() {
            //         $ticker.removeClass('flash');
            //     }, 1000);
            // }
        },
        tickerChange: function(text, flash) {
            //ticker_title = text;
            //$ticker.data('tick', ticker_title);
            app.tickerText(50, text, flash, true);
        },
        tickerLoad: function() {
            ticker_title = $ticker.data('tick');
            app.tickerText(50, ticker_title, false, true);
            $ticker.scrollForever({
                speed: 0.7,
                container: '#ticker-inner',
                inner: '.banner_text'
            });
        },
        mouseNav: function(event) {
            $(window).mousemove(function(event) {
                if (!isMobile) {
                    if ($body.hasClass('artist') || $body.hasClass('project') || $body.data('id') == 'artists') {
                        posX = event.pageX;
                        posY = event.pageY;
                        if (posX < width / 2 - 50) {
                            $body.removeClass('hover-right').addClass('hover-left');
                        } else if (posX > width / 2 + 50) {
                            $body.removeClass('hover-left').addClass('hover-right');
                        }
                        var value = 'translate3d(' + posX + 'px,' + posY + 'px,0)';
                        $('#image-hover').css('transform', value);
                    }
                }
            });
        },
        loadSlider: function() {
            $slider = $('.slider').flickity({
                cellSelector: '.cell',
                imagesLoaded: true,
                //lazyLoad: 2,
                setGallerySize: false,
                //percentPosition: false,
                accessibility: false,
                wrapAround: true,
                prevNextButtons: false,
                pageDots: false,
                draggable: Modernizr.touchevents
            });
            flkty = $slider.data('flickity');
            $bottombar = $('#bottom-bar');
            //HASH SLIDES
            // if ($slider && flkty) {
            //     var hash = window.location.hash.substr(1);
            //     $slider.flickity('selectCell', '[data-id="' + hash + '"]', true, true);
            //     var count = $(flkty.selectedElement).attr('data-id');
            //     window.location.hash = count;
            // }
            $slider.on('select.flickity', function() {
                // count = $(flkty.selectedElement).attr('data-id');
                // window.location.hash = count;
                var projectTitle = $(flkty.selectedElement).attr('data-project-title');
                if (typeof projectTitle !== typeof undefined && projectTitle !== false) {
                    $bottombar.html(projectTitle);
                }
                var adjCellElems = $slider.flickity('getAdjacentCellElements', 2);
                $(adjCellElems).find('.lazyimg').addClass('lazyload');
            });
            // $lazyload = $('.lazyimg');
            // if (isMobile) {
            //     $lazyload.addClass('lazyload');
            // }
            $slider.on('staticClick.flickity', function(event, pointer, cellElement, cellIndex) {
                if (!cellElement) {
                    return;
                }
                app.goPrev($slider);
            });
            $slider.click(function(event) {
                if (!isMobile) {
                    if ($body.hasClass('hover-left')) {
                        app.goPrev($slider);
                    } else {
                        app.goNext($slider);
                    }
                }
            });
        },
        goNext: function($slider) {
            $slider.flickity('next', true);
        },
        goPrev: function($slider) {
            $slider.flickity('previous', true);
        },
        goIndex: function() {
            History.pushState({
                type: 'index'
            }, $sitetitle, window.location.origin + $root);
        },
        menuHideFix: function() {
            $header.addClass('hide');
            setTimeout(function() {
                $header.removeClass('hide');
            }, 1000);
        },
        loadContentAjax: function(url, target) {
            // $body.addClass('leaving');
            // app.menuHideFix();
            // $slider = null;
            // $lazyload = null;
            // setTimeout(function() {
            //     $(target).load(url + ' #container .inner', function(response) {
            //         $body.scrollTop(0);
            //         $body.attr('data-id', content.id);
            //         app.tickerChange(content.title);
            //         setTimeout(function() {
            //             // if (content.type == 'album') {
            //             //     $body.attr('class', 'album');
            //             // } else if (content.type == 'page') {
            //             //     $body.attr('class', 'page');
            //             // }
            //             //app.sizeSet();
            //             $(window).trigger('resize');
            //         }, 100);
            //         setTimeout(function() {
            //             $body.removeClass('leaving');
            //         }, 150);
            //         if (content.type == 'album') {
            //             $body.attr('class', 'album leaving');
            //             app.plyr(false);
            //             app.loadSlider();
            //         } else if (content.type == 'page') {
            //             $body.attr('class', 'page leaving');
            //             app.plyr(false);
            //         } else {
            //             $body.attr('class', '');
            //             app.plyr(true);
            //             if (players && players.length > 0) {
            //                 players[0].on('ready', function(event) {
            //                     players[0].play();
            //                 });
            //             }
            //         }
            //     });
            // }, 300);
        },
        loadContent: function(url, target) {
            $body.addClass('leaving');
            app.menuHideFix();
            setTimeout(function() {
                window.location = url;
            }, 0);
        },
        deferImages: function() {
            var imgDefer = document.getElementsByTagName('img');
            for (var i = 0; i < imgDefer.length; i++) {
                if (imgDefer[i].getAttribute('data-src')) {
                    imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                }
            }
        }
    };
    app.init();
});
String.prototype.times = function(n) {
    return Array.prototype.join.call({
        length: n + 1
    }, this);
};
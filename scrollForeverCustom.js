(function($) {
    // plugin name: scrollForever
    // plugin author: caibaojian
    // plugin url: http://caibaojian.com/scrollForever
    // plugin demo: http://caibaojian.com/demo/scrollForever/
    // license: MIT
    $.fn.scrollForever = function(options) {
        var defaults = {
            placeholder: 0, //非连续滚动时每次的滑动距离，可以自定义，如果没有自定义则根
            dir: 'left', //滚动方向，left & top
            container: 'ul', //外层对象
            inner: 'li', //内部元素
            speed: 1000, //非连续滚动速度
            delayTime: 0, //滚动间隔
            continuous: true, //是否连续
            num: 1, //非连续一次滚动的数量
            randomSpeed: false
        };
        var opts = $.extend({}, defaults, options);
        var placeHolder = opts.placeholder;
        var dir = opts.dir;
        var speed = opts.speed;
        var Time = opts.Time;
        var num = opts.num;
        var randomSpeed = opts.randomSpeed;
        var delayTime = opts.delayTime;
        var scrollTime, resizeTimer;
        return this.each(function() {
            var obj = $(this);
            var container = obj.find(opts.container);
            var inner = container.find(opts.inner);
            var len = inner.length;
            var randomSpeedValue = Math.random() + 0.5;
            var distance, scrollDistance = 0,
                innerWidth, innerHeight;
            //滚动前的准备工作
            function setScroll() {
                innerWidth = inner.outerWidth();
                innerHeight = inner.outerHeight();
                containerWidth = container.outerWidth();
                windowWidth = $(window).width();
                if (opts.continuous) {
                    if (dir == 'left') {
                        if (containerWidth < windowWidth) {
                            inner.clone().appendTo(container);
                            containerWidth = container.outerWidth();
                        }
                        distance = containerWidth - $(window).width();
                    } else if (dir == 'top') {
                        distance = innerHeight * len;
                        container.css('height', 2 * distance);
                        if (cloneFlag) {
                            inner.clone().appendTo(container);
                            cloneFlag = false;
                        }
                    }
                } else {
                    if (dir == 'left') {
                        placeHolder = placeHolder != 0 ? placeHolder : innerWidth * num;
                        distance = innerWidth * (len + 1);
                        container.css('width', distance);
                    } else if (dir == 'top') {
                        placeHolder = placeHolder != 0 ? placeHolder : innerHeight * num;
                        distance = innerHeight * (len + 1);
                        container.css('height', distance);
                    }
                }
            }
            $(window).on("resize", function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(setScroll, 250);
            })
            setScroll();

            function autoScroll() {
                if (opts.continuous) {
                    //无缝不间歇滚动
                    if (dir == 'left') {
                        if (scrollDistance >= distance) {
                            scrollDistance = 0;
                            var value = 'translate3d(0,0,0)';
                            container.css('transform', value);
                        } else {
                            var value = 'translate3d(-' + scrollDistance + 'px,0,0)';
                            container.css('transform', value);
                            if (randomSpeed) {
                                scrollDistance += randomSpeedValue;
                            } else {
                                scrollDistance += speed;
                            }
                        }
                    } else if (dir == 'top') {
                        scrollDistance = obj.scrollTop();
                        if (scrollDistance >= distance) {
                            obj.scrollTop(0);
                        } else {
                            obj.scrollTop(scrollDistance + 1);
                        }
                    }
                } else {
                    //非连续滚动，间断无缝滚动
                    if (dir == 'left') {
                        container.animate({
                            transform: 'translate3d(-' + placeHolder + 'px,0,0)'
                        }, speed, function() {
                            container.css({
                                transform: 'translate3d(0,0,0)'
                            }).find(opts.inner + ":lt(" + num + ")").appendTo(container);
                        });
                    } else if (dir == 'top') {
                        container.animate({
                            transform: 'translate3d(-' + placeHolder + 'px,0,0)'
                        }, speed, function() {
                            container.css({
                                transform: 'translate3d(0,0,0)'
                            }).find(opts.inner + ":lt(" + num + ")").appendTo(container);
                        });
                    }
                }
            }
            //滚动函数
            var aTime = opts.continuous == true ? 20 : 2000;
            delayTime = delayTime == 0 ? aTime : delayTime;
            scrollTime = setInterval(autoScroll, delayTime);
            // obj.hover(function() {
            //     clearInterval(scrollTime);
            // }, function() {
            //     scrollTime = setInterval(autoScroll, delayTime);
            // });
        });
    };
})(jQuery);
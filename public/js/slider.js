var slider = {
    // DOM CACHE
    $slider : $('#slider'),
    $slideContainer : $('.slides'),
    $slides : $('.slide'),
    $slideNext : $('#slider-next'),
    $slidePrevious : $('#slider-previous'),
    $slidePauseIcon : $('#slider-pause-icon'),
    // nr of images
    slideLength : 0,
    // define interval
    interval : null,
    // animation setup
    myWith : 758,
    animationSpeed : 1500,
    pause : 4000,
    currentSlide : 1,
    isPaused : false
};
slider.init = function(){
    // call the ajax method, that starts the slider
    slider.ajax();
}
slider.startSlider = function() {
    slider.interval = setInterval(function() {
            slider.$slideContainer.animate({'margin-left': '-='+slider.myWith}, slider.animationSpeed, function() {
                if (++slider.currentSlide === slider.slideLength) {
                    slider.currentSlide = 1;
                    slider.$slideContainer.css('margin-left', 0);
                }
            });
        }, slider.pause);
};
slider.pauseSlider = function() {
    clearInterval(slider.interval);
}
slider.ajax = function() {
        $.ajax({
                url: 'index.php',
                method: 'GET',
                data: 'page=ajax&action=getGallery'
            }).done(function(data) {
                var data = $.parseJSON(data);
                slider.slideLength = data.length;

                for (var i = 0; i < data.length - 1; i++){
                    slider.$slider.find('.slides').append('<li class="slide"><img src="'+data[i]+'"/></li>');
                }
                slider.$slider.find('.slides').append('<li class="slide"><img src="'+data[0]+'"/></li>');

                slider.startSlider();
        });
}
slider.nextSlide = function() {
    slider.$slideContainer.animate({'margin-left': '-='+slider.myWith}, slider.animationSpeed, function() {
                    if (++slider.currentSlide === slider.slideLength) {
                        slider.currentSlide = 1;
                        slider.$slideContainer.css('margin-left', 0);
                    }
    });
};
slider.previousSlide = function() {
    if (slider.currentSlide !== 1) {
        slider.currentSlide--;
        slider.$slideContainer.animate({'margin-left': '+='+slider.myWith}, slider.animationSpeed);
    }
};
slider.onMouseEnter = function() {
    slider.pauseSlider();
    slider.$slideNext.css('opacity', 0);
    slider.$slideNext.css('display', 'block');
    slider.$slideNext.fadeTo(400, 0.4);

    slider.$slidePrevious.css('opacity', 0);
    slider.$slidePrevious.css('display', 'block');
    slider.$slidePrevious.fadeTo(400, 0.4);

    slider.$slidePauseIcon.css('opacity', 0);
    slider.$slidePauseIcon.css('display', 'block');
    slider.$slidePauseIcon.fadeTo(400, 0.4);

};
slider.onMouseLeave = function() {
    if(!slider.isPaused) {
        slider.startSlider();
        slider.$slidePauseIcon.fadeTo(400, 0);
        // slider.$slidePauseIcon.css('display', 'none');

        slider.$slideNext.fadeTo(400, 0);
        // slider.$slideNext.css('display', 'none');

        slider.$slidePrevious.fadeTo(400, 0);
        // slider.$slidePrevious.css('display', 'none');
    } else {
        slider.$slideNext.fadeTo(400, 0);
        // slider.$slideNext.css('display', 'none');

        slider.$slidePrevious.fadeTo(400, 0);
        // slider.$slidePrevious.css('display', 'none');
    }

};
slider.onClickPause = function() {
    if (slider.isPaused === true) {
        slider.isPaused = false;
        slider.$slidePauseIcon.html('&#10073;&#10073;');
    } else {
        slider.isPaused = true;
        slider.$slidePauseIcon.html('&#9654');
    }
};

// EVENTS
slider.$slider.on('mouseenter', slider.onMouseEnter)
              .on('mouseleave', slider.onMouseLeave);
slider.$slidePauseIcon.on('mouseenter', function() { slider.$slidePauseIcon.fadeTo(300, 0.8) })
                      .on('mouseleave', function() { slider.$slidePauseIcon.fadeTo(300, 0.4) });
slider.$slideNext.on('mouseenter', function() { slider.$slideNext.fadeTo(300, 0.8) })
                 .on('mouseleave', function() { slider.$slideNext.fadeTo(300, 0.4) });
slider.$slidePrevious.on('mouseenter', function() { slider.$slidePrevious.fadeTo(300, 0.8) })
                     .on('mouseleave', function() { slider.$slidePrevious.fadeTo(300, 0.4) });
slider.$slideNext.on('click', slider.nextSlide);
slider.$slidePrevious.on('click', slider.previousSlide);
slider.$slidePauseIcon.on('click', slider.onClickPause);

// start it!
slider.init();
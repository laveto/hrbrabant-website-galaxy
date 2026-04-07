common.View.create('canvas.blocks.custom.leftTextSliderRight.Block', {

    customSlider: {
        animation: {
            busy: false,
        },
        slidesToShow: 3, // Currently support has not been checked for more/less items
        autoplay: {
            active: false,
            timeout: 4000,
            interrupted: {
                active: false
            },
        },
        scrollSlideHeight: 50,
        isDragging: false,
        startPosition: {
            x: 0, y: 0
        },
        currentPosition: {
            x: 0, y: 0
        }
    },

    onDOMLoad()
    {
        this.initCustomSlider();
    },

    initCustomSlider()
    {
        let $slider = this.element.find('.slider');

        // Set first slide as active
        $slider.find('.slide-wrapper > :first-child').addClass('active');
        this.customSliderAssignClasses('prev', $slider.find('.slide-wrapper > .active'), 1);

        // Check if autoplay is turned on and also check for user interaction for interrupting it
        this.customSliderAutoPlay($slider);

        $slider
            .find('.prev')
                .on('click', () => this.customSliderPrevButton($slider, event))
                .end()
            .find('.next')
                .on('click', () => this.customSliderNextButton($slider, event))
                .end()

            .on('touchstart', (event) => this.customSliderTouchStart(event))
            .on('mousedown', (event) => this.customSliderMouseDown(event))

            .on('mousemove', (event) => this.customSliderMouseMove($slider, event))
            .on('touchmove', (event) => this.customSliderTouchMove($slider, event), {'passive': false})

            .on('mouseup touchend', (event) => this.customSliderUp(event));
    },

    customSliderAutoPlay($slider)
    {
        if( $slider.data('autoplay') !== undefined ) {
            this.customSlider.autoplay.active = $slider.data('autoplay');
        }

        if( !this.customSlider.autoplay.active ) {
            return false;
        }

        setInterval(() => {
            if( !this.customSlider.autoplay.interrupted.active ) {
                this.customSliderNext($slider);
            }
        }, this.customSlider.autoplay.timeout);
    },

    customSliderPrevButton($slider, event)
    {
        this.customSliderPrev($slider);

        event.preventDefault();
        return false;
    },

    customSliderPrev($slider)
    {
        if( this.customSliderAnimationBusy() ) {
            return;
        }

        // Assign 'nth-' classes, so we can update the styling
        this.customSliderResetClasses($slider);
        this.customSliderAssignClasses('previous', $slider.find('.slide-wrapper > .active'), 1);

        setTimeout(() => {
            this.customSlider.animation.busy = false;
        }, 300);
        // $slider.find('.slide-wrapper > :last-child').fadeOut(300, 'swing', () => {
        //     return $slider.find('.slide-wrapper > :last-child').prependTo($slider.find('.slide-wrapper')).hide();
        // }).fadeIn(200, 'swing', () => {
        //     $slider.find('.slide-wrapper > :first-child').css('pointer-events', 'auto');
        //     this.customSlider.animation.busy = false;
        // });
    },

    customSliderNextButton($slider, event)
    {
        this.customSliderNext($slider);

        event.preventDefault();
        return false;
    },

    customSliderNext($slider)
    {
        if( this.customSliderAnimationBusy() ) {
            return;
        }

        // Assign 'nth-' classes, so we can update the styling
        this.customSliderResetClasses($slider);
        this.customSliderAssignClasses('next', $slider.find('.slide-wrapper > .active'), 1);

        setTimeout(() => {
            this.customSlider.animation.busy = false;
        }, 300);

        // return $slider.find('.slide-wrapper > :first-child').fadeOut(300, 'swing', () => {
        //     return $slider.find('.slide-wrapper > :first-child').appendTo($slider.find('.slide-wrapper')).hide();
        // }).fadeIn(200, 'swing', () => {
        //     $slider.find('.slide-wrapper > :first-child').css('pointer-events', 'auto');
        //     this.customSlider.animation.busy = false;
        // });
    },

    customSliderResetClasses($slider)
    {
        $slider.find('.slide-wrapper').children().removeClass (function (index, css) {
            return (css.match (/(^|\s)nth-\S+/g) || []).join(' '); // Remove all 'nth-' classes
        });
    },

    customSliderAssignClasses(previousOrNext, element, depth)
    {
        if (depth > this.customSlider.slidesToShow) {
            return;
        }

        let newElement = null;

        if( previousOrNext === 'previous' && depth === 1 ) {
            // Get next element, or first one if next doesn't exist
            newElement = element.prev().length ? element.prev() : element.siblings().last();
        } else {
            // Get previous element, or last one if next doesn't exist
            newElement = element.next().length ? element.next() : element.siblings().first();
        }

        // Add active class?
        if( depth === 1 ) {
            newElement.addClass('active');
            element.addClass('converting');
            element.removeClass('active');

            setTimeout(() => {
                element.removeClass('converting');
            }, 300);
        }

        if( !newElement.is('[class*="nth-"]') ) {
            newElement.addClass('nth-' + depth);
        }

        this.customSliderAssignClasses(previousOrNext, newElement, depth + 1); // Recursive call
    },

    customSliderAnimationBusy()
    {
        if( this.customSlider.animation.busy ) {
            return true;
        }

        this.customSlider.animation.busy = true;

        return false;
    },

    customSliderTouchStart(event)
    {
        this.customSlider.startPosition.x = event.touches[0].clientX;
        this.customSlider.startPosition.y = event.touches[0].clientY;

        this.customSliderClick();
    },

    customSliderMouseDown(event)
    {
        this.customSlider.startPosition.x = event.clientX;
        this.customSlider.startPosition.y = event.clientY;

        this.customSliderClick();
    },

    customSliderClick()
    {
        this.customSlider.isDragging = true;

        // Interrupt autoplay
        this.customSlider.autoplay.interrupted.active = true;
        clearTimeout(this.customSlider.autoplay.interrupted.timeout);
    },

    customSliderMouseMove($slider, event)
    {
        if (!this.customSlider.isDragging) {
            return;
        }

        this.customSlider.currentPosition.x = event.clientX;
        this.customSlider.currentPosition.y = event.clientY;

        this.customSliderMove($slider);
    },

    customSliderTouchMove($slider, event)
    {
        if (!this.customSlider.isDragging) {
            return;
        }

        this.customSlider.currentPosition.x = event.touches[0].clientX;
        this.customSlider.currentPosition.y = event.touches[0].clientY;

        this.customSliderMove($slider);

        event.preventDefault();
        return false;
    },

    customSliderMove($slider)
    {
        // Check difference between scrolled amount
        const deltaY = Math.abs(this.customSlider.currentPosition.y - this.customSlider.startPosition.y);
        const slidesToScroll = Math.round(deltaY / this.customSlider.scrollSlideHeight);

        if( slidesToScroll >= 1 && this.customSlider.currentPosition.y > this.customSlider.startPosition.y ) {
            this.customSliderNext($slider);

            // Reset current start position so we redo the code
            this.customSliderUpdateStartPosition();
        } else if( slidesToScroll >= 1 && this.customSlider.currentPosition.y < this.customSlider.startPosition.y ) {
            this.customSliderPrev($slider);

            // Reset current start position so we redo the code
            this.customSliderUpdateStartPosition();
        }
    },

    customSliderUpdateStartPosition()
    {
        this.customSlider.startPosition.x = this.customSlider.currentPosition.x;
        this.customSlider.startPosition.y = this.customSlider.currentPosition.y;
    },

    customSliderUp(event)
    {
        this.customSlider.isDragging = false;

        // Reset interrupted autoplay after x time
        this.customSlider.autoplay.interrupted.timeout = setTimeout(() => {
            this.customSlider.autoplay.interrupted.active = false;
        }, this.customSlider.autoplay.timeout);
    },

    initSwiperSlider()
    {
        let $slider = this.element.find('.swiper-container');
        const swiper = new Swiper($slider.get(0), {
            initialSlide: $slider.find('.swiper-wrapper .swiper-slide:last-child').index(),

            loop: $slider.data('autoplay'),

            effect: 'coverflow',
            direction: 'vertical',
            slideToClickedSlide: true,
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: -5,
                stretch: 250,
                depth: 150,
                modifier: 1,
                slideShadows: false
            },
            freeMode:false,
            freeModeSticky:true,
            on: {
                slideChange: function (swiperInstance) {
                    const secondPrevIndex = swiperInstance.realIndex - 2;

                    // Remove the 'swiper-slide-secondprev' class from all slides
                    swiperInstance.slides.forEach((slide) => {
                        slide.classList.remove('swiper-slide-secondprev');
                    });

                    // Add the 'swiper-slide-secondprev' class to the second previous slide if it exists
                    if (secondPrevIndex >= 0) {
                        swiperInstance.slides[secondPrevIndex].classList.add('swiper-slide-secondprev');
                    }
                },
                slideChangeTransitionEnd: function (slider) {
                    const slides = this.slides;
                    slides.forEach((slide) => {
                        slide.style.zIndex = "";
                    });
                    const activeSlide = slides[this.activeIndex];
                    const prevSlide = slides[this.previousIndex];
                    activeSlide.style.zIndex = 2;
                    prevSlide.style.zIndex = 1;
                }
            },
        });
    }

});

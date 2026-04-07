common.View.create('canvas.blocks.custom.vacancySlider.Block', {

    onDOMLoad()
    {
        this.initSlider();
    },

    initSlider()
    {
        let $slider = this.element.find('.swiper-container');

        const swiper = new Swiper($slider.get(0), {
            slidesPerView: 1.2,
            spaceBetween: 10,
            navigation: {
                nextEl: this.element.find('.button-next').get(0),
                prevEl: this.element.find('.button-prev').get(0),
                disabledClass: 'opacity-50 cursor-not-allowed',
            },

            a11y: {
                prevSlideMessage: 'Vorige slide',
                nextSlideMessage: 'Volgende slide',
            },

            breakpoints: {
                // when window width is >= 640px
                640: {
                    slidesPerView: 2.2,
                    spaceBetween: 30,
                },

                // when window width is >= 640px
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    }

});

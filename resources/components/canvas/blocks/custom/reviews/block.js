import Swiper from 'swiper/bundle';

import 'swiper/css/bundle';

common.View.create('canvas.blocks.custom.reviews.Block', {

    onDOMLoad()
    {
        this.initSlider();
    },

    initSlider()
    {
        let $slider = this.element.find('.swiper-container');

        const swiper = new Swiper($slider.get(0), {
            slidesPerView: 1,
            spaceBetween: 30,
            autoHeight: true,
            navigation: {
                prevEl: $slider.find('.button-prev').get(0),
                nextEl: $slider.find('.button-next').get(0),
            },
        });
    }

});

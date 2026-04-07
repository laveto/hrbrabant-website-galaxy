common.View.create('canvas.blocks.custom.sponsorSlider.Block', {

    onDOMLoad()
    {
        this.initSlider();
    },

    initSlider()
    {
        this.element.find('.owl-carousel')
            .owlCarousel({
                loop: !!this.element.find('.owl-carousel').data('autoplay'),
                items: 6,
                autoplay: !!this.element.find('.owl-carousel').data('autoplay'),
                slideTransition: 'linear',
                autoplaySpeed: this.element.find('.owl-carousel').data('autoplay') ? 6000 : 0,
                smartSpeed: this.element.find('.owl-carousel').data('autoplay') ? 6000 : 0,
                margin: 30,
                touchDrag: false,
                mouseDrag: false,
                responsive: {
                    0: { items: 1, margin: 10 },
                    480: { items: 3 },
                    768: { items: 5, margin: 30 },
                    992: { items: 6 }
                },
                nav: true,
                navText: [this.element.find('.owl-prev'), this.element.find('.owl-next')],
                dots: false,
            });


        this.element.find('.owl-carousel').trigger('play.owl.autoplay');
    }

});

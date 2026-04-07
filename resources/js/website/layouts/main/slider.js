common.View.create('website::layouts.main.Slider', {

    onDOMLoad() {
        // Not needed (yet?)
        //this.initSlider();
    },

    initSlider() {
        new Swiper(this.element.get(0), {
            spaceBetween: 10,
        });
    }
});

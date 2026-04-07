common.View.create('website::layouts.Main', {

    onDOMLoad()
    {
        this.initNavbar();
    },

    initNavbar()
    {
        // Give parent .active when has a .active subitem
        $('.navbar-nav .dropdown-menu > .dropdown-item.active').each(function(){
            $(this).parents('.nav-item').find('.nav-link').addClass('active');
        });
    },
});

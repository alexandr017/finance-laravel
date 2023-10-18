$(function(){

    var post_loader = {

        current__thisement: $('.author-info'),

        status_bar_block: $('.content'),

        status_parent_block: window,

        block_top: null,

        ready_load: true,

        posts: [],

        category_id: null,

        init: function(category_id, current_post){

            this.category_id = category_id;
            this.posts.push(current_post);
            this.current__thisement.offset().top + this.current__thisement.height();
            //this.status_bar_block = status_bar_block;

            if(this.ready_load) {

                that = this;

                $(this.status_parent_block).on("scroll resize", function() {

                    //console.log(that.ready_load);

                    var o = $(window).scrollTop() / ($(that.status_bar_block).height() - $(window).height());
                    $(".progress-bar").css({
                        "width": (100 * o | 0) + "%"
                    });
                    $('progress')[0].value = o;
                    //$('progress').attr('value',o);

                    //console.log($(window).scrollTop() >  block_top);
                    if ($(that.status_parent_block).scrollTop() >  that.block_top) {


                        that.ready_load = false;

                        return;

                    }

                });

            };
        },

        change_status_block : function (selector, parent_selector){
            this.status_bar_block = selector;
            this.status_parent_block = parent_selector;
            console.log(this.status_bar_block);
        },







    };

    window.post_loader_obj =  post_loader;
    window.post_loader_obj.init(15, window.post_id);
    //post_loader_obj.change_status_block($('.author-info'));


});

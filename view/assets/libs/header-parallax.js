"use strict";

jQuery(document).ready(function(e) {


    e(window).scroll(function() {
        var a = e("#lgx-parallax-banner");
        e(window).scrollTop() >= 50 ? a.addClass("scrolled") : a.removeClass("scrolled")
    })


    var a = e("#object1"),
        t = e("#object2"),
        o = (e("#object3"), e("#object4"), e("#object5")),
        i = e("#object6"),
        s = e("#object7"),
        n = e("#object8"),
        r = e("#object9"),
        p = e("#object10"),
        l = (e("#object11"),
            e("#layer-wrapper"));

    l.mousemove(function(e) {
        var t = -1 * e.pageX / 12,
            o = -1 * e.pageY / 12;
        a.css({
            transform: "translate3d(" + t + "px," + o + "px,0)"
        })
    }),
        l.mousemove(function(e) {
            var a = -1 * e.pageX / 24,
                o = -1 * e.pageY / 24;
            t.css({
                transform: "translate3d(" + a + "px," + o + "px,0)"
            })
        }),

        l.mousemove(function(e) {
            var a = -1 * e.pageX / 60,
                t = -1 * e.pageY / 60;
            o.css({
                transform: "translate3d(" + a + "px," + t + "px,0)"
            })
        }),

        l.mousemove(function(e) {
            var a = -1 * e.pageX / 12,
                t = -1 * e.pageY / 60;
            i.css({
                transform: "translate3d(" + a + "px," + t + "px,0)"
            })
        }),

        l.mousemove(function(e) {
            var a = -1 * e.pageX / 15,
                t = -1 * e.pageY / 60;
            s.css({
                transform: "translate3d(" + a + "px," + t + "px,0)"
            })
        }),

        l.mousemove(function(e) {
            var a = -1 * e.pageX / 25,
                t = -1 * e.pageY / 50;
            n.css({
                transform: "translate3d(" + a + "px," + t + "px,0)"
            })
        }),

        p.mousemove(function(e) {
            var a = -1 * e.pageX / 25,
                t = -1 * e.pageY / 50;
            l.css({
                transform: "translate3d(" + a + "px," + t + "px,0)"
            })
        }),

        l.mousemove(function(e) {
            var a = -1 * e.pageX / 25,
                t = -1 * e.pageY / 50;
            r.css({
                transform: "translate3d(" + a + "px," + t + "px,0)"
            })
        })

});
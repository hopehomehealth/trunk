define(function(require, exports, module) {
    var e = {
        slide: function() {
            var e = $(".gallery"),
            a = e.find(".gallery-item"),
            t = a.length,
            i = $(".gallery-nav"),
            n = i.find("a"),
            l = $(".slider-btn"),
            s = l.find(".prev"),
            d = l.find(".next"),
            r = i.data("pages"),
            f;
            function o(s, d) {
                var r = e.find("li.active"),
                f = i.find("a.selected"),
                o = !isNaN(s) ? s: r.index() + 1 == t ? 0 : r.index() + 1,
                p,
                u = 1;
                r.removeClass("active").stop().fadeTo(1500, 0);
                p = a.eq(o);
                p.stop().fadeTo(1200, 1).addClass("active");
                f.removeClass("selected");
                n.eq(o).addClass("selected");
                u = n.eq(o).data("page");
                c(i, u);
                g(u);
                l.data("currpage", u);
                if (d) d()
            }
            function c(e, a) {
                e.stop().animate({
                    "margin-left": -110 * (a - 1)
                },
                250)
            }
            function g(e) {
                s.toggleClass("disabled", !(e > 1));
                d.toggleClass("disabled", !(e < r))
            }
            function p() {
                f = setInterval(function() {
                    o()
                },
                5e3)
            }
            p();
            i.delegate("a", "click",
            function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                o($(this).data("slide"))
            });
            i.hover(function() {
                clearInterval(f)
            },
            function() {
                p()
            });
            l.delegate("a", "click",
            function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                clearInterval(f);
                var a = $(this),
                t = $(".slider-btn"),
                n = parseInt(t.attr("data-currpage"));
                if (a.hasClass("disabled")) {
                    p();
                    return
                }
                if (a.hasClass("prev")) {
                    if (n > 1) {
                        t.attr("data-currpage", --n)
                    }
                } else {
                    if (n < r) {
                        t.attr("data-currpage", ++n)
                    }
                }
                c(i, n);
                g(n);
                p()
            })
        }
    };
    module.exports = e
});
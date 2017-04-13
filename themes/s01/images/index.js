/*!
 * Created by zhu on 15-3-13.
 */
define(function(require, exports, module) {
    var e = require("jquery");
    require("handlebars");
    require("underscore");
    require("unveil");
    require("livequery");
    var t = {
        init: function() {
            this.getFlight();
            this.setHomeModuleTab();
            this.lazyLoad()
        },
        setHomeModuleTab: function() {
            e(".home-tabnav,.gt-tabnav,.gt-tabtit").delegate("li", "mouseover",
            function(t) {
                t.preventDefault();
                t.stopImmediatePropagation();
                if (t.type == "mouseover") {
                    var a = e(this),
                    n = a.data("tab"),
                    i = a.parentsUntil(".home-module").parent(),
                    r = i.find(".tab-content"),
                    l = i.find(".home-tabnav,.gt-tabnav,.gt-tabtit").find("li");
                    l.filter(".selected").removeClass("selected");
                    a.addClass("selected");
                    r.filter(".selected").removeClass("selected").stop().fadeTo(750, 0);
                    r.filter("." + n).stop().fadeTo(450, 1).addClass("selected")
                }
            })
        },
        getFlight: function() {
            var t = baseConfig.base + baseConfig.index_flight;
            e.ajax({
                url: t,
                data: {
                    city: now_city || "SZX"
                },
                dataType: "json"
            }).done(function(t) {
                if (t.code !== 0) return;
                if (!_.isArray(t.result)) return;
                var a = e(".home-flight"),
                n = a.find("dl"),
                i = e("#flight-tmpl").html();
                if (!i) return;
                var r = Handlebars.compile(i);
                _.each(t.result,
                function(t, a) {
                    if (t.hasOwnProperty("goods")) {
                        var i = r(t.goods);
                        e(i).appendTo(n.eq(a))
                    }
                })
            })
        },
        setModules: function() {
            var t = {};
            var a = t.menus.length;
            var n = _.map(t.menus,
            function(e, t) {
                if (t === 0) e.select = "selected";
                if (t === a - 1) e.last = "last";
                return e
            });
            t.menus = n;
            var i = e(".home-main"),
            r = e("#module-gny-tmpl").html();
            if (!r) return;
            var l = Handlebars.compile(r),
            o = l(t);
            e(o).appendTo(i)
        },
        setThemeGallery: function() {
            var t = e(".m-gallery"),
            a = t.find(".inner"),
            n = t.data("pages"),
            i = t.data("width");
            e(t).delegate(".btn-gallery", "click",
            function(t) {
                t.preventDefault();
                var r = e(this),
                l = e(".m-gallery"),
                o = parseInt(l.attr("data-curr"));
                if (r.hasClass("l-btn")) {
                    if (o > 1) {
                        l.attr("data-curr", --o)
                    }
                } else {
                    if (o < n) {
                        l.attr("data-curr", ++o)
                    }
                }
                a.stop().animate({
                    "margin-left": (1 - o) * i
                },
                750)
            })
        },
        lazyLoad: function() {
            e(".home-module img").unveil(200,
            function(t) {
                var a = this;
                e.Deferred(function(e) {
                    a.onload = function() {
                        a.onload = null;
                        e.resolve()
                    };
                    a.setAttribute("src", t);
                    return e.promise()
                }).done(function() {
                    e(a).removeClass("unveil-img")
                })
            })
        }
    };
    module.exports = t
});
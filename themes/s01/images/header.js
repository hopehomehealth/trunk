
define(function(require, exports, module) {
    var e = require("jquery");
    require("underscore");
    require("util");
    require("handlebars");
    function t(e) {
        var t = i();
        return _.filter(t,
        function(t) {
            var i = _.some([t.val, t.JP, t.PY],
            function(t) {
                return t.match(new RegExp("^" + e.toUpperCase(), "ig"))
            });
            if (i) return t
        })
    }
    function i() {
        var e = [];
        for (var t in cityObj) {
            if (t != "HOT") {
                for (var i in cityObj[t]) {
                    var n = cityObj[t][i];
                    for (var a in n) {
                        e.push(n[a])
                    }
                }
            }
        }
        return e
    }
    function n(e) {
        var t = {};
        for (var i in e) {
            if (i != "index") {
                t[i] = e[i]
            }
        }
        return t
    }
    function a(t) {
        t.delegate("li", "click",
        function() {
            var t = e(this).children("a").attr("value");
            if (t) {
                var i = e(this).children("a").attr("title"); 
                location.href = r(t)
            }
        })
    }
    function o(t) {
        t.children("dl, .city-pick").delegate("a.sel-city", "click",
        function() {
            var t = e(this).attr("value");
            if (t) {
                var i = e(this).attr("title"); 
                location.reload()
            }
        })
    }
    function r(e) {
        if (/\?/gi.test(location.search)) {
            var t = "";
            if (/\&city\=/.test(location.search)) {
                t = location.search.replace("&city=" + Util.bom.getQuery("city"), "") + "&city=" + e
            } else if (/\?city\=/.test(location.search)) {
                t = location.search.replace("?city=" + Util.bom.getQuery("city"), "") + "?city=" + e
            } else {
                t = location.search + "&city=" + e
            }
            return t
        } else {
            return "?city=" + e
        }
    }
    var c = {
        init: function() {
            this.initCityList();
            this.initSearch();
            this.initLogin();
            this.initSso()
        },
        initSearch: function() {
            var t = e("body"),
            i = e("#search"),
            n = i.find(".search-classify"),
            a = n.find(".search-classify-link"),
            o = n.find(".drop-down-list"),
            r = o.find("li").length + 1,
            c = e("#btn-search");
            n.hover(function(t) {
                t.preventDefault();
                t.stopImmediatePropagation();
                e(this).toggleClass("on")
            },
            function() {
                n.removeClass("on")
            });
            o.delegate("li", "click",
            function(t) {
                t.preventDefault();
                t.stopImmediatePropagation();
                var i = e(this),
                a = o.find("li"),
                c = i.find("a"),
                l = parseInt(i.data("type"));
                var s = e(".cat-select"),
                d = parseInt(s.attr("data-type")),
                f = s.text();
                var u = '<li data-type="' + d + '"><a href="javascript:void(0)">' + f + "</a></li>";
                if (d === r) {
                    e(u).appendTo(o)
                } else {
                    e(u).insertBefore(a.filter('[data-type="' + (d + 1) + '"]'))
                }
                i.remove();
                s.text(c.text()).attr("data-type", l);
                n.toggleClass("on")
            });
            o.hover(function() {},
            function() {
                n.removeClass("on")
            });
            c.on("click",
            function(t) {
                t.preventDefault();
                var n = i.find('input[type="text"]'),
                a = n.data("url"),
                o = e.trim(n.val()),
                r = parseInt(e(".cat-select").attr("data-type")),
                c = baseConfig.header_search,
                l = "";
                if (!o.length && a) {
                    window.open(a)
                } else {
                    if (o.length === 0) return;
                    switch (r) {
                    case 2:
                        c = baseConfig.header_search_type2;
                        break;
                    case 3:
                        c = baseConfig.header_search_type3;
                        break;
                    case 4:
                        c = baseConfig.header_search_type4;
                        break
                    }
                    document.location.href = '/search?keywords=' + o+'&goods_type='+r;
                }
            });
            t.keydown(function(e) {
                if (e.which === 13) {
                    c.trigger("click")
                }
            })
        },
        initCityList: function() {
            var t = e(".hd-city"),
            i = e(".city-sub");
            t.hover(function() {
                t.addClass("on")
            },
            function() {
                t.removeClass("on")
            });
            i.on("click", "a",
            function(t) {
                var i = e(this),
                n = i.attr("value");
                i.addClass("selected").siblings().removeClass("selected");
                if (n) {
                    var a = e(this).attr("title");
                    e("#citysite").html(a);
                    document.cookie = "sCityCode=" + encodeURIComponent(n) + ";path=/";
                    document.cookie = "sCityName=" + encodeURIComponent(a) + ";path=/";
                    location.href = r(n)
                }
                t.preventDefault()
            });
            this._renderHotCityNew()
        },
        _renderHotCityNew: function() {
            var t = [],
            i,
            n = "",
            a = cityObj["HOT"],
            o = e(".city-sub");
            for (i in a) {
                t = t.concat(a[i])
            }
            t.forEach(function(e) {
                n += '<a href="javascript:;" value="' + e.key + '"' + (now_city === e.key ? ' class="selected"': "") + ' title="' + e.val + '">' + e.val + "</a>"
            });
            //o.html(n)
        },
        _renderHotCity: function() {
            var t = this,
            i = e("#HOT"),
            a = i.find(".city-pick"),
            o = i.find("dl"),
            c = e("#city-matching");
            var l = cityObj["HOT"];
            var s = l["index"];
            a.html(t._setCityIndex(s));
            o.html(t._setCityCategory(n(l)));
            i.addClass("unempty");
            e(i, c).delegate("a.sel-city", "click",
            function(t) {
                t.preventDefault();
                var i = e(this).attr("value");
                if (i) {
                    var n = e(this).attr("title");
                    document.cookie = "sCityCode=" + encodeURIComponent(i) + ";path=/";
                    document.cookie = "sCityName=" + encodeURIComponent(n) + ";path=/";
                    location.href = r(i)
                }
            })
        },
        _setCityCategory: function(e) {
            var t = "";
            for (var i in e) {
                var n = "<dt>" + i + "</dt>",
                a = "",
                o = e[i];
                _.map(o,
                function(e, t) {
                    var i = e.val,
                    n = e.key,
                    o = r(n);
                    a += '<a class="sel-city" title="' + i + '" href="' + o + '"  value="' + n + '">' + i + "</a>"
                });
                a = "<dd>" + a + "</dd>";
                t += n + a
            }
            return t
        },
        _setCityIndex: function(e) {
            var t = _.map(e,
            function(e) {
                var t = r(e["key"]);
                return '<a class="sel-city" title="' + e["val"] + '" href="' + t + '" value="' + e["key"] + '">' + e["val"] + "</a>"
            });
            return t.join("")
        },
        initCitySearch: function() {
            var i = e("#search-city");
            var n = e("#result-city");
            i.livequery(function() {
                e(this).keyup(function() {
                    var i = e(this),
                    a = i.val(),
                    o = "",
                    c = [];
                    if (!a) {
                        n.hide().empty();
                        return
                    }
                    e.each(t(i.val()),
                    function(e, t) {
                        var i = r(t.key);
                        o += '<li><a title="' + t.val + '" href="' + i + '" class="sel-city" value="' + t.key + '">' + t.val + "</a></li>"
                    }); ! o && (o = '<li style="cursor:default">没有找到结果</li>');
                    n.show().empty().append(o)
                })
            });
            a(e("#result-city"))
        },
        initLeftNav: function() {},
        initLogin: function() { 
        },
        initSso: function() {
            var e = {
                tologin: function() {
                    window.location.href = [baseConfig.member_login_url, "redirectUrl=" + encodeURIComponent(location.href)].join("?")
                },
                toreg: function() {
                    window.location.href = [baseConfig.member_reg_url, "redirectUrl=" + encodeURIComponent(location.href)].join("?")
                }
            };
            window.Member = e
        }
    };
    module.exports = c
});
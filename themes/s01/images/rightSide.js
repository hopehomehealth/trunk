 
define(function(require, exports, module) {
    var e = require("jquery");
    require("underscore");
    require("handlebars");
    var i = "side_0";
    var n = "side_1";
    var t = "side_2";
    var r = Util.getRegex(1);
    var a = Util.getRegex(2);
    var l;
    var s = false;
    var d = false;
    var o = "";
    Handlebars.registerHelper("prepareUrl",
    function(e, i) {
        return e.url
    });
    function c(i, n) {
        var t = e(".hs-top").children("li").eq(i);
        if (n == 0) {
            t.children("div").eq(0).hide();
            t.children("div").eq(1).show();
            switch (i) {
            case 0:
            case 1:
                var r = t.children("div").eq(1).find("iframe"); ! r.data("loaded") && r.data("loaded", true).attr("src", o);
                break;
            case 2:
                h(2, e("#order-form"));
                break;
            default:
                break
            }
        } else if (n == 1) {
            var a = e(".hs-top").children("li");
            a.eq(0).children("div").eq(0).css("display", "none");
            a.eq(1).children("div").eq(0).css("display", "none");
            a.eq(2).children("div").eq(0).css("display", "none");
            t.children("div").eq(0).css("display", "block");
            t.children("div").eq(1).hide()
        } else {
            if (i == 0) {
                var l = t.children("div").eq(0).find("span");
                l.eq(0).html(n["userName"]);
                l.eq(1).html(n["levelName"]);
                if (n["isSign"] == 1) {
                    t.children("div").children("div").eq(2).show();
                    f()
                } else {
                    t.children("div").children("div").eq(2).hide()
                }
            } else if (i == 1) {
                e("#point").html(n["point"]);
                e("#money").html(n["money"])
            } else if (i == 2) {
                if (_.size(n["unfinish"]) < 1) {
                    t.trigger("mouseenter").children("div").eq(2).show().siblings("div").hide()
                } else {
                    t.trigger("mouseenter").children("div").eq(0).show().siblings("div").hide();
                    e("#order-unfinish").children("ul").html(m(3, n));
                    if (Util.getCookie("mbrID")) {
                        e("#order-unfinish").children("ul").find("a").attr("href", "#")
                    }
                }
            }
        }
    }
    function f() {
        e("#sign").on("click",
        function(i) {
            i.stopImmediatePropagation();
            var n = Util.getJdbcUrl(2);
            Util.ajaxCustom(n, "get", "", "json", "",
            function() {},
            function(i, n) {
                if (n["code"] == 0) {
                    e("#sign").off("click")
                }
            })
        })
    }
    function h(e, i) {
        switch (e) {
        case 1:
            {
                var n = Util.getJdbcUrl(3);
                i.find("a").eq(0).on("click",
                function(e) {
                    e.stopImmediatePropagation();
                    var t = i.find("input");
                    var l = t.eq(0).val();
                    var s = t.eq(1).val();
                    if (! (r.test(l) || a.test(l))) {
                        i.find("span").html("用户名格式不正确");
                        return
                    } else {
                        i.find("span").html("")
                    }
                    Util.ajaxCustom(n, "post", {
                        userName: l,
                        pwd: s
                    },
                    "json", i,
                    function() {},
                    function(e, n) {
                        if (n) {
                            if (n["code"] == 0) location.reload();
                            else e.find("span").html("账号或密码错误")
                        } else {
                            i.find("span").html("")
                        }
                    })
                });
                i.find("a").eq(1).on("click",
                function(e) {
                    e.stopImmediatePropagation();
                    location.href = Util.getJdbcUrl(9)
                });
                break
            }
        case 2:
            {
                if (!s) {
                    i.find("a").eq(0).on("click",
                    function(e) {
                        e.stopImmediatePropagation();
                        var n = i.find("input");
                        var t = n.eq(0).val();
                        if (!a.test(t)) {
                            i.find("span").html("手机号码不正确");
                            return
                        } else {
                            i.find("span").html("")
                        }
                        var r = Util.getJdbcUrl(4) + "?phone=" + t;
                        Util.ajaxCustom(r, "get", "", "json", i,
                        function() {
                            u()
                        },
                        function(e, n) {
                            if (n.code == 0) {} else {
                                i.find("span").html("短信验证码发送失败");
                                v()
                            }
                        })
                    })
                }
                i.find("a").eq(1).on("click",
                function(e) {
                    e.stopImmediatePropagation();
                    var n = i.find("input");
                    var t = n.eq(0).val();
                    var r = n.eq(1).val();
                    if (!a.test(t)) {
                        i.find("span").html("手机号码不正确");
                        return
                    } else if (!r) {
                        i.find("span").html("请输入验证码");
                        return
                    } else {
                        i.find("span").html("")
                    }
                    var l = Util.getJdbcUrl(5) + "?phone=" + t + "&code=" + r;
                    Util.ajaxCustom(l, "get", "", "json", i,
                    function() {},
                    function(e, n) {
                        if (n.code == 0) {
                            d = true;
                            c(2, n)
                        } else {
                            i.find("span").html("验证码校验失败")
                        }
                    })
                });
                break
            }
        default:
            break
        }
    }
    function u() {
        e("#btn-send").off("click");
        s = true;
        var i = 60;
        e("#btn-send").html(i + "秒");
        l = setInterval(function() {
            i -= 1;
            if (i <= 0) {
                s = false;
                clearInterval(l);
                e("#btn-send").html("重新发送");
                h(2, e("#order-form"));
                return false
            } else {
                e("#btn-send").html(i + "秒")
            }
        },
        1e3)
    }
    function v() {
        clearInterval(l);
        e("#btn-send").html("重新发送");
        s = false;
        h(2, e("#order-form"))
    }
    function m(i, n) {
        var t = "";
        var r = [];
        switch (i) {
        case 0:
            t = e("#mine-tmpl").html();
            break;
        case 1:
            t = e("#assets-tmpl").html();
            break;
        case 2:
            t = e("#order-tmpl").html();
            break;
        case 3:
            t = e("#unfinish-tmpl").html();
            break;
        default:
            break
        }
        var a = Handlebars.compile(t);
        r.push(n);
        return a(n)
    }
    var p = {
        update: function() {
            var r = Util.getJdbcUrl(6);
            var a = Util.getJdbcUrl(7);
            var l = Util.getJdbcUrl(8);
            var s = e(".hs-top").find(">li.on").attr("value");
            if (s) {
                if (s == i) {
                    s = 0
                } else if (s == n) {
                    s = 1
                } else if (s == t) {
                    s = 2
                }
                if (!Util.isLogin()) {
                    if (s == 2 && d) {
                        c(s, 1)
                    } else {
                        c(s, 0)
                    }
                    return
                } else {
                    c(s, 1)
                }
                var o = "";
                switch (s) {
                case 0:
                    o = r;
                    break;
                case 1:
                    o = a;
                    break;
                case 2:
                    o = l;
                    break;
                default:
                    break
                }
                Util.ajaxCustom(o, "get", "", "json", s,
                function() {},
                function(e, i) {
                    c(e, i)
                })
            }
        },
        init: function() {
            var r = Util.getJdbcUrl(6);
            var a = Util.getJdbcUrl(7);
            var l = Util.getJdbcUrl(8);
            e(function() {
                e(".hs-top").find(">li").hover(function(s) {
                    s.stopImmediatePropagation();
                    if (e(this).hasClass("on")) return;
                    e(this).addClass("on");
                    var o = e(this).attr("value");
                    if (o) {
                        if (o == i) {
                            o = 0
                        } else if (o == n) {
                            o = 1
                        } else if (o == t) {
                            o = 2
                        }
                        if (!Util.getCookie("mbrID")) {
                            if (o == 2 && d) {
                                c(o, 1)
                            } else {
                                c(o, 0)
                            }
                            return
                        } else {
                            c(o, 1)
                        }
                        var f = "";
                        switch (o) {
                        case 0:
                            f = r;
                            break;
                        case 1:
                            f = a;
                            break;
                        case 2:
                            f = l;
                            break;
                        default:
                            break
                        }
                        Util.ajaxCustom(f, "get", "", "json", o,
                        function() {},
                        function(e, i) {
                            c(e, i)
                        })
                    }
                },
                function() {
                    e(this).removeClass("on");
                    e(".hs-top").children("li").eq(0).children("div").eq(0).css("display", "none");
                    e(".hs-top").children("li").eq(1).children("div").eq(0).css("display", "none");
                    e(".hs-top").children("li").eq(2).children("div").eq(0).css("display", "none")
                })
            })
        }
    };
    module.exports = p
});
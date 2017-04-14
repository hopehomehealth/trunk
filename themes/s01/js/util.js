(function(e, n) {
    if (typeof exports === "object") {
        module.exports = n()
    } else if (typeof define === "function" && define.amd) {
        define(n)
    } else {
        e.Util = n()
    }
})(this,
function() {
    var e = {
        IsNullEmpty: function(e) {
            if (e.length == "" || e.length <= 0) {
                return false
            } else {
                return true
            }
        },
        ajaxCustom: function(e, n, t, r, o, i, a) {
            $.ajax({
                url: e,
                type: n,
                data: t,
                dataType: r,
                beforeSend: function() {
                    i(o)
                },
                success: function(e, n) {
                    a(o, e)
                },
                error: function(e, n, t) {}
            })
        },
        setCookie: function(e, n, t) {
            var r = {
                domain: "",
                path: "/"
            };
            t = $.extend(r, t);
            if (n === null) {
                t.expires = -1
            }
            if (typeof t.expires === "number") {
                var o = t.expires,
                i = t.expires = new Date;
                i.setDate(i.getDate() + o)
            }
            return document.cookie = [encodeURIComponent(e), "=", t.raw ? String(n) : encodeURIComponent(String(n)), t.expires ? "; expires=" + t.expires.toUTCString() : "", t.path ? "; path=" + t.path: "", t.domain ? "; domain=" + t.domain: "", t.secure ? "; secure": ""].join("")
        },
        getCookie: function(e) {
            var n = e + "=";
            var t = document.cookie.split(";");
            for (var r = 0; r < t.length; r++) {
                var o = t[r];
                while (o.charAt(0) == " ") {
                    o = o.substring(1, o.length)
                }
                if (o.indexOf(n) == 0) {
                    return decodeURIComponent(o.substring(n.length, o.length))
                }
            }
            return false
        },
        getJdbcUrl: function(e) {
            var n = "../product.php/cindexcontroller/";
            switch (e) {
            case 1:
                n += "isSignInToday";
                break;
            case 2:
                n += "signInUser";
                break;
            case 3:
                n += "loginUser";
                break;
            case 4:
                n += "sendMsgCheckCode";
                break;
            case 5:
                n += "checkMsgCode";
                break;
            case 6:
                n += "getMyAccountInfo";
                break;
            case 7:
                n += "getMyPropertyInfo";
                break;
            case 8:
                n += "getMyOrderList";
                break;
            case 9:
                n = "../mbrWebCenter/password/init.action";
                break;
            default:
                break
            }
            return n
        },
        getRegex: function(e) {
            var n = "";
            switch (e) {
            case 1:
                n = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
                break;
            case 2:
                n = /^((13[0-9])|(15[^4\D])|(18[0-9])|(147))\d{8}$/;
                break;
            default:
                break
            }
            return n
        },
        isLogin: function() {
            return !! e.getCookie("mbrID")
        },
        bom: {
            getQuery: function(e) {
                var n, t = {},
                r, o = location.search,
                i, a, s;
                if (o.length > 2) {
                    n = o.substr(1).split("&");
                    for (i = 0, a = n.length; i < a; i++) {
                        r = n[i].split("=");
                        s = r[1];
                        t[r[0]] = decodeURIComponent(s)
                    }
                }
                return arguments.length ? t[e] : t
            },
            toQueryStr: function(e, n) {
                var t, r, o = [];
                for (t in e) {
                    r = $.isFunction(n) ? n(e[t]) : n ? e[t] : encodeURIComponent(e[t]);
                    o.push(t + "=" + r)
                }
                return o.join("&")
            },
            _deal: function() {
                var e, n, t = {},
                r = this,
                o = arguments.length;
                if (o === 1) {
                    $.extend(t, arguments[0])
                } else if (o === 2) {
                    t[arguments[0]] = arguments[1]
                }
                $.each(t,
                function(e, n) {
                    n ? r[e] = n: delete r[e]
                })
            },
            locatedTo: function() {
                var e = {};
                this._deal.apply(e, arguments);
                e = this.toQueryStr(e,
                function(e) {
                    return encodeURIComponent(e)
                });
                location.href = [location.pathname, e].join("?") + location.hash
            }
        },
        string: {
            lpad: function(e, n, t) {
                var r = "";
                n = +n;
                if (!e || isNaN(n) || n < 0 || !n) {
                    return r
                }
                e += "";
                t += "";
                t = t || " ";
                if (e.length >= n) {
                    r = e.substr(0, n)
                } else {
                    r = e;
                    while (r.length < n) {
                        r = t + r
                    }
                }
                return r
            },
            rpad: function(e, n, t) {
                var r = "";
                n = +n;
                if (!e || isNaN(n) || n < 0 || !n) {
                    return r
                }
                e += "";
                t += "";
                t = t || " ";
                if (e.length >= n) {
                    r = e.substr(0, n)
                } else {
                    r = e;
                    while (r.length < n) {
                        r += t
                    }
                }
                return r
            },
            timeDiff: function(e, n, t) {
                var r, o, i, a, s, c, u, f, l;
                t = $.extend({
                    D: "天",
                    H: "小时",
                    m: "分钟",
                    s: "秒"
                },
                t);
                s = n - e;
                c = s % 864e5;
                r = (s - c) / 864e5;
                u = c % 36e5;
                o = (c - u) / 36e5;
                f = u % 6e4;
                i = (u - f) / 6e4;
                l = f % 1e3;
                a = (f - l) / 1e3;
                return [r > 0 ? r + t.D: "", o > 0 ? o + t.H: "", i > 0 ? i + t.m: "", a > 0 ? a + t.s: ""].join("")
            }
        }
    };
    return e
});
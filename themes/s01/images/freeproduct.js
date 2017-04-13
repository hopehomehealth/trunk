/*!

 * Created by qzm (qzmer1104@qq.com) on 2015/3/21.

 */
define(function(require, exports, module) {
    require("util");
    require("moment");
    require("handlebars");
    require("jquery.stickyNavbar");
    require("fancybox");
    var e = require("jquery"),
    t = require("cal4pro"),
    r = require("mgSelect"),
    i = require("base64");
    try {
        document.domain = ""
    } catch(o) {
        window.console && console.log && console.error("domain set failed")
    }
    var n, a, l, s, c, d, u, f, h, p, m, g, v, b, y, _, H, k;
    c = {
        popupLoginUrl: "~http://www./mbrWebCenter/jsp_new/member/init4WebDirectBook_new.jsp",
        hoverRel: "a.rel",
        relTip: ".box-tips",
        remoteRoot: ".detail-left",
        remoteUrl: baseConfig.base + baseConfig.tour_calc_price_url,
        remoteGetData: e.noop,
        holiday: [],
        cal4proBuildLink: e.noop,
        navTablSelector: ".detail-tabnav",
        productUrl: baseConfig.base + baseConfig.tour_product_url,
        actionUrl: baseConfig.base + baseConfig.tour_order_url,
        productPriceUrl: baseConfig.base + baseConfig.tour_product_price_url,
        formName: "orderForm",
        submitBtn: "#pro-order-submit",
        detailRoomSelector: ".detail-room",
        orderTipSelector: "#orderTip",
        dayListSelector: ".detail-daylist",
        listRootSelector: ".room-con",
        priceSelector: "#calcPrice",
        calcAchor: ".cal4pro .tbl_con a",
        productType: "#productType",
        singleRoomHtml: '<i id="singleTip" class="icon waring-sm2"></i><span class="box-tips" style="right: 135px;display:none"><i class="icon arr-tr"></i>包含预付单房差¥{txt}，如您有特殊需求，请在付款前联系客服协调，我们将尽量满足您的需求。</span>',
        freshPriceUrl: baseConfig.base + baseConfig.tour_fresh_price_url,
        //showPriceHtml: '<span class="yellow-a"><i>¥</i><em>{price}</em><sub>起</sub></span>',
        //sellOutHtml: "<em>实时计价</em>",
        showPriceSelector: ".d_price span.yellow-a:first",
        oriPriceSelector: ".d-con .d_row del",
        priceDivSelector: ".d_price"
    };
    p = {
        hotel: {},
        flight: {},
        traffic: {},
        other: {}
    };
    m = e.extend(true, {},
    p);
    g = new i;
    k = function(t) {
        var r, i, o = {
            title: "温馨提示",
            loading: false,
            msg: "",
            desc: "",
            confirmBtn: "确定"
        };
        e.type(t) == "string" && (t = {
            msg: t
        });
        t = e.extend(o, t);
        r = e("#mg_msg");
        i = Handlebars.compile(e("#mg_msg_tpl").html());
        r.length ? r.replaceWith(i(t)) : e("body").append(i(t))
    };
    function x(e, t) {
        if (e.value > t.value) {
            return 1
        } else if (e.value < t.value) {
            return - 1
        } else {
            return 0
        }
    }
    function j(t) {
        e("#back_select").html('{date}<input type="hidden" name="backDate" value="{date}">'.replace(/\{date\}/g, t))
    }
    function w(e, t) {
        var r = [],
        i,
        o,
        n,
        a;
        r.push({
            value: "",
            label: {}
        });
        for (i in e) {
            if (i != "id") {
                if (i < t) {
                    delete e[i];
                    continue
                } ! o && (o = i);
                o > i && (o = i);
                if (e[i] && +e[i] > 0 && e[i] !== "已售完") { ! a && (a = i);
                    a > i && (a = i);
                    n = {};
                    n.label = {
                        price: e[i]
                    };
                    n.value = i;
                    r.push(n)
                }
            }
        }
        return [r, o, a]
    }
    function I(t) {
        var r, i = true,
        o, a = [],
        c = [],
        d = [],
        u = 0;
        e("#orderPriceNo").show();
        e("#orderPriceYes").hide();
        o = e(".room-con").find(":input").toArray();
        i = o.every(function(t) {
            var r, i;
            switch (t.name) {
            case "itemid":
                if (t.checked) {
                    a.push(t.value)
                }
                break;
            case "checkInDate":
                if (!t.disabled) {
                    r = t.value.split("|");
                    i = e("#s_" + r[0]);
                    if (i.val()) {
                        r.push(i.val());
                        c.push(r.join("|"))
                    } else {
                        return false
                    }
                }
                break;
            case "checkOutDate":
                if (!t.disabled) {
                    r = t.value.split("|");
                    i = e("#e_" + r[0]);
                    if (i.val()) {
                        r.push(i.val());
                        d.push(r.join("|"))
                    } else {
                        return false
                    }
                }
                break;
            default:
                if (/^rm_/.test(t.id)) { ! u && (u = t.value)
                }
                break
            }
            return true
        });
        r = {
            productId: b["pid"].value,
            departDate: n.val(),
            adultNum: l.val(),
            childNum: s.val(),
            itemid: a.join(","),
            checkInDate: c.join(","),
            checkOutDate: d.join(","),
            roomNum: u
        };
        i && e.post(t.productPriceUrl, r,
        function(r) {
            var i = "";
            if (r && r.Code == "0") {
                e("#orderPriceNo").hide();
                r.Result && r.Result.items && r.Result.items.singleRoomPirce && (i = t.singleRoomHtml.replace(/\{txt\}/g, r.Result.items.singleRoomPirce));
                e("#orderPrice").html(Math.ceil(parseFloat(r.Result.orderPrice)).toFixed(0) + i);
                e("#orderPriceYes").show()
            }
        },
        "json")
    }
    function D(t, r) {
        var i = e(".cal4pro"),
        o,
        n,
        a;
        n = i.find('.tbl_con [data-date="' + t + '"]');
        if (!n.length) {
            var l = i.find(".full_date .year").text(),
            s = i.find(".full_date .month").text();
            a = moment(t, "YYYY-MM").diff(moment([l, s].join("-"), "YYYY-MM"), "month");
            if (a) {
                o = a > 0 ? i.find(".m_next") : i.find(".m_prev");
                a = Math.abs(a);
                while (a--) {
                    o.trigger("click")
                }
            }
            n = i.find('.tbl_con [data-date="' + t + '"]')
        } ! r && n.addClass("selected")
    }
    function P(t) {
        var r = [];
        if (h) {
            y = {};
            h.journeyLists && h.journeyLists.forEach(function(i) {
                var o, n, a, l, s = 0,
                c = 0,
                d, u;
                n = e(t.listRootSelector).find(".hotel-table tr[data-journey-id='" + i.journeyId + "']");
                d = moment(i.startDate);
                u = moment(i.endDate);
                if (n.length) {
                    a = n.find("[id='s_" + i.journeyId + "']");
                    l = n.find("[id='e_" + i.journeyId + "']");
                    var f = l.data("hotel");
                    e.type(f) == "string" && (f = JSON.parse(g.decode(f)));
                    s = moment(f.minCheckoutDate).diff(moment(f.checkinDate), "days");
                    c = moment(l.val()).diff(a.val(), "days");
                    y[i.journeyId] = {
                        s_: a.val(),
                        e_: l.val()
                    }
                }
                o = c - s;
                if (o) {
                    r.push([i.journeyId, c].join("|"))
                }
            })
        }
        H = r
    }
    function C() {
        H = []
    }
    function S(e) {
        if (H && H.length) {
            e.hotelStayDays = H.join(",")
        }
    }
    function N() {
        return e("#productType").val() === "2"
    }
    function L() {
        return e("#p_status").val() === "2"
    }
    function O(t) {
        var r = {},
        i = e(t.detailRoomSelector),
        o,
        a = true;
        e(t.calcAchor).removeClass("selected");
        o = e(t.submitBtn);
        if (n.val() && s.val() && l.val()) {
            r.productId = b["pid"].value;
            r.departDate = n.val();
            r.childNum = s.val();
            r.adultNum = l.val();
            S(r, t);
            D(r.departDate);
            o.off("click.order").addClass("disabled");
            e("#orderPriceNo").show();
            e("#orderPriceYes").hide();
            e.post(t.productUrl, r,
            function(o) {
                var c = o.Code == 0 && o.Result;
                if (!e.isEmptyObject(c)) {
                    _ = true;
                    h = c;
                    c.freeOrder && (c.freeOrder.childnum = +r.childNum);
                    e(t.listRootSelector).html("");
                    c.flightGroupList && c.flightGroupList.length && (a = false, F(c));
                    c.hotelGroupList && c.hotelGroupList.length && (a = false, G(c));
                    c.tourGroupList && c.tourGroupList.length && Y(c);
                    c.ticketItemProductList && c.ticketItemProductList.length && (a = false, E(c));
                    c.notFlightGroupList && c.notFlightGroupList.length && (a = false, B(c));
                    c.otherMap && !e.isEmptyObject(c.otherMap) && (a = false, U(c)); ! N() && !a && i.show();
                    r.productId.slice( - 1) === "2" && c.tourGroupList && c.tourGroupList.forEach(function(e) {
                        e.defaultSelect == 1 && (b["saleNote"].value = e.isPayment == 1 ? 1 : 0)
                    });
                    I(t);
                    c.freeOrder && c.freeOrder.dateToBack && c.freeOrder.dateToBack.replace(/\b(\w)\b/g, "0$1"),
                    j(c.freeOrder.dateToBack);
                    e("#back_select").show();
                    e("#back_label").show()
                } else {
                    switch (o.Code) {
                    case "30000":
                        k("您选择的此产品余位不足（剩余数：" + o.Result + "），请修改出行人数或更换其他产品");
                        s && s.val(0);
                        l.val(o && o.Result, true);
                        break;
                    case "30001":
                        k(o.Message);
                        l.val(o && o.Result, true);
                        break;
                    case "O20001":
                        k(o.Message);
                        n.val("", true);
                        break;
                    case "0":
                        k(o.Message);
                        l.val("", true);
                        break;
                    default:
                        k("加载失败，请稍后再试");
                        n.val("", true);
                        break
                    }
                }
            },
            "json").fail(function(t) {
                if (t && t.readyState == 4) {
                    k("网络延时，请重试！")
                }
                n.val("", true);
                e(".cal4pro .tbl_con a").removeClass("selected")
            }).always(function() {
                C();
                o.on("click.order", t, T).removeClass("disabled")
            })
        } else {
            e("#back_label").hide();
            e("#back_select").hide();
            i.hide()
        }
    }
    function T(t, r) {
        var i, o;
        if (!n.val()) {
            n.showOption();
            e("#noselectTip").show();
            t.stopPropagation()
        } else if (!r && !Util.isLogin()) {
            i = e("#J_popup_login");
            if (!i.length) {
                o = Handlebars.compile(e("#popup_login_tpl").html());
                e("body").append(o({
                    src: t.data.popupLoginUrl
                }));
                i = e("#J_popup_login")
            }
            i.add(".mask").show()
        } else {
            e(b).submit()
        }
    }
    function R(t) {
        var r = this,
        i = true,
        o, n = [],
        a = [],
        l = [],
        s = 0,
        c = "YYYY-MM-DD",
        d,
        u;
        u = e(t.submitBtn);
        o = e(".room-con").find(":input").toArray();
        i = o.every(function(t) {
            var r, i;
            switch (t.name) {
            case "itemid":
                if (t.checked) {
                    n.push(t.value)
                }
                break;
            case "checkInDate":
                if (!t.disabled) {
                    r = t.value.split("|");
                    i = e("#s_" + r[0]);
                    if (i.val()) {
                        r.push(i.val());
                        a.push(r.join("|"))
                    } else {
                        i.css("color", "#f90").focus(function() {
                            e(this).css("color", "")
                        });
                        return false
                    }
                }
                break;
            case "checkOutDate":
                if (!t.disabled) {
                    r = t.value.split("|");
                    i = e("#e_" + r[0]);
                    if (i.val()) {
                        r.push(i.val());
                        l.push(r.join("|"))
                    } else {
                        i.css("color", "#f90").focus(function() {
                            e(this).css("color", "")
                        });
                        return false
                    }
                }
                break;
            default:
                if (/^rm_/.test(t.id)) { ! s && (s = t.value)
                }
                break
            }
            return true
        });
        if (!h) {
            return false
        }
        if (i) {
            u.off("click.order");
            var f = [],
            p = [],
            m = 0;
            h.journeyLists && h.journeyLists.forEach(function(e) {
                f.push(e.journeyId + "|" + moment(e.startDate).format(c));
                p.push(e.journeyId + "|" + moment(e.endDate).format(c))
            });
            d = {
                itemid: n.join(","),
                checkInDate: a.join(","),
                checkOutDate: l.join(","),
                journeyStartDate: f.join(","),
                journeyEndDate: p.join(","),
                roomNum: s
            };
            e.each(d,
            function(e, t) {
                r[e].value = t
            });
            t.actionUrl && (r.action = t.actionUrl);
            r.submit()
        } else {
            e(t.orderTipSelector).show()
        }
        return false
    }
    function M() {
        return h && (h.flightGroupList.length || h.notFlightGroupList.length || h.tourGroupList.length)
    }
    d = {
        name: "departDate",
        labelFormat: function(e) {
            return JSON.stringify(e.label)
        },
        textFormat: function(t) {
            if (t.value) {
                var r = '<span class="for-input">{date}</span>  <sub>¥</sub> {price}起/人',
                i = e(this).data("label");
                return r.replace(/\{date\}/, t.value).replace(/\{weekday\}/g, t.label.weekday).replace(/\{price\}/g, t.label.price)
            } else {
                return this.noLabel
            }
        },
        titleFormat: function(e) {
            if (e.value) {
                var t = "{date} ￥{price}起/人";
                return t.replace(/\{date\}/, e.value).replace(/\{weekday\}/g, e.label.weekday).replace(/\{price\}/g, e.label.price)
            } else {
                return ""
            }
        },
        labelShowFormat: function() {
            var t = '<span class="for-input">{date}</span>  <sub>¥</sub> {price}起/人',
            r = e(this).data("label");
            return t.replace(/\{date\}/, e(this).data("value")).replace(/\{weekday\}/g, r.weekday).replace(/\{price\}/g, r.price)
        }
    };
    u = {
        id: "",
        name: "",
        "class": "input-select",
        disabled: "",
        selected: "",
        options: []
    };
    Handlebars.registerHelper("showHtml",
    function(e, t) {
        return e
    });
    Handlebars.registerHelper("stringify",
    function(e, t) {
        return g.encode(JSON.stringify(e))
    });
    Handlebars.registerHelper("ifnopic",
    function(e, t, r) {
        return e ? e: t
    });
    Handlebars.registerHelper("popupEqual",
    function(e, t, r) {
        if (e == t) {
            return r.fn(this)
        } else {
            return r.inverse(this)
        }
    });
    function F(t) {
        var r, i;
        r = Handlebars.compile(e("#list-flight").html());
        Handlebars.registerHelper("canFlightChange",
        function(e, t, r) {
            var i = !!e || true;
            i = t.flightList.length > 1 && i;
            return i ? r.fn(this) : ""
        });
        Handlebars.registerHelper("lineCompanyShortcut",
        function(e, t) {
            return e && e.substr(0, 2)
        });
        Handlebars.registerHelper("hasFc",
        function(e, t) {
            if (e == 2) {
                return t.fn(this)
            } else {
                return t.inverse(this)
            }
        });
        Handlebars.registerHelper("calcLast",
        function(e, t, r) {
            var i, o, n;
            if (t > e) {
                o = moment(t, "HH:mm").toDate();
                n = moment(e, "HH:mm").toDate();
                i = Util.string.timeDiff(n, o)
            } else if (e > t) {
                o = moment(t, "HH:mm").toDate();
                o.setDate(o.getDate() + 1);
                n = moment(e, "HH:mm").toDate();
                i = Util.string.timeDiff(n, o)
            } else {
                i = "0分"
            }
            return "约" + i
        });
        Handlebars.registerHelper("setPageFlightData",
        function(t, r, i) {
            t && r && (p.flight[t] = e.extend(true, {},
            {
                flight: r
            }));
            var o = {};
            o.price = {};
            o.price[t] = r.price;
            h._flightParam = e.extend(true, h._flightParam, o);
            return ""
        });
        Handlebars.registerHelper("currentFlight",
        function(e, t) {
            if (e.flightId == p.flight[p.flight.from.journeyId].flight.flightId) {
                return t.fn(this)
            } else {
                return t.inverse(this)
            }
        });
        Handlebars.registerHelper("calcFlightDiffWithAll",
        function(e, t, r, i) {
            var o;
            e = e || 0;
            o = e - h._flightParam.price[t];
            r.diffPrice = Math.abs(o);
            if (o > 0) {
                return i.fn(this)
            } else if (o < 0) {
                return i.inverse(this)
            } else {
                return ""
            }
        });
        t.flightGroupList.sort(function(e, t) {
            return e.journeyIndex - t.journeyIndex
        });
        i = r(t);
        e(".room-con").html(i)
    }
    function G(t) {
        var r, i, o = true,
        n = "YYYY-MM-DD",
        a, l = "",
        s, c;
        function d(e, t) {
            return "" + t + f({
                id: e,
                value: t
            })
        }
        function f(t) {
            var r = '<input type="hidden" id="{id}" name="{name}" value="{value}" >';
            t = e.extend({
                id: "",
                name: "",
                value: ""
            },
            t);
            e.each(t,
            function(e, t) {
                r = r.replace(new RegExp("\\{" + e + "\\}", "g"), t)
            });
            return r
        }
        function m(t) {
            var r = {},
            i = "checkinDate checkoutDate defaultDelay journeyId livestay" + " maxCheckoutDate maxStayDays minCheckoutDate stayDays".split(" ");
            e.each(t,
            function(e, t) {
                if (i.indexOf(e) > -1) {
                    r[e] = t
                }
            });
            return JSON.stringify(r)
        }
        Handlebars.registerHelper("hasNote",
        function(e, t) {
            if (e) {
                return true
            }
        });
        Handlebars.registerHelper("explainStar",
        function(e, t) {
            var r = Math.ceil(e);
            if (r == e) {
                return r
            } else {
                return r + "x"
            }
        });
        Handlebars.registerHelper("initCheck",
        function(t, r, i) {
            var f = Handlebars.compile(e("#input-select").html()),
            h = {},
            p = {},
            g = "--",
            b,
            y,
            _,
            H,
            k,
            x,
            j,
            w;
            e.extend(true, h, u);
            e.extend(true, p, u);
            h.id = ["s", t.journeyId].join("_");
            p.id = ["e", t.journeyId].join("_");
            y = moment(t.checkinDate);
            _ = y.format(n);
            H = moment(t.checkoutDate);
            k = H.format(n);
            g = H.diff(y, "days");
            w = m(t);
            h.relateId = s;
            p.relateId = h.id;
            h.data = w;
            p.data = w;
            if (t.minCheckoutDate != t.maxCheckoutDate) {
                p.options.push({
                    text: "请选择",
                    value: ""
                });
                x = moment(t.minCheckoutDate);
                j = moment(t.maxCheckoutDate).diff(x, "days") + 1;
                while (j--) {
                    b = {};
                    b.text = x.format(n);
                    b.value = b.text;
                    if (b.value == k) {
                        b["selected"] = "selected"
                    }
                    p.options.push(b);
                    x.add(1, "d")
                }
                s = p.id;
                v = true
            } else {
                b = {};
                b.text = k;
                b.value = b.text;
                p.options.push(b);
                s = ""
            }
            if (o) {
                o = false;
                a = d(h.id, _)
            } else {
                h.options.push({
                    text: _,
                    value: _
                });
                a = f(h)
            }
            l = f(p);
            c = g;
            return i.fn(this)
        });
        Handlebars.registerHelper("showInHtml",
        function(e, t) {
            return a
        });
        Handlebars.registerHelper("showOutHtml",
        function(e, t) {
            return l
        });
        Handlebars.registerHelper("showStay",
        function(e, t) {
            return c
        });
        Handlebars.registerHelper("breakfastShow",
        function(e, t) {
            var r;
            if (/^\d+$/.test(e)) {
                if (e) {
                    r = "含早"
                } else {
                    r = "不含早"
                }
            } else {
                r = e
            }
            return r
        });
        Handlebars.registerHelper("showMoreRoom",
        function(e, t, r) {
            if (t.length > 1) {
                return r.fn(this)
            } else {
                return r.inverse(this)
            }
        });
        Handlebars.registerHelper("showMoreRoomPopup",
        function(e, t, r) {
            if (t.length > 1) {
                return r.fn(this)
            } else {
                return r.inverse(this)
            }
        });
        Handlebars.registerHelper("roomNumSelect",
        function(t, r, i) {
            var o = {},
            n, a, l, s, c;
            s = h.freeOrder;
            e.extend(true, o, u, {
                id: ["rm", r.roomId].join("_")
            });
            c = s.adultnum;
            a = Math.ceil(c / 2);
            l = c;
            for (var d = a; d <= l; d++) {
                o.options.push({
                    text: d,
                    value: d
                })
            }
            n = Handlebars.compile(e("#input-select").html());
            r.roomNumSelectHtml = n(o);
            return i.fn(this)
        });
        Handlebars.registerHelper("roomNumSelectPopup",
        function(t, r, i) {
            var o = {},
            n, a, l, s, c;
            s = h.freeOrder;
            e.extend(true, o, u, {
                id: ["popup", "rm", r.roomId].join("_")
            });
            c = s.adultnum;
            a = Math.ceil(c / 2);
            l = c;
            for (var d = a; d <= l; d++) {
                o.options.push({
                    text: d,
                    value: d,
                    selected: h._hotelParam.roomNum && d == h._hotelParam.roomNum ? "selected": ""
                })
            }
            n = Handlebars.compile(e("#input-select").html());
            r.roomNumSelectHtml = n(o);
            return i.fn(this)
        });
        Handlebars.registerHelper("roomNumSelectPopupSelect",
        function(t, r, i) {
            var o = {},
            n, a, l, s, c;
            s = h.freeOrder;
            e.extend(true, o, u, {
                id: ["rm", r.roomId].join("_")
            });
            c = s.adultnum;
            a = Math.ceil(c / 2);
            l = c;
            for (var d = a; d <= l; d++) {
                o.options.push({
                    text: d,
                    value: d,
                    selected: h._hotelParam.roomNum && d == h._hotelParam.roomNum ? "selected": ""
                })
            }
            n = Handlebars.compile(e("#input-select").html());
            r.roomNumSelectHtml = n(o);
            return i.fn(this)
        });
        Handlebars.registerHelper("canChangeHotel",
        function(e, t, r) {
            if (e && t.length > 1) {
                return r.fn(this)
            } else {
                return r.inverse(this)
            }
        });
        Handlebars.registerHelper("setPageHotelData",
        function(t, r, i) {
            t && r && (p.hotel[t] = e.extend(true, {},
            {
                room: r
            }));
            var o = {};
            o.price = {};
            o.price[t] = r.livingTotalPrice;
            h._hotelParam = e.extend(true, h._hotelParam, o);
            return ""
        });
        Handlebars.registerHelper("setPopupPageHotelData",
        function(t, r, i) {
            t && r && (p.hotel[t] = e.extend(true, {},
            {
                room: r
            }));
            return ""
        });
        Handlebars.registerHelper("currentRoomId",
        function(e, t, r) {
            if (p.hotel[e].room.roomId == t) {
                return r.fn(this)
            } else {
                return r.inverse(this)
            }
        });
        Handlebars.registerHelper("calcDiffWithAll",
        function(e, t, r, i) {
            var o;
            o = e - h._hotelParam.price[t];
            r.diffPrice = Math.abs(o);
            if (o > 0) {
                return i.fn(this)
            } else if (o < 0) {
                return i.inverse(this)
            } else {
                return ""
            }
        });
        Handlebars.registerHelper("splitNote",
        function(e, t, r) {
            if (e) {
                if (!t.productNoteList) {
                    t.productNoteList = e.split(/\r\n/)
                }
                return r.fn(this)
            } else {
                return r.inverse(this)
            }
        });
        i = Handlebars.compile(e("#list-hotel").html());
        r = i(t);
        e(".room-con").append(r)
    }
    function Y(t) {
        var r, i;
        r = Handlebars.compile(e("#list-tour").html());
        i = r(t);
        e(".room-con").append(i)
    }
    function E(t) {
        var r, i;
        Handlebars.registerHelper("showNoFlight",
        function(e, t) {
            var r = [];
            e.ticketItemProductList && e.ticketItemProductList.forEach(function(e) {
                if (e.journeyId) {
                    r.push(e)
                }
            });
            if (r.length > 0) {
                e.canShowList = r;
                return t.fn(this)
            }
        });
        Handlebars.registerHelper("showTicketSelect",
        function(t, r) {
            var i = {},
            o;
            e.extend(true, i, u);
            for (var n = t.minperson; n <= t.maxperson; n++) {
                i.options.push({
                    text: n,
                    value: n
                })
            }
            o = Handlebars.compile(e("#input-select").html());
            t.showTicketSelectHtml = o(i);
            return r.fn(this)
        });
        i = Handlebars.compile(e("#list-scenic").html());
        r = i(t);
        e(".room-con").append(r)
    }
    function B(t) {
        var r, i, o;
        o = Handlebars.compile(e("#list-traffic").html());
        Handlebars.registerHelper("showTrafficCount",
        function(e, t) {
            return (isNaN(e.adultnum) ? 0 : e.adultnum) + (isNaN(e.childnum) ? 0 : e.childnum)
        });
        Handlebars.registerHelper("canTrifficChange",
        function(e, t) {
            if (e.notFlightList.length > 1) {
                return t.fn(this)
            }
        });
        Handlebars.registerHelper("setPageTrafficData",
        function(t, r, i) {
            t.journeyId && r && (p.traffic[t.journeyId] = e.extend(true, {},
            {
                traffic: r
            }));
            var o = {};
            o.price = {};
            o.price[t.journeyId] = r.dayPrice || 0;
            h._trafficParam = e.extend(true, h._trafficParam, o);
            return ""
        });
        Handlebars.registerHelper("currentNotFlight",
        function(e, t) {
            if (e.flightId == p.traffic[p.traffic.from.journeyId].traffic.flightId) {
                return t.fn(this)
            } else {
                return t.inverse(this)
            }
        });
        Handlebars.registerHelper("trafficNum",
        function(e) {
            var t = h.freeOrder;
            return parseInt(t.adultnum || 0) + parseInt(t.childnum || 0)
        });
        Handlebars.registerHelper("ifTrafficCouple",
        function(e, t) {
            if (e == 2) {
                return t.fn(this)
            } else if (e == 1) {
                return t.inverse(this)
            }
        });
        Handlebars.registerHelper("calcTraffDiffWithAll",
        function(e, t, r, i) {
            var o;
            e = e || 0;
            o = e - h._trafficParam.price[t];
            r.diffPrice = Math.abs(o);
            if (o > 0) {
                return i.fn(this)
            } else if (o < 0) {
                return i.inverse(this)
            } else {
                return ""
            }
        });
        i = o(t);
        e(".room-con").append(i)
    }
    function U(t) {
        var r, i, o, n = [];
        Handlebars.registerHelper("otherNum",
        function(e) {
            var t, r;
            t = h.freeOrder;
            r = (t.adultnum || 0) + (t.childnum || 0);
            return r
        });
        Handlebars.registerHelper("otherCanChange",
        function(e, t) {
            if (e.length > 1) {
                return t.fn(this)
            }
        });
        Handlebars.registerHelper("setPageOtherData",
        function(t, r) {
            t && (p.other[t.journeyId] = e.extend(true, {},
            {
                other: t
            }));
            var i = {};
            i.price = {};
            i.price[t.journeyId] = t.price || 0;
            h._otherParam = e.extend(true, h._otherParam, i);
            return ""
        });
        Handlebars.registerHelper("currentOther",
        function(e, t) {
            if (e.id == p.other[p.other.from.journeyId].other.id) {
                return t.fn(this)
            } else {
                return t.inverse(this)
            }
        });
        Handlebars.registerHelper("calcOtherDiffWithAll",
        function(e, t, r, i) {
            var o;
            e = e || 0;
            o = e - h._otherParam.price[t];
            r.subprice = Math.abs(o);
            if (o > 0) {
                return i.fn(this)
            } else if (o < 0) {
                return i.inverse(this)
            } else {
                return ""
            }
        });
        e.each(t.otherMap,
        function(e, t) {
            t.forEach(function(t) {
                t.journeyId = e
            });
            n.push(t)
        });
        if (n.length) {
            o = Handlebars.compile(e("#list-other").html());
            i = o(n);
            e(".room-con").append(i)
        }
    }
    function q(r, i) {
        var o = t({
            startDate: i,
            proInfo: {},
            holiday: r.holiday,
            buildLink: r.cal4proBuildLink,
            proClick: function(e, t) {
                t.preventDefault()
            }
        });
        e(r.priceSelector).replaceWith(o.addClass("mt20"))
    }
    f = {
        init: function(t) {
            var i, o, a = e.extend({},
            c, t);
            b = document.forms["order"];
            i = e(".input-num");
            l = new r.simple(i[0], {
                name: "adultNum"
            });
            s = new r.simple(i[1], {
                name: "childNum",
                disabled: !!i.eq(1).find("input.disabled").length
            });
            o = e(".input-group");
            n = new r.rich(o[0], d);
            this.initCalcPrice(a);
            this.initHover(a);
            this.addTabEvent(a);
            this.initStickyup(a);
            this.initSubmit(a);
            this.initTip(a);
            this.initDaysEvent(a);
            this.initOrderEvent(a);
            this.initMoreRoomEvent(a);
            this.initPopup(a);
            this.initTrafficPopup(a);
            this.initFlightPopup(a);
            this.initOtherPopup(a);
            this.initShowBigImg(a);
            this.initShowMsg(a);
            this.initLoginCallback(a);
            n.onchange(function() {
                O.call(this, a)
            });
            s.onchange(function() {
                O.call(this, a)
            });
            l.onchange(function() {
                if (N()) {
                    var e, t = [],
                    r;
                    e = +(this.val() || 0) * 2;
                    e > 10 && (e = 10);
                    for (var i = 0; i <= e; i++) {
                        r = {};
                        r.value = r.text = i;
                        t.push(r)
                    }
                    s && s.setup(t);
                    s && s.val() > e && s.val(e)
                }
                O.call(this, a)
            })
        },
        initOrderEvent: function(t) {
            var r = e(".room-con"),
            i = "YYYY-MM-DD",
            o = {},
            n = e("#back_select"),
            l,
            s;
            r.on("change", "table.hotel-table select[id^=s_]",
            function() {
                var t, o, n, a, l, s, c, d, u, f, h, p, m, g;
                a = r.find("[relateid='" + this.id + "']");
                if (a.length) {
                    l = e(this).data("hotel");
                    c = moment(this.value);
                    a[0].options.length = 0;
                    if (l.minCheckoutDate != l.maxCheckoutDate) {
                        a[0].options[0] = new Option("请选择", "");
                        g = moment(l.minCheckoutDate).diff(moment(l.checkinDate), "days");
                        s = moment(l.maxCheckoutDate).diff(moment(l.minCheckoutDate), "days") + 1;
                        u = moment(c.format(i)).add(g, "days");
                        while (s--) {
                            f = u.format(i);
                            a[0].options[a[0].length] = new Option(f, f);
                            u.add(1, "d").format(i)
                        }
                    } else {
                        p = c.add(l.stayDays, "d").format(i);
                        a[0].options[0] = new Option(p, p)
                    }
                    t = this.value;
                    o = e(this).parent().next().find(":input").val();
                    n = e(this).parent().prev();
                    if (t && o) {
                        n.html(moment(o).diff(moment(t), "days"))
                    } else {
                        n.html("--")
                    }
                    a.trigger("change")
                }
            });
            r.on("change", "table.hotel-table select[id^=e_]",
            function() {
                var o = this,
                n, l, s, c, d, u, f, p, m, g;
                n = this.value;
                l = e(this).parent().prev().find(":input").val();
                s = e(this).parent().prev().prev();
                u = e(this).data("hotel");
                c = r.find("[relateid='" + this.id + "']");
                if (l && n) {
                    _ = false;
                    s.html(moment(n).diff(moment(l), "days"));
                    if (c.length) {
                        d = c.data("hotel");
                        if (n) {
                            f = moment(d.checkinDate).diff(moment(u.checkoutDate), "days");
                            m = moment(n).add(f, "days")
                        } else {
                            m = moment(d.checkinDate)
                        }
                        g = m.format(i);
                        c[0].options.length = 0;
                        c[0].options[0] = new Option(g, g);
                        c.trigger("change")
                    } else {
                        if (!_) {
                            P(t);
                            O(t)
                        } else {
                            p = moment(h.freeOrder.dateToBack).diff(u.checkoutDate);
                            j(moment(n).add(p, "days").format(i));
                            I(t)
                        }
                    }
                } else {
                    s.html("--");
                    if (!c.length) {
                        a && a.val("")
                    }
                    e("#orderPriceNo").show();
                    e("#orderPriceYes").hide()
                }
            })
        },
        initMoreRoomEvent: function(t) {
            var r = e(t.listRootSelector);
            r.on("click", "[btn='moreRoomUnfolder']",
            function() {
                var t = e(this).hide().next().show().parents("table:first");
                t.find("tr:first").show();
                t.find("tr[main]").show();
                t.find("td.col-05").show()
            });
            r.on("click", "[btn='moreRoomFolder']",
            function() {
                var t, r, i;
                t = e(this).parents("tr:first").hide();
                r = t.parents("table:first");
                r.find("tr[st='0']").hide();
                i = r.find("tr[st='1']");
                r.find("tr[note]").each(function() {
                    i.next()[0] != this && e(this).hide()
                });
                i.find('[btn="moreRoomUnfolder"]').show();
                i.find("[choosed]").hide();
                i.find("td.col-05").hide()
            });
            r.on("change", 'select[id^="rm_"]',
            function() {
                r.find('select[id^="rm_"]').not(this).val(this.value);
                I(t)
            });
            r.on("click", "span.text-underline",
            function() {
                var t = e(this).parents("tr:first"),
                r = t.next();
                e(this).parents("table:first").find("tr[note]").each(function() {
                    r[0] == this ? r.data("note") && r.toggle() : e(this).hide()
                })
            });
            r.on("click", "[choose]",
            function() {
                var r, i, o, n, a, l, s;
                s = e(this).data();
                a = s.journeyId;
                n = e(this).parents("table.room-table");
                e.type(s.room) === "string" && (s.room = JSON.parse(g.decode(s.room)));
                p.hotel[a].room = s.room;
                n.find("[choosed]").hide();
                n.find("[choose]").show();
                i = e(this).hide().prev().show().parents("tr:first");
                i.attr("st", 1).find("input[type='hidden']").prop("disabled", false);
                i.find(":checkbox").prop("checked", true);
                o = h._hotelParam.price[a] = i.find("[data-yen]").html("<em>¥</em>0").data("yen");
                r = i.siblings("[main]");
                r.attr("st", "0").find("input[type='hidden']").prop("disabled", true);
                r.find(":checkbox").prop("checked", false);
                r.find("[data-yen]").each(function() {
                    var t = e(this).data("yen") - o;
                    e(this).html([t > 0 ? "+": t < 0 ? "-": "", "<em>¥</em>", Math.abs(t)].join(""))
                });
                I(t)
            })
        },
        initDaysEvent: function(t) {
            var r = e(t.dayListSelector),
            i = r.css("top"),
            o,
            n,
            a,
            l,
            s,
            c = [],
            d = {},
            u = e(".detail-route"),
            f = false;
            if (r.length) {
                r.on("click", "li",
                function() {
                    e("html,body").animate({
                        scrollTop: e("#" + e(this).data("id")).offset().top - 60
                    },
                    {
                        queue: false,
                        duration: 350
                    })
                });
                n = {
                    top: r.css("top"),
                    fixedTop: 60
                };
                s = u.find("[id^='day']");
                a = r.outerHeight(true);
                function h() {
                    if (!c.length || s.eq(0).offset().top != c[0].top) {
                        d.top = u.offset().top - 60;
                        d.bottom = d.top + u.outerHeight(true);
                        s.each(function(e) {
                            c[e] = {
                                top: e > 0 ? s.eq(e).offset().top - 120 : s.eq(e).offset().top,
                                bottom: e == s.length - 1 ? d.bottom: s.eq(e + 1).offset().top
                            }
                        })
                    }
                }
                o = function() {
                    var t, i, o, l;
                    h();
                    t = e(this).scrollTop();
                    i = d.bottom - t;
                    o = a - i;
                    if (t >= d.top && t < d.bottom) {
                        r.addClass("fixed");
                        c.forEach(function(e, i) {
                            if (t > e.top && t < e.bottom) {
                                r.children(":eq(" + i + ")").addClass("selected").siblings().removeClass("selected")
                            }
                        });
                        r.css({
                            top: o > 0 ? n.fixedTop - o: n.fixedTop
                        })
                    } else {
                        r.css({
                            top: n.top
                        }).removeClass("fixed").children(":eq(0)").addClass("selected").siblings().removeClass("selected")
                    }
                };
                e(window).resize(o).scroll(o).load(o)
            }
        },
        initStickyup: function(t) {
            e(t.navTablSelector).stickyNavbar({
                activeClass: "selected",
                sectionSelector: "toscroll",
                selector: "li",
                startAt: 30
            })
        },
        initHover: function(t) {
            var r = this;
            e(document).on({
                mouseenter: function() {
                    e(this).find(t.relTip).show()
                },
                mouseleave: function() {
                    e(this).find(t.relTip).hide()
                }
            },
            t.hoverRel)
        },
        initTip: function(t) {
            e(document).click(function(r) {
                var i = e(t.relTip);
                if (r.target != e(t.submitBtn)[0] && !e(r.target).closest(i).length) {
                    i.hide()
                }
            }).on({
                mouseenter: function(t) {
                    e(this).next().show()
                },
                mouseleave: function(t) {
                    e(this).next().hide()
                }
            },
            "#singleTip")
        },
        initPrice: function(t, r) {
            var i = {};
            if (!L() && !r) {
                i["thirdpartid"] = document.forms[0]["pid"].value;
                i["productType"] = e("#productType").val();
                e.getJSON(t.freshPriceUrl, i).done(function(r) {
                    if (r && r.Code == "0") {
                        var i = e(t.priceDivSelector);
                        i.prev().remove();
                        i.next(":not(.route-line)").remove();
                        i.replaceWith(r.html)
                    }
                })
            } !! r && e(t.showPriceSelector).html(t.sellOutHtml)
        },
        initCalcPrice: function(r) {
            var i, o, a = new Date,
            l = e(r.submitBtn),
            s,
            c,
            d,
            u,
            f,
            h = this;
            r.url = r.remoteUrl;
            r.url = r.url.indexOf("#") > -1 ? r.url.substring(0, r.url.indexOf("#")) : r.url;
            o = [a.getFullYear(), a.getMonth() + 1, a.getDate()].join("-").replace(/\b(\w)\b/g, "0$1");
            q(r, o);
            f = L() ? e.Deferred(function(e) {
                e.resolve({});
                return e.promise()
            }) : e.ajax({
                url: r.url,
                type: "GET",
                cache: true,
                data: e.isFunction(r.remoteGetData) && r.remoteGetData.call(null),
                dataType: "jsonp",
                jsonp: "callBack",
                jsonpCallback: "__pr_mg_cache__"
            });
            f.done(function(t) {
                var r = [],
                i,
                a;
                if (!t || t.Code && t.Code != 0 || t.Result && t.Result.priceData && !t.Result.priceData.length || e.isEmptyObject(t)) {
                    a = true;
                    t = t || {}
                }
                if (!a) {
                    i = w(t, o);
                    r = i[0];
                    s = i[1];
                    d = i[2]
                }
                c = t;
                r.sort(x);
                r.length < 2 && (u = true);
                n.setup(r); ! a && !u && l.removeAttr("disabled").removeClass("disabled")
            }).fail(function(e) {
                c = {};
                if (e && e.readyState == 4) {
                    k("网络延时，请重试")
                }
            }).always(function() {
                i = t({
                    startDate: s || o,
                    proInfo: c,
                    holiday: r.holiday,
                    buildLink: r.cal4proBuildLink,
                    proClick: function(t, r) {
                        n.val(e(this).data("date"), true);
                        e("html,body").animate({
                            scrollTop: e("#searchzone").offset().top - 12
                        },
                        {
                            queue: false
                        });
                        t.find(".tbl_con a").removeClass("selected");
                        e(this).addClass("selected");
                        r.preventDefault()
                    }
                });
                e(r.priceSelector).replaceWith(i.addClass("mt20"));
                u && (i.prepend('<div class="cal-ysw"></div>'), e(".d_price span.yellow-a:first").addClass("mr20"));
                d && D(d, true);
                var a = Util.bom.getQuery("date");
                a && n.val(a, true);
                h.initPrice(r, u)
            })
        },
        initPopup: function(t) {
            var r = e("#popup_hotel_header_root"),
            i = e("#popup_hotel_list_root"),
            o = e("#popup_hotel_btn_confirm"),
            n;
            e(document).on("click", "a.close",
            function() {
                e(this).parents(".popup-box").hide();
                e(".mask").hide();
                e("body").css("overflow", "").css("paddingRight", "")
            }).on("click", "a.change-btn[data-id]",
            function() {
                e(".mask").show();
                e("body").css("overflow", "hidden").css("paddingRight", "17px");
                e("#" + e(this).data("id")).show()
            });
            e(t.listRootSelector).on("click", "[data-id='hotelPopup']",
            function() {
                var t, r, i, o, n, a, l, s, c, d;
                r = e(this).data("index");
                if (h) {
                    t = h.hotelGroupList[r];
                    p.hotel.from = {
                        index: r,
                        journeyId: t.journeyId
                    };
                    c = p.hotel[t.journeyId].room.roomId;
                    t.hotelList.sort(function(e, t) {
                        var r = 0; [e, t].every(function(e, t) {
                            if (e.roomTypeList.every(function(t) {
                                if (c == t.roomId) {
                                    d = e.singleProductId;
                                    return false
                                }
                                return true
                            })) {
                                r = t ? -1 : 1;
                                return false
                            }
                            return true
                        });
                        return r
                    });
                    e("#popup_hotel_header_city").html("入住城市 —— " + t.city);
                    e("#popup_hotel_btn_confirm").data("journeyId", t.journeyId).data("changed", false);
                    l = {};
                    e.extend(true, l, p.hotel[t.journeyId].room);
                    l.singleProductId = d;
                    l.roomNum = e("#rm_" + l.roomId).val();
                    l.checkinDate = e("#s_" + t.journeyId).val();
                    l.checkoutDate = e("#e_" + t.journeyId).val();
                    o = Handlebars.compile(e("#popup-hotel-list").html());
                    h._hotelParam.roomNum = l.roomNum;
                    n = o(t);
                    e("#popup_hotel_list_root").html(n);
                    a = Handlebars.compile(e("#popup-hotel-header").html());
                    e("#popup_hotel_header_root").html(a(l))
                }
            });
            i.on("click", "[popupchoose]",
            function() {
                var t = e(this).data(),
                n,
                a,
                l,
                s,
                c,
                d;
                o.data("changed", true);
                e.type(t.room) === "string" && (t.room = JSON.parse(g.decode(t.room)));
                n = {};
                e.extend(true, n, t.room);
                n.singleProductId = t.hotelId;
                n.roomNum = e("#popup_rm_" + n.roomId).val();
                n.checkinDate = e("#s_" + p.hotel.from.journeyId).val();
                n.checkoutDate = e("#e_" + p.hotel.from.journeyId).val();
                m.hotel[t.journeyId] = e.extend(true, {},
                {
                    room: t.room,
                    roomNum: n.roomNum
                });
                e.extend(true, m.hotel[t.journeyId], {
                    hotel: h.hotelGroupList[p.hotel.from.index]
                });
                a = Handlebars.compile(e("#popup-hotel-header").html());
                r.html(a(n));
                i.find("[popupchoosed]").hide().next().show();
                i.find("tr[main]").attr("st", "0");
                l = e(this).hide().prev().show().parents("tr[main]:first").attr("st", 1);
                c = l.find("[data-yen]").data("yen");
                i.find("[data-yen]").each(function() {
                    var t = e(this).data("yen") - c;
                    e(this).html([t > 0 ? "+": t < 0 ? "-": "", "<em>¥</em>", Math.abs(t)].join(""))
                })
            });
            i.on("click", "span.text-underline",
            function() {
                var t = e(this).parents("tr:first"),
                r = t.next();
                e(this).parents("table:first").find("tr[note]").each(function() {
                    r[0] == this ? r.toggle() : e(this).hide()
                })
            });
            i.on("change", "select[id^='popup_rm_']",
            function() {
                var t, n, a = i.find("tr[main]"),
                l = this;
                r.find(".col-08 span").html(l.value);
                a.each(function() {
                    n = e(this);
                    n.find("select[id^='popup_rm_']").val(l.value);
                    if (n.attr("st") == 1) {
                        t = n.find("[popupchoose]").data();
                        if (!m.hotel[t.journeyId]) {
                            e.type(t.room) === "string" && (t.room = JSON.parse(g.decode(t.room)));
                            m.hotel[t.journeyId] = e.extend(true, {},
                            {
                                room: t.room
                            })
                        }
                        m.hotel[t.journeyId].roomNum = l.value;
                        o.data("changed", true)
                    }
                })
            });
            o.click(function() {
                var r, i, n, a, l, s, c;
                if (o.data("changed")) {
                    c = {};
                    r = e(this).data("journeyId");
                    i = m.hotel[r].room;
                    var d = e("tr[data-journey-id='" + r + "']");
                    n = Handlebars.compile(e("#hotel-col2").html());
                    a = Handlebars.compile(e("#hotel-col3").html());
                    h.hotelGroupList.every(function(e, t) {
                        e.hotelList.every(function(e, o) {
                            e.roomTypeList.every(function(n, a) {
                                if (n.roomId == i.roomId) {
                                    c.groupIndex = t;
                                    c.hotelIndex = o;
                                    c.roomIndex = a;
                                    l = e;
                                    c.price = {};
                                    c.price[r] = i.livingTotalPrice;
                                    return false
                                }
                                return true
                            });
                            return true
                        });
                        return true
                    });
                    c.roomNum = p.hotel[r].roomNum = m.hotel[r].roomNum;
                    e.extend(true, h._hotelParam, c);
                    d.children("td.col-02").html(n(l));
                    d.children("td.col-03").html(a(h))
                }
                e("#hotelPopup").find("a.close").trigger("click");
                e(".mask").hide();
                I(t)
            })
        },
        initTrafficPopup: function(t) {
            e(t.listRootSelector).on("click", "[data-id='trafficPopup']",
            function() {
                var t, r, i, o, n, a;
                r = e(this).parents("tr:first").index();
                if (h) {
                    t = h.notFlightGroupList[r];
                    p.traffic.from = {
                        index: r,
                        journeyId: t.journeyId
                    };
                    o = Handlebars.compile(e("#popup-traffic-list").html());
                    t.notFlightList.sort(function(e, t) {
                        return e.dayPrice - t.dayPrice
                    });
                    e("#popup_traffic_content_root").html(o(t));
                    e("#popup_traffic_btn_confirm").data("changed", false)
                }
            });
            var r = e("#trafficPopup");
            r.on("click", "[popupchoose]",
            function() {
                var t = e(this).data(),
                i,
                o;
                e("#popup_traffic_btn_confirm").data("changed", true);
                e.type(t.traffic) === "string" && (t.traffic = JSON.parse(g.decode(t.traffic)));
                m.traffic[t.journeyId] = e.extend(true, {},
                {
                    traffic: t.traffic
                });
                r.find("[popupchoosed]").hide();
                r.find("[popupchoose]").show();
                o = e(this).hide().prev().show().parents("tr:first");
                i = o.find("[data-rmb]").data("rmb");
                r.find("[data-rmb]").each(function() {
                    var t = e(this).data("rmb") - i;
                    e(this).html([t > 0 ? "+": t < 0 ? "-": "", "<em>¥</em>", Math.abs(t)].join(""))
                })
            });
            e(document).on("click", "#popup_traffic_btn_confirm",
            function() {
                var i, o, n, a;
                if (e("#popup_traffic_btn_confirm").data("changed")) {
                    a = p.traffic.from.index;
                    n = h.notFlightGroupList[a];
                    n.currentFlightId = m.traffic[p.traffic.from.journeyId].traffic.flightId;
                    e.extend(true, p.traffic[p.traffic.from.journeyId].traffic, m.traffic[p.traffic.from.journeyId].traffic);
                    i = Handlebars.compile(e("#list-traffic-inner").html());
                    e("#traffic_root").find("tr").eq(a).html(i(n))
                }
                r.hide();
                e(".mask").hide();
                I(t)
            })
        },
        initFlightPopup: function(t) {
            var r, i, o, n, a;
            a = e("#flightPopup");
            o = e("#popup-flight-header-root");
            r = e("#popup-flight-tab-root");
            i = e("#popup-flight-list-root");
            n = e("#popup_flight_btn_confirm");
            r.find("li[leave]").click(function() {
                i.find("tr[type='leave']").show();
                i.find("tr[type='rtn']").hide();
                e(this).addClass("selected").siblings().removeClass("selected")
            });
            r.find("li[rtn]").click(function() {
                i.find("tr[type='leave']").hide();
                i.find("tr[type='rtn']").show();
                e(this).addClass("selected").siblings().removeClass("selected")
            });
            e(t.listRootSelector).on("click", "[data-id='flightPopup']",
            function() {
                var t, a, l, s, c, d;
                a = e(this).data("journeyId");
                r.find("li[leave]").trigger("click");
                if (h) {
                    t = p.flight[a].flight;
                    h.flightGroupList.every(function(e, t) {
                        if (e.journeyId == a) {
                            d = e;
                            p.flight.from = {
                                index: t,
                                journeyId: a
                            };
                            return false
                        }
                        return true
                    });
                    d.flightList.sort(function(e, t) {
                        return e.price - t.price
                    });
                    l = Handlebars.compile(e("#popup-flight-header").html());
                    c = Handlebars.compile(e("#popup-flight-list").html());
                    o.html(l(t));
                    i.html(c(d));
                    n.data("changed", false)
                }
            });
            i.on("click", "[popupchoose]",
            function() {
                var t = e(this).data(),
                r,
                a,
                l,
                s;
                n.data("changed", true);

                s = Handlebars.compile(e("#popup-flight-header").html());
                e.type(t.flight) === "string" && (t.flight = JSON.parse(g.decode(t.flight)));
                o.html(s(t.flight));
                m.flight[t.journeyId] = e.extend(true, {},
                {
                    flight: t.flight
                });
                a = e(this).parents("tr:first");
                i.find("[popupchoosed]").hide();
                i.find("[popupchoose]").show();
                e(this).hide().prev().show();
                l = i.find("[" + t.type + "='" + t.flightId + "']");
                l.length && l.hide().prev().show();
                r = a.find("[data-rmb]").data("rmb");
                i.find("[data-rmb]").each(function() {
                    var t = e(this).data("rmb") - r;
                    e(this).html([t > 0 ? "+": t < 0 ? "-": "", "<em>¥</em>", Math.abs(t)].join(""))
                })
            });
            n.click(function() {
                var r, i, o, l, s;
                if (n.data("changed")) {
                    l = p.flight.from.index;
                    o = h.flightGroupList[l];
                    s = o.journeyId;
                    e.extend(true, p.flight[s].flight, m.flight[s].flight);
                    i = Handlebars.compile(e("#list-flight-inner").html());
                    e("table.flight-table[journeyid='" + s + "']").html(i(o))
                }
                a.find("a.close").trigger("click");
                e(".mask").hide();
                I(t)
            })
        },
        initOtherPopup: function(t) {
            var r = e("#popup_other_btn_confirm"),
            i = e("#popup_other_content_root");
            e(t.listRootSelector).on("click", "[data-id='otherPopup']",
            function() {
                var t, o, n;
                o = e(this).data("journeyId");
                if (h) {
                    t = h.otherMap[o];
                    p.other.from = {
                        journeyId: o
                    };
                    n = Handlebars.compile(e("#popup-other-list").html());
                    t.sort(function(e, t) {
                        return e.price - t.price
                    });
                    i.html(n(t));
                    r.data("changed", false)
                }
            });
            var o = e("#otherPopup"),
            r = e("#popup_other_btn_confirm");
            o.on("click", "[popupchoose]",
            function() {
                var t = e(this).data(),
                i,
                n;
                r.data("changed", true);
                e.type(t.other) === "string" && (t.other = JSON.parse(g.decode(t.other)));
                m.other[t.journeyId] = e.extend(true, {},
                {
                    other: t.other
                });
                o.find("[popupchoosed]").hide();
                o.find("[popupchoose]").show();
                n = e(this).hide().prev().show().parents("tr:first");
                i = n.find("[data-rmb]").data("rmb");
                o.find("[data-rmb]").each(function() {
                    var t = e(this).data("rmb") - i;
                    e(this).html([t > 0 ? "+": t < 0 ? "-": "", "<em>¥</em>", Math.abs(t)].join(""))
                })
            });
            e(document).on("click", "#popup_other_btn_confirm",
            function() {
                var i, n, a;
                if (r.data("changed")) {
                    a = p.other.from.journeyId;
                    i = h.otherMap[a];
                    e.extend(true, p.other[p.other.from.journeyId].other, m.other[p.other.from.journeyId].other);
                    n = Handlebars.compile(e("#list-other-inner").html());
                    e("#other_root").find("tr[data-row='" + a + "']").html(n(i))
                }
                o.find("a.close").trigger("click");
                e(".mask").hide();
                I(t)
            })
        },
        addTabEvent: function(t) {
            var r, i = "selected",
            o = ".detail-h2",
            n = ".detail-article",
            a = ".tab-menu li";
            r = e(o).filter(function() {
                return e(this).next(n).length
            });
            r.on("click", a,
            function() {
                var t = this,
                r, n;
                r = e(this).index();
                e(this).addClass(i).siblings().removeClass(i);
                n = e(this).parents(o).eq(0).next();
                n.children("div").each(function(t) {
                    t == r ? e(this).show() : e(this).hide()
                })
            })
        },
        initSubmit: function(t) {
            var r = e(t.submitBtn);
            r.on("click.order", t, T);
            e(b).submit(function() {
                return R.call(this, t)
            })
        },
        initShowBigImg: function(t) {
            e("a.showBig").each(function() {
                var t = e(this);
                t.fancybox({
                    padding: 0,
                    type: "image",
                    onStart: function() {
                        e("body").css("overflow", "hidden").css("paddingRight", "17px")
                    },
                    onClosed: function() {
                        e("body").css("overflow", "").css("paddingRight", "")
                    }
                })
            })
        },
        initShowMsg: function() {
            e("body").on("click", "#mg_msg_btn_con",
            function() {
                e("#mg_msg").hide()
            })
        },
        initLoginCallback: function(e) {
            window.afterDirectBook = function() {
                T.call(null, {
                    data: e
                },
                true)
            }
        }
    };
    return f
});
define(function(require, exports, module) {
    var i = require("jquery");
    require("pcc");
    require("placeholder");
    var e = this,
    t = "";
    i.extend({
        unitFillRight: true,
        touristlist: []
    });
    var n = {
        showMoreSelector: "a.show-fold",
        touristBox: ".tour-info",
        scoreTitle: ".score-tit",
        scoreBox: ".score-detail",
        contactBox: ".contact-box",
        contactPopBox: ".msg-pop-wrap",
        invoiceBox: "#invoice-box",
        paymentBox: ".payment-tot-wrap",
        recProductBox: ".rec-bd",
        recipientPopBox: ".recipient-pop",
        disTpl: '{name}<span class="tot-discount-price font-en"><span class="price-ico ico-mg font-yahei">¥</span>{price}</span>'
    };
    var a = {
        emptyTourName: "请填写旅客姓名",
        rightTourName: "请填写正确的旅客姓名",
        emptyName: "请填写联系人姓名",
        rightName: "请填写正确的联系人姓名",
        emptyPhone: "请填写手机号码",
        rightPhone: "请填写正确的手机号码",
        emptyEmail: "请填写电子邮箱",
        rightEmail: "请填写正确的邮箱号码",
        emptyHeader: "请填写发票抬头",
        rightHeader: "请填写正确的发票抬头",
        emptyReceiver: "请填写收件人",
        rightReceiver: "请填写正确的收件人",
        emptyAdress: "请填写详细地址",
        rightAdress: "请填写正确的街道地址",
        emptyId: "请填写身份证号码",
        rightId: "请填写正确的身份证号码",
        rightCode: "请填写正确的邮政编码",
        rightPsEffect: "请填写正确的护照有效期",
        emptyPsEffect: "请填写护照有效期",
        emptySex: "请选择性别",
        emptyProvince: "请选择省份",
        haveSameName: "有相同的旅客姓名",
        haveSameCert: "有相同的证件信息",
        rightPassport: "请填写正确护照信息",
        rightId: "请填写正确身份证信息",
        rightHkPass: "请填写正确港澳通行证信息",
        rightRemark: "请正确填写备注"
    };
    function s(i) {
        this.item = i
    }
    function o(i) {
        this.item = i
    }
    function r(i) {
        this.item = i
    }
    function d(i) {
        this.item = i
    }
    function c(i) {
        this.item = i
    }
    s.prototype = {
        vali: function(i, e, t, n) {
            if (n == "required") {
                if (this.isempty()) {
                    this.showTips(t);
                    return false
                }
                if (!this.test(i)) {
                    this.showTips(e);
                    return false
                } else {
                    this.hideTips();
                    return true
                }
            } else if (n == "norequired") {
                if (this.isempty()) {
                    this.hideTips();
                    return true
                }
                if (!this.test(i)) {
                    this.showTips(e);
                    return false
                } else {
                    this.hideTips();
                    return true
                }
            }
        },
        test: function(i) {
            return i.test(this.item.val())
        },
        isempty: function() {
            return this.item.val() == ""
        },
        showTips: function(e) {
            this.item.next().data("hidden", false).show().css("color", "#ff9900");
            i(this.item).next().text(e);
            i(this.item).css("border-color", "#ff9900");
            i(this.item).parent().data("valid", false);
            if (i(this.item).parent().hasClass("checked")) {
                i(this.item).parent().data("valid", false).removeClass("checked").addClass("unchecked")
            }
            if (i(this.item).parent().parent().hasClass("checked")) {
                i(this.item).parent().parent().data("valid", false).removeClass("checked").addClass("unchecked")
            }
        },
        hideTips: function(e) {
            this.item.next().data("hidden", true).hide();
            i(this.item).css("border-color", "#bec3c7");
            i(this.item).parent().data("valid", true);
            if (i(this.item).parent().hasClass("unchecked")) {
                i(this.item).parent().removeClass("unchecked").addClass("checked")
            }
            if (i(this.item).parent().parent().hasClass("unchecked")) {
                i(this.item).parent().parent().data("valid", true).removeClass("unchecked").addClass("checked")
            }
        }
    };
    o.prototype = new s;
    o.prototype.vali = function(e, t, n) {
        var a = /[\u4e00-\u9fa5Z]/g,
        s = /[a-zA-Z]/g;
        if (this.isempty()) {
            this.showTips(n);
            i(this.item).parent().parent().parent().data("filled", false);
            return false
        }
        if (!this.test(e)) {
            this.showTips(t);
            i(this.item).parent().parent().parent().data("filled", false);
            return false
        } else {
            if (this.test(a) && !this.test(s)) {
                if (this.item.val().length > 10) {
                    t = "中文不能超过10个汉字";
                    this.showTips(t);
                    i(this.item).parent().parent().parent().data("filled", false);
                    return false
                } else if (this.item.val().length <= 1) {
                    t = "中文不能少于1个汉字";
                    this.showTips(t);
                    i(this.item).parent().parent().parent().data("filled", false);
                    return false
                } else {
                    this.hideTips();
                    i(this.item).parent().parent().parent().data("filled", true);
                    return true
                }
            } else if (this.test(s) && !this.test(a)) {
                if (this.item.val().length > 26) {
                    t = "英文不能超过26个字母";
                    this.showTips(t);
                    i(this.item).parent().parent().parent().data("filled", false);
                    return false
                } else if (this.item.val().length <= 1) {
                    t = "英文名不能少于1个字母";
                    this.showTips(t);
                    i(this.item).parent().parent().parent().data("filled", false);
                    return false
                } else {
                    this.hideTips();
                    i(this.item).parent().parent().parent().data("filled", true);
                    return true
                }
            }
            i(this.item).parent().parent().parent().data("filled", false);
            this.showTips(t);
            return false
        }
    };
    r.prototype = new s;
    r.prototype.vali = function(i, e, t) {
        if (this.isempty()) {
            this.showTips(t);
            return false
        }
        if (!this.test(i)) {
            this.showTips(e);
            return false
        } else {
            var n = /^[0-9]*$/;
            if (this.test(n)) {
                e = "地址不能为纯数字";
                this.showTips(e);
                return false
            }
            if (this.item.val().length > 30) {
                e = "已经超出最大输入长度30个字符";
                this.showTips(e);
                return false
            } else {
                this.hideTips();
                return true
            }
        }
    };
    d.prototype = new s;
    d.prototype.vali = function(i) {
        var e = /[\u4e00-\u9fa5Za-zA-Z0-9]/g;
        if (this.isempty()) {
            this.hideTips();
            return true
        }
        if (!this.test(e)) {
            this.showTips(i);
            return false
        } else {
            if (this.item.val().length > 200) {
                i = "已经超出最大输入长度200个字符";
                this.showTips(i);
                return false
            } else {
                this.hideTips();
                return true
            }
        }
    };
    c.prototype = new s;
    c.prototype.vali = function(i, e, t, n) {
        var a = /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/g;
        if (n == "required") {
            if (this.isempty()) {
                this.showTips(t);
                return false
            }
            if (!this.test(a)) {
                this.showTips(e);
                return false
            } else {
                this.hideTips();
                return true
            }
        } else if (n == "norequired") {
            if (this.isempty()) {
                this.hideTips();
                return true
            }
            if (!this.test(a)) {
                this.showTips(e);
                return false
            } else {
                var s = new Array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                var o = 0;
                for (var r = 0; r < s.length; r++) {
                    o = o + parseInt(this.item.val().substring(r, r + 1)) * s[r]
                }
                var d = o % 11;
                var c = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
                var l = new Array(1, 0, 88, 9, 8, 7, 6, 5, 4, 3, 2);
                var p = "";
                for (var r = 0; r < c.length; r++) {
                    var f = c[r];
                    if (f == d) {
                        p = l[r];
                        if (l[r] > 57) {
                            p = "x"
                        }
                    }
                }
                if (p == this.item.val().substring(this.item.val().length - 1).toLowerCase()) {
                    this.hideTips();
                    return true
                } else {
                    this.showTips(e);
                    return false
                }
            }
        }
    };
    function l(i) {
        this.rule = i;
        this.perPageNum = parseInt(this.rule.perPageNum);
        if (!this.rule.data) {
            this.rule.data = []
        }
        this.pageCount = Math.ceil(this.rule.data.length / parseInt(this.rule.perPageNum));
        this.page = 0;
        this.curPage = 1;
        this.result = [];
        this.popWinWidth = 470;
        this.popWinHeight = parseInt(this.rule.popWinHeight);
        this.wrapper = i.wrapper
    }
    l.prototype = {
        paging: function(i) {
            var e = 0,
            t = [],
            n;
            for (var e = 0; e < this.rule.data.length; e++) {
                n = "page" + this.page;
                t.push(this.rule.data[e]);
                this.result[n] = t;
                if ((e + 1) % this.perPageNum == 0) {
                    t = [];
                    this.page++
                }
            }
            this.renderPage(i)
        },
        renderPage: function(e) {
            var t = this;
            this.pageUi = e;
            var n = "<a href='javascript:void(0)' data-index='-1' data-curpage='0' ><</a><!--<div  style='overflow: hidden;float: left;max-width:160px'><div class='page-wrap'>-->";
            for (var a = 0; a < this.pageCount; a++) {
                if (a == 0) n += "<a class='cur page-a' data-index='" + a + "' href='javascript:void(0)' >" + (a + 1) + "</a>";
                else n += "<a class='page-a' data-index='" + a + "' href='javascript:void(0)' >" + (a + 1) + "</a>"
            }
            n += "<a data-index='-1' data-curpage='0' href='javascript:void(0)'  data-maxpage='" + this.pageCount + "'>></a>";
            e.html(n);
            i(e.find("a")[0]).on("click",
            function(n) {
                var a = parseInt(i(this).data("curpage")) - 1;
                i(this).data("curpage", a);
                e.find("a:last").data("curpage", a);
                if (a <= 0) i(this).data("curpage", 0);
                t.gotoPage(i(this).data("curpage"))
            });
            e.find("a:last").click(function(n) {
                var a = parseInt(i(this).data("curpage")) + 1;
                var s = parseInt(i(this).data("maxpage"));
                i(this).data("curpage", a);
                e.find("a:first").data("curpage", a);
                if (a >= s - 1) i(this).data("curpage", s - 1);
                t.gotoPage(i(this).data("curpage"))
            });
            e.find("a").click(function() {
                if (i(this).data("index") != -1) {
                    var n = parseInt(i(this).data("index"));
                    e.find("a:first").data("curpage", n);
                    e.find("a:last").data("curpage", n);
                    t.gotoPage(i(this).data("index"))
                }
            });
            if (this.rule.direction == "hor") this.wrapper.css("width", this.pageCount * this.popWinWidth + "px");
            else if (this.rule.direction == "ver") this.wrapper.css("height", this.pageCount * this.popWinHeight + "px")
        },
        gotoPage: function(e) {
            var t = this;
            this.curPage = e;
            var n;
            if (this.rule.direction == "hor") {
                n = -this.curPage * this.popWinWidth;
                this.wrapper.animate({
                    left: n + "px"
                },
                "easeInCubic")
            } else if (this.rule.direction == "ver") {
                n = -this.curPage * this.popWinHeight;
                this.wrapper.animate({
                    marginTop: n + "px"
                },
                "easeInCubic")
            }
            if (this.pageUi) {
                if (this.pageUi.find("a").hasClass("cur")) this.pageUi.find("a").removeClass("cur");
                this.pageUi.find("a").each(function() {
                    if (!isNaN(i(this).data("index"))) {
                        if (i(this).data("index") == e) {
                            i(this).addClass("cur")
                        }
                    }
                })
            }
        },
        renderElements: function() {
            var e = this.result[curPage],
            t,
            n = "";
            for (var a = 0; a < e.length; a++) {
                if (e.length[a]) {
                    t = e[a].chiName != "undefined" ? e[a].chiName: e[a].firstName;
                    n += '<a href="javascript:void(0)" data-phone="' + e[a].mobileNo + '" data-name="' + t + '"> <span>' + t + "</span> <span>" + e[a].mobileNo + "</span> </a>"
                }
            }
            i(".msg-pop-wrap").html("");
            i(".msg-pop-wrap").find(".pop-w-a").append(n)
        }
    };
    var p = {
        init: function(e, t, s, o, r, d, c, l, p, f, h, u) {
            var v = i.extend({},
            n, a);
            i.extend({
                hisLinker: o,
                content: l,
                recommandItem: {},
                recommandStr: "",
                invoiceList: t,
                postAddress: s,
                saleNote: r,
                originPrice: 0,
                showPrice: 0,
                channelPrice: p,
                sid: f,
                currentTime: h,
                isLogin: u
            });
            i.originPrice = i.content.orderPrice;
            i.showPrice = i.content.orderPrice;
            var m = this;
            this.setTopSeps(r);
            this.calcuTotalPrice(v, l, this.displayPriceDetail);
            this.triggerPriceChanged(v);
            this.getNormalTourAndFill(v, e);
            this.fillTourist(v, l);
            this.sortTourist(v);
            this.showMore(v);
            this.chooseDiscount(v, d, c);
            this.validContact(v);
            this.validTourist(v, this.checkValid);
            this.validInvoice(v, t);
            this.submitOrder(v, l);
            this.setSidePos();
            this.closePopWin(v);
            this.ignoreFill(v);
            i("#specialRequire").placeholder({
                word: "选填，可告诉客服人员您的特殊要求"
            })
        },
        discountCalc: null,
        discountCalcator: function(e) {
            var t = false;
            switch (e.pomotionType) {
            case "1":
                return function() {
                    return Math.ceil(Number(e.discountType) * 10 * i.showPrice / 100)
                };
                break;
            case "2":
                return function() {
                    return Math.ceil(i.showPrice - Number(e.discountType))
                };
                break;
            case "3":
                return function() {
                    return Number(e.discountType)
                };
                break;
            case "4":
                break;
            default:
                break;
                return function() {
                    return i.showPrice
                }
            }
        },
        updateUserInfo: function(e, t, s, o, r, d, c) {
            var l = i.extend({},
            n, a);
            i.postAddress = s;
            i.invoiceList = t;
            i.hisLinker = o;
            i.isLogin = "1";
            i(l.contactBox).find("input.input-name").prop("value", c);
            i(l.contactBox).find("input.input-phone").prop("value", d);
            this.closePopWin(l);
            this.fillNormalContact(l);
            this.getNormalTourAndFill(l, e);
            this.confirmScorePoint(l, r);
            this.updateDiscount(l, d, r);
            this.sendAndGetPhoneCode(l, d)
        },
        updateDiscount: function(e, t, n) {
            var a = t.substr(0, 3) + "****" + t.substr(t.length - 3, 3);
            bindingPhone = t == "" ? false: true;
            i(".score-tit").find("input").prop("disabled", n >= 100 ? false: true);
            i(".score-change").next().html("（您有 " + n + ' 积分，100积分= <span class="font-yahei">¥</span><span class="num font-en">1</span>）');
            i(".count-time").next().css("color", "rgb(187, 187, 187)").html("验证码将发送至您的账户绑定手机" + a);
            this.validScorePoint(e, n)
        },
        setTopSeps: function(e) {
            var t = i(".order-step").find("li")[1];
            if (!e) return;
            if (e == "1") {
                i(t).remove();
                i(".order-step").find("li").each(function() {
                    i(this).addClass("li-3")
                })
            }
        },
        ignoreFill: function(e) {
            i(e.touristBox).find(".ignore").find("input").click(function(t) {
                t.stopPropagation();
                i(e.touristBox).find(".of-bd").stop().slideToggle(function() {})
            })
        },
        closePopWin: function(e) {
            var t = i.hisLinker;
            var n = i.postAddress;
            var a = i.invoiceList;
            var s = this;
            i(document).click(function(o) {
                var r = o.target;
                if (r == i(e.contactBox).find(".input-name")[0] || i(i(r)[0]).parent().parent()[0] == i(e.contactPopBox)[0] || i(i(r)[0])[0] == i(e.contactPopBox)[0] || i(i(r)[0]).parent().parent().parent()[0] == i(e.contactPopBox)[0]) {
                    if (t && t.length > 0) i(e.contactPopBox).show()
                } else {
                    i(e.contactPopBox).hide()
                }
                if (r == i(".inv-selected").find(".invoice-receiver")[0] || i(i(r)[0]).parent().parent()[0] == i(".inv-selected").find(".recipient-pop")[0] || i(i(r)[0])[0] == i(".inv-selected").find(".recipient-pop")[0] || i(i(r)[0]).parent().parent().parent()[0] == i(".inv-selected").find(".recipient-pop")[0]) {
                    if (r == i(".inv-selected").find(".invoice-receiver")[0]) s.getAndShowUsedAddress(e, n);
                    if (n && n.length > 0) i(".inv-selected").find(".recipient-pop").show()
                } else {
                    i(".inv-selected").find(".recipient-pop").hide()
                }
                if (r == i(".invoice-header")[0] || i(i(r)[0]).parent().parent()[0] == i("#inv-detail").find(".inv-pop-c")[0] || i(i(r)[0])[0] == i("#inv-detail").find(".inv-pop-c")[0] || i(i(r)[0]).parent().parent().parent()[0] == i("#inv-detail").find(".inv-pop-c")[0]) {
                    if (r == i(".invoice-header")[0]) s.getAndShowUsedInvoice(e, a);
                    if (a && a.length > 0) i("#inv-detail").find(".inv-pop-c").show()
                } else {
                    i("#inv-detail").find(".inv-pop-c").hide()
                }
            })
        },
        getAndShowUsedInvoice: function(e, t) {
            var n = this;
            var a = "",
            s, o = Math.ceil(t.length / 3);
            if (t && t.length > 0) {
                i(".inv-pop-c").find(".inv-pop-c-bd").find("div:first").html("");
                for (var r = 0; r < t.length; r++) {
                    s = t[r];
                    if ((r + 1) % 3 == 1) {
                        a = "";
                        i(".inv-pop-c").find(".inv-pop-c-bd").find("div:first").append("<div class='inv-c-row'></div>")
                    }
                    if (s) {
                        a += "<span>" + s.title + "</span>"
                    }
                    i(".inv-pop-c").find(".inv-pop-c-bd").find("div:first").find(".inv-c-row").last().html(a)
                }
                i(".inv-pop-c").find(".inv-pop-c-bd").css("height", "125px");
                var d = new l({
                    data: t,
                    perPageNum: "9",
                    wrapper: i(".inv-pop-c").find(".inv-pop-c-bd").find("div:first"),
                    direction: "ver",
                    popWinHeight: "148"
                });
                d.paging(i(".inv-pop-c").find(".pop-page-row"));
                i(".inv-pop-c").find(".inv-c-row").find("span").click(function() {
                    i(".invoice-header").prop("value", i(this).html());
                    if (n.validName(e, i(".invoice-header"), e.rightHeader, e.emptyHeader)) {
                        n.validUnitWrapRow(i(".invoice-header"))
                    }
                })
            }
        },
        getAndShowUsedAddress: function(e, t) {
            var n = this;
            var a = '<table class="table"><tbody>',
            s;
            if (t && t.length > 0) {
                for (var o = 0; o < t.length; o++) {
                    s = t[o];
                    if (s) a += "<tr> <td>" + s.receiveName + "</td> <td>" + s.mobileNo + "</td> <td class='td-address'>" + s.province + s.city + s.district + s.detailAddr + "</td> <td>" + s.postalcode + "</td> </tr>"
                }
            }
            a += "</tbody></table>";
            i(".inv-selected").find(".recipient-pop").find(".msg-pop-bd").css("height", "180px").find("div").html(a);
            i(".inv-selected").find(".recipient-pop").find("table").find("tr").each(function(e) {
                i(this).data("address", t[e])
            });
            var r = new l({
                data: t,
                perPageNum: "5",
                wrapper: i(".inv-selected").find(".msg-pop-bd").find("div"),
                direction: "ver",
                popWinHeight: "180"
            });
            r.paging(i(".inv-selected").find(".recipient-pop").find(".pop-page-row"));
            i(".inv-selected").find(".recipient-pop").find("table").find("tr").click(function() {
                var t = i(".inv-selected").data("type");
                var a = i(this).find("td");
                i(i(".inv-selected").find(".input-wrap")[0]).find("input").prop("value", i(a[0]).html());
                i(i(".inv-selected").find(".input-wrap")[1]).find("input").prop("value", i(a[1]).html());
                var s = i(this).data("address");
                seajs.use(["pcc"],
                function(i) {
                    var e = t == 0 ? ["province", "city", "county"] : ["province1", "city1", "county1"];
                    i.selected(s, e)
                });
                i(i(".inv-selected").find(".input-wrap")[3]).find("input").prop("value", i(a[2]).html());
                i(i(".inv-selected").find(".input-wrap")[4]).find("input").prop("value", i(a[3]).html());
                n.validName(e, i(".inv-selected").find(".invoice-receiver"), e.rightReceiver, e.emptyReceiver)
            })
        },
        setSidePos: function() {
            var e = i(".aside").offset().top;
            i(window).scroll(function() {
                var t = document.body.scrollTop || document.documentElement.scrollTop;
                if (t > e) {
                    i(".payment-tot-wrap").addClass("aside-fixed")
                } else {
                    i(".payment-tot-wrap").removeClass("aside-fixed")
                }
            })
        },
        calcuTotalPrice: function(e, t, n) {
            var a = t.productId;
            var s = t.departDate;
            var o = t.backDate;
            var r = t.itemid;
            var d = t.adultNum;
            var c = t.childNum;
            var l = t.oldNum;
            var p = t.checkInDate;
            var f = t.checkOutDate;
            var h = t.roomNum;
            var u = t.journeyStartDate;
            var v = t.journeyEndDate;
            var m = this;
            i.ajax({
                url: baseConfig.base + baseConfig.tour_product_price_url,
                type: "POST",
                dataType: "json",
                data: {
                    productId: a,
                    departDate: s,
                    backDate: o,
                    itemid: r,
                    adultNum: d,
                    childNum: c,
                    oldNum: l,
                    checkInDate: p,
                    checkOutDate: f,
                    roomNum: h
                },
                error: function() {},
                success: function(t) {
                    if (t.Code == 0) {
                        i.content.orderPrice = Math.ceil(parseFloat(t.Result.orderPrice));
                        i.originPrice = Math.ceil(parseFloat(t.Result.orderPrice));
                        i.showPrice = Math.ceil(parseFloat(t.Result.orderPrice));
                        var a = i(".discount-wrap").find(".discount-bd").find(".d-bd-row");
                        var s = parseFloat(i.channelPrice.channelprice);
                        if (i.sid == "600001") {
                            i(".pm-jingdong").show()
                        } else if (i.sid == "600002") {
                            i(".pm-onepercent").show()
                        } else if (i.sid == "600003" || sid == "100") {
                            i(".pm-jingdong").hide();
                            var o = "平安银行信用卡支付，可享" + s + "元优惠，活动期间每位客户仅限享受一次优惠。";
                            var r = "";
                            a.eq(0).find(".msg").html(o);
                            if (s > parseFloat(i.originPrice)) {
                                a.eq(0).find("input").prop("disabled", true)
                            }
                            a.eq(0).find("input").click(function() {
                                if (i(this).prop("checked")) {
                                    i.showPrice -= s;
                                    if (parseInt(s) != 0) {
                                        r = " <h4>平安银行信用卡支付</h4> <p><span class='price'><span class=\"price-ico font-yahei\">¥</span>-" + s + "</span> </p>";
                                        i("#price-pingan").show().html(r)
                                    } else {
                                        i("#price-pingan").html("").hide()
                                    }
                                    m.showOrderPrice();
                                    m.calcAverPrice()
                                } else {
                                    i.showPrice += s;
                                    i("#price-pingan").html("").hide();
                                    m.showOrderPrice();
                                    m.calcAverPrice()
                                }
                            })
                        } else if (!i.isArray(productChannel) && !i.isEmptyObject(productChannel)) {
                            var l = productChannel || {},
                            p;
                            m.discountCalc = m.discountCalcator(l);
                            p = i.disPrice = m.discountCalc();
                            i(".pm-discount-price").html(e.disTpl.replace(/\{name\}/g, (l.priceTxt || "优惠价") + ":").replace(/\{price\}/g, p)).show();
                            m.calcAverPrice()
                        }
                        m.showOrderPrice();
                        n(e, d, c, t.Result.items, m)
                    }
                }
            })
        },
        setRightPos: function() {
            var e = i(".fl").width() + i(".fl").position().left + 13
        },
        checkValid: function(i) {},
        getProductItems: function(e, t) {
            if (!e.productId || !e.departDate) {
                i("#recoBox").hide();
                return
            }
            i.ajax({
                url: baseConfig.base + baseConfig.tour_product_url,
                type: "POST",
                dataType: "json",
                data: {
                    productId: e.productId,
                    departDate: e.departDate,
                    adultNum: e.adultNum,
                    childNum: e.childNum
                },
                error: function() {},
                success: function(i) {
                    t(i)
                }
            })
        },
        render: function(e, t) {
            if (t && t.Result) {
                if (t.Result.safeItemProductList.length == 0 && t.Result.ticketItemProductList.length == 0) {
                    i("#recoBox").hide();
                    return
                }
            } else {
                i("#recoBox").hide();
                return
            }
            i("#recoBox").show();
            this.getRecommandProduct(e, t.Result.safeItemProductList, "保险");
            this.getRecommandProduct(e, t.Result.ticketItemProductList, "门票");
            var n = {};
            t.Result.selectItemProductList.forEach(function(i, e) {
                var t = i.productType;
                if (!n[t]) {
                    n[t] = [i]
                } else {
                    n[t].push(i)
                }
            });
            this.getRecommandProduct(e, t.Result.otherItemProductList, "其它")
        },
        rebuildOrder: function(e, t, n, a) {
            var s = {},
            o = {},
            r, d = {},
            c = this;
            var l = /[\u4e00-\u9fa5Z]/g,
            p = /[a-zA-Z]/g;
            if (i(".score-tit").find("input[type='checkbox']").prop("checked")) {
                t.pointAmount = i(i(".score-detail")[1]).data("scorePoint") ? i(i(".score-detail")[1]).data("scorePoint") : "0"
            } else {
                t.pointAmount = 0
            }
            i.content.orderPrice = i.disPrice || i.originPrice;
            d.requiredInvoice = i(e.invoiceBox).find(".inv-row").find("input[type='checkbox']").prop("checked");
            d.invoiceName = c.getElementVal(i(e.invoiceBox).find(".invoice-header"));
            d.invoiceItem = c.getElementVal(i("#inv-detail").find(".input-select"));
            d.invoiceCost = "";
            d.invoiceNote = "";
            t.invoiceInfo = d;
            t.token = i("#token").val();
            var f = i("#specialRequire");
            t.specialRequire = f.val() == f.attr("placeholder") ? "": f.val();
            var h = i(".discount-wrap").find(".discount-bd").find(".d-bd-row");
            t.pingan = h.eq(0).find("input").prop("checked") == true ? "1": "0";
            var u = {
                "normal-exp": 0,
                "emergy-exp": 1,
                "free-exp": 2
            },
            v;
            i(e.invoiceBox).find(".inv-d-row").find("li").each(function(n) {
                if (i(this).data("on")) {
                    for (v in u) {
                        if (v == i(this).prop("id")) {
                            r = u[v];
                            o.fulDate = "";
                            o.fulTime = "";
                            o.fulEndTime = "";
                            o.receivingProvince = "";
                            o.receivingCityId = "";
                            o.receivingCity = "";
                            o.receivingZoneId = "";
                            o.receivingZone = "";
                            var a = i(".remark-row").find("textarea");
                            o.fulRemark = a.val() == a.attr("placeholder") ? "": a.val();
                            if (r == "0" || r == "1") {
                                if (r == "0") {
                                    o.receivingProvince = i(e.invoiceBox).find("#province").find("option:selected").text();
                                    o.receivingCity = i(e.invoiceBox).find("#city").find("option:selected").text();
                                    o.receivingCityId = i(e.invoiceBox).find("#city").find("option:selected").val();
                                    o.receivingZone = i(e.invoiceBox).find("#county").find("option:selected").text();
                                    o.receivingZoneId = i(e.invoiceBox).find("#county").find("option:selected").val()
                                } else if (r == "1") {
                                    o.receivingProvince = i(e.invoiceBox).find("#province1").find("option:selected").text();
                                    o.receivingProvince = i(e.invoiceBox).find("#province1").find("option:selected").text();
                                    o.receivingCityId = i(e.invoiceBox).find("#city1").find("option:selected").val();
                                    o.receivingCity = i(e.invoiceBox).find("#city1").find("option:selected").text();
                                    o.receivingZoneId = i(e.invoiceBox).find("#county1").find("option:selected").val();
                                    o.receivingZone = i(e.invoiceBox).find("#county1").find("option:selected").text()
                                }
                                o.fulSendType = r == "0" ? "normal": "emergy";
                                o.fulReceiver = i(i(e.invoiceBox).find(".inv-pop")[n]).find(".invoice-receiver").val();
                                o.fulMobile = i(i(e.invoiceBox).find(".inv-pop")[n]).find(".invoice-phone").val();
                                o.receivingStreetAddress = i(i(e.invoiceBox).find(".inv-pop")[n]).find(".invoice-address").val();
                                o.fulPostcode = i(i(e.invoiceBox).find(".inv-pop")[n]).find(".inp-w-2").val()
                            } else {
                                o.fulSendType = "self";
                                o.receivingStreetAddress = i(i(e.invoiceBox).find(".inv-pop")[n]).find(".curr").find("p").html();
                                o.fulReceiver = "";
                                o.fulMobile = "";
                                o.fulPostcode = ""
                            }
                        }
                        t.deliveryInfo = o
                    }
                }
            });
            var m = i("#recoBox").find(".rec-bd-row").find(".select-num");
            i.recommandStr = "";
            m.each(function() {
                if (i(this).find("option:selected").val() != "0") {
                    i.recommandStr += ",freeselect|" + i(this).data("item").id + "|0|" + i(this).find("option:selected").val()
                }
            });
            if (t.itemid.indexOf("freeselect") > 0) t.itemid = t.itemid.substring(0, t.itemid.indexOf("freeselect") - 1);
            t.itemid += i.recommandStr;
            t.mermberName = i(i(e.contactBox).find("input")[0]).val();
            t.mermberPhone = i(i(e.contactBox).find("input")[2]).val();
            t.memberMail = i(i(e.contactBox).find("input")[3]).val();
            t.memberSaveAsCommon = i(i(e.contactBox).find("[type='checkbox']")).prop("checked");
            i(e.touristBox).find(".ifo-input-wrap").each(function(a) {
                s = {};
                s.saveAsCommon = i(i(this).find(".ifo-chk").find("input[type='checkbox']")).prop("checked");
                s.name = i(this).find(".input-name").val();
                if (i.content.lineType == 4) {
                    seajs.use(["pinyin"],
                    function(i) {
                        if (l.test(s.name) && !p.test(s.name)) s.englishname = i.convertPinyin(s.name);
                        else s.englishname = s.name
                    })
                }
                s.sex = i(this).find("input[name='sexradio" + a + "']:checked").val();
                s.sex = s.sex == "undefined" ? "0": s.sex;
                s.sex = s.sex == "0" ? "male": "female";
                s.telephone = c.getElementVal(i(this).find(".input-phone"));
                s.telephone = s.telephone == undefined ? "": s.telephone;
                s.nation = c.getElementVal(i(this).find(".s-w-b"));
                s.adult = i(this).data("passType") == "adult" ? "1": "0";
                s.certificateType = i(this).find(".select-certype") == undefined ? "": i(this).find(".select-certype").children("option:selected").val();
                s.touristcertificateNo = c.getElementVal(i(this).find(".input-certnumber"));
                s.birthDay = "";
                s.issuePlace = "";
                s.issueValidity = c.getElementVal(i(this).find(".input-ps-effect"));
                s.birthPlace = "";
                s.sendOffDate = "";
                n(e, t, s)
            });
            i(".popup-box").find(".popup").css("width", "480px");
            c.openPopWin();
            i(".popup-main").html('<div class="title"><span>温馨提示</span></div> <div class="pop-alert"> <div class="loading-lg"></div> <p class="pop-status"><i class="icon waring-lg mr10"></i>您的订单正在提交中,请稍候...！</p>  <div class="mt20"></div> </div>');
            if (i(".popup-box").hasClass("tour-popup")) i(".popup-box").removeClass("tour-popup");
            i.ajax({
                url: baseConfig.base + baseConfig.order_create,
                type: "POST",
                dataType: "json",
                data: t,
                error: function() {},
                success: function(e, t) {
                    if (e.Code == "0") {
                        if (i(".p-btn").hasClass("diab-btn")) {
                            i(".p-btn").removeClass("diab-btn")
                        }
                        var n = setTimeout(function() {
                            i(".mask").hide();
                            i(".popup-box").hide();
                            location.replace(baseConfig.base + baseConfig.order_result + e.Result.ordercd + "&saleNote=" + i.saleNote + "&token=" + e.Result.token);
                            a.returnValue = false
                        },
                        3e3)
                    } else {
                        i(".popup-main").find(".pop-status").html('<i class="icon waring-lg mr10"></i>很遗憾，订单生成失败，请稍后再尝试！');
                        var n = setTimeout(function() {
                            i(".mask").hide();
                            i(".popup-box").hide()
                        },
                        3e3)
                    }
                }
            })
        },
        getElementVal: function(i) {
            if (i.prop("tagName") == "INPUT") return i == undefined ? "": i.val();
            else if (i.prop("tagName") == "SELECT") return i == undefined ? "": i.children("option:selected").val()
        },
        openPopWin: function() {
            i(".mask").show();
            i(".popup-container").show()
        },
        addTouristToOrder: function(e, t, n) {
            i.touristlist.push(n);
            t.fellowInfoList = i.touristlist
        },
        getCertInfo: function(i) {
            if (i) {
                if (i.certificateInfoList.length > 0) {
                    return i.certificateInfoList[0]
                }
            }
            return {
                cerNo: ""
            }
        },
        optionSelected: function(i, e) {
            if (i) i.find("option[value='" + e + "']").prop("selected", "selected")
        },
        getNormalTourAndFill: function(e, t) {
            var n = t.length,
            a = i(e.touristBox),
            s = {},
            o = [],
            r,
            d,
            c,
            l,
            p = this,
            f = i(e.touristBox).find(".full-notice");
            if (!t || t.length == 0) {
                i(e.touristBox).find(".show-fold").hide();
                return
            }
            for (var h = 0; h < n; h++) {
                s = {};
                s.index = h;
                s.birthday = t[h].birthday;
                s.country = t[h].country == undefined ? "": t[h].country;
                s.certificateInfoList = t[h].certificateInfoList;
                s.chiName = t[h].chiName == undefined ? "": t[h].chiName;
                s.createBy = t[h].createBy == undefined ? "": t[h].createBy;
                s.createTime = t[h].createTime == undefined ? "": t[h].createTime;
                s.gender = t[h].gender == undefined ? "": t[h].gender;
                s.lastUsedTime = t[h].lastUsedTime == undefined ? "": t[h].lastUsedTime;
                s.mbrId = t[h].mbrId == undefined ? "": t[h].mbrId;
                s.passCardInfoList = t[h].passCardInfoList == undefined ? "": t[h].passCardInfoList;
                s.passId = t[h].passId == undefined ? "": t[h].passId;
                s.passType = t[h].passType == undefined ? "": t[h].passType;
                s.status = t[h].status == undefined ? "": t[h].status;
                s.updateTime = t[h].updateTime == undefined ? "": t[h].updateTime;
                s.firstName = t[h].firstName == undefined ? "": t[h].firstName;
                s.lastName = t[h].lastName == undefined ? "": t[h].lastName;
                s.mobileNo = t[h].mobileNo == undefined ? "": t[h].mobileNo;
                d = t[h].chiName ? t[h].chiName: t[h].firstName;
                s.name = d;
                o.push(s);
                a.find("a").before("<label title=" + d + " data-passtype='" + s.passType + "'><input type='checkbox' name='checkbox'>" + d + "</label>")
            }
            a.find("label").each(function(e) {
                i(this).data("tour", o[e])
            });
            var u, v, m, g = 99,
            b, x = 0,
            w = {
                adultCount: 0,
                childCount: 0
            },
            y,
            P = "",
            k,
            C;
            a.find("input").click(function() {
                u = this;
                v = i(this).parent().data("col");
                m = i(this).parent().data("row");
                s = i(this).parent().data("tour");
                r = i(i(".ifo-input-wrap")[h]);
                c = i(this).parent().data("passtype");
                C = i(e.touristBox).find(".ifo-input-wrap").length;
                if (c == 0) {
                    l = ".tour-adult";
                    b = i.content.adultNum;
                    y = "adultCount";
                    P = '<i class="order-icon full-ico"></i>人数已满'
                } else if (c == 1) {
                    l = ".tour-child";
                    b = i.content.childNum;
                    y = "childCount";
                    P = '<i class="order-icon full-ico"></i>人数已满'
                }
                if (i(u).prop("checked")) {
                    x++;
                    w[y]++;
                    i(e.touristBox).find(".ifo-input-wrap").each(function() {
                        if (i(this).data("filled")) {
                            C--
                        }
                        if (C <= 1) {
                            f.css("left", (v + 1) * g + 40 + "px").css("top", (m + 1) * 25 - 13 + "px").html(P).hide().fadeIn(300);
                            setTimeout(function() {
                                f.hide()
                            },
                            3e3)
                        }
                    });
                    i(e.touristBox).find(".ifo-input-wrap").each(function(t) {
                        if (!i(this).data("filled")) {
                            i(u).data("index", t);
                            i(this).data("filled", true);
                            if (i(i(this).find(".ifo-input-row")).hasClass("unchecked")) {
                                i(i(this).find(".ifo-input-row")).removeClass("unchecked").addClass("checked")
                            }
                            i(i(this).find(".input-name")).prop("value", s.name);
                            p.validName(e, i(this).find(".input-name"), e.rightName, e.emptyName);
                            if (i(i(this).find(".input-phone"))) {
                                i(i(this).find(".input-phone")).prop("value", s.mobileNo);
                                p.validPhone(e, i(this).find(".input-phone"), "norequired")
                            }
                            if (i(i(this).find(".input-certnumber"))) i(i(this).find(".input-certnumber")).prop("value", p.getCertInfo(s).cerNo);
                            if (p.getCertInfo(s).cerType == "IDC") {
                                k = "1";
                                i(this).find(".ifo-detail:last").hide()
                            } else if (p.getCertInfo(s).cerType == "PSP") {
                                k = "2";
                                i(this).find(".ifo-detail:last").show()
                            } else if (p.getCertInfo(s).cerType == "HKM") {
                                k = "3";
                                i(this).find(".ifo-detail:last").hide()
                            } else {
                                k = "1";
                                i(this).find(".ifo-detail:last").hide()
                            }
                            p.optionSelected(i(i(this).find(".select-certype")), k);
                            p.optionSelected(i(i(this).find(".select-nation")), s.country);
                            var n = i(i(this).find(".select-certype")).find("option:selected").val();
                            if (n == "2") {
                                p.validPassport(e, i(this).find(".input-certnumber"), "norequired")
                            } else if (n == "1") {
                                p.validId(e, i(this).find(".input-certnumber"), "norequired")
                            } else if (n == "3") {
                                p.validHkPassport(e, i(this).find(".input-certnumber"), "norequired")
                            }
                            if (s.gender == "female") {
                                i(this).find("input[type='radio'][value='0']").prop("checked", false);
                                i(this).find("input[type='radio'][value='1']").prop("checked", true)
                            } else {
                                i(this).find("input[type='radio'][value='1']").prop("checked", false);
                                i(this).find("input[type='radio'][value='0']").prop("checked", true)
                            }
                            return false
                        }
                    })
                } else {
                    x--;
                    w[y]--;
                    i(e.touristBox).find(".ifo-input-wrap").each(function(e) {
                        if (e == i(u).data("index")) {
                            i(u).data("index", -1);
                            p.resetTourInput(this)
                        }
                    })
                }
            });
            return o
        },
        resetTourInput: function(e) {
            if (i(i(e).find(".ifo-input-row")).hasClass("checked")) {
                i(i(e).find(".ifo-input-row")).removeClass("checked").addClass("unchecked")
            }
            i(i(e).data("filled", false).find(".input-name")).prop("value", "");
            i(e).find(".input-name").css("border-color", "#bec3c7").next().html("").hide();
            i(e).find("input[type='radio'][value='0']").prop("checked", true);
            i(e).find("input[type='radio'][value='1']").prop("checked", false);
            this.optionSelected(i(i(e).find(".select-certype")), 1);
            if (i(i(e).find(".select-nation"))) {
                this.optionSelected(i(i(e).find(".select-nation")), "70007")
            }
            i(e).find(".select-certype").parent().parent().next().hide();
            if (i(i(e).find(".input-phone"))) {
                i(i(e).find(".input-phone")).prop("value", "");
                i(e).find(".input-phone").css("border-color", "#bec3c7").next().html("").hide()
            }
            if (i(i(e).find(".input-id"))) {
                i(i(e).find(".input-id")).prop("value", "");
                i(e).find(".input-id").css("border-color", "#bec3c7").next().html("").hide()
            }
            if (i(i(e).find(".input-passport"))) {
                i(i(e).find(".input-passport")).prop("value", "");
                i(e).find(".input-passport").css("border-color", "#bec3c7").next().html("").hide()
            }
            if (i(i(e).find(".input-certnumber"))) {
                i(i(e).find(".input-certnumber")).prop("value", "");
                i(e).find(".input-certnumber").css("border-color", "#bec3c7").next().html("").hide()
            }
        },
        fillTourist: function(e, t) {
            var n = '<div class="ifo-input-wrap bd-b-do tour-local">' + i(i(e.touristBox).find(".tour-local").parent().children()[1]).html() + "</div>",
            a = '<div class="ifo-input-wrap bd-b-do tour-hk">' + i(i(e.touristBox).find(".tour-hk").parent().children()[2]).html() + "</div>",
            s = '<div class="ifo-input-wrap bd-b-do tour-oversea">' + i(i(e.touristBox).find(".tour-oversea").parent().children()[3]).html() + "</div>";
            var o = '<span class="item-tit font-yahei"> </span>';
            i(e.touristBox).find(".ifo-input-wrap").remove();
            var r = parseInt(t.adultNum) + parseInt(t.childNum),
            d = "",
            c = {
                adult: t.adultNum,
                child: t.childNum
            };
            var l = i.content.lineType;
            var p = i(i(e.touristBox).find(".select-certype"));
            switch (l) {
            case 0:
                for (var f = 0; f < r; f++) {
                    d += n
                }
                i(e.touristBox).find(".of-bd").append(d);
                i(e.touristBox).find(".ifo-input-wrap").find(".ifo-detail:last").hide();
                this.optionSelected(i(i(e.touristBox).find(".select-certype")), 1);
                break;
            case 1:
                for (var f = 0; f < r; f++) {
                    d += n
                }
                i(e.touristBox).find(".of-bd").append(d);
                i(e.touristBox).find(".ifo-input-wrap").find(".ifo-detail:last").hide();
                this.optionSelected(i(i(e.touristBox).find(".select-certype")), 1);
                break;
            case 2:
                for (var f = 0; f < r; f++) {
                    d += n
                }
                i(e.touristBox).find(".of-bd").append(d);
                i(e.touristBox).find(".ifo-input-wrap").find(".ifo-detail:last").hide();
                this.optionSelected(i(i(e.touristBox).find(".select-certype")), 1);
                break;
            case 3:
                for (var f = 0; f < r; f++) {
                    d += a
                }
                i(e.touristBox).find(".of-bd").append(d);
                i(e.touristBox).find(".ifo-input-wrap").find(".ifo-detail:last").hide();
                this.optionSelected(i(i(e.touristBox).find(".select-certype")), 3);
                break;
            case 4:
                for (var f = 0; f < r; f++) {
                    d += s
                }
                i(e.touristBox).find(".of-bd").append(d);
                i(e.touristBox).find(".ifo-input-wrap").find(".ifo-detail:last").show();
                this.optionSelected(i(i(e.touristBox).find(".select-certype")), 2);
                break
            }
            var h = c.adult,
            u = c.child;
            for (var f = 0; f < r; f++) {
                i(i(e.touristBox).find(".ifo-input-wrap")[f]).find(".item-tit").html("旅客" + (f + 1) + "");
                i(i(e.touristBox).find(".ifo-input-wrap")[f]).find("label").find("input").attr("name", "sexradio" + f);
                i("input[name='sexradio" + f + "'][value='0']").attr("checked", true);
                if (h && f < h) {
                    i(i(e.touristBox).find(".ifo-input-wrap")[f]).data("passType", "adult").data("filled", false).addClass("tour-adult").find(".ifo-tit").find("i").addClass("adult-ico")
                } else if (u && f >= h && f < h + u) {
                    i(i(e.touristBox).find(".ifo-input-wrap")[f]).data("passType", "child").data("filled", false).addClass("tour-child").find(".ifo-tit").find("i").addClass("chr-ico")
                }
            }
        },
        displayPriceDetail: function(e, t, n, a, s) {
            var o = i(e.paymentBox),
            r = i(o.find(".pm-tit-wrap").find("#base"));
            var d = 0,
            c = 0,
            l, p, f, h = "";
            var u = "";
            var v;
            if (a) {
                if (a.adultPrice) u += "<p>" + a.adultNum + "成人<span class='price'><span class=\"price-ico font-yahei\">¥</span>" + a.adultPrice + "</span> </p>";
                if (a.childPrice) u += "<p>" + a.childNum + "儿童<span class='price'><span class=\"price-ico font-yahei\">¥</span>" + a.childPrice + "</span> </p>";
                if (a.singleRoomPirce) u += " <h4>单房差</h4> <p><span class='price'><span class=\"price-ico font-yahei\">¥</span>" + a.singleRoomPirce + "</span> </p>";
                r.append(u)
            }
            s.calcAverPrice();
            s.getProductItems(i.content,
            function(i) {
                s.render(e, i)
            })
        },
        calcAverPrice: function() {
            var e = String(Math.ceil(parseFloat(i.disPrice || i.showPrice)) / (parseInt(i.content.adultNum) + parseInt(i.content.childNum)));
            if (e.indexOf(".") > 0) e = e.substring(0, e.indexOf(".") + 3);
            else e = String(e) + ".00";

            i(".avg-ps").next().html(String(e))
        },
        showMore: function(e) {
            var t = i(e.touristBox).find(".ifo-more-row").find("label:last").data("row");
            if (t > 0) {
                i(e.showMoreSelector).show()
            } else i(e.showMoreSelector).hide();
            var a = i(".op-detail"),
            s = i("#up-down-btn");
            s.on("click",
            function(e) {
                var t = i(this),
                n = t.find(".order-icon"),
                s = t.find(".u-d-btn-text");
                a.stop().slideToggle(function() {
                    if (n.hasClass("down-ico")) {
                        a.removeClass("hide");
                        s.text("展开套餐明细");
                        n.removeClass("down-ico").addClass("up-ico")
                    } else {
                        s.text("收起套餐明细");
                        n.removeClass("up-ico").addClass("down-ico")
                    }
                })
            });
            var o = i(".op-passenger");
            var r = this;
            var d = i(e.touristBox).find(".ifo-bd");
            o.on("click", d,
            function(e) {
                e.stopPropagation();
                var t = i(this),
                s = t.find(".order-icon"),
                o = t.find("span"),
                r = i.extend({},
                n),
                d = i(r.touristBox).find(".ifo-bd"),
                c;
                c = !d.data("on");
                d.data("on", c).toggleClass("nowrap", !c);
                if (s.hasClass("down-ico")) {
                    a.removeClass("hide");
                    o.text("更多");
                    s.removeClass("down-ico").addClass("up-ico")
                } else {
                    o.text("收起");
                    s.removeClass("up-ico").addClass("down-ico")
                }
            })
        },
        sortTourist: function(e) {
            var t, n = 0,
            a = 0;
            t = i(e.touristBox);
            t.find("label").each(function(e) {
                var t = (e + 1) % 7;
                i(this).data("col", a);
                if (t == 0) {
                    a = 0;
                    i(this).data("row", n);
                    n++
                } else {
                    a++;
                    i(this).data("row", n)
                }
            })
        },
        chooseDiscount: function(e, t, n) {
            var a = i(i(e.scoreBox)[0]),
            s = true,
            o = 0,
            r = this,
            d = true;
            var c = n.substr(0, 3) + "****" + n.substr(n.length - 3, 3);
            d = n == "" ? false: true;
            i(a.find(".score-inp")[1]).data("valid", 0);
            i(i(e.scoreBox)[0]).find("input").prop("disabled", true);
            i(e.scoreTitle).find("input").click(function(t) {
                a.css("height", i(this).prop("checked") ? "auto": "30px");
                if (!i(this).prop("checked")) {
                    i(i(e.scoreBox)[0]).show();
                    i(i(e.scoreBox)[0]).find("input").prop("value", "").css("border-color", "#bbbbbb");
                    i(i(e.scoreBox)[0]).find("input").prop("disabled", true);
                    i(i(e.scoreBox)[0]).find(".score-mark").find("span:last").hide().html("");
                    i(".score-change").hide().find("span:last").html("");
                    i(".count-time").next().css("color", "rgb(187, 187, 187)").html("验证码将发送至您的账户绑定手机" + c);
                    i(i(e.scoreBox)[1]).hide();
                    i(i(e.scoreBox)[2]).hide()
                } else {
                    i(i(e.scoreBox)[0]).find("input").prop("disabled", false)
                }
            });
            if (t >= 100) {
                if (!d) {
                    i(i(e.scoreBox)[0]).show();
                    i(i(e.scoreBox)[1]).hide();
                    i(i(e.scoreBox)[2]).hide()
                } else {
                    i(i(e.scoreBox)[0]).show();
                    i(i(e.scoreBox)[1]).hide();
                    i(i(e.scoreBox)[2]).hide()
                }
            } else {
                i(e.scoreTitle).find("input").prop("disabled", true)
            }
            i(".code-inp").focus(function() {
                i(this).css("border-color", "#bbbbbb");
                i(this).prop("placeholder", "")
            });
            var l = a.find(".score-inp").eq(0);
            l.bind("keyup",
            function() {
                if (i(this).val().indexOf("-") >= 0) {
                    i(this).prop("value", "")
                }
            });
            l.focus(function() {
                if (i(this).val() == "") i(this).css("border-color", "#bbbbbb")
            });
            this.confirmScorePoint(e, t);
            this.validScorePoint(e, t);
            this.sendAndGetPhoneCode(e, c)
        },
        confirmScorePoint: function(e, t) {
            var n = i(i(e.scoreBox)[0]),
            a = this,
            s = true,
            o = -1;
            if (!i(".discount-wrap").hasClass("unchecked")) {
                i(".discount-wrap").addClass("unchecked")
            }
            n.find(".conf-btn").click(function(e) {
                s = 1;
                if (i(n.find(".score-inp")[0]).val() == "") {
                    i(n.find(".score-inp")[0]).next().find("span:last").show().html("请输入100倍数的积分");
                    i(n.find(".score-inp")[0]).css("border-color", "rgb(255, 153, 0)");
                    s = s & 0
                } else {
                    var r = parseInt(i(n.find(".score-inp")[0]).val());
                    if (r <= 0) {
                        s = s & 0
                    } else {
                        if (r % 100 == 0) {
                            if (r <= t) {
                                var d = r / 100;
                                if (d > i.originPrice) {
                                    s = s & 0
                                }
                                s = s & 1
                            } else {
                                s = s & 0
                            }
                        } else {
                            s = s & 0
                        }
                    }
                }
                if (i(n.find(".score-inp")[1]).val() == "") {
                    i(n.find(".score-inp")[1]).next().next().next().show().css("color", "rgb(255, 153, 0)").html("请输入手机验证码");
                    i(n.find(".score-inp")[1]).css("border-color", "rgb(255, 153, 0)");
                    s = s & 0
                }
                s = s & i(n.find(".score-inp")[1]).data("valid");
                if (s) {
                    if (i(".discount-wrap").hasClass("unchecked")) i(".discount-wrap").data("valid", true).removeClass("unchecked").addClass("checked");
                    i(n.find(".score-inp")[0]).css("border-color", "#bbbbbb");
                    i(n.find(".score-inp")[1]).css("border-color", "#bbbbbb");
                    i(i(".score-detail")[0]).hide();
                    i(i(".score-detail")[1]).data("scorePoint", i(n.find(".score-inp")[0]).val()).show();
                    var d = String(Math.floor(parseInt(i(n.find(".score-inp")[0]).val()) / 100));
                    i(i(".score-detail")[1]).find("span.num").html(d);
                    i(n.find(".score-inp")[0]).next().find("span:last").hide();
                    i(".pass-text").find("a").click(function() {
                        i(i(".score-detail")[0]).show();
                        i(i(".score-detail")[1]).hide()
                    });
                    if (i.content.orderPrice > 0) {
                        i.showPrice = i.originPrice - parseInt(d);
                        a.showOrderPrice();
                        a.calcAverPrice();
                        var c = "";
                        if (parseInt(d) != 0) {
                            c = " <h4>优惠</h4> <p>积分优惠<span class='price'><span class=\"price-ico font-yahei\">¥</span>-" + d + "</span> </p>";
                            i("#price-discount").show().html(c)
                        } else {
                            i("#price-discount").html("").hide()
                        }
                    }
                    o = parseInt(d)
                } else {
                    i(i(".score-detail")[1]).data("scorePoint", "0");
                    if (i(".discount-wrap").hasClass("checked")) i(".discount-wrap").data("valid", false).removeClass("checked").addClass("unchecked")
                }
            })
        },
        validScorePoint: function(e, t) {
            var n = i(i(e.scoreBox)[0]);
            i(n.find(".score-inp")[0]).unbind("blur").blur(function() {
                var e = parseInt(i(this).val()),
                a;
                if (e < 0) {
                    i(n.find(".score-inp")[0]).next().find("span:last").show().html("输入值不能为负数");
                    i(this).next().find("span.score-change").hide();
                    i(n.find(".score-inp")[0]).css("border-color", "rgb(255, 153, 0)");
                    return
                }
                if (!isNaN(e)) {
                    if (e % 100 == 0) {
                        if (e < t) {
                            a = String(Math.floor(e / 100));
                            if (a > i.originPrice) {
                                i(n.find(".score-inp")[0]).next().find("span:last").show().html("积分兑换价格已经超过需要支付的总金额");
                                i(this).next().find("span.score-change").hide();
                                i(n.find(".score-inp")[0]).css("border-color", "rgb(255, 153, 0)");
                                return
                            }
                            i(n.find(".score-inp")[0]).css("border-color", "#bbbbbb");
                            i(this).next().find("span.score-change").show().find("span:last").html(a);
                            i(this).next().find("span:last").hide()
                        } else {
                            i(n.find(".score-inp")[0]).next().find("span:last").show().html("输入值已经超过您的积分数");
                            i(this).next().find("span.score-change").hide();
                            i(n.find(".score-inp")[0]).css("border-color", "rgb(255, 153, 0)")
                        }
                    } else {
                        i(n.find(".score-inp")[0]).next().find("span:last").html("请输入100倍数的积分");
                        i(n.find(".score-inp")[0]).css("border-color", "rgb(255, 153, 0)");
                        i(this).next().find("span.score-change").hide();
                        i(this).next().find("span:last").show()
                    }
                }
            })
        },
        sendAndGetPhoneCode: function(e, t) {
            var n = t.substr(0, 3) + "****" + t.substr(t.length - 3, 3);
            var a = i(i(e.scoreBox)[0]);
            var s = "";
            var o = "",
            r = "";
            var d = i(a.find(".score-inp")[1]);
            var c = 60,
            l;
            i(".count-time").next().show().css("color", "#bbbbbb").html("验证码将发送至您的账户绑定手机" + n);
            i(".send-btn").unbind("click").click(function() {
                var e = this;
                i(this).hide();
                i(this).next().show().html("60秒后可重新发送");
                l = setInterval(p, 1e3);
                i.ajax({
                    url: baseConfig.base + baseConfig.order_phone_code,
                    type: "GET",
                    error: function() {},
                    success: function(t) {
                        if (t) {
                            if (t.code == "0008") {
                                i(e).next().next().show().css("color", "#bbbbbb").html("验证码已经发送至您的账户绑定手机" + n);
                                r = t.seqNumber
                            } else {
                                i(e).next().next().show().css("color", "rgb(255, 153, 0").html("验证码发送失败");
                                r = "000"
                            }
                        }
                    }
                })
            });
            i(".code-inp").bind("keyup",
            function() {
                if (i(this).prop("placeholder") == "") i(this).prop("placeholder", "输入验证码");
                if (i(this).val().length == 6) {
                    if (i(this).val() != "" && s == i(this).val()) return;
                    s = i(this).val();
                    if (i(a.find(".score-inp")[1]).val() != "") {
                        i.ajax({
                            url: baseConfig.base + baseConfig.order_validate_code,
                            type: "GET",
                            data: {
                                phoneCode: i(a.find(".score-inp")[1]).val(),
                                seqNumber: r
                            },
                            error: function() {},
                            success: function(e) {
                                if (e) {
                                    d.data("valid", e.code == "0009" ? 1 : 0);
                                    if (e.code != "0009") {
                                        d.next().next().next().show().css("color", "rgb(255, 153, 0").html("验证码错误");
                                        d.css("border-color", "rgb(255, 153, 0)");
                                        d.data("valid", false)
                                    } else {
                                        c = 60;
                                        i(".send-btn").show();
                                        i(".count-time").hide();
                                        clearInterval(l);
                                        i(".count-time").next().show().css("color", "rgb(26, 186, 15)").html("校验成功");
                                        d.css("border-color", "#bbbbbb");
                                        d.data("valid", true)
                                    }
                                }
                            }
                        })
                    }
                }
            });
            function p() {
                c--;
                i(".send-btn").next().html("" + c + "秒后可重新发送");
                if (c <= 0) {
                    c = 60;
                    i(".send-btn").show();
                    i(".send-btn").next().hide();
                    i(".send-btn").next().next().html("");
                    i(".count-time").next().show().css("color", "#bbbbbb").html("验证码将发送至您的账户绑定手机" + n);
                    clearInterval(l)
                }
            }
        },
        validContact: function(e) {
            var t, n, a, o, r = this;
            n = i(e.contactPopBox);
            t = i(e.contactBox).find(".item-ifo:first").find("input");
            a = i(e.contactBox).find("#phone-input").find("input");
            o = i(e.contactBox).find("#email-input").find("input");
            i(e.contactBox).find(".msg-row").each(function(e) {
                if (e == 0 || e == 1) {
                    i(this).data("valid", false).addClass("unchecked")
                } else if (e == 3) {
                    i(this).data("valid", false).addClass("checked")
                }
            });
            t.blur(function(t) {
                r.validName(e, i(this), e.rightName, e.emptyName)
            });
            a.focus(function(e) {
                i(this).prop("placeholder", "")
            });
            a.blur(function(t) {
                if (i(this).val() == "") i(this).prop("placeholder", "用于接收订单信息");
                var n = i(this).val();
                r.validPhone(e, i(this), "required");
                if (i(this).data("valid")) {
                    i.ajax({
                        url: baseConfig.base + baseConfig.order_isExist_member + n + "",
                        type: "GET",
                        error: function() {},
                        success: function(t) {
                            if (t == "1" && i.isLogin == "0") i(e.contactBox).find(".ard-ifo").parent().show();
                            else i(e.contactBox).find(".ard-ifo").parent().hide();
                            i(e.contactBox).find(".ard-ifo").find("a").click(function() {
                                r.openPopWin();
                                i(".popup-box").find(".popup").css("width", "430px");
                                i(".popup-main").html(' <a href="#none" class="spr close">关闭</a> <div style=\'padding-left: 0px; overflow-x: hidden; overflow-y: hidden\' class="pop-scroll"> <iframe scrolling=\'none\' style="border:none; width:  430px; height: 450px;" src=\'#\'></iframe></div>');
                                i(".popup-wrap").find(".close").on("click",
                                function() {
                                    i(".popup-container").hide();
                                    i(".mask").hide()
                                })
                            });
                            i(e.contactBox).find(".close-ico").click(function() {
                                i(this).parent().parent().hide()
                            })
                        }
                    })
                } else {
                    i(e.contactBox).find(".ard-ifo").parent().hide()
                }
            });
            o.blur(function(t) {
                exp = /^[a-zA-Z0-9]+([-_.][a-zA-Z0-9]+)*@([a-zA-Z0-9]+[-.])+[A-Za-zd]{2,5}$/;
                var n = new s(i(this));
                n.vali(exp, e.rightEmail, e.emptyEma, "norequired")
            });
            this.fillNormalContact(e)
        },
        fillNormalContact: function(e) {
            var t = i.hisLinker,
            n = i(e.contactPopBox),
            a = this;
            i(e.contactPopBox).find(".pop-w-a").find("a").remove();
            var s = "",
            o;
            if (t && t.length > 1) {
                for (var r = 0; r < t.length; r++) {
                    if (t[r]) {
                        o = t[r].linkPersonName != "undefined" ? t[r].linkPersonName: "";
                        s += '<a href="javascript:void(0)" data-phone="' + t[r].linkMobileNo + '" data-name="' + o + '"> <span>' + o + "</span> <span>" + t[r].linkMobileNo + "</span> </a>"
                    }
                }
            }
            i(e.contactPopBox).find(".pop-w-a").append(s);
            var d = new l({
                data: t,
                perPageNum: "4",
                wrapper: i(n.find(".msg-pop-bd")),
                direction: "hor"
            });
            d.paging(i(e.contactPopBox).find(".pop-page-row"));
            n.find(".pop-w-a").on("click", "a",
            function(t) {
                t.stopPropagation();
                i(e.contactPopBox).hide();
                i(i(e.contactBox).find(".item-ifo").find("input")[0]).val(i(this).data("name"));
                i(i(e.contactBox).find(".item-ifo").find("input")[1]).val(i(this).data("phone"));
                a.validName(e, i(e.contactBox).find(".input-name"), e.rightName, e.emptyName);
                a.validPhone(e, i(e.contactBox).find(".input-phone"), "required")
            })
        },
        validPhone: function(i, e, t) {
            var n = /^1[3|4|5|7|8][0-9]\d{8}$/;
            var a = new s(e);
            e.data("valid", a.vali(n, i.rightPhone, i.emptyPhone, t));
            return a.vali(n, i.rightPhone, i.emptyPhone, t)
        },
        getRecommandProduct: function(e, t, n) {
            var a = this;
            if (!t) {
                return
            }
            var s = t,
            o = s.length,
            r, d, c, l, p, f;
            if (o > 0) i(e.recProductBox).append('<div class="rec-item-row"><div class="fl bd-class font-yahei" >' + n + '</div><div class="rec-bd-wrap"></div></div>  ');
            d = i(e.recProductBox).find(".rec-item-row").last().find(".rec-bd-wrap").last();
            for (var h = 0; h < o; h++) {
                r = s[h];
                if (r) {
                    c = "<div><div class='rec-bd-row' ><div class=\"fl bd-name pd-lr-a\"><a title='" + r.name + "' href='javascript:void(0)'>" + r.name + ' </a><i class="order-icon up-ico "></i>' + '</div><div class="fl bd-price pd-lr-a">¥<span>' + r.selectDatePrice + '</span></span></div><div class="fl bd-unit pd-lr-a"><select id="order-free-num" class="input-select select-num" data-uprice="' + r.selectDatePrice + '">';
                    for (var u = r.minperson; u < r.maxperson + 1; u++) {
                        c += '<option value="' + u + '" >' + u + "</option>"
                    }
                    c += '</select></div> <div class="fl bd-total pd-lr-a">¥<span>300</span></div></div><div class="pop-rec-row"> <i class="order-icon tips-ico-p3 tips-ico-2"></i> ' + r.productNote + " </div></div>";
                    d.append(c);
                    p = r.minperson;
                    l = r.selectDatePrice;
                    f = r.id;
                    i.recommandItem[f] = "0"
                }
                var v = p * l;
                i(d.find(".rec-bd-row")[h]).find(".bd-total").find("span").html("" + v + "");
                i(d.find(".rec-bd-row")[h]).find(".bd-unit").find("select").data("item", r)
            }
            i(e.recProductBox).find(".rec-bd-row").each(function(e) {
                r = s[e];
                i(this).data("info", r)
            });
            a.calcuSafePriceDetail(e);
            i(d.find(".rec-bd-row")).find("select").change(function() {
                l = i(this).data("uprice");
                v = l * i(this).children("option:selected").val();
                i(this).parent().next().find("span").html("" + v + "");
                a.calcuSafePriceDetail(e);
                a.reCalcuTotalPriceByItem(i(this))
            });
            var m;
            i(e.recProductBox).find(".rec-bd-row").find(".order-icon").unbind("click").click(function(e) {
                m = this;
                i(this).parent().parent().next().slideToggle(function() {
                    i(m).data("on", !i(m).data("on"));
                    if (i(m).data("on")) {
                        i(m).removeClass("up-ico").addClass("down-ico")
                    } else {
                        i(m).removeClass("down-ico").addClass("up-ico")
                    }
                })
            });
            i(e.recProductBox).find(".rec-bd-row").find("a").unbind("click").click(function(e) {
                m = i(this).next();
                i(this).parent().parent().next().slideToggle(function() {
                    i(m).data("on", !i(m).data("on"));
                    if (i(m).data("on")) {
                        i(m).removeClass("up-ico").addClass("down-ico")
                    } else {
                        i(m).removeClass("down-ico").addClass("up-ico")
                    }
                })
            })
        },
        calcuSafePriceDetail: function(e, t) {
            var n = 0,
            a = 0,
            s = i(".pm-tit-wrap").find("#other"),
            o = this;
            var r = i(e.recProductBox).find(".rec-item-row");
            r.each(function(e) {
                n = 0;
                a = 0;
                i(this).find(".rec-bd-row").find("select").each(function() {
                    n += parseInt(i(this).children("option:selected").val());
                    a += i(this).children("option:selected").val() * i(this).data("uprice");
                    o.reCalcuTotalPriceByItem(i(this))
                });
                if (n > 0) {
                    if (i(this).find(".fl").html() == "保险") {
                        s.find("#price-safe").show().html("<h4>" + i(this).find(".fl").html() + "</h4><p>" + n + "份<span class='price'><span class=\"price-ico font-yahei\">¥</span>" + a + "</span></p>")
                    } else if (i(this).find(".fl").html() == "门票") {
                        s.find("#price-ticket").show().html("<h4>" + i(this).find(".fl").html() + "</h4><p>" + n + "张<span class='price'><span class=\"price-ico font-yahei\">¥</span>" + a + "</span></p>")
                    } else if (i(this).find(".fl").html() == "签证") {
                        s.find("#price-qianzheng").show().html("<h4>" + i(this).find(".fl").html() + "</h4><p>" + n + "张<span class='price'><span class=\"price-ico font-yahei\">¥</span>" + a + "</span></p>")
                    } else if (i(this).find(".fl").html() == "其它") {
                        s.find("#price-other").show().html("<h4>" + i(this).find(".fl").html() + "</h4><p>" + n + "张<span class='price'><span class=\"price-ico font-yahei\">¥</span>" + a + "</span></p>")
                    }
                } else {
                    if (i(this).find(".fl").html() == "保险") s.find("#price-safe").hide().html("");
                    if (i(this).find(".fl").html() == "门票") s.find("#price-ticket").hide().html("");
                    if (i(this).find(".fl").html() == "签证") s.find("#price-qianzheng").hide().html("");
                    if (i(this).find(".fl").html() == "其它") s.find("#price-other").hide().html("")
                }
            })
        },
        reCalcDiscountPrice: function() {
            i.disPrice && (i.disPrice = this.discountCalc())
        },
        reCalcuTotalPriceByItem: function(e) {
            var t, n;
            if (e.prop("tagName") == "SELECT") {
                for (key in i.recommandItem) {
                    if (!e.data("item")) {
                        return
                    }
                    if (key == e.data("item").id) {
                        i.showPrice -= Math.ceil(parseFloat(i.recommandItem[key]));
                        i.originPrice -= Math.ceil(parseFloat(i.recommandItem[key]));
                        n = parseInt(e.find("option:selected").val()) * Math.ceil(parseFloat(e.data("item").selectDatePrice));
                        i.originPrice += n;
                        i.showPrice += n;
                        this.reCalcDiscountPrice();
                        i.recommandItem[key] = n;
                        this.showOrderPrice()
                    }
                }
            }
            this.calcAverPrice()
        },
        showOrderPrice: function() {
            i(".tot-num").each(function(e) {
                var t = e ? i.showPrice: i.disPrice || i.showPrice;
                i(this).html("<span class='price-ico ico-mg font-yahei'>¥</span>" + t)
            });
            var e = parseFloat(i.channelPrice.channelprice);
            var t = i.currentTime;
            var n = t.split("-");
            var a = 0;
            if (i.sid == "600001") {
                a = Math.ceil(i.showPrice * (1 / 12));
                i(".tot-jingdong ").html('<span class="price-ico ico-mg font-yahei">¥</span>' + a + '<span class="price-ico">起/月</span>')
            } else if (i.sid == "600002") {
                a = Math.ceil(i.showPrice * (1 / 10));
                if (n[2] == "18" || n[2] == "30") {}
                i(".tot-onepercent ").html('<span class="price-ico ico-mg font-yahei">¥</span>' + a + "")
            } else if (i.disPrice && !i.isArray(productChannel) && i.isEmptyObject(productChannel)) {
                var s = '{name}<span class="tot-discount-price font-en"><span class="price-ico ico-mg font-yahei">¥</span>{price}</span>',
                o = this.discountCalc();
                i(".pm-discount-price").html(s.replace(/\{name\}/g, (productChannel.priceTxt || "优惠价") + ":").replace(/\{price\}/g, o)).show()
            }
        },
        testTheSameInfo: function(e, t, n, a) {
            if (n.find(".input-certnumber").val() != undefined && n.find(".input-certnumber").val() != "") {
                if (n.find(".input-certnumber").val() == t.find(".input-certnumber").val()) {
                    n.data("filled", false);
                    t.data("filled", false);
                    if (n.find(".input-certnumber").parent().hasClass("checked")) {
                        n.find(".input-certnumber").parent().data("valid", false);
                        n.find(".input-certnumber").parent().removeClass("checked").addClass("unchecked")
                    }
                    if (t.find(".input-certnumber").parent().hasClass("checked")) {
                        t.find(".input-certnumber").parent().data("valid", false);
                        t.find(".input-certnumber").parent().removeClass("checked").addClass("unchecked")
                    }
                    n.find(".input-certnumber").next().data("hidden", false).show().css("color", "#ff9900").text(e.haveSameCert);
                    n.find(".input-certnumber").css("border-color", "#ff9900");
                    i.unitFillRight = i.unitFillRight & 0
                }
            }
        },
        validAll: function(e) {
            var t = this,
            n;
            if (i(".score-tit").find("input[type='checkbox']").prop("checked")) {
                if (i(".discount-wrap").data("valid")) {
                    i.unitFillRight = i.unitFillRight & 1
                } else {
                    i.unitFillRight = i.unitFillRight & 0
                }
            } else {
                i.unitFillRight = i.unitFillRight & 1
            }
            if (i(e.touristBox).find(".ignore").find("input").prop("checked") || i.saleNote == 0) {
                i.unitFillRight = i.unitFillRight & 1
            } else {
                i(e.touristBox).find(".ifo-input-row").find(".input-name").each(function(n) {
                    t.validName(e, i(this), e.rightTourName, e.emptyTourName);
                    i.unitFillRight = i.unitFillRight & i(this).data("valid")
                });
                i(e.touristBox).find(".ifo-input-row").find(".input-certnumber").each(function(n) {
                    var a = i(this).parent().find(".select-certype").find("option:selected").val();
                    if (a == "2") {
                        t.validPassport(e, i(this), "norequired")
                    } else if (a == "1") {
                        t.validId(e, i(this), "norequired")
                    } else if (a == "3") {
                        t.validHkPassport(e, i(this), "norequired")
                    }
                    i.unitFillRight = i.unitFillRight & i(this).parent().data("valid")
                });
                i(e.touristBox).find(".input-ps-effect").each(function(n) {
                    var a = i(this).parent().parent().prev().find(".select-certype").find("option:selected").val();
                    if (a == "2") {
                        if (i(this).parent().parent().prev().find(".input-certnumber").val() != "" && t.validPassport(e, i(this).parent().parent().prev().find(".input-certnumber"), "norequired")) {
                            t.validPsEffect(e, i(this), "required")
                        } else {
                            t.validPsEffect(e, i(this), "norequired")
                        }
                    } else {
                        t.validPsEffect(e, i(this), "norequired")
                    }
                    i.unitFillRight = i.unitFillRight & i(this).parent().data("valid")
                });
                i(e.touristBox).find(".input-phone").each(function(n) {
                    t.validPhone(e, i(this), "norequired");
                    i.unitFillRight = i.unitFillRight & i(this).parent().data("valid")
                });
                i(e.touristBox).find(".ifo-input-wrap").each(function(a) {
                    n = i(this);
                    i(e.touristBox).find(".ifo-input-wrap").each(function(s) {
                        if (a != s) {
                            t.testTheSameInfo(e, n, i(this))
                        }
                    })
                });
                t.validSex(e)
            }
            i(e.contactBox).find(".input-name").each(function(n) {
                t.validName(e, i(this), e.rightName, e.emptyName);
                i.unitFillRight = i.unitFillRight & i(this).data("valid")
            });
            i(e.contactBox).find(".input-phone").each(function(n) {
                var a = i(this).val();
                t.validPhone(e, i(this), "required");
                i.unitFillRight = i.unitFillRight & i(this).data("valid")
            });
            i("#specialRequire").each(function() {
                var t = new d(i(this));
                i(this).data("valid", t.vali(e.rightRemark));
                i.unitFillRight = i.unitFillRight & i(this).data("valid")
            });
            if (i(i(e.invoiceBox).find(".inv-row")[0]).find("input").prop("checked")) {
                i(".inv-selected").find(".invoice-receiver").each(function() {
                    t.validName(e, i(this), e.rightReceiver, e.emptyReceiver);
                    i.unitFillRight = i.unitFillRight & i(this).data("valid")
                });
                i(".inv-selected").find(".invoice-phone").each(function() {
                    t.validPhone(e, i(this), "required");
                    i.unitFillRight = i.unitFillRight & i(this).data("valid")
                });
                i(".invoice-header").each(function() {
                    t.validName(e, i(this), e.rightHeader, e.emptyHeader);
                    i.unitFillRight = i.unitFillRight & i(this).data("valid")
                });
                i(".inv-selected").find(".inp-w-2").each(function() {
                    t.validCode(e, i(this));
                    i.unitFillRight = i.unitFillRight & i(this).data("valid")
                });
                i(".inv-selected").find(".invoice-address").each(function() {
                    if (t.validAddress(e, i(this))) {
                        t.validUnitWrapRow(i(this))
                    }
                    i.unitFillRight = i.unitFillRight & i(this).data("valid")
                })
            } else {
                i.unitFillRight = i.unitFillRight & 1
            }
            return i.unitFillRight
        },
        validTourist: function(e, t) {
            var n = 0,
            a = this;
            i(e.touristBox).find(".ifo-input-wrap").find(".input-name").each(function() {
                i(this).parent().data("valid", false).addClass("unchecked")
            });
            i(e.touristBox).find(".ifo-input-wrap").find(".input-name").blur(function() {
                if (i(this).val() == "") {
                    if (i.content.lineType == 0 || i.content.lineType == 1 || i.content.lineType == 2) i(this).prop("placeholder", "同证件姓名");
                    else if (i.content.lineType == 3 || i.content.lineType == 4) i(this).prop("placeholder", "证件中的英文姓名")
                }
                a.validName(e, i(this), e.rightTourName, e.emptyTourName)
            });
            i(e.touristBox).find(".ifo-input-wrap").find(".input-name").focus(function() {
                i(this).prop("placeholder", "")
            });
            i(e.touristBox).find(".ifo-input-wrap").find(".input-phone").each(function() {
                i(this).parent().data("valid", true).addClass("checked")
            });
            i(e.touristBox).find(".input-phone").blur(function(t) {
                a.validPhone(e, i(this), "norequired")
            });
            i(e.touristBox).find(".ifo-input-row").find("input[type='radio']").each(function() {
                i(this).parent().parent().data("valid", true).addClass("row-checked")
            });
            i(e.touristBox).find(".ifo-input-wrap").find(".select-certype").each(function() {
                i(this).parent().data("valid", true).addClass("checked")
            });
            i(e.touristBox).find(".input-certnumber").blur(function(t) {
                var n = i(this).parent().find(".select-certype").find("option:selected").val();
                if (n == "2") a.validPassport(e, i(this), "norequired");
                else if (n == "1") a.validId(e, i(this), "norequired");
                else if (n == "3") a.validHkPassport(e, i(this), "norequired")
            });
            i(e.touristBox).find(".input-ps-effect").each(function() {
                i(this).parent().data("valid", true).addClass("checked")
            });
            i(e.touristBox).find(".input-ps-effect").blur(function(t) {
                if (i(this).val() == "") i(this).prop("placeholder", "格式:2015-09-20");
                if (i(this).parent().parent().prev().find(".input-certnumber").val() != "" && a.validPassport(e, i(this).parent().parent().prev().find(".input-certnumber"), "norequired")) {
                    a.validPsEffect(e, i(this), "required")
                } else {
                    a.validPsEffect(e, i(this), "norequired")
                }
            });
            i(e.touristBox).find(".input-ps-effect").focus(function() {
                i(this).prop("placeholder", "")
            });
            i(".qmk-ico").mouseover(function() {
                i(this).next().show()
            });
            i(".qmk-ico").mouseout(function() {
                i(this).next().hide()
            });
            i(e.touristBox).find(".select-certype").change(function() {
                var t = i(this).find("option:selected").val();
                if (t == "2") {
                    i(this).parent().parent().next().show();
                    a.validPassport(e, i(this).next(), "norequired")
                } else if (t == "1") {
                    a.validId(e, i(this).next(), "norequired");
                    i(this).parent().parent().next().hide()
                } else if (t == "3") {
                    a.validHkPassport(e, i(this).next(), "norequired");
                    i(this).parent().parent().next().hide()
                }
            })
        },
        validName: function(i, e, t, n) {
            var a = /[\u4e00-\u9fa5a-zA-Z]/g,
            s = false;
            var r = new o(e);
            e.data("valid", r.vali(a, t, n));
            s = e.data("valid");
            return s
        },
        validPassport: function(i, e, t) {
            var n = /^((P\d{7})|(G\d{8})|(S\d{7,8})|(D\d+|1[4,5]\d{7}))$/gi,
            a = true;
            var o = new s(e);
            e.data("valid", o.vali(n, i.rightPassport, "", t));
            a = e.data("valid");
            return a
        },
        validId: function(i, e, t) {
            var n = /^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{4}$/,
            a = true;
            var s = new c(e);
            e.data("valid", s.vali(n, i.rightId, "", t));
            a = e.data("valid");
            return a
        },
        validHkPassport: function(i, e, t) {
            var n = /^((W\d{8})|(C\d{8}))$/gi,
            a = true;
            var o = new s(e);
            e.data("valid", o.vali(n, i.rightHkPass, "", t));
            a = e.data("valid");
            return a
        },
        validPsEffect: function(i, e, t) {
            var n = /^(20[2-9][0-9]-([0][1-9]|[1][0-2])-([0][1-9]|[1][0-9]|[2][0-9]|[3][0-1]))|(20[1][5-9]-([0][1-9]|[1][0-2])-([0][1-9]|[1][0-9]|[2][0-9]|[3][0-1]))$/,
            a = true;
            var o = new s(e);
            e.data("valid", o.vali(n, i.rightPsEffect, i.emptyPsEffect, t));
            a = e.data("valid");
            return o.vali(n, i.rightPsEffect, i.emptyPsEffect, t)
        },
        validAddress: function(i, e) {
            var t = /[\u4e00-\u9fa5a-zA-Z0-9]/g,
            n = true;
            var a = new r(e);
            e.data("valid", a.vali(t, i.rightAdress, i.emptyAdress));
            n = e.data("valid");
            return n
        },
        validSex: function(e) {
            var t;
            var n = parseInt(i.content.adultNum) + parseInt(i.content.childNum);
            i(e.touristBox).find(".sex-row").each(function() {
                if (!i(this).hasClass("row-checked")) i(this).find("label:last").show().css("color", "#ff9900").html(e.emptySex);
                else {
                    i(this).find("label:last").hide()
                }
            });
            i.unitFillRight = i.unitFillRight & 1
        },
        validCode: function(i, e) {
            var t = /^[0-9][0-9]{5}$/,
            n = true;
            var a = new s(e);
            e.data("valid", a.vali(t, i.rightCode, "", "norequired"));
            n = e.data("valid");
            return n
        },
        validUnitWrapRow: function(i) {
            if (i.parent().hasClass("unchecked")) i.parent().data("valid", true).removeClass("unchecked").addClass("checked");
            if (i.parent().parent().hasClass("unchecked")) i.parent().parent().data("valid", true).removeClass("unchecked").addClass("checked")
        },
        validInvoice: function(e, t) {
            var n, a, s, o, r, c = this,
            l = 0,
            p = 0;
            n = i(".invoice-header");
            n.focus(function() {
                i(this).prop("placeholder", "")
            });
            n.blur(function() {
                if (i(this).val() == "") i(this).prop("placeholder", "请以客户姓名或公司名称作为发票抬头");
                if (c.validName(e, i(this), e.rightHeader, e.emptyHeader)) {
                    c.validUnitWrapRow(i(this))
                }
            });
            i(e.invoiceBox).find(".inv-row").each(function(e) {
                if (e == 2) {
                    i(this).data("valid", false).addClass("unchecked")
                }
            });
            i(e.invoiceBox).find(".input-wrap").each(function() {
                i(this).data("valid", false).addClass("unchecked")
            });
            a = i(".invoice-receiver");
            a.blur(function() {
                if (c.validName(e, i(this), e.rightReceiver, e.emptyReceiver)) {
                    c.validUnitWrapRow(i(this))
                }
            });
            s = i(".invoice-phone");
            s.focus(function() {
                i(this).prop("placeholder", "")
            });
            s.blur(function() {
                if (i(this).val() == "") {
                    i(this).prop("placeholder", "收件人手机号码")
                }
                if (c.validPhone(e, i(this), "required")) {
                    c.validUnitWrapRow(i(this))
                }
            });
            o = i(".invoice-address");
            o.focus(function() {
                i(this).prop("placeholder", "")
            });
            o.blur(function() {
                if (i(this).val() == "") {
                    i(this).prop("placeholder", "详细街道地址，不需要重复省市")
                }
                if (c.validAddress(e, i(this))) {
                    c.validUnitWrapRow(i(this))
                }
            });
            i(e.invoiceBox).find(".inp-w-2").blur(function() {
                if (c.validCode(e, i(this))) {
                    c.validUnitWrapRow(i(this))
                }
            });
            i(i(e.invoiceBox).find(".inv-d-row").find("li")[0]).data("on", true);
            i(i(e.invoiceBox).find(".inv-pop")[0]).data("on", true).data("type", 0).addClass("inv-selected");
            i(e.invoiceBox).find(".inv-d-row").find("li").click(function(t) {
                var n = i(this).prop("id");
                var a = {
                    "normal-exp": 0,
                    "emergy-exp": 1,
                    "free-exp": 2
                };
                i(i(e.invoiceBox).find(".inv-d-row").find("li").each(function() {
                    if (i(this).data("on")) {
                        i(this).data("on", false).removeClass("sed-dtb")
                    }
                }));
                i(this).data("on", true).addClass("sed-dtb");
                i(i(e.invoiceBox).find(".inv-pop").each(function() {
                    if (i(this).data("on")) {
                        i(this).hide()
                    }
                }));
                for (key in a) {
                    if (n == key) {
                        i(i(e.invoiceBox).find(".inv-pop")[a[key]]).data("on", true).data("type", a[key]).addClass("inv-selected").show()
                    } else {
                        if (i(i(e.invoiceBox).find(".inv-pop")[a[key]]).hasClass("inv-selected")) {
                            i(i(e.invoiceBox).find(".inv-pop")[a[key]]).removeClass("inv-selected")
                        }
                        i(i(e.invoiceBox).find(".inv-pop")[a[key]]).data("on", false)
                    }
                }
            });
            i("#invoice-box").find(".inv-row").find("input[type='checkbox']").click(function() {
                i("#inv-detail").stop().slideToggle(function() {})
            });
            i(".self-add-row").find("a").click(function(e) {
                i(".curr").removeClass("curr");
                i(this).addClass("curr")
            });
            i(".payment-wrap").find("input[type='checkbox']").prop("checked", true);
            i(".diab-btn").removeClass("diab-btn").attr("disabled", false);
            i(".payment-wrap").find("input[type='checkbox']").click(function() {
                if (i(this).prop("checked")) i(".diab-btn").removeClass("diab-btn").attr("disabled", false);
                else i(".p-btn").addClass("diab-btn").attr("disabled", true)
            });
            i("#specialRequire").blur(function() {
                var t = new d(i(this));
                i(this).data("valid", t.vali(e.rightRemark))
            });
            if (!i(".popup-box").hasClass("tour-popup")) i(".popup-box").addClass("tour-popup");
            i(".payment-wrap").find("span").find("a").click(function() {
                c.openPopWin();
                var e = i.content.lineType;
                i(".popup-main").html(' <a href="#none" class="spr close">关闭</a> <div class="pop-scroll"> </div>');
                i(".popup-box").find(".popup").css("width", "900px");
                i(".popup-box").find(".pop-scroll").load(baseConfig.base + baseConfig.order_notice, "",
                function(t) {
                    if (e != 4) {
                        i(".notice-domestic").show();
                        i(".notice-oversea").hide()
                    } else {
                        i(".notice-domestic").hide();
                        i(".notice-oversea").show()
                    }
                });
                i(".popup-wrap").find(".close").on("click",
                function() {
                    i(".popup-container").hide();
                    i(".mask").hide()
                })
            })
        },
        submitOrder: function(e, t) {
            var n = this;
            i("input.p-btn").click(function(a) {
                i.unitFillRight = 1;
                i.touristlist = [];
                if (n.validAll(e)) {
                    i(this).addClass("diab-btn").prop("disabled", true);
                    i(".payment-wrap").find("input[type='checkbox']").prop("checked", false);
                    n.rebuildOrder(e, t, n.addTouristToOrder, a)
                } else {
                    i("html,body").animate({
                        scrollTop: i(i(".unchecked")[0]).offset().top
                    },
                    1e3)
                }
            })
        },
        triggerPriceChanged: function(e) {
            i("#text").on("valuechange",
            function(i, e) {});
            i.event.special.valuechange = {
                teardown: function(e) {
                    i(this).unbind(".valuechange")
                },
                handler: function(e) {
                    i.event.special.valuechange.triggerChanged(i(this))
                },
                add: function(e) {
                    i(this).on("keyup.valuechange cut.valuechange paste.valuechange input.valuechange", e.selector, i.event.special.valuechange.handler)
                },
                triggerChanged: function(i) {}
            }
        }
    };
    module.exports = p
});
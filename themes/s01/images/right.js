/*!
 * Created by xbill on 15/3/16.
 */
define(function(require,exports,module){var e=require("jquery");require("underscore");require("handlebars");var t={init:function(){this._renderHotel();this.initTheme()},_renderHotel:function(){var t=e(".hotel-wrapper"),a=e("#hotel-tmpl").html();if(!a)return;var i=Handlebars.compile(a);var r=HotelTopDataArray;var l=0,n=0,s=_.omit(r,"more"),o=_.size(s);var d=_.map(s,function(e,t){l++;n=e.length-1;return{id:"htl"+l,city:t,selected:l==1?"selected":"",hide:l==o?"hide":"",values:_.map(e,function(e,t){if(e.lowprice){e.last=t==n?"last":"";return e}})}});var c={hotels:d,more:r.more||""};var h=i(c);e(h).appendTo(t);this._setHotelTab()},_setHotelTab:function(){var t=e(".hotel-wrapper"),a=t.find(".tab-nav"),i=t.find(".tab-content");t.delegate(".tab-nav","click",function(t){t.preventDefault();t.stopImmediatePropagation();var r=e(this).data("tab");a.removeClass("selected");a.filter('[data-tab="'+r+'"]').addClass("selected");i.addClass("hide");i.filter("."+r).removeClass("hide")})},initTheme:function(){e("#aside-tab").delegate("li","click",function(t){t.preventDefault();e(this).addClass("selected").siblings().removeClass("selected");e("#"+e(this).attr("value")).show().siblings().hide()})}};module.exports=t});
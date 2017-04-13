/**
 * Created by jahon on 15/3/16.
 */

var baseVersion = '0.9.0619',
    product='product',
    baseConfig = {
        base: Url.intfaceBase,
        member_login_url: 'mbrWebCenter/login/init.action',
        member_reg_url: '/register_new/init.action',
        tour_calc_price_url: "/index.php?d=api&c=callapi_controller&ServiceName=vac.order.getCalendarPriceData",
        tour_product_url: "/product.php/product/productItem",
        tour_order_url: "/product.php/order/order_controller/index",
        tour_product_price_url:"/product.php/product/getOrderPrice",
        tour_comment_url:"/index.php?d=api&c=callapi_controller&ServiceName=vac.order.gradeRecordList",
        tour_fresh_price_url: "/product.php?d=freeline&c=productinfo_controller&m=getLowPrice",
        list_req_url:"/index.php?d=api&c=callapi_controller&m=request",
        index_phone_order_url:"/index.php?d=membercenter&c=travelOrder&m=info_whole&ordercd=",
        index_flight: '/index.php?c=cindexcontroller&m=getFlightYHInfo',
        header_search: '/search/',
        header_search_type2: '/destination/grouptravel/1/',
        header_search_type3: '/destination/freeline/1/',
        header_search_type4: '/destination/freeline/2/',
        order_create: "/product.php?d=order&c=order_controller&m=createFreeOrder",
        order_result: "/product.php?d=order&c=order_controller&m=order_result&ordercd=",
        order_phone_code: "/product.php?d=order&c=order_controller&m=getPhoneCode",
        order_validate_code: "/product.php?d=order&c=order_controller&m=getValidatecode",
        order_isExist_member:"/product.php?d=order&c=order_controller&m=isExistMember&mobileNo=",
        order_notice: "/index.php?d=order&c=order_controller&m=getNotices",
        member_pay: "/product.php?c=pay&m=pay_form&ordercd="
};


seajs.config({
    alias: {
        'es5-shim': '/themes/s01/js/es5-shim.min.js',
        'json': '/themes/s01/js/json.js',
        'jquery': '/themes/s01/js/jquery.min.js',
        'underscore': '/themes/s01/js/underscore-min.js',
        'handlebars': '/themes/s01/images/handlebars.js',
        'moment': '/themes/s01/js/moment.min.js',

        //js插件
        'livequery': '/themes/s01/js/jquery.livequery.js',
        'unveil': '/themes/s01/js/jquery.unveil.js',
        'jquery.stickyNavbar': '/themes/s01/js/jquery.stickyNavbar.min.js',
        'fancybox':'/themes/s01/js/jquery.fancybox-1.3.4.js',

        //自定义模块
        'cal4pro': '/themes/s01/images/cal4pro.min.js',
        'util': '/themes/s01/js/util.js',
        'base64': '/themes/s01/js/base64.js',
        //'freeline': 'http://webres.mangocity.com/web/public/js/0.9.0619/modules/freeline/freeline.js',
        'freeproduct': '/themes/s01/images/freeproduct.js',


        'index': '/themes/s01/images/index.js',
        'header': '/themes/s01/images/header.js',
        'banner': '/themes/s01/images/banner.js',
        'right': '/themes/s01/images/right.js',
        'rightSide': '/themes/s01/images/rightSide.js',
        //'footer': 'http://webres.mangocity.com/web/public/js/0.9.0619/modules/main/footer.js',
        //'pagination': 'http://webres.mangocity.com/web/public/js/0.9.0619/modules/tour/pagination.js',
        //'filter': 'http://webres.mangocity.com/web/public/js/0.9.0619/modules/tour/filter.js',

        'mgSelect': '/themes/s01/images/day.js',
        //'mgGallery': 'http://webres.mangocity.com/web/public/js/0.9.0619/modules/tour/mgGallery.js',

        'yoslide': '/themes/s01/images/yoSlider.js',

        //订单
        //'order': 'http://webres.mangocity.com/web/public/js/0.9.0619/modules/order/order.js',

        //评论
        //'comment': "http://webres.mangocity.com/web/public/js/0.9.0619/modules/freeline/comment.js",
        //详情
        //'travelorder':"http://webres.mangocity.com/web/public/js/0.9.0619/modules/membercenter/travelOrder.js",

        'pcc': "/themes/s01/js/pcc.js",
        'pinyin': "/themes/s01/js/pinyin.js",
        'placeholder': "/themes/s01/js/placeholder.js"
    },
    preload: [
        'jquery',
        'util',
        Function.prototype.bind ? '' : 'es5-shim',
        this.JSON ? '' : 'json'
    ],
    debug: false,
    // 变量配置
    vars: {
        'public': 'public/js/{version}',
        'public_unver': 'public/js',
        'spm_modules': 'spm_modules',
        'modules': 'modules',
        'vendor': 'vendor',
        'ptype':'product'
    },
    map: [ [/\{version\}/g,baseVersion]],
    base: Url.scriptBase,
    charset: 'utf-8',
    timeout: 20000
});

//'public': 'public/js/{version}',
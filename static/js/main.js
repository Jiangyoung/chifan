/**
 * Created by zhangjianying on 2015/10/30.
 */
requirejs.config({
    baseUrl : 'http://static.chifan.com/js/lib',
    paths : {
        'app' : '../app',
        'jquery' : 'jquery-1.11.3',
        'jquery-ui' : '../app/widget/jquery-ui'
    },
    map : {
        '*' : {
            'css' : 'css' //制定css.js的位置，相对于baseUrl
        }
    },
    shim : {
        'jquery-ui' : ['jquery', 'css!../../css/jquery-ui.css'],
    }
});

require(['app/index'], function(index) {
    index.init();
});
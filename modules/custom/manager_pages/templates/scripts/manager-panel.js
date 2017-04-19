/**
 * 添加用户操作顶栏
 */
jQuery('document').ready(function($) {
    /**
     * 为菜单添加交互事件
     */
    $('.manager-panel').find('li').on('mouseenter', function() {
        $(this).addClass('hover');
    }).on('mouseleave', function() {
        $(this).removeClass('hover');
    });
});
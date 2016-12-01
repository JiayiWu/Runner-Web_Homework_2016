/**
 * Created by StevenWu on 16/12/1.
 */
$(function () {
    $('#logout').click(function () {
        jQuery.ajax({
            url: 'user/logout',
            cache: false
        })
    });
});



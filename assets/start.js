var scrolled = false;
var page = 1;
var contenttypeslug = window.location.href.substr(window.location.href.lastIndexOf("/")+1);

$(window).scroll(function() {

    var window_top = $(window).scrollTop() + $(window).height();
    var div_top =  $('#infinite-scroll-bottom').offset().top;
    if(window_top >= div_top) {
        if (scrolled == false) {
            loadMore();
            scrolled = true;
        }
    }
});

function loadMore() {
    var url = '/infinitescroll/'+contenttypeslug;
    page++;
    $.ajax({
        type: "GET",
        url: url,
        data: {'page': page },
        cache: false,
        success: function (html) {
            $('#infinite-scroll').append(html);
            if(html != 'No more posts') {
                scrolled = false;
            }
        }
    });
}

var List = function(url, data){
    var list = this;
    list.currentPage = 1;
    list.name = list.getTime();
    list.loading = false;
    list.noMore = false;
    list.url = url;
    list.data = data;

    list.getItems();
    $(window).scroll(function() {
        list.getItems();
    });
}

List.prototype.init = function() {
    var self = this;
    self.currentPage = 1;
    self.name = self.getTime();
    self.loading = false;
    self.noMore = false;
    $("#loading").html('<i></i>加载中，请稍候…');
}

List.prototype.getTime = function() {
    return new Date().getTime();
}

List.prototype.getItems = function() {
    var self = this;
    if (self.loading || self.noMore) {
        return false;
    }
    var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());     //浏览器的高度加上滚动条的高度
    if ($(document).height() > totalheight + 400){     //当文档的高度小于或者等于总的高度的时候，开始动态加载数据
        return false;
    }
    self.loading = true;
    var name = self.name;
    $.ajax({
        url: self.url,
        type: 'get',
        data: $.extend({}, {'page': self.currentPage}, self.data),
        async: true,
        cache: false,
        success: function (response) {
            if (response.result !== true) {
                layer.msg(response.message);
                return false;
            }
            if (name != self.name) {
                return false;
            }
            if (!response.content.hasMorePages) {
                self.noMore = true;
                $("#loading").text('没有更多了');
            }
            $('#loading').before(response.content.data);
            self.currentPage++;
        },
        complete: function () {
            self.loading = false;
        }
    });

    return false;
}
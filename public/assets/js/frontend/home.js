var fe_home = function (options) {
    var self = this;
};

fe_home.prototype.fetch_articles = function () {
    var self = this;
    $.ajax({
        url: HOST_URL + "/article/fetch-articles",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "GET",
        success: function (response) {
            console.log(response);
        },
        error: function (error) {},
    });
};

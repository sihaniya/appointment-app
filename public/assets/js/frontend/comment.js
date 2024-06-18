var fe_comment = function (options) {
    var self = this;
    this.article_id = options.article_id;

    $(document).on("submit", "#commentForm", function (e) {
        e.preventDefault();
        var commentDetails = $(this).serializeArray();
        var commentTargetUrl = $(this).attr("action");
        self.save(commentDetails, commentTargetUrl);
    });
};

fe_comment.prototype.fetch = function (id) {
    var self = this;
    $.ajax({
        url: HOST_URL + "/comment/" + id + "/fetch",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "GET",
        success: function (response) {
            self.displayComments(response.data);
        },
        error: function (error) {},
    });
};

fe_comment.prototype.save = function (data, url) {
    var self = this;
    $.ajax({
        url: url,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        data: data,
        beforeSend: function () {
            $("#commentFormLoader").show();
        },
        success: function (response) {
            if (response.success) {
                toastr.success(response.message);
                self.resetForm();
                self.fetch(self.article_id);
            }
            $("#commentFormLoader").hide();
        },
        error: function (error) {
            var errors = error.responseJSON.errors;
            var keys = Object.keys(errors);
            var values = Object.values(errors);
            for (let index = 0; index < keys.length; index++) {
                $("#" + keys[index]).after(
                    `<div class="form-error">${values[index][0]}</div>`
                );
            }
        },
    });
};

fe_comment.prototype.displayComments = function (comments) {
    var html = "";
    comments.forEach((e) => {
        html += `<div class="media fe-comment-card">
                <div class="media-avatar">${e.name.substring(0, 2)}</div>
                <div class="media-body">
                    <h5 class="app-h5 d-flex justify-content-between">${
                        e.name
                    } <span class="datetime">${moment(
            e.createdAt
        ).fromNow()}</span></h5>
                    <p class="email-text">${e.email}</p>
                    <p>${e.message}</p>

                </div>
        </div>`;
    });

    $("#displayComments").html(html);
};

fe_comment.prototype.resetForm = function () {
    $("#commentForm")[0].reset();
    $("#commentForm .form-error").remove();
};

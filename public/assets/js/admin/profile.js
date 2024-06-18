var profile_manager = function (options) {
    var self = this;
    this.upload_url = options.upload_url;

    $(document).on("click", ".swalConfirmButton", function () {
        self.destroy($(this).attr("data-href"));
    });

    $(document).on("change", "#profile_image", function () {
        var formData = new FormData();
        var files = $("#profile_image")[0].files[0];
        if (files) {
            formData.append("profile_image", files);
            var url = $("#update_profile_image").attr("action");
            self.update_profile_image(formData, url);
        }
    });

    $(document).on("submit", "#changePassword", function (e) {
        e.preventDefault();
        var change_password = $(this).serializeArray();
        var change_password_url = $(this).attr("action");
        self.update_password(change_password, change_password_url);
    });

    Dropzone.autoDiscover = false;
    const dropzone = new Dropzone("#image", {
        init: function () {
            this.on("addedfile", function (file) {
                if (this.files.length > 1) {
                    this.removeFile(this.files[0]);
                }
            });
        },
        url: self.upload_url,
        maxFiles: 1,
        paramName: "profile_image",
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (file, response) {
            console.log(response);
        },
    });
};

profile_manager.prototype.update_profile_image = function (data, url) {
    $.ajax({
        url: url,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "post",
        data: data,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success) {
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
        },
    });
};

profile_manager.prototype.update_password = function (data, url) {
    var self = this;
    $.ajax({
        url: url,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        data: data,
        success: function (response) {
            if (response.success) {
                toastr.success(response.message);
            } else {
                toastr.error(response.message);
            }
            self.resetChangePasswordForm();
        },
        error: function (error) {
            var errors = error.responseJSON.errors;
            console.log(errors);
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

profile_manager.prototype.resetChangePasswordForm = function () {
    $("#changePassword")[0].reset();
};

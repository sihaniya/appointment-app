var user_manager = function (options) {
    var self = this;
    this.userDataTable = null;

    $(document).on("click", ".swalConfirmButton", function () {
        // self.destroy($(this).attr("data-href"));
        window.location.href = $(this).attr("data-href");
    });

    $(document).on("click", ".closeCategoryForm", function (e) {
        e.preventDefault();
        $("#categoryModel").offcanvas("hide");
        self.resetForm();
    });
};

// Fetch All User

user_manager.prototype.fetch_list = function () {
    var self = this;

    self.userDataTable = $("#user_table").DataTable({
        bProcessing: false,
        bServerSide: true,
        ajax: {
            url: ADMIN_HOST_URL + "/user/fetch",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            data: function (d) {
                return $.extend({}, d, {});
            },
            error: function () {},
        },
        columns: [
            { title: "User", data: "name" },
            { title: "Role", data: "role" },
            { title: "Email", data: "email" },
            { title: "Mobile", data: "phone" },
            {
                title: "Action",
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    data =
                        '<a href="' +
                        (ADMIN_HOST_URL + "/user/" + data.id + "/edit") +
                        '" class="btn btn-sm btn-icon btn-success edit_category" type="button"><i class="bx bx-edit-alt"></i></a>' +
                        '<button data-href="' +
                        (ADMIN_HOST_URL + "/user/" + data.id + "/destroy") +
                        '"  class="btn btn-sm btn-icon btn-danger ms-1 confirm_button" type="button"><i class="bx bx-trash" ></i></button>';

                    return data;
                },
            },
        ],
    });
};

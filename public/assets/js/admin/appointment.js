// validation
// $("form").validate({
//     rules: {
//         user_id: "required",
//         appointment_date: "required",
//     },
//     messages: {
//         user_id: "The User field is required.",
//         appointment_date: "The Appointment Date field is required.",
//     },
// });

var appointment_manager = function (options) {
    var self = this;
    this.appointmentDataTable = null;

    $(document).on("click", ".swalConfirmButton", function () {
        // self.destroy($(this).attr("data-href"));
        window.location.href = $(this).attr("data-href");
    });

    $(document).on("click", ".closeCategoryForm", function (e) {
        e.preventDefault();
        $("#categoryModel").offcanvas("hide");
        self.resetForm();
    });

    // $(document).on("submit", "#appointmentForm", function (e) {
    //     e.preventDefault();
    //     var appointment_details = $(this).serializeArray();
    //     var appointment_form_url = $(this).attr("action");

    //     // console.log(appointment_details);
    //     self.store(appointment_details, appointment_form_url);
    // });
};

appointment_manager.prototype.fetch_list = function () {
    var self = this;

    self.appointmentDataTable = $("#appointment_table").DataTable({
        bProcessing: false,
        bServerSide: true,
        ajax: {
            url: ADMIN_HOST_URL + "/appointment/fetch",
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
            { title: "User", data: "user_id" },
            { title: "Appointment Date", data: "appointment_date" },
            {
                title: "Status",
                data: null,
                render: function (data, type, row) {
                    if (data.status === 1) {
                        data = `<span class="badge rounded-pill text-bg-success">Active</span>`;
                    } else {
                        data = `<span class="badge rounded-pill text-bg-danger">Inactive</span>`;
                    }
                    return data;
                },
            },
            {
                title: "Action",
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    data =
                        '<a href="' +
                        (ADMIN_HOST_URL + "/appointment/" + data.id + "/edit") +
                        '" class="btn btn-sm btn-icon btn-success edit_category" type="button"><i class="bx bx-edit-alt"></i></a>' +
                        '<button data-href="' +
                        (ADMIN_HOST_URL +
                            "/appointment/" +
                            data.id +
                            "/destroy") +
                        '"class="btn btn-sm btn-icon btn-danger ms-1 confirm_button" type="button"><i class="bx bx-trash" ></i></button>';

                    return data;
                },
            },
        ],
    });
};

// ADMIN_HOST_URL + "/appointment/store",
// appointment store

// appointment_manager.prototype.store = function (data, url) {
//     var self = this;
//     $.ajax({
//         url: url,
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//         type: "POST",
//         data: data,
//         success: function (response) {
//             console.log(response);
//             if (response.success) {
//                 toastr.success(response.message);
//                 window.location.href = ADMIN_HOST_URL + "/appointment";
//             }
//         },
//         error: function (error) {
//             var errors = error.responseJSON.errors;
//             var keys = Object.keys(errors);
//             var values = Object.values(errors);
//             for (let index = 0; index < keys.length; index++) {
//                 $("#" + keys[index]).after(
//                     `<div class="form-error">${values[index][0]}</div>`
//                 );
//             }
//         },
//     });
// };

// A appointment Deleted
appointment_manager.prototype.destroy = function (url) {
    var self = this;

    $.ajax({
        url: ADMIN_HOST_URL + "/appointment//destroy",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "DELETE",
        success: function (response) {
            if (response.success) {
                Swal.clickConfirm();
                toastr.success(response.message);
                self.categoryDataTable.ajax.reload();
            }
        },
    });
};

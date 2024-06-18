"use strict";

var beData = function (options) {
    var self = this;

    $("#toastr_success").click(function (e) {
        toastr.success("Data saved successfully.");
    });
    $("#toastr_danger").click(function (e) {
        toastr.error("Some error occurred.");
    });
    $("#toastr_warning").click(function (e) {
        toastr.warning("Before submit check all values.");
    });

    // Jquery Validation
    var forms = document.querySelectorAll(".needs-validation");
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener(
            "submit",
            function (event) {
                event.preventDefault();
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });

    // Confirm
    $("#swal_confirm").click(function (e) {
        // swal({
        // 	title: 'Are you sure?',
        // 	text: 'Once deleted, you will not be able to recover this imaginary file!',
        // 	icon: 'warning',
        // 	buttons: true,
        // 	dangerMode: true,
        // }).then((willDelete) => {
        // 	if (willDelete) {
        // 		swal('Poof! Your imaginary file has been deleted!', {
        // 			icon: 'success',
        // 		});
        // 	} else {
        // 		swal('Your imaginary file is safe!');
        // 	}
        // });
        Swal.fire({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, keep it",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Deleted!",
                    "Your imaginary file has been deleted.",
                    "success"
                );
                // For more information about handling dismissals please visit
                // https://sweetalert2.github.io/#handling-dismissals
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    "Cancelled",
                    "Your imaginary file is safe :)",
                    "error"
                );
            }
        });
    });

    self.beDataTable();
};

beData.prototype.beDataTable = function () {
    var self = this;
    console.log(HOST_URL + "/assets/data/data.json");
    // $.isLoading(defaults);
    self.datatable = $("#user_datatable").DataTable({
        ajax: HOST_URL + "/assets/data/data.json",
        columns: [
            { data: "name" },
            { data: "position" },
            { data: "office" },
            { data: "extn" },
            { data: "start_date" },
            { data: "salary" },
        ],
    });

    // $.isLoading('hide');

    // self.datatable = $('#user_datatable').Datatable({
    // 	data: {
    // 		type: 'remote',
    // 		source: {
    // 			read: {
    // 				url: 'https://jsonplaceholder.typicode.com/users',
    // 				headers: {
    // 					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
    // 						'content'
    // 					),
    // 				},
    // 				params: { parent_category_id: self.parent_category_id },
    // 			},
    // 		},
    // 		pageSize: 10,
    // 		serverPaging: true,
    // 		serverFiltering: true,
    // 		serverSorting: true,
    // 	},
    // 	layout: {
    // 		scroll: false,
    // 		footer: false,
    // 	},
    // 	sortable: true,
    // 	pagination: true,
    // 	search: {
    // 		input: $('#user_datatable'),
    // 		key: 'generalSearch',
    // 	},
    // 	columns: [
    // 		{
    // 			field: 'id',
    // 			title: '#',
    // 			sortable: 'asc',
    // 			width: 30,
    // 			type: 'number',
    // 			selector: false,
    // 			textAlign: 'center',
    // 		},
    // 		{
    // 			field: 'name',
    // 			title: 'Name',
    // 			sortable: 'asc',
    // 		},
    // 		{
    // 			field: 'created_at',
    // 			title: 'Created At',
    // 			sortable: 'asc',
    // 			autoHide: false,
    // 			template: function (row) {
    // 				return moment(row.created_at).format('LL');
    // 			},
    // 		},
    // 		{
    // 			field: 'Actions',
    // 			title: 'Actions',
    // 			sortable: false,
    // 			width: 280,
    // 			overflow: 'visible',
    // 			autoHide: false,
    // 			template: function (row) {},
    // 		},
    // 	],
    // });
};

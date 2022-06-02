<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});

$("button#addDocument").click(function(e) {
    e.preventDefault();

    var date_received = $("input[name=date_received]").val();
    var deadline = $("input[name=deadline]").val();
    var subject = $("input[name=subject]").val();
    var origin_id = $("input[name=origin_id]").val();
    var employee_id = $("input[name=employee_id]").val();
    var doctype_id = $("input[name=doctype_id]").val();
    var mor_id = $("input[name=mor_id]").val();
    var control_number = $("input[name=control_number]").val();

    $(this).text('Adding...');

    $.ajax({
        type: 'POST',
        url: "{{ route('storeAjax') }}",
        data: {

            date_received: date_received,
            deadline: deadline,
            subject: subject,
            origin_id: origin_id,
            employee_id: employee_id,
            doctype_id: doctype_id,
            mor_id: mor_id,
            control_number: control_number

        },
        success: function(data) {
            // console.log(data.success);
            if (data.status == 200) {
                Swal.fire(
                    'Added!',
                    'Document Added Successfully!',
                    'success'
                )
                fetchAllDocuments();
            }
            $("button#addDocument").text('Add Document');
            $("#addDocumentForm")[0].reset();
            $("#addDocumentModal").modal('hide');
        }
    });
});

// edit employee ajax request
$(document).on('click', '.editIcon', function(e) {
    e.preventDefault();

    let id = $(this).attr('id');
    $.ajax({
        url: "{{ route('edit.doc') }}",
        method: 'get',
        data: {
            id: id,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {

            dr = response[0].date_received;
            for (let x in response[0]) {

                var el = document.querySelector('#updateDocument');
                el.setAttribute('data-id', id);

                if (x.search("_id") < 0) $("#editDocumentModal #" + x).val(response[0][x]);
                else {
                    name = x.replace('_id', '');

                    $("#editDocumentModal input[name='" + x + "'").val(response[0][x]);
                    $("#editDocumentModal #" + x).val(response[name]);
                }
            }
        }
    });
});

// update employee ajax request

$("button#updateDocument").click(function(e) {
    e.preventDefault();

    var date_received = $("#editDocumentModal input[name=date_received]").val();
    var deadline = $("#editDocumentModal input[name=deadline]").val();
    var subject = $("#editDocumentModal input[name=subject]").val();
    var origin_id = $("#editDocumentModal input[name=origin_id]").val();
    var employee_id = $("#editDocumentModal input[name=employee_id]").val();
    var doctype_id = $("#editDocumentModal input[name=doctype_id]").val();
    var mor_id = $("#editDocumentModal input[name=mor_id]").val();
    var control_number = $("#editDocumentModal input[name=control_number]").val();
    var el = document.querySelector("button#updateDocument");
    var id = el.getAttribute('data-id');
    // var id = 38;

    $(this).text('Updating...');

    $.ajax({
        type: 'POST',
        url: "{{ route('update.doc') }}",
        data: {

            date_received: date_received,
            deadline: deadline,
            subject: subject,
            origin_id: origin_id,
            employee_id: employee_id,
            doctype_id: doctype_id,
            mor_id: mor_id,
            control_number: control_number,
            id: id

        },
        method: 'put',
        success: function(data) {
            // console.log(data.success);
            if (data.status == 200) {
                Swal.fire(
                    'Updated!',
                    'Document Updated Successfully!',
                    'success'
                )
                fetchAllDocuments();
            }
            $("#editDocumentModal").modal('hide');
            $("button#updateDocument").text('Update Document');

        }
    });
});

// delete employee ajax request
$(document).on('click', '.deleteIcon', function(e) {
    e.preventDefault();
    let id = $(this).attr('id');
    let csrf = '{{ csrf_token() }}';
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('delete') }}",
                method: 'delete',
                data: {
                    id: id,
                    _token: csrf
                },
                success: function(response) {
                    // console.log(response);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    fetchAllDocuments();
                }
            });
        }
    })
});

// fetch all employees ajax request
fetchAllDocuments();

function fetchAllDocuments() {
    $.ajax({
        url: "{{ route('fetchAll.doc') }}",
        method: 'get',
        success: function(response) {
            $("#show_all_documents").html(response);
            var table = $('#myTable').DataTable({
                "order": [
                    [5, "desc"]
                ],
                columnDefs: [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    },

                    {
                        "targets": [3],
                        "visible": false,
                    },

                    {
                        "targets": [6],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        orderable: false,
                        targets: [5, 6]
                    }
                ]
            });

            table.columns().iterator('column', function(ctx, idx) {
                $(table.column(idx).header()).prepend('<span class="sort-icon"/>');
            });
        }
    });
}
</script>
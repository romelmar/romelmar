<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#addRoute").click(function(e) {

        e.preventDefault();
        $(this).text('Updating...');
        URL = $("#add_route_form").attr('action');

        var date_received = $("input[name=date_received]").val();
        var doc_id = $("input[name=doc_id]").val();
        var employee_id = $("input[name=employee_id]").val();
        var division_id = $("input[name=division_id]").val();
        var action = $("textarea[name=action]").val();

        $.ajax({
            type: 'POST',
            url: "{{ route('docroutes.create') }}",
            data: {
                date_received: date_received,
                doc_id: doc_id,
                action: action,
                employee_id: employee_id,
                division_id: division_id,
            },
            success: function(response) {
                if (response.status == "success") {
                    Swal.fire(
                        'Updated!',
                        'Document Route Updated Successfully!',
                        'success'
                    )
                    fetchAllRoutes();
                }
                $("#addRouteModal").modal('hide');
                $("button#addRoute").text('Update Document');
                $("#add_route_form")[0].reset();
            },
            error: function(error) {
                console.log(error)
            }
        });
    });

    // ----------------------- edit Route -------------------------------------------
    $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();

        let id = $(this).attr('id');
        $.ajax({
            url: "{{ route('edit.doc_route') }}",
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {

                dr = response[0].date_received;
                $("#editRouteModal textarea[name='action'").val(response.action);

                for (let x in response[0]) {

                    var el = document.querySelector('#editRoute');
                    el.setAttribute('data-id', id);

                    if (x.search("_id") < 0) $("#editRouteModal #" + x).val(response[0][x]);
                    else {
                        name = x.replace('_id', '');

                        $("#editRouteModal input[name='" + x + "'").val(response[0][x]);
                        $("#editRouteModal #" + x).val(response[name]);
                    }
                }
            }
        });
    });

    $("button#editRoute").click(function(e) {
        e.preventDefault();

        var date_received = $("#editRouteModal input[name=date_received]").val();
        var action = $("#editRouteModal textarea[name=action]").val();
        var division_id = $("#editRouteModal input[name=division_id]").val();
        var employee_id = $("#editRouteModal input[name=employee_id]").val();

        var el = document.querySelector("button#editRoute");
        var id = el.getAttribute('data-id');

        $(this).text('Updating...');

        $.ajax({
            type: 'POST',
            url: '{{ route('update.doc_route') }}',
            data: {

                date_received: date_received,
                action: action,
                division_id: division_id,
                employee_id: employee_id,
                id: id

            },
            method: 'put',
            success: function(data) {
                // console.log(data.success);
                if (data.status == 200) {
                    Swal.fire(
                        'Updated!',
                        'Document Route Updated Successfully! ',
                        'success'
                    )
                    fetchAllRoutes();
                }
                $("#editRouteModal").modal('hide');
                $("button#editRoute").text('Update Document');
                $("#add_route_form")[0].reset();

            }
        });
    });

    // ----------------------------------------------------------------
    fetchAllRoutes();

    function fetchAllRoutes() {
        $.ajax({
            url: '{{ route('fetchAllRoute', $document->id) }}',
            method: 'get',
            success: function(response) {
                $("#show_all_documents").html(response);
                var table = $('#myTable').DataTable({
                    "order": [
                        [1, "desc"]
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: [2]
                    }]
                });

                table.columns().iterator('column', function(ctx, idx) {
                    $(table.column(idx).header()).prepend('<span class="sort-icon"/>');
                });
            }
        });
    }
</script>
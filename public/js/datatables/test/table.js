$(document).ready(function() {
    $(function() {
        var template = Handlebars.compile($("#details-template").html());
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'http://laravel55.com/testdatatable/data',
            columns: datatable.columns,
            initComplete: function(rows) {
                this.api().columns().every(function() {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('change', function() {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });

        // Add event listener for opening and closing details
        $('#users-table tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(template(row.data())).show();
                tr.addClass('shown');
            }
        });

    });
});
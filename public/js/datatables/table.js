var initTableData = function(rows, _this) {
    $(".dataTables_filter").remove();

    _this.api().columns([1, 2]).every(function(key) {
        var column = this;
        var name = rows.aoColumns[key].name;

        switch (key) {
            case 1:
                var input = $('<input type="text" name="' + name + '">');

                break;
            case 2:

                var input = document.createElement("select");
                input.name = name;

                var array = ['Todos', 'Activo', 'Inactivo', 'Sincronizando'];

                for (var i = 0; i < array.length; i++) {
                    var option = document.createElement("option");
                    option.value = array[i];
                    option.text = array[i];
                    input.appendChild(option);
                }

                break;
        }

        $(input).appendTo($(column.footer())).on('keyup change', function() {
            column.search($(this).val(), false, false, true).draw();
        });
    });
    $("tfoot tr").appendTo("thead");
};

$(document).ready(function() {

    var template = Handlebars.compile($("#details-template").html());
    var table = LaravelDataTables.categories;

    // Add event listener for opening and closing details
    $('#categories tbody').on('click', 'td.details-control', function() {
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

$(document).on("click", ".delele-data-table", function(e) {
    var _this = this;
    console.log(_this);
    bootbox.confirm({
        closeButton: true,
        animate: true,
        message: "Estar seguro de borrar fila?",
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function(result) {
            if (result) {
                console.log('fila borrada');
                _this.form.submit();
            } else {
                console.log('fila no borrada');
                return true;
            }
        }
    });
    return false;
});
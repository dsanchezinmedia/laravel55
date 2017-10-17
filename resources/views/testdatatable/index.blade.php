<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel DataTables Tutorial</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            body {
                padding-top: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">

        <table class="table table-bordered" id="users-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Estado</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
                <th></th>
                <th>Id</th>
                <th>Name</th>
                <th>Estado</th>
                <th>Action</th>            
            </tfoot>
        </table>
        
        </div>

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/2.0.0/handlebars.js"></script>
        <!-- App scripts -->
        @stack('scripts')

        <script>var datatable = {!! json_encode($datatable) !!};</script>

        <script src="{{ asset('js/datatables/test/table.js') }}"></script>       
        <script id="details-template" type="text/x-handlebars-template">
            <table class="table">
                <tr>
                    <td>Full name:</td>
                    <td>@{{name}}</td>
                </tr>
                <tr>
                    <td>ID status:</td>
                    <td>@{{statuses.id}}</td>
                </tr>
                <tr>
                    <td>Extra info:</td>
                    <td>lalalala</td>
                </tr>
            </table>
        </script>

    </body>
</html>
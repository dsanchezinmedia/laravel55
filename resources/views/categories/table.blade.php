@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'id' => 'categories'], true) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    <script src="{{ asset('js/datatables/table.js') }}"></script>
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Full name:</td>
                <td>@{{c_name}}</td>
            </tr>
            <tr>
                <td>status:</td>
                <td>@{{s_name}}</td>
            </tr>
            <tr>
                <td>Extra info:</td>
                <td>lalalala</td>
            </tr>
        </table>
    </script>    
@endsection
@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%', 'id' => 'categories'], true) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}

    <script type="text/javascript">
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
            callback: function (result) {
                if(result) {
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
</script>
@endsection
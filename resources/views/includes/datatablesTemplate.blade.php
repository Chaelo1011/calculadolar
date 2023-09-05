<script async="false">
    $(document).ready(function(){
        //Iniciar los custom inputs
        bsCustomFileInput.init();
        //DataTables
        let table = new DataTable('#tabla', {
            processing: true,
            serverSide: true,
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            ajax: "{{ url("$url") }}",
            columns: [
                {!!$columns!!}
            ],
            language: {
                "lengthMenu":     "Mostrar _MENU_ registros",
                "zeroRecords":    "No se encontraron resultados",
                "emptyTable":     "No hay datos para mostrar",
                "sInfo":           "Mostrando registros del _START_ al _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "search":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
            }
            
        });
    })
</script>
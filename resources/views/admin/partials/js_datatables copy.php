<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>



<!-- ZONA DE BOTONES -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>






<script>
    $(document).ready(function() {
        $('#tabla').DataTable({

            responsive: true,
            autowidth: false,
            pageLength : 25,

            "language": {
            "lengthMenu": "Mostrando _MENU_ registros por pagina",
            "zeroRecords": "No hay registros, lo sentimos",
            "info": "Mostrando _PAGE_ de _PAGES_",
            "infoEmpty": "No hay datos",
            "infoFiltered": "(Filtrado de _MAX_ registros)",
            "search": "Buscar:",
            'paginate':{
                'next':'Siguiente',
                'previous':'Anterior'
            }
        },
          //para usar los botones
        dom: 'Bfrtilp',
        buttons:[
			{
				extend:    'excelHtml5',
				text:      '<i class="fas fa-file-excel"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-success'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fas fa-file-pdf"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-danger'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-info'
			},
		]


        });
    } );
</script>

<script>


// $(document).ready(function() {
//     $('#example').DataTable({
//         language: {
//                 "lengthMenu": "Mostrar _MENU_ registros",
//                 "zeroRecords": "No se encontraron resultados",
//                 "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
//                 "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
//                 "infoFiltered": "(filtrado de un total de _MAX_ registros)",
//                 "sSearch": "Buscar:",
//                 "oPaginate": {
//                     "sFirst": "Primero",
//                     "sLast":"Último",
//                     "sNext":"Siguiente",
//                     "sPrevious": "Anterior"
// 			     },
// 			     "sProcessing":"Procesando...",
//             },

//     });
// });

</script>

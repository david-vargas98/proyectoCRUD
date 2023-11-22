@extends('adminlte::page')

@section('title', 'Índice')

@section('content_header')
    <h1>Elementos militares</h1>
@stop

@section('content')
    @livewire('admin.elementos-militares-index')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> {{-- Inclusión de scrip para los botones de confirmación --}}
    {{-- Mensaje de session en caso de confirmarse la eliminación --}}
    @if (session('deleted') == 'El elemento fue borrado con éxito')
        <script>
            Swal.fire({
                title: "!Es un hecho!",
                text: "El elemento fue borrado con éxito.",
                icon: "success"
            });
        </script>
    @endif
    {{-- Script que lleva acabo la pregunta de confirmación --}}
    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault(); //Se detiene el envío del formulario
            //En su lugar, saldrá la alerta
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta es una acción definitiva D:",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Borrar"
            }).then((result) => {
                if (result.isConfirmed) {
                    //Se envía el formulario si es true, y se envía con submit para borrar el registro
                    this.submit();
                }
            });
        });
    </script>
    <script>
        setTimeout(function() {
            document.getElementById('successMessage').style.display = 'none';
        }, 5000);
    </script>
@stop

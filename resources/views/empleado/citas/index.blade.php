@extends('adminlte::page')

@section('title', 'Índice')

@section('content_header')
    <h1>Citas</h1>
@stop

@section('content')
    @livewire('admin.citas-index')
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> {{-- Inclusión de scrip para los botones de confirmación --}}
    {{-- Mensaje de session en caso de confirmarse la eliminación --}}
    @if (session('deleted') == 'El cita fue borrada con éxito')
        <script>
            Swal.fire({
                title: "!Es un hecho!",
                text: "La cita fue borrada con éxito.",
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
                text: "La cita va a ser borrada",
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

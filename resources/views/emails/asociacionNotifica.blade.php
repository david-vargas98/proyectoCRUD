<x-mail::message>
# Nueva asociación

<x-mail::panel>
La asociación entre el/la cliente/a {{$nombreCliente}} y el/la empleado/a {{$nombreUser}} ha sido creada!
</x-mail::panel>

<x-mail::button :url="$verContratoUrl" color="primary">
Ver contrato de la asociación
</x-mail::button>

<x-mail::button :url="$descargarContratoUrl" color="success">
Descargar contrato de la asociación
</x-mail::button>

Thanks, <br>
{{ config('app.name') }}
</x-mail::message>
{{-- 
    Do not use excess indentation when writing Markdown emails. Per Markdown standards, Markdown parsers will render indented content as code blocks. Sino sale todo horrible el mail con htm sin procesar XD
 --}}
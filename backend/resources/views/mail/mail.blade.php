@component('mail::message')
# Bienvenido a la institucion universitaria de colombia

Querido {{$email}},

Muchas gracias por incribirte al curso. Es muy importante para nosotros tenerte tan cerca

@component('mail::button', ['url' => 'https://universitariadecolombia.edu.co/'])
Ir a la pagina
@endcomponent

Gracias infinitas,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
# Bievenido a universidad de colombia

Querido {{$email}},

Muchas gracias por incribirse al curso. Es muy importante para nosoros tenerte tan cerca

@component('mail::button', ['url' => 'https://universitariadecolombia.edu.co/'])
Ir a la pagina
@endcomponent

Gracias infinitas,<br>
{{ config('app.name') }}
@endcomponent
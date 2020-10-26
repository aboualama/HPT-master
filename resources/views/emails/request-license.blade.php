@component('mail::message')
# Richiesta Licenze


<div class="mail-items">
  <h2>Complimenti! hai ricevuto una richiesta di acquisto di {{$number}} da:</h2>
  <h5 class="list-group-item-heading text-bold-600 mb-25">Utente: {{$username}}</h5>
  <h5 class="list-group-item-heading text-bold-600 mb-25">email: {{$email}}</h5>
  <h5 class="list-group-item-heading text-bold-600 mb-25">N. licenze: {{$number}}</h5>
  <h5 class="list-group-item-heading text-bold-600 mb-25">cell: {{$cell}}</h5>
</div>

@component('mail::button', ['url' => 'http://dev.hpt.training/en/login'])
Vai al sito
@endcomponent


@endcomponent

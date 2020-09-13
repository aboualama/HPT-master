@component('mail::message')
# Result


<div class="mail-items">
  <h2>Complimenti! hai ricevuto una richiesta di acquisto di {{$numero}} da:</h2>
  <h5 class="list-group-item-heading text-bold-600 mb-25">Username: {{$username}}</h5>
  <h5 class="list-group-item-heading text-bold-600 mb-25">email: {{$email}}</h5>
  <h5 class="list-group-item-heading text-bold-600 mb-25">cell: {{$cell}}</h5>
</div>

@component('mail::button', ['url' => 'http://dev.hpt.training/en/login'])
Back
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

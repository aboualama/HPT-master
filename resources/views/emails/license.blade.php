@component('mail::message')
# licensecodes


<div class="mail-items">
  <h5 class="list-group-item-heading text-bold-600 mb-25">Username: {{$username}}</h5>
  <h5 class="list-group-item-heading text-bold-600 mb-25">Licensecode: {{$licensecode}}</h5>
</div>

@component('mail::button', ['url' => 'http://dev.hpt.training/en/login'])
Back
@endcomponent


@endcomponent

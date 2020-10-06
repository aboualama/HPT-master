<div class="col-md-12 col-12">

  @include('partials._errors')
  <div class="card">
    <div class="card-content">
      <div class="card-body">


                @foreach ($records as $record)
                  <li value="{{$record->id}}">{{$record->code}}</li>
                @endforeach

      </div>
    </div>
  </div>
</div>


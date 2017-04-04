<!-- device select -->
{{--dd(get_defined_vars()['__data'])--}}
{{--$active_device--}}
<div class="row">
  <div class="col-md-12">
    <form action="{{ route( Route::currentRouteName()) }}" class="form" name="deviceselector" method="POST">
      {{ csrf_field() }}
      <div class="form-group">
        <label class="control-label" for="device">Dispositivos</label>
          @if($placas->count())
            <select name="device" id="device" class="form-control" onchange="$('form[name=deviceselector]').submit();">
              @foreach($placas as $d)
                <option value="{{ $d->part_number }}" {{ ($d->part_number == $active_device) ? 'selected' : '' }}>{{ $d->alias }}</option>
              @endforeach
            </select>
          @else
            <a class="btn btn-link" href="{{ route('appdevices.show') }}">Adicionar Dispositivo</a>
          @endif
      </div>
    </form>
  </div>
</div>
@extends('layouts.layout')

@section('content')

    <div class="px-3 py-3 pt-md-0 mt-md-0 pb-md-5 text-center container-fluid">
      <h1 class="display-4 mt-0 pt-0">{{ $front_control->object_unit->name }}</h1>
      <p class="lead">
        {{ $front_control->object_unit->description }}
      </p>
      <div class="btn-group btn-group-sm row" role="group" aria-label="Canvas menu">
        <div class="input-group-prepend mx-auto col-md-auto col-12 text-center">
          <div class="input-group-text w-100" id="btnGroupAddon">{{ $front_control->type_of_canvas->name }}</div>
        </div>
        <div class="input-group-prepend mx-auto col-md-auto col-12">
          <a class="btn btn-light px-3 border w-100" href="{{ route($front_control->workspace_bar['canvases.edit']->route, $front_control->object_unit->id) }}">
            {{ $front_control->workspace_bar['canvases.edit']->name }}
            <img class="ml-3" src="{{ asset('assets/img/'.$front_control->workspace_bar['canvases.edit']->icon_name.'.svg') }}" />
          </a>
        </div>
        <div class="input-group-prepend mx-auto col-md-auto col-12">
          @if (isset($front_control->workspace_bar['canvases.destroy']))
          <form class="m-0 p-0 w-100 mx-auto" action="{{ route($front_control->workspace_bar['canvases.destroy']->route, $front_control->object_unit->id) }}" method="POST">
            @csrf
            @method ('DELETE')
            <button type="submit" class="btn btn-outline-danger px-3 w-100 mx-auto">
              {{ $front_control->workspace_bar['canvases.destroy']->name }}
              <!--<img class="ml-3" src="{{ asset('assets/img/'.$front_control->workspace_bar['canvases.destroy']->icon_name.'.svg') }}" />-->
            </button>
          </form>
          </a>
          @else
          <a class="btn btn-light px-3 w-100 border" href="{{ route($front_control->workspace_bar['canvases.delete']->route, $front_control->object_unit->id) }}">
            {{ $front_control->workspace_bar['canvases.delete']->name }}
            <img class="ml-3" src="{{ asset('assets/img/'.$front_control->workspace_bar['canvases.delete']->icon_name.'.svg') }}" />
          </a>
          @endif
        </div>
      </div>
    </div>

    <div class="container-fluid">
      @php ($column_in_deck = 1)
      @php ($card_in_column = 0)

      @foreach ($front_control->canvas_content as $card)
        @if ($card->max_card_column == 1 or $column_in_deck == 1)
      <div class="card-deck mb-3 text-center">
        @endif

        @php (++$card_in_column)

        @if ($card->max_card_row == 1 or $card_in_column == 1)

          @php (++$column_in_deck)
        <div class="card border-white p-0 m-0 bg-transparent">
        @endif
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">{{ $card->name }}</h4>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush text-left px-0 mx-0 mt-0 mb-4">
                @foreach (array_keys($card->card_value) as $card_key)
                <li class="list-group-item d-flex justify-content-between align-items-center px-0 mx-0 py-2">
                  {{ $card->card_value[$card_key] }}
                  @php ($destroy = 'canvases.edit.cardvalues.destroy.'.$card->sequence.'_'.$card_key)
                  @if (isset($front_control->workspace_bar[$destroy]))
                  <form class="m-0 p-0" action="{{ route($front_control->workspace_bar[$destroy]->route, ['canvas_id' => $front_control->object_unit->id, 'card_id' => $card->sequence, 'value_order' => $card_key]) }}" method="POST">
                    @csrf
                    @method ('DELETE')
                    <input type="submit" class="btn btn-outline-danger btn-sm" value="{{ $front_control->workspace_bar[$destroy]->name }}" />
                  </form>
                  </a>
                  @else
                  <a class="badge badge-white text-danger badge-pill" href="{{ route($front_control->workspace_bar['canvases.edit.cardvalues.delete']->route, ['canvas_id' => $front_control->object_unit->id, 'card_id' => $card->sequence, 'value_order' => $card_key]) }}">
                    {{ $front_control->workspace_bar['canvases.edit.cardvalues.delete']->name }}
                  </a>
                  @endif
                </li>
                @endforeach
              </ul>
              <div class="mb-3">
                <div class="input-group">
                  <form class="mx-0 px-0 row" action="{{ route($front_control->workspace_bar['canvases.edit.cardvalues.store']->route, ['canvas_id' => $front_control->object_unit->id, 'card_id' => $card->sequence]) }}" method="POST">
                    @csrf
                    @method ('PUT')

                    <input class="px-0 mx-0 btn-outline-primary col-11" type="text" name="new_card_value" />
                    <div class="input-group-prepend mx-0 px-0 col-1">
                      <input type="submit" class="btn btn-primary" value="{{ $front_control->workspace_bar['canvases.edit.cardvalues.store']->name }}" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @if ($card->max_card_row == 1 or $card_in_column == $card->max_card_row)
        </div>
          @php ($card_in_column = 0)
        @endif
      @if ($column_in_deck > $card->max_card_column)
        @php ($column_in_deck = 1)
      </div>
      @endif
      @endforeach

  <!-- FOOTER -->
  @section('footer')
    @include('layouts.footer')
  @show
  <!-- END FOOTER -->
    </div>
@endsection
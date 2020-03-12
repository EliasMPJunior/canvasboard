          <ul class="nav nav-tabs">
            @foreach ($front_control->workspace_bar as $option)
                <li class="nav-item">
                  <a href="{{ isset($front_control->object_unit)?route($option->route, $front_control->object_unit->id) : route($option->route) }}" class="nav-link @if($option->active) active @endif">
                    <i class="fa fa-{{ $option->icon_name }} fa-lg"></i>
                    {{ $option->name }}
                  </a>
                </li>
            @endforeach
          </ul>
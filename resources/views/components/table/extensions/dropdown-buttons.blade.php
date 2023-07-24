<td>
    <div class="dropdown dropend">
        <button type="button" class="{{ car_status_class($status) }} dropdown-toggle" data-mdb-ripple-color="dark"
            id="carStatus" data-mdb-toggle="dropdown" aria-expanded="false">
            {{ $status }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="carStatus">
            @foreach (car_statuses() as $index => $car_status)
                <li wire:click="changeStatus({{ $index }},{{ $id }})">
                    <a class="dropdown-item text-white
                    {{ $car_status == 'new' ? 'bg-warning' : '' }}
                    {{ $car_status == 'approved' ? 'bg-success' : '' }}
                    {{ $car_status == 'rejected' ? 'bg-danger' : '' }}
                        {{ __("$car_status") == $status ? 'active' : '' }}
                        "
                        status="{{ $car_status }}" href="#">{{ __("$car_status") }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</td>

<td>
    <div class="dropdown dropend">
        <i class="text-primary fas fa-eye dropdown-toggle" type="button" id="dropdownMenuButton1"
            data-mdb-toggle="dropdown" aria-expanded="false">
            <span style="font-family: Arial, Helvetica, sans-serif; ">{{ __('Places') }}</span>
        </i>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            @foreach ($models as $model)
                <li><a class="dropdown-item" href="#">{{ __($model) }}</a></li>
            @endforeach
        </ul>
    </div>
</td>

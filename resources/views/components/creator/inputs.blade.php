@if (in_array($input['type'], ['text', 'email', 'password', 'number']))
    <div class="{{ $classsize }}" wire:ignore>

        @if ($input['lable'])
            <label class="form-label select-label mb-1"><strong>{{ $input['lable'] }}</strong></label>
        @endif

        <div class="input-group">
            <span class="input-group-text">
                <i class="{{ $input['icon'] }}"></i>
            </span>

            <input type="{{ $input['type'] }}" id="{{ $input['id'] }}" wire:model.defer="{{ $input['name'] }}"
                dir="{{ $input['dir'] }}" maxlength="{{ $input['maxlength'] }}" name="{{ $input['name'] }}"
                class="{{ $input['class'] }}" placeholder="{{ $input['placeholder'] }}"
                {{ $input['disabled'] ? 'disabled' : '' }} wire:ignore.self />

            @if ($input['name'] == 'phone')
                <span class="input-group-text">+966</span>
            @endif

            @if (in_array($input['name'], ['commission_vat', 'commission_percentage']))
                <span class="input-group-text">%</span>
            @endif

            @if ($input['name'] == 'space')
                <span class="input-group-text">متر</span>
            @endif

            @if (in_array($input['name'], [
                    'amount_paid',
                    'price_meter',
                    'commission_price',
                    'deserved_amount',
                    'real_estate_price',
                ]))
                <span class="input-group-text">ريال</span>
            @endif

        </div>
        <small class="{{ $input['validation'] }}"></small>
    </div>
@endif

@if ($input['type'] == 'select')
    <div class="{{ $classsize }}" wire:ignore>

        @if ($input['lable'])
            <label class="form-label select-label mb-1"><strong>{{ $input['lable'] }}</strong></label>
        @endif

        <div class="col-md-12 input-group">
            <span class="input-group-text">
                <i class="{{ $input['icon'] }}"></i>
            </span>
            <select id="{{ $input['id'] }}" {{ $input['multiple'] }}
                @if ($input['defer']) wire:model.defer="{{ $input['name'] }}" @else wire:model="{{ $input['name'] }}" @endif
                class="{{ $input['class'] }}" name="{{ $input['name'] }}"
                @if ($input['search']) data-mdb-container="#{{ $creatorid }}" data-mdb-filter="true" @endif
                {{ $input['disabled'] ? 'disabled' : '' }} wire:ignore.self>
                @if (!$input['multiple'])
                    <option selected hidden></option>
                @endif
                @foreach ($input['options'] as $key => $option)
                    <option value="{{ $option }}">{{ $key }}
                    </option>
                @endforeach
            </select>
        </div>
        <small class="{{ $input['validation'] }}"></small>
    </div>
@endif

@if ($input['type'] == 'image')

    <div class="{{ $classsize }}" wire:ignore>

        @if ($input['lable'])
            <label class="form-label select-label mb-1"><strong>{{ $input['lable'] }}</strong></label>
        @endif

        <div class="input-group">
            <span class="input-group-text">
                <i class="{{ $input['icon'] }}"></i>
            </span>
            <input type="file" id="{{ $input['id'] }}" accept={{ $input['accept'] }}
                wire:model="{{ $input['name'] }}" name="{{ $input['name'] }}" class="{{ $input['class'] }}"
                {{ $input['disabled'] ? 'disabled' : '' }} />
        </div>

        <small class="{{ $input['validation'] }}"></small>
    </div>

@endif

@if ($input['type'] == 'group-select')
    <div class="{{ $classsize }}">

        @if ($input['lable'])
            <label class="form-label select-label mb-1"><strong>{{ $input['lable'] }}</strong></label>
        @endif

        <div class="col-md-12 input-group">
            <span class="input-group-text">
                <i class="{{ $input['icon'] }}"></i>
            </span>
            <select id="{{ $input['id'] }}"
                @if ($input['defer']) wire:model.defer="{{ $input['name'] }}" @else wire:model="{{ $input['name'] }}" @endif
                class="{{ $input['class'] }}" name="{{ $input['name'] }}"
                @if ($input['search']) data-mdb-container="#{{ $creatorid }}" data-mdb-filter="true" @endif
                {{ $input['multiple'] }} wire:ignore.self>

                @foreach ($input['options'] as $title => $option)
                    @if (!$input['multiple'])
                        <option selected hidden></option>
                    @endif
                    <optgroup label="{{ __("$title") }}">
                        @foreach ($option as $key => $value)
                            <option value="{{ $value }}">{{ $key }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach

            </select>
        </div>
        <small class="{{ $input['validation'] }}"></small>
    </div>
@endif


@if ($input['type'] == 'textarea')
    <div class="col-md-12">

        @if ($input['lable'])
            <label class="form-label select-label mb-1"><strong>{{ $input['lable'] }}</strong></label>
        @endif

        <div class="col-md-12 input-group">
            {{-- <span class="input-group-text">
                <i class="{{ $input['icon'] }}"></i>
            </span> --}}

            <textarea wire:model.defer="{{ $input['name'] }}" dir="{{ $input['dir'] }}" maxlength="{{ $input['maxlength'] }}"
                name="{{ $input['name'] }}" class="{{ $input['class'] }}" placeholder="{{ $input['placeholder'] }}"
                style="height: 100px;">
            </textarea>

        </div>
        <small class="{{ $input['validation'] }}"></small>
    </div>
@endif

@if ($input['type'] == 'checkbox')
    <div class="col-12">
        <div class="switch">
            <label class="form-check-label"><strong>{{ $input['lable'] }}</strong></label>
            <label>
                <input type="checkbox" id="{{ $input['id'] }}" class="{{ $input['class'] }}"
                    name={{ $input['name'] }}>
                نعم<span class="lever"></span>لا
            </label>
        </div>
    </div>
@endif

@if ($input['type'] == 'date')
    <div class="{{ $classsize }}" wire:ignore>

        @if ($input['lable'])
            <label class="form-label select-label mb-1"><strong>{{ $input['lable'] }}</strong></label>
        @endif

        <div class="col-md-12 input-group">
            <span class="input-group-text">
                <i class="{{ $input['icon'] }}"></i>
            </span>

            <div class="form-outline datepicker {{ $input['id'] . '_dateInput' }}" inputid="{{ $input['id'] }}"
                data-mdb-format="yyyy-mm-dd" wire:ignore.self>
                <input type="text" id="{{ $input['id'] }}" class="{{ $input['class'] }}"
                    name="{{ $input['name'] }}" placeholder="yyyy-mm-dd"
                    @if ($input['defer']) wire:model.defer="{{ $input['name'] }}" @else wire:model="{{ $input['name'] }}" @endif
                    wire:ignore.self>
                <label for="{{ $input['id'] }}" class="form-label">{{ $input['lable'] }}</label>
            </div>

        </div>
        <small class="{{ $input['validation'] }}"></small>
    </div>
@endif

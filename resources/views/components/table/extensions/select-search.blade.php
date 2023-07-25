<div id="customwidth">
    <i class="bg-danger"></i>
    <select class="select" wire:model="{{ $input }}" multiple>
        @foreach ($options as $key => $value)
            <option value="{{ $value }}">{{ $key }}</option>
        @endforeach
    </select>
    <label class="form-label select-label">{{ __("$input") }}</label>
</div>

<td>
    <div class="switch">
        <label>
            {{ __('Active') }}
            <input type="checkbox" wire:click="status({{ $id }})" {{ $status == 'active' ? 'checked' : '' }}
                {{ $status == 1 ? 'checked' : '' }}>
            <span class="lever"></span>
            {{ __('In Active') }}
        </label>
    </div>
</td>

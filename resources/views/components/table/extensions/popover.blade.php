<td wire:ignore>
    <i type="button" class="text-primary fas fa-eye" data-mdb-toggle="popover" data-mdb-placement="top" title="فروع المستخدم الحالي"
        data-mdb-content="
    @foreach ($models as $model) {{ $model['name'] . ', ' }} @endforeach" wire:ignore.self>
    </i>
</td>

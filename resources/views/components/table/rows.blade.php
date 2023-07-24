<tr>

    @foreach ($rows as $row => $type)
        @if ($type == 'property')
            <td>{{ $model["$row"] }}</td>
        @endif

        @if ($type == 'selects')
            <x-table.extensions.table-select :models="$model[$row]"></x-table.extensions.table-select>
        @endif

        @if ($type == 'selects-table')
            <x-table.extensions.select-table :models="$model[$row]"></x-table.extensions.select-table>
        @endif

        @if ($type == 'status')
            <x-table.extensions.status :status="$model[$row]" :id="$model['id']"></x-table.extensions.status>
        @endif

        @if ($type == 'popover')
            <x-table.extensions.popover :models="$model[$row]"></x-table.extensions.popover>
        @endif

        @if ($type == 'dropdown')
            <x-table.extensions.dropdown :models="$model[$row]"></x-table.extensions.dropdown>
        @endif

        @if ($type == 'dropdown-buttons')
            <x-table.extensions.dropdown-buttons :id="$model['id']" :status="$model[$row]">
            </x-table.extensions.dropdown-buttons>
        @endif

        @if ($type == 'image')
            <x-table.extensions.image :image="$model[$row]"></x-table.extensions.image>
        @endif

        @if ($type == 'video')
            <x-table.extensions.video :video="$model[$row]"></x-table.extensions.video>
        @endif

        @if ($type == 'badge')
            <x-table.extensions.badge :property="$model[$row]"></x-table.extensions.badge>
        @endif

        @if ($row == 'actions')
            <x-table.extensions.actions :buttons="$type" :page="$page" :table="$table" :updaterid="$updaterid"
                :id="$model['id']"></x-table.extensions.actions>
        @endif
    @endforeach

</tr>

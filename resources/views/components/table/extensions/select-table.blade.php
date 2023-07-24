<td>
    <select>
        @foreach ($models as $model)
            <option selected>{{ $model }}</option>
        @endforeach
    </select>
</td>

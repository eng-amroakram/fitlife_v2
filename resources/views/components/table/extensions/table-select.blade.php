<td>
    <select class="form-control">
        @foreach ($models as $model)
            <option value="{{ $model->id }}" selected>{{ $model->name }}</option>
        @endforeach
    </select>
</td>

@foreach ($checkboxes as $title => $names)
    @foreach ($names as $name)
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input checkboxInput" type="checkbox" name="{{ $name }}" value=""
                    id="flexCheckDefault" />
                <label class="form-check-label" for="flexCheckDefault">{{ __($name) }}</label>
            </div>
        </div>
    @endforeach
@endforeach

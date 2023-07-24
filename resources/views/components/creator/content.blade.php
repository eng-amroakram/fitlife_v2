<div class="tab-pane fade in {{ $content['status'] }} nav-tabs-custom-creator {{ $content['id'] . '-' . 'creator-tap' }}"
    id="{{ $content['id'] }}" role="tabpanel">

    <div class="modal-body">
        @if ($size == 'modal-lg' || $size == 'modal-xl')
            <div class="row">
                @foreach ($content['inputs'] as $input)
                    <x-creator.inputs :input="$input" :classsize="'col-md-6 mb-3'" :size="$size" :creatorid="$creatorid">
                    </x-creator.inputs>
                @endforeach
            </div>
        @endif

        @if ($size == '')
            @foreach ($content['inputs'] as $input)
                <x-creator.inputs :input="$input" :classsize="'col-md-12 mb-3'" :size="$size" :creatorid="$creatorid">
                </x-creator.inputs>
            @endforeach
        @endif
    </div>

    <div class="modal-footer">

        <button type="button" class="btn color-green" data-mdb-dismiss="modal">
            {{ __('Close') }}
        </button>

        @if ($content['prev'])
            <button type="button" class="btn color-green nextCreator"
                tapcreatorid="{{ $content['prev'] }}">{{ __('Previous') }}</button>
        @endif

        <button type="button" class="btn text-white button-hover-black bg-color-green {{ $creatorbuttong }}">{{ __('Save') }}</button>

        @if ($content['next'])
            <button type="button" class="btn color-green nextCreator"
                tapcreatorid="{{ $content['next'] }}">{{ __('Next') }}</button>
        @endif

    </div>
</div>

<div class="modal top fade" id="{{ $creator_id }}" tabindex="-1" data-mdb-backdrop="static" aria-labelledby="Creator"
    aria-hidden="true" wire:ignore>
    <div class="modal-dialog {{ $size }} cascading-modal" style="margin-top: 4%">

        <div class="modal-content">

            <div class="modal-c-tabs">

                <x-creator.tabs :tabs="$tabs"></x-creator.tabs>

                <div class="tab-content">
                    <x-table.extensions.loading></x-table.extensions.loading>

                    @foreach ($contents as $content)
                        <x-creator.content :content="$content" :size="$size" :creatorbuttong="'submitCreator'" :creatorid="$creator_id">
                        </x-creator.content>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

@push('creator')
    <script>
        $(document).ready(function() {

            //Buttons
            var $submitCreator = $(".submitCreator");

            //Inputs
            var $inputTextCreator = $(".inputTextCreator");
            var $inputSelectCreator = $(".inputSelectCreator");
            var $checkboxInputCreator = $(".checkboxInputCreator");

            //Data
            var $data = [];

            //Functions
            function setInput($name, $value) {
                $data[$name] = $value;
            }

            function getContent() {
                var $object = Object.assign({}, $data);
                return JSON.stringify($object);
            }

            function numbers($name, $value) {

                if ($value) {

                    let string_number = $value.replace(/[^\d.]/g, "");

                    if (string_number.match(/\./g)) {
                        if (string_number.match(/\./g).length > 1) {
                            string_number = string_number.replace(/,/g, "").replace(/\.(?=.*\.)/g,
                                "");
                        }
                    }

                    let number = parseFloat(string_number.replace(/,/g, ""));
                    return number;
                }

                return 0;

            }

            //Events
            $inputTextCreator.on("input", function() {
                let $name = $(this).attr("name");
                let $value = $(this).val();
                setInput($name, $value);
            });

            $inputSelectCreator.on("change", function() {
                let $name = $(this).attr("name");
                let $value = $(this).val();
                setInput($name, $value);
            });

            $checkboxInputCreator.on('change', function() {
                let $value = $(this).val();
                let $name = $(this).attr('name');
                let $checked = $(this).is(':checked');

                if ($checked) {
                    $(this).prop('checked', true);
                    setInput($name, true);
                } else {
                    setInput($name, false);
                    $(this).prop('checked', false);
                }
            });

            $submitCreator.on('click', function() {
                $(".reset-validation").text(" ");

                for (let key in $data) {
                    if ($data.hasOwnProperty(key)) {
                        if (key != "image" && key != "video") {
                            @this.set(key, $data[key]);
                        }
                    }
                }

                console.log("Title");

                Livewire.emit('store', getContent());
            });

            Livewire.on("errorsCreator", function(errors) {
                $(".reset").text("");
                $(".exercise-info-creator").removeClass("tab-error-color");
                $(".exercise-description-creator").removeClass("tab-error-color");
                $(".exercise-media-creator").removeClass("tab-error-color");

                let tab_one = ['muscle_id', 'equipment_id', 'title_ar', 'title_en', 'place', 'type',
                    'level',
                ];
                let tab_two = ['description_ar', 'description_en', 'tips_ar', 'tips_en'];
                let tab_three = ['image', 'video', ];


                for (let key in errors) {

                    if (errors.hasOwnProperty(key)) {
                        $("." + key + "-validation").text(errors[key]);

                        console.log(key);

                        if (tab_one.includes(key)) {
                            $(".exercise-info-creator").addClass("tab-error-color");
                        }

                        if (tab_two.includes(key)) {
                            $(".exercise-description-creator").addClass("tab-error-color");
                        }

                        if (tab_three.includes(key)) {
                            $(".exercise-media-creator").addClass("tab-error-color");
                        }

                    }
                }
            });

            Livewire.on("closeModal", function(check) {
                let $id = "#{{ $creator_id }}";
                $($id).modal('hide');
                $(".reset-validation").val("");
                $data = [];
            });

        });
    </script>
@endpush

<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1" wire:ignore>


    @if ($is_auth)
        <div class="divider d-flex align-items-center my-4">
            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid" width="100" height="100"
                alt="Sample image">
        </div>

        <div>
            <div class="mask" style="background-color: rgba(97, 191, 68, 0.5)" wire:loading>
                <div class="position-absolute w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                    <div class="spinner-border" role="status">
                    </div>
                    <h4>جاري التحميل يرجى الانتظار ...</h4>
                </div>
            </div>
            <!-- Email input -->
            <div class="form-outline">
                <input type="email" id="email" name="email" class="form-control form-control-lg inputText"
                    placeholder="Enter a valid email address" />
                <label class="form-label" for="email">Email address</label>
            </div>
            <small class="text-danger email_validation reset fw-bold"></small>

            <!-- Password input -->
            <div class="form-outline mt-3">
                <input type="password" id="password" name="password" class="form-control form-control-lg inputText"
                    placeholder="Enter password" />
                <label class="form-label" for="password">Password</label>
            </div>
            <small class="text-danger password_validation reset fw-bold"></small>

            <div class="d-flex justify-content-between align-items-center">
                <!-- Checkbox -->
                <div class="form-check mt-3">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                        Remember me
                    </label>
                </div>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
                <button type="button" class="btn btn-success btn-lg login-submit"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            </div>
        </div>
    @endif
    @push('login')
        <script>
            $(document).ready(function() {
                var $inputText = $(".inputText");
                var $loginSubmit = $(".login-submit");
                var $logout = $(".logout");

                var $data = [];

                function setData(key, value) {
                    $data[key] = value;
                }

                function getContent() {
                    var $object = Object.assign({}, $data);
                    return JSON.stringify($object);
                }

                $inputText.on("input", function() {
                    let $value = $(this).val();
                    let $name = $(this).attr('name');
                    setData($name, $value);
                });

                $loginSubmit.on('click', function() {
                    for (let key in $data) {
                        if ($data.hasOwnProperty(key)) {
                            @this.set(key, $data[key]);
                        }
                    }
                    Livewire.emit('submit');
                });

                Livewire.on("errors", function(errors) {
                    $(".reset").text("");

                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            $("." + key + "_validation").text(errors[key]);
                        }
                    }

                    console.log(errors);
                });

                $logout.on('click', function() {
                    Livewire.emit('logout');
                });

            });
        </script>
    @endpush


</div>

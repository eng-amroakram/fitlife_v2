<div wire:ignore>

    <div class="row">

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Email') }}</h1>
            <div class="form-group">
                <div class="form-outline">
                    <input type="email" wire:model='email' placeholder="Email: example@exmaple.com" id="email"
                        class="form-control" />
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Mobile') }}</h1>
            <div class="form-group">
                <div class="form-outline">
                    <input type="tel" wire:model='mobile' placeholder="0599916672" id="mobile"
                        class="form-control" />
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Site Link') }}</h1>
            <div class="form-group">
                <div class="form-outline">
                    <input type="url" wire:model='site_url' placeholder="Site Url" id="site-link"
                        class="form-control" />
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Start Video') }}</h1>
            <div class="form-group">

                <div class="input-group">
                    <input type="file" wire:model='video' class="form-control" id="video" accept="video/mp4" />
                    <span class="input-group-text">
                        <a href="{{ $video_table }}" data-toggle="lightbox" data-gallery="youtubevideos">
                            <img src="{{ asset('assets/images/video.png') }}" class="img-fluid" width="30"
                                height="30" />
                        </a>
                    </span>
                </div>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Privacy Policy (English)') }}</h1>
            <div class="form-group">
                <input id="privacy_policy_en" type="hidden" name="content" value="{{ $privacy_policy_en }}">
                <trix-editor input="privacy_policy_en"></trix-editor>
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Privacy Policy (Arabic)') }}</h1>
            <div class="form-group">
                <input id="privacy_policy_ar" type="hidden" name="content" value="{{ $privacy_policy_ar }}">
                <trix-editor input="privacy_policy_ar"></trix-editor>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Terms Of Service (English)') }}</h1>
            <div class="form-group">
                <input id="terms_service_en" type="hidden" name="content" value="{{ $terms_service_en }}">
                <trix-editor input="terms_service_en"></trix-editor>
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('Terms Of Service (Arabic)') }}</h1>
            <div class="form-group">
                <input id="terms_service_ar" type="hidden" name="content" value="{{ $terms_service_ar }}">
                <trix-editor input="terms_service_ar"></trix-editor>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('About Us (English)') }}</h1>
            <div class="form-group">
                <input id="about_us_en" type="hidden" name="content" value="{{ $about_us_en }}">
                <trix-editor input="about_us_en"></trix-editor>
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="h6 mb-4 mt-4">{{ __('About Us (Arabic)') }}</h1>
            <div class="form-group">
                <input id="about_us_ar" type="hidden" name="content" value="{{ $about_us_ar }}">
                <trix-editor input="about_us_ar"></trix-editor>
            </div>
        </div>
    </div>


    <div class="row mb-5 mt-5">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary w-100" wire:click='submit'>{{ __('Update') }}</button>
        </div>
    </div>



    <script>
        var trixEditor_privacy_policy_en = document.getElementById("privacy_policy_en");
        var trixEditor_privacy_policy_ar = document.getElementById("privacy_policy_ar");
        var trixEditor_terms_service_en = document.getElementById("terms_service_en");
        var trixEditor_terms_service_ar = document.getElementById("terms_service_ar");
        var trixEditor_about_us_en = document.getElementById("about_us_en");
        var trixEditor_about_us_ar = document.getElementById("about_us_ar");

        addEventListener("trix-blur", function(event) {
            @this.set('privacy_policy_en', trixEditor_privacy_policy_en.getAttribute('value'));
            @this.set('privacy_policy_ar', trixEditor_privacy_policy_ar.getAttribute('value'));
            @this.set('terms_service_en', trixEditor_terms_service_en.getAttribute('value'));
            @this.set('terms_service_ar', trixEditor_terms_service_ar.getAttribute('value'));
            @this.set('about_us_en', trixEditor_about_us_en.getAttribute('value'));
            @this.set('about_us_ar', trixEditor_about_us_ar.getAttribute('value'));
        });
    </script>

</div>

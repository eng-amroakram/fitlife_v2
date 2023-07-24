<?php

namespace App\Http\Livewire;

use App\Models\Settings as ModelsSettings;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    protected $listeners = ["refresh" => '$refresh'];

    use LivewireAlert;
    use WithFileUploads;

    public $email = "";
    public $mobile = "";
    public $site_url = "";
    public $video = "";
    public $video_table = "";
    public $privacy_policy_en = "";
    public $privacy_policy_ar = "";
    public $terms_service_en = "";
    public $terms_service_ar = "";
    public $about_us_en = "";
    public $about_us_ar = "";

    public function mount()
    {
        $settings = ModelsSettings::find(1);

        if ($settings) {
            $this->email = $settings->email;
            $this->mobile = $settings->mobile;
            $this->site_url = $settings->site_url;
            $this->video = $settings->video;
            $this->video_table = $settings->video_table;
            $this->privacy_policy_en = $settings->privacy_policy_en;
            $this->privacy_policy_ar = $settings->privacy_policy_ar;
            $this->terms_service_en = $settings->terms_service_en;
            $this->terms_service_ar = $settings->terms_service_ar;
            $this->about_us_en = $settings->about_us_en;
            $this->about_us_ar = $settings->about_us_ar;
        }
    }

    public function render()
    {
        return view('livewire.settings');
    }

    public function submit()
    {
        $data = $this->validate([
            'email' => 'nullable',
            'mobile' => 'nullable',
            'site_url' => 'nullable',
            'video' => 'nullable',
            'privacy_policy_en' => 'nullable',
            'privacy_policy_ar' => 'nullable',
            'terms_service_en' => 'nullable',
            'terms_service_ar' => 'nullable',
            'about_us_en' => 'nullable',
            'about_us_ar' => 'nullable',
        ]);

        $message = ModelsSettings::updateModel($data);

        if ($message) {
            $this->alert("success", '', [
                'toast' => true,
                'position' => app()->getLocale() == 'ar' ? 'top-start' : 'top-end',
                'timer' => 3000,
                'text' => $message,
            ]);
        }
    }
}

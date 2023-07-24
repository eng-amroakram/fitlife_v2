<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'images/settings';

    protected $fillable = [
        'email',
        'mobile',
        'site_url',
        'video',
        'privacy_policy_en',
        'privacy_policy_ar',
        'terms_service_en',
        'terms_service_ar',
        'about_us_en',
        'about_us_ar',
    ];

    public function scopeUpdateModel(Builder $builder, $data)
    {
        $video = $data['video'];

        $model = $builder->find(1);

        if (gettype($video) == "object") {
            $builder->deleteVideo(1);
            $data['video'] = $builder->storeFile($video);
        } else {
            unset($data['video']);
        }

        $result =  $model->update($data);

        $this->deleteLivewireTempImage();

        if ($result) {
            return __("Updated Successfully");
        }

        return false;
    }

    public function getVideoTableAttribute()
    {
        return asset('storage/' . $this->video);
    }

    public function getPrivacyPolicyAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->privacy_policy_ar : $this->privacy_policy_en;
    }

    public function getTermsServiceAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->terms_service_ar : $this->terms_service_en;
    }

    public function getAboutUsAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->about_us_ar : $this->about_us_en;
    }
}

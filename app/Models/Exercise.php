<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'images/exercises';

    protected $fillable = [
        'muscle_ids',
        'equipment_ids',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'tips_ar',
        'tips_en',
        'place',
        'type',
        'level',
        'status',
        'image',
        'video',
    ];

    protected $casts = [
        'place' => 'array',
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'muscle_ids', 'equipment_ids', 'title_ar', 'title_en', 'description_ar', 'description_en', 'tips_ar', 'tips_en', 'place', 'type', 'level', 'status', 'image', 'video', 'created_at', 'updated_at']);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'muscle_id' => null,
            'equipment_id' => null,
            'type' => null,
            'level' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('title_ar', 'like', '%' . $filters['search'] . '%')
                ->orWhere('title_en', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['muscle_id'] != null, function ($query) use ($filters) {
            $query->whereIn('muscle_id', $filters['muscle_id']);
        });

        $builder->when($filters['search'] == '' && $filters['equipment_id'] != null, function ($query) use ($filters) {
            $query->whereIn('equipment_id', $filters['equipment_id']);
        });

        $builder->when($filters['search'] == '' && $filters['type'] != null, function ($query) use ($filters) {
            $query->whereIn('type', $filters['type']);
        });

        $builder->when($filters['search'] == '' && $filters['level'] != null, function ($query) use ($filters) {
            $query->whereIn('level', $filters['level']);
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getPlaceAttribute($value)
    {
        return json_decode($value);
    }

    public function setPlaceAttribute($value)
    {
        $this->attributes['place'] = json_encode($value);
    }

    public function getMuscleIdsAttribute($value)
    {
        return json_decode($value);
    }

    public function getMuscleNamesAttribute($value)
    {
        return getMusclesNames($this->muscle_ids);
    }

    public function setMuscleIdsAttribute($value)
    {
        $this->attributes['muscle_ids'] = json_encode($value);
    }

    public function getEquipmentIdsAttribute($value)
    {
        return json_decode($value);
    }

    public function getEquipmentNamesAttribute()
    {
        return getEquipmentNames($this->equipment_ids);
    }

    public function setEquipmentIdsAttribute($value)
    {
        $this->attributes['equipment_ids'] = json_encode($value);
    }

    public function getLevelNameAttribute()
    {
        return __($this->level);
    }

    public function getTypeNameAttribute()
    {
        return __($this->type);
    }

    public function getVideoTableAttribute()
    {
        return asset('storage/' . $this->video);
    }

    public function getImageTableAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('assets/images/no-image-available.jpg');
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function getTipsAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->tips_ar : $this->tips_en;
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            "muscle_ids" => ["required"],
            "equipment_ids" => ["required"],
            "title_ar" => ["required"],
            "title_en" => ["required"],
            "description_ar" => ["required"],
            "description_en" => ["required"],
            // "tips_ar" => ["required"],
            // "tips_en" => ["required"],
            "place" => ["required"],
            "type" => ["required"],
            "level" => ["required"],
            // "image" => ["required"],
            // "video" => ["required"],
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [
            "muscle_ids.required" =>  __("This field is required"),
            "equipment_ids.required" => __("This field is required"),
            "title_ar.required" =>  __("This field is required"),
            "title_en.required" =>  __("This field is required"),
            "description_ar.required" =>  __("This field is required"),
            "description_en.required" =>  __("This field is required"),
            // "tips_ar.required" =>  __("This field is required"),
            // "tips_en.required" =>  __("This field is required"),
            "place.required" =>  __("This field is required"),
            "type.required" =>  __("This field is required"),
            "level.required" =>  __("This field is required"),
            // "image.required" =>  __("This field is required"),
            // "video.required" =>  __("This field is required"),
        ];
    }

    public function scopeStore(Builder $builder, $data)
    {
        $data['status'] = 'active';
        $data['image'] = $builder->storeFile($data['image']);
        $data['video'] = $builder->storeFile($data['video']);

        $model = $builder->create($data);

        if ($model) {
            return __("Added Successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $image = $data['image'];
        $video = $data['video'];

        unset($data['status']);
        $model = $builder->find($id);

        if (gettype($image) == "object") {
            $builder->deleteImage($id);
            $data['image'] = $builder->storeFile($image);
        } else {
            unset($data['image']);
        }

        if (gettype($video) == "object") {
            $builder->deleteVideo($id);
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
}

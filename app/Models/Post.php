<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'images/posts';

    protected $fillable = [
        'tag_id',
        'image',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'type',
        'status',
        'featured',
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'tag_id', 'image', 'title_ar', 'title_en', 'description_ar', 'description_en', 'type', 'status', 'featured', 'created_at', 'updated_at']);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
            'type' => null,
            'featured' => null,
            'tag_id' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('title_ar', 'like', '%' . $filters['search'] . '%')
                ->orWhere('title_en', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });

        $builder->when($filters['search'] == '' && $filters['type'] != null, function ($query) use ($filters) {
            $query->whereIn('type', $filters['type']);
        });

        $builder->when($filters['search'] == '' && $filters['featured'] != null, function ($query) use ($filters) {
            $query->whereIn('featured', $filters['featured']);
        });

        $builder->when($filters['search'] == '' && $filters['tag_id'] != null, function ($query) use ($filters) {
            $query->whereIn('tag_id', $filters['tag_id']);
        });
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function getTagNameAttribute()
    {
        return $this->tag ? $this->tag->title : "";
    }

    public function getTypeNameAttribute()
    {
        return __($this->type);
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

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            // "tag_id" => ["required"],
            "title_ar" => ["required"],
            "title_en" => ["required"],
            "description_ar" => ["required"],
            "description_en" => ["required"],
            "type" => ["required"],
            // "status" => ["required"],
            "featured" => ["required"],
            // "image" => ["required", "image", "mimes:jpeg,png,jpg,gif,svg", "max:2048"],
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [
            // "tag_id.required" => __("validation.required"),
            "title_ar.required" => __("This field is required"),
            "title_en.required" => __("This field is required"),
            "description_ar.required" => __("This field is required"),
            "description_en.required" => __("This field is required"),
            "type.required" => __("This field is required"),
            // "status.required" => __("This field is required"),
            "featured.required" => __("This field is required"),
            // "image.required" => __("This field is required"),
            // "image.image" => __("validation.image"),
            // "image.mimes" => __("validation.mimes"),
            // "image.max" => __("validation.max.file", ["max" => 2]),
        ];
    }

    public function scopeStore(Builder $builder, $data)
    {
        $data['status'] = 'active';
        $data['image'] = $builder->storeFile($data['image']);
        $this->deleteLivewireTempImage();

        $model = $builder->create($data);

        if ($model) {
            return __("Added Successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $image = $data['image'];
        $model = $builder->find($id);

        if (gettype($image) == "object") {
            $builder->deleteImage($id);
            $data['image'] = $builder->storeFile($image);
            $this->deleteLivewireTempImage();
        } else {
            unset($data['image']);
            unset($data['status']);
        }

        $result =  $model->update($data);

        if ($result) {
            return __("Updated Successfully");
        }

        return false;
    }
}

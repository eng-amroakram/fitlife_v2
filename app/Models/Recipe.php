<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'images/recipes';

    protected $fillable = [
        "user_id",
        "food_exchange_ids",
        "image",
        "title_ar",
        "title_en",
        "description_ar",
        "description_ar",
        "other_info_ar",
        "other_info_en",
        "status"
    ];

    public function scopeData($query)
    {
        return $query->select(["id", "user_id", "food_exchange_ids", "image", "title_ar", "title_en", "description_ar", "description_ar", "other_info_ar", "other_info_en", "status", "created_at", "updated_at",]);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            "search" => "",
            "user_id" => null,
            "status" => null,
        ], $filters);

        $builder->when($filters["search"] != "", function ($query) use ($filters) {
            $query->where("title_ar", "like", "%" . $filters["search"] . "%")
                ->orWhere("title_en", "like", "%" . $filters["search"] . "%");
        });

        $builder->when($filters["search"] == "" && $filters["user_id"] != null, function ($query) use ($filters) {
            $query->whereIn("user_id", $filters["user_id"]);
        });

        $builder->when($filters["search"] == "" && $filters["status"] != null, function ($query) use ($filters) {
            $query->whereIn("status", $filters["status"]);
        });
    }

    public function getImageTableAttribute()
    {
        return $this->image ? asset("storage/" . $this->image) : asset("assets/images/no-image-available.jpg");
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == "ar" ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == "ar" ? $this->description_ar : $this->description_en;
    }

    public function getOtherInfoAttribute()
    {
        return app()->getLocale() == "ar" ? $this->other_info_ar : $this->other_info_en;
    }

    public function getFoodExchangeIdsAttribute($value)
    {
        return json_decode($value);
    }

    public function setFoodExchangeIdsAttribute($value)
    {
        $this->attributes['food_exchange_ids'] = json_encode($value);
    }

    public function getFoodExchangeNamesAttribute()
    {
        return getFoodExchangeNames($this->food_exchange_ids ?? []);
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            "food_exchange_ids" => ["required"],
            "title_ar" => ["required"],
            "title_en" => ["required"],
            "description_ar" => ["required"],
            "description_en" => ["required"],
            "other_info_ar" => ["required"],
            "other_info_en" => ["required"],
        ];
    }

    public function scopeGetMessages(Builder $builder, $id = "")
    {
        return [
            "food_exchange_ids.required" => __("This field is required"),
            "title_ar.required" => __("This field is required"),
            "title_en.required" => __("This field is required"),
            "description_ar.required" => __("This field is required"),
            "description_en.required" => __("This field is required"),
            "other_info_ar.required" => __("This field is required"),
            "other_info_en.required" => __("This field is required"),
        ];
    }

    public function scopeStore(Builder $builder, $data)
    {
        $data['user_id'] = auth()->id();
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

        $result = $model->update($data);

        if ($result) {
            return __("Updated Successfully");
        }

        return false;
    }
}

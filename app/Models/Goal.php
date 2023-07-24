<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $file_path = 'images/goals';

    protected $fillable = [
        "title_ar",
        "title_en",
        "type",
        "status",
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'title_ar', 'title_en', 'type', 'status', 'created_at', 'updated_at']);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'type' => null,
            'status' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('title_ar', 'like', '%' . $filters['search'] . '%')
                ->orWhere('title_en', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['type'] != null, function ($query) use ($filters) {
            $query->whereIn('type', $filters['type']);
        });

        $builder->when($filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getTypeNameAttribute()
    {
        return __($this->type);
    }

    public function mealPlans()
    {
        return $this->hasMany(MealPlan::class);
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            "title_ar" => ["required"],
            "title_en" => ["required"],
            "type" => ["required", "in:gain,loss,maintain"],
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [
            "title_ar.required" => __("This field is required"),
            "title_en.required" =>  __("This field is required"),
            "type.required" =>  __("This field is required"),
        ];
    }


    public function scopeStore(Builder $builder, $data)
    {
        $data['status'] = 'active';

        $model = $builder->create($data);

        if ($model) {
            return __("Added Successfully");
        }

        return false;
    }

    public function scopeUpdateModel(Builder $builder, $data, $id)
    {
        $model = $builder->find($id);

        $result =  $model->update($data);

        if ($result) {
            return __("Updated Successfully");
        }

        return false;
    }
}

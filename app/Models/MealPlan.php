<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        'user_id',
        'goal_id',
        'meals',
        'title_ar',
        'title_en',
        'status',
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'user_id', 'goal_id', 'meals', 'title_ar', 'title_en', 'status', 'created_at', 'updated_at']);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('title_ar', 'like', '%' . $filters['search'] . '%')
                ->orWhere('title_en', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }
    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMealsAttribute($value)
    {
        return json_decode($value);
    }

    public function setMealsAttribute($value)
    {
        $this->attributes['meals'] = json_encode($value);
    }

    public function getMealsNamesAttribute()
    {
        return mealsNames($this->meals);
    }

    public function getGoalNameAttribute()
    {
        return $this->goal ? $this->goal->title : "None";
    }

    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : "None";
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'title_ar' => 'required',
            'title_en' => 'required',
            'goal_id' => 'required|exists:goals,id',
            'meals' => 'required'
            // 'user_id' => 'required|exists:users,id',
            // 'status' => 'required|in:active,inactive',
            // 'meals' => 'required|array',
            // 'meals.*.meal_type_id' => 'required|exists:meal_types,id',
            // 'meals.*.title_ar' => 'required|string|max:255',
            // 'meals.*.title_en' => 'required|string|max:255',
            // 'meals.*.status' => 'required|in:active,inactive',
        ];
    }


    public function scopeGetMessages(Builder $builder)
    {
        return [
            'title_ar.required' => __("This field is required"),
            'title_en.required' => __("This field is required"),
            'goal_id.required' => __("This field is required"),
            'meals.required' => __("This field is required"),
        ];
    }

    public function scopeStore(Builder $builder, $data)
    {
        $data['user_id'] = auth()->id();
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

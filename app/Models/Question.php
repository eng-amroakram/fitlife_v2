<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        'question_ar',
        'question_en',
        'status',
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'question_ar', 'question_en', 'status', 'created_at', 'updated_at']);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('question_ar', 'like', '%' . $filters['search'] . '%')
                ->orWhere('question_en', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function getQuestionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->question_ar : $this->question_en;
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            "question_ar" => ["required"],
            "question_en" => ["required"],
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [
            "question_ar.required" => __("This field is required"),
            "question_en.required" => __("This field is required"),
        ];
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
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

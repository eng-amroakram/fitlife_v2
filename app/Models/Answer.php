<?php

namespace App\Models;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    use ModelHelper;

    protected $fillable = [
        'question_id',
        'answer_ar',
        'answer_en',
        'status',
    ];

    public function scopeData($query)
    {
        return $query->select(['id', 'question_id', 'answer_ar', 'answer_en', 'status', 'created_at', 'updated_at']);
    }

    public function scopeFilters(Builder $builder, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'status' => null,
        ], $filters);

        $builder->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('answer_ar', 'like', '%' . $filters['search'] . '%')
                ->orWhere('answer_en', 'like', '%' . $filters['search'] . '%');
        });

        $builder->when($filters['search'] == '' && $filters['status'] != null, function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            "question_id" => ["required"],
            "answer_ar" => ["required"],
            "answer_en" => ["required"],
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [
            "question_id.required" => __("This field is required"),
            "answer_ar.required" => __("This field is required"),
            "answer_en.required" => __("This field is required"),
        ];
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function getAnswerAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->answer_ar : $this->answer_en;
    }

    public function getQuestionNameAttribute()
    {
        return $this->question->question;
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

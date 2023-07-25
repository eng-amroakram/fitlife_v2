<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\ModelHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, ModelHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'phone',
        'type',
        'gender',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeData($query)
    {
        return $query->select([
            'id',
            'name',
            'image',
            'email',
            'phone',
            'type',
            'status',
            'gender',
            'created_at',
            'updated_at',
        ]);
    }

    public function scopeFilters($query, array $filters = [])
    {
        $filters = array_merge([
            'search' => '',
            'type' => '',
            'status' => '',
        ], $filters);

        $query->when($filters['search'] != '', function ($query) use ($filters) {
            $query->where('name', 'like', '%' . $filters['search'] . '%')
                ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                ->orWhere('phone', 'like', '%' . $filters['search'] . '%');
        });

        $query->when($filters['type'] != '', function ($query) use ($filters) {
            $query->whereIn('type', $filters['type']);
        });

        $query->when($filters['status'] != '', function ($query) use ($filters) {
            $query->whereIn('status', $filters['status']);
        });
    }

    public function getImageTableAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('assets/images/no-image-available.jpg');
    }

    public function getPasswordAttribute($value)
    {
        return decrypt($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = encrypt($value);
    }

    public function scopeGetRules(Builder $builder, $id = "")
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:255|unique:users,phone,' . $id,
            'type' => 'required|in:admin,coach,client',
            'gender' => 'required',
            'password' => 'required|string',
        ];
    }

    public function scopeGetMessages(Builder $builder)
    {
        return [
            'name.required' => __('This field is required'),
            'gender.required' => __('This field is required'),
            'name.string' => __('Name must be string'),
            'name.max' => __('Name must be less than 255 characters'),
            'email.required' => __('This field is required'),
            'email.string' => __('Email must be string'),
            'email.email' => __('Email must be valid email'),
            'email.max' => __('Email must be less than 255 characters'),
            'email.unique' => __('Email must be unique'),
            'phone.required' => __('This field is required'),
            'phone.string' => __('Phone must be string'),
            'phone.max' => __('Phone must be less than 255 characters'),
            'phone.unique' => __('Phone must be unique'),
            'type.required' => __('This field is required'),
            'type.in' => __('Type must be one of the following: :values', ['values' => 'admin,coach,client']),
            'password.required' => __('This field is required'),
            'password.string' => __('Password must be string'),
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

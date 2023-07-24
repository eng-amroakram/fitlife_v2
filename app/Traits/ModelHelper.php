<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

trait ModelHelper
{
    public function scopeDeleteModel(Builder $builder, $id)
    {
        $model = $builder->find($id);
        $builder->deleteImage($id);
        $builder->deleteVideo($id);
        if ($model) {
            $model->delete();
            return __("Delete Successfully");
        }

        return false;
    }

    public function scopeStatus(Builder $builder, $id)
    {
        $model = $builder->find($id);
        if ($model) {
            $model->update([
                'status' => $model->status == 'active' ? 'inactive' : 'active'
            ]);
            return __("Update Status Successfully");
        }

        return false;
    }

    public function deleteLivewireTempImage()
    {
        if (Storage::disk('local')->exists('livewire-tmp')) {
            Storage::disk('local')->deleteDirectory('livewire-tmp');
        }
        return "";
    }

    public function scopeDeleteImage(Builder $builder, $id)
    {
        $model = $builder->find($id);
        if ($model->image) {
            if (Storage::disk('public')->exists($model->image)) {
                Storage::disk('public')->delete($model->image);
            }
        }
        return "";
    }

    public function scopeDeleteVideo(Builder $builder, $id)
    {
        $model = $builder->find($id);
        if ($model->video) {
            if (Storage::disk('public')->exists($model->video)) {
                Storage::disk('public')->delete($model->video);
            }
        }

        return "";
    }

    public function scopeStoreFile(Builder $builder, $file)
    {
        if ($file) {
            $file_path = $file->store($this->file_path, 'public');
            return $file_path;
        }

        return "";
    }
}

<?php

namespace App\Traits;

use App\Http\Controllers\Services\Services;
use Illuminate\Support\Facades\Validator;

trait UpdaterHelper
{
    private function setService($service)
    {
        return Services::createServiceInstance($service) ?? new Services();
    }

    public function setFields($fillable)
    {
        foreach ($fillable as $field) {
            $this->{$field} = null;
        }
    }

    public function getFieldsValues($fillable)
    {
        $data = [];
        foreach ($fillable as $field) {
            $data[$field] = $this->{$field};
        }
        return $data;
    }

    public function alertMessage($message)
    {

        $type = $message ? 'success' : 'error';

        $this->alert($type, '', [
            'toast' => true,
            'position' => app()->getLocale() == 'ar' ? 'top-start' : 'top-end',
            'timer' => 3000,
            'text' => $message,
        ]);
    }

    public function makeValidation($service, $data, $emit, $id = "")
    {
        $this->rules = $service->rules($id);
        $this->messages = $service->messages();

        $validator = Validator::make($data, $this->rules, $this->messages);
        $errors = array_map(fn ($value) => $value[0], $validator->errors()->toArray());

        if (count($errors)) {
            $this->emit($emit, $errors);
            return false;
        }

        return true;
    }

    public function getContent($service, $type = "Updater")
    {
        $this->title = $type == "Updater" ? $service->title_creator : $service->title_updater;
        $this->updater_id = $service->updater_id;
        $this->creator_id = $service->creator_id;
        $this->size = $service->modal_size;
        $this->tabs = $service->tabs("Updater");
        $this->contents = $service->contents($type);
    }

    public function getZeroPoint()
    {
        $this->setFields($this->fillable);
        $this->emit('updateTable');
        $this->emit('closeModal');
        $this->emit('refresh');
    }
}

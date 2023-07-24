<?php


namespace App\Traits;

use App\Http\Controllers\Services\Services;

trait TableHelper
{
    private function setService()
    {
        $this->service = Services::createServiceInstance($this->table) ?? new Services();
        return $this->service;
    }

    public function setSelectsSearch($service, $is_init = true)
    {
        $selects = $service->selects();

        if ($is_init) {
            foreach ($selects as $name => $options) {
                $this->{$name} = null;
            }

            return true;
        }

        $selects = $service->selects();
        foreach ($selects as $name => $options) {
            $this->filters["$name"] = $this->{$name};
        }
    }

    public function getServiceData($service)
    {
        $this->filters['search'] = trim($this->search);
        return $service->data($this->filters, $this->sort_field, $this->sort_direction, $this->rows_number);
    }

    public function getContent($service)
    {
        $this->setSelectsSearch($service, false);
        $data = $this->getServiceData($service);
        $this->columns = $service->columns();
        $this->selects = $service->selects();
        $this->create = $service->create();
        $this->rows = $service->rows();
        $this->table_name = $service->name;
        $this->updater_id = $service->updater_id;
        return $data;
    }

    public function alertMessage($message, $type)
    {
        $this->alert($type, '', [
            'toast' => true,
            'position' => app()->getLocale() == 'ar' ?  'top-start' : 'top-end',
            'timer' => 3000,
            'text' => $message,
            'timerProgressBar' => true,
        ]);
    }
}

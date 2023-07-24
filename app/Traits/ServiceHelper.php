<?php

namespace App\Traits;

trait ServiceHelper
{
    public function rules($id = "")
    {
        return $this->model->getRules($id);
    }

    public function messages()
    {
        return $this->model->getMessages();
    }

    public function delete($id)
    {
        return $this->model->deleteModel($id);
    }

    public function status($id)
    {
        return $this->model->status($id);
    }

    public function store($data)
    {
        return $this->model->store($data);
    }

    public function update($data, $id)
    {
        return $this->model->updateModel($data, $id);
    }

    public function show($id)
    {
        return redirect()->route('panel.equipment.profile', $id);
    }
}

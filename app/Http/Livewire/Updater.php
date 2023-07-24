<?php

namespace App\Http\Livewire;

use App\Traits\UpdaterHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Updater extends Component
{
    use LivewireAlert;
    use UpdaterHelper;
    use WithFileUploads;

    protected $listeners = [
        'updater' => 'updater',
        'update' => 'update',
        "refresh" => '$refresh',
    ];

    public $service = '';

    public $fillable = [];
    public $contents = [];
    public $tabs = [];
    public $rules = [];
    public $messages = [];

    public $title = '';
    public $updater_id;
    public $size = '';

    public $model_id = '';

    public $data = [];

    public function mount($service)
    {
        $this->service = $service;
        $service = $this->setService($this->service);
        $this->fillable = $service->fillable();
        $this->setFields($this->fillable);
    }

    public function render()
    {
        $service = $this->setService($this->service);
        $this->getContent($service, "Updater");

        return view('livewire.updater');
    }

    public function updater($service, $id)
    {
        $this->service = $service;
        $this->model_id = $id;
        $service = $this->setService($this->service);
        $model =   $service->model($id);

        foreach ($this->fillable as $field) {
            $this->{$field} = $model->{$field};
        }

        foreach ($this->contents as $content) {
            foreach ($content['inputs'] as $input) {
                if ($input['type'] == 'select') {
                    $value = $model->{$input['name']};
                    $this->emit('select2', "#" . $input['id'], $value);
                }
            }
        }

        $this->data = $this->getFieldsValues($this->fillable);
        $data = json_encode($this->data);
        $this->emit('setDataFields', $data);
    }

    public function update($data)
    {
        $service = $this->setService($this->service);
        $data = $this->getFieldsValues($this->fillable);

        if (!$this->makeValidation($service, $data, 'updateError', $this->model_id)) {
            return false;
        }

        $result = $service->update($data, $this->model_id);

        $this->alertMessage($result);

        $this->getZeroPoint();
    }
}

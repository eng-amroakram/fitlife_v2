<?php

namespace App\Http\Livewire;

use App\Traits\CreatorHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Creator extends Component
{
    use LivewireAlert;
    use CreatorHelper;
    use WithFileUploads;

    protected $listeners = ["store" => "store", "refresh" => '$refresh',];
    public $service = '';
    public $fillable = [];
    public $contents = [];
    public $tabs = [];
    public $rules = [];
    public $messages = [];

    public $title = '';

    public $creator_id;
    public $size = '';

    public $name = '';

    public $imageFile = "";

    public function mount($service = "")
    {
        $this->service = $service;
        $service = $this->setService($service);
        $this->fillable = $service->fillable();
        $this->setFields($this->fillable);
    }

    public function render()
    {
        $service = $this->setService($this->service);
        $this->getContent($service, "Creator");
        return view('livewire.creator');
    }

    public function store($data)
    {
        $service = $this->setService($this->service);
        $data = $this->getFieldsValues($this->fillable);

        if (!$this->makeValidation($service, $data, 'errorsCreator')) {
            return false;
        }

        $result = $service->store($data);

        $this->alertMessage($result);

        $this->getZeroPoint();
    }
}

<?php

namespace App\Http\Livewire;

use App\Traits\TableHelper;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use TableHelper;
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['submit', 'updateTable' => '$refresh'];
    public $table = '';
    private $service = null;
    public $columns = [];
    public $rows = [];
    public $selects = [];
    public $table_name = '';

    public $search = '';
    public $rows_number = 5;
    public $sort_field = 'id';
    public $sort_direction = 'desc';
    public $style_sort_direction = 'sorting_desc';
    public $paginate_ids = [];

    public $create;
    public $updater_id;
    public $edit;

    public $filters = [];


    public function mount($service)
    {
        $this->table = $service;
        $obj_service = $this->setService();
        $this->setSelectsSearch($obj_service, true);
    }

    public function sortDirection()
    {
        $this->sort_direction = $this->sort_direction == 'asc' ? 'desc' : 'asc';
        $this->style_sort_direction = $this->sort_direction == 'asc' ? 'sorting_asc' : 'sorting_desc';
    }

    public function edit($id)
    {
        $this->emit("updater", $this->table, $id);
    }

    public function show($id)
    {
        return $this->setService()->show($id);
    }

    public function render()
    {
        $service = $this->setService();
        $data = $this->getContent($service);
        $this->resetPage();
        return view('livewire.table', [
            'data' => $data
        ]);
    }

    public function delete($id)
    {
        $service = $this->setService();
        $result = $service->delete($id);
        if ($result) {
            $this->alertMessage($result, 'success');
            return true;
        }
        $this->alertMessage("حدث خطأ في عملية الحذف، يرجى المحاولة مرة اخرى", 'error');
        return false;
    }

    public function status($id)
    {
        $service = $this->setService();
        $result = $service->status($id);
        if ($result) {
            $this->alertMessage($result, 'success');
            return true;
        }
        $this->alertMessage("حدث خطأ في عملية الحذف، يرجى المحاولة مرة اخرى", 'error');
        return false;
    }
}

<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class DynamicForm extends Component
{
    public $structure;
    public $data;
    public $method;
    public $action;

    public function mount($structure, $data,$method='post',$action='')
    {
        $this->structure = $structure;
        $this->data = $data;
        $this->method=$method;
        $this->action=$action;
    }

    public function render()
    {
        return view('livewire.dynamic-form');
    }

    #[On('update-field')]
    public function syncFormData($id, $value)
    {
        $this->syncData($id, $value);
    }

    public function syncData($id, $value)
    {
        if (!isset($this->data)) {
            $this->data = [];
        }

        $parts = explode('.', $id);//x,0,y
        $cloneData = $this->data;
        $currentData = &$cloneData;

        foreach ($parts as $part) {
            if (!isset($currentData[$part])) {
                $currentData[$part] = [];
            }
            $currentData = &$currentData[$part];
        }

        $currentData = $value;
        $this->data = $cloneData;
    }
}

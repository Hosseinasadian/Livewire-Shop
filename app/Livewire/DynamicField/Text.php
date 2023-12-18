<?php

namespace App\Livewire\DynamicField;

use Livewire\Component;

class Text extends Component
{
    public $id;
    public $value;
    public $errors;
    public $label;

    public function mount($id, $value, $errors,$label='')
    {
        $this->id = $id;
        $this->value = $value;
        $this->errors = $errors;
        $this->label=$label;
    }

    public function render()
    {
        return view('livewire.dynamic-field.text');
    }

    public function updatedValue()
    {
        $this->dispatch('update-field', id: $this->id, value: $this->value);
    }
}

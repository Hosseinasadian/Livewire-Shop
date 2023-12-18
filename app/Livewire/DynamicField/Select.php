<?php

namespace App\Livewire\DynamicField;

use Livewire\Component;

class Select extends Component
{
    public $id;
    public $value;
    public $options;
    public $errors;
    public $label;

    public function mount($id, $value, $errors, $options,$label='')
    {
        $this->id = $id;
        $this->value = $value;
        $this->errors = $errors;
        $this->options = $options;
        $this->label=$label;
    }

    public function render()
    {
        return view('livewire.dynamic-field.select');
    }

    public function updatedValue()
    {
        $this->dispatch('update-field', id: $this->id, value: $this->value);
    }
}

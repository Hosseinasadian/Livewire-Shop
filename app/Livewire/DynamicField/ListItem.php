<?php

namespace App\Livewire\DynamicField;

use Livewire\Attributes\On;
use Livewire\Component;

class ListItem extends Component
{
    public $id;
    public $value;
    public array $items;
    public $errors;
    public $label;

    public function mount($id, $value, $errors, array $items = [], $label = '')
    {
        $this->id = $id;
        $this->value = $value;
        $this->errors = $errors;
        $this->items = $items;
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.dynamic-field.list-item');
    }

    #[On('update-field')]
    public function syncFormData($id, $value)
    {
        $str2 = $this->id . '.';
        $string_position = strrpos($id, $str2);
        if ($string_position !== false) {
            $remain_id = substr($id, $string_position + strlen($str2));
            $position = explode('.', $remain_id, 2);
            $this->value[$position[0]][$position[1]] = $value;
            $this->dispatch('update-field', id: $this->id, value: $this->value);
        }
    }

    public function addItem()
    {
        $this->value[] = [];
        $this->dispatch('update-field', id: $this->id, value: $this->value);
    }
}

<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class SelectPropertyOption extends Component
{
    public $id;
    public $parent;
    public $index;
    public $optionsHasImage;
    public $optionsHasDescription;
    public $name;
    public $description;
    public $image;
    public $server_errors;

    public function mount($parent,$info, $index, $item,$server_errors)
    {
        $this->index = $index;
        $this->server_errors = $server_errors;
        $this->parent = $parent;
        $this->id = $index;
        $this->optionsHasImage = $info['optionsHasImage'] ?? 0;
        $this->optionsHasDescription = $info['optionsHasDescription'] ?? 0;
        $this->name = $item['name'] ?? '';
        $this->description = $item['description'] ?? '';
        $this->image = $item['image'] ?? '';
    }

    public function render()
    {
        return view('livewire.select-property-option');
    }

    public function toArray()
    {
        $data = [
            'name' => $this->name,
            'id'=>$this->id,
        ];
        if ($this->optionsHasImage){
            $data['image'] = $this->image;
        }
        if ($this->optionsHasDescription){
            $data['description'] = $this->description;
        }
        return $data;
    }

    public function updated($property)
    {
        if (in_array($property, ['name', 'description', 'image'])) {
            $this->dispatch('update-property-option',parent:$this->parent, value: $this->toArray())->to('property-item');
        }
    }

    public function removePropertyOption()
    {
        $this->dispatch('remove-property-option', index: $this->index);
    }

    #[On('property-has-image-updated')]
    public function updatePropertyHasImage($value)
    {
        $this->optionsHasImage = $value;
        $this->dispatch('update-property-option',parent:$this->parent, value: $this->toArray());
    }

    #[On('property-has-description-updated')]
    public function updatePropertyHasDescription($value)
    {
        $this->optionsHasDescription = $value;
        $this->dispatch('update-property-option',parent:$this->parent, value: $this->toArray());
    }

    public function dumpDetail()
    {
        dump("index: " . $this->index);
        dump("name: " . $this->name);
    }
}

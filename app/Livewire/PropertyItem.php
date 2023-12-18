<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class PropertyItem extends Component
{
    public $parent;
    public $id;
    public $index;
    public $name;
    public $slug;
    public $type;
    public $activeItemId;
    public $server_errors;

    // start select type
    public $optionsHasImage;
    public $optionsHasDescription;
    public $items = [];
    // end select type

    // start relational type
    public $model;
    // end relational type


    public function mount($index, $parent, $info, $server_errors)
    {
        $this->id = $info['id'] ?? rand(100000, 1000000);
        $this->parent = $parent;
        $this->index = $index;
        $this->server_errors = $server_errors;
        $this->name = $info['name'] ?? '';
        $this->slug = $info['slug'] ?? '';
        $this->type = $info['type'] ?? 'text';
        isset($info['optionsHasImage']) && $this->optionsHasImage = $info['optionsHasImage'];
        isset($info['optionsHasDescription']) && $this->optionsHasDescription = $info['optionsHasDescription'];
        isset($info['items']) && $this->items = $info['items'];
    }

    public function render()
    {
        return view('livewire.property-item');
    }

    public function toArray()
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
        ];
        if ($this->type == 'select') {
            $data = array_merge($data, [
                'optionsHasImage' => $this->optionsHasImage,
                'optionsHasDescription' => $this->optionsHasDescription,
                'items' => $this->items,
            ]);
        }
        if ($this->type == 'relational') {
            $data = array_merge($data, [
                'model' => $this->model,
            ]);
        }
        return $data;
    }

    public function addOptionToProperty()
    {
        $newItem = [
            'name' => '',
            'description' => null,
            'image' => null,
            'id' => rand(100000, 1000000)
        ];

        if ($this->optionsHasDescription) {
            $newItem['description'] = ''; // Get the description from the form input
        }

        if ($this->optionsHasImage) {
            $newItem['image'] = ''; // Get the image URL from the form input
        }

        $this->items[] = $newItem;
        $this->dispatch('property-updated', property: $this->toArray());
    }

    public function updateActiveItemId($id)
    {
        if ($this->activeItemId == $id) {
            $this->activeItemId = null;
        } else {
            $this->activeItemId = $id;
        }
    }


    public function updated($property)
    {
        if ($property == 'optionsHasImage') {
            $this->dispatch('property-has-image-updated', value: $this->optionsHasImage);
        } elseif ($property == 'optionsHasDescription') {
            $this->dispatch('property-has-description-updated', value: $this->optionsHasDescription);
        }

        if (in_array($property, ['name', 'slug', 'type', 'optionsHasImage', 'optionsHasDescription', 'model'])) {
            $this->dispatch('property-updated', property: $this->toArray());
        }
    }

    public function removeOption($index)
    {
        $this->items = array_values(array_filter($this->items, function ($value) use ($index) {
            return $value['id'] != $index;
        }));
        $this->dispatch('property-updated', property: $this->toArray());
    }

    #[On('update-property-option')]
    public function updatePropertyOption($parent, $value)
    {
        if ($this->id == $parent) {
            $items = $this->items;
            $index = array_key_first(array_filter($items, function ($item) use ($value) {
                return $item['id'] == $value['id'];
            }));
            $items[$index] = $value;
            $this->items = $items;
            $this->dispatch('property-updated', property: $this->toArray());
        }
    }

    public function removeProperty()
    {
        $this->dispatch('remove-property', id: $this->id)->to('template-properties');
    }
}

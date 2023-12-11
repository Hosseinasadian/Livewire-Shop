<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;


class TemplateProperties extends Component
{
    public $id;
    public $properties;
    public $templateId;
    public $server_errors;

    public function mount($id, $properties, $templateId,$server_errors)
    {
        $this->id = $id;
        $this->server_errors = $this->clusterErrorMessages($server_errors);
        $this->templateId = $templateId;
        array_walk($properties, function (&$value, $key) {
            $value['id'] = rand(100000, 1000000);
            if ($value['type'] == 'select') {
                $items = $value['items'] ?? [];
                array_walk($items, function (&$v, $k) {
                    $v['id'] = rand(100000, 1000000);
                });
                $value['items'] = $items;
            }
        });
        $this->properties = $properties;
    }

    public function render()
    {
        return view('livewire.template-properties');
    }

    public function updateTemplateProperties($property)
    {
        $index = array_key_first(array_filter($this->properties, function ($value) use ($property) {
            return $value['id'] == $property['id'];
        }));
        $this->properties[$index] = $property;
    }

    #[On('remove-property')]
    public function removeProperty($id)
    {
        $this->properties = array_values(array_filter($this->properties, function ($property) use ($id) {
            return $id != $property['id'];
        }));
    }

    public function addProperty()
    {
        $this->properties[] = [
            'id' => rand(100000, 1000000),
            'name' => '',
            'slug' => '',
            'type' => 'text',
        ];
    }

    public function clusterErrorMessages(array $errors)
    {
        $nestedErrors = [];

        foreach ($errors as $attribute => $messages) {
            // Split the attribute name into its segments
            $segments = explode('.', $attribute);

            // Create a reference to the current level of the nested array
            $currentLevel = &$nestedErrors;

            // Traverse the segments and build the nested error structure
            foreach ($segments as $segment) {
                if (!isset($currentLevel[$segment])) {
                    $currentLevel[$segment] = [];
                }

                $currentLevel = &$currentLevel[$segment];
            }

            // Add the error messages to the corresponding nested level
            $currentLevel = $messages;
        }

        return $nestedErrors;
    }
}

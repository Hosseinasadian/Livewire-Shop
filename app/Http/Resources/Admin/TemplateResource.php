<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TemplateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'action' => "<a href='" . route('admin.template.edit', $this->id) . "'><i class='fa fa-edit' style='color: green;'></i></a>"
        ];
    }
}

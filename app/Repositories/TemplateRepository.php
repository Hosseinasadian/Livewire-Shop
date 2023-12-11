<?php
namespace App\Repositories;

use App\Http\Resources\Admin\TemplateResource;
use App\Interfaces\TemplateRepositoryInterface;
use App\Models\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TemplateRepository implements TemplateRepositoryInterface{

    /**
     * @return Builder|Model
     */
    public function create(array $data): Template
    {
        return Template::query()->create($data);
    }

    /**
     * @return Model
     */
    public function update(Template $template, array $data): Template
    {
        $template->update($data);
        return $template;
    }

    public function dataTable($offset,$limit,$search,$order=[]):array
    {
        $list_query = Template::query();
        $columns = [
            'name','action'
        ];
        $recordsTotal = (clone $list_query)->count();
        $recordsFiltered = $recordsTotal;
        $search_value = $search['value']??'';
        if ($search_value){
            $list_query->where('name','like',"%".$search_value."%");
            $recordsFiltered = (clone $list_query)->count();
        }
        if (isset($order[0]['column']) && isset($columns[$order[0]['column']])){
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir']??'asc';
            $list_query->orderBy($column,$dir);
        }
        return [
            "data" => TemplateResource::collection(
                $list_query->limit($limit)->offset($offset)->get()
            ),
            "recordsFiltered" => $recordsFiltered,
            "recordsTotal" => $recordsTotal
        ];
    }

    public function syncProperties(Template $template, array $properties): bool
    {
        $template->properties = $properties;
        return $template->save();
    }
}

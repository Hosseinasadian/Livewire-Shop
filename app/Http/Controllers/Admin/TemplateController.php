<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Template\Request;
use App\Http\Requests\Admin\Template\PropertiesRequest;
use App\Interfaces\TemplateRepositoryInterface;
use App\Models\Template;
use Illuminate\Validation\ValidationException;

class TemplateController extends Controller
{
    public function __construct(
        private TemplateRepositoryInterface $templateRepository
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.template.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.template.create');
    }

    /**
     * Store a newly created resource in storage.
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        try {
            $this->templateRepository->create([
                'name' => $data['name']
            ]);
            return redirect()->route('admin.template.index')->with('success', 'Template created successfully');
        } catch (\Exception $exception) {
            throw  ValidationException::withMessages([['name' => 'Data provided is invalid']]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
/*        $properties = [
            [
                'name' => 'property 1',
                'slug' => 'property-1',
                'type' => 'text'
            ],
            [
                'name' => 'property 2',
                'slug' => 'property-2',
                'type' => 'select',
                'optionsHasDescription'=>1,
                'items' => [
                    [
                        'name' => 'option-1',
                        'description' => 'option-1 description',
                    ],
                    [
                        'name' => 'option-2',
                        'description' => 'option-2 description',
                    ],
                ]
            ],
            [
                'name' => 'property 3',
                'slug' => 'property-3',
                'type' => 'text'
            ],
        ];*/
        $properties = old('properties',$template->properties??[]);
        $templateId = $template->id;
        $id = "template-properties-" . $templateId;
        return view('admin.pages.template.edit', compact('template', 'properties', 'id','templateId'));
    }

    /**
     * Update the specified resource in storage.
     * @throws ValidationException
     */
    public function update(Request $request, Template $template)
    {
        $data = $request->validated();
        try {
            $this->templateRepository->update($template, [
                'name' => $data['name']
            ]);
            return redirect()->route('admin.template.index')->with('success', 'Template created successfully');
        } catch (\Exception $exception) {
            throw  ValidationException::withMessages([['name' => 'Data provided is invalid']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        //
    }

    public function list()
    {
        $offset = (int)request('start', 0);
        $limit = (int)request('length', 10);
        $search = (array)request('search', [
            'value' => '',
            'regex' => 'false'
        ]);
        $order = (array)request('order', []);
        return response()->json(
            $this->templateRepository->dataTable($offset, $limit, $search, $order)
        );
    }

    /**
     * @throws ValidationException
     */
    public function syncProperties(PropertiesRequest $request, Template $template)
    {
        $data = $request->validated();
//        dd($data);
        try {
            $this->templateRepository->syncProperties($template,$data['properties']??[]);
            return redirect()->back()->with('success', 'Template Properties Synced Successfully');
        } catch (\Exception $exception) {
            throw  ValidationException::withMessages([['properties' => 'Data provided is invalid']]);
        }
    }
}

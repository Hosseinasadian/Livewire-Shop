<div class="accordion-item">
    <h2 class="accordion-header d-flex justify-content-between align-items-center {{$server_errors?'has-error':''}}"
        id="heading-{{$id}}">
        <button class="accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse-{{$id}}"
                aria-expanded="true"
                aria-controls="collapse-{{$id}}"
                aria-expanded="{{ $id === $activeItemId ? 'false' : 'true' }}"
                wire:click="updateActiveItemId({{ $id }})">
            {{$name?$name:'New Property'}}
        </button>
    </h2>
    <div id="collapse-{{$id}}"
         class="accordion-collapse collapse {{ $id === $activeItemId ? 'show' : '' }}"
         aria-labelledby="heading-{{$id}}"
         data-bs-parent="#{{$parent}}">
        <div class="accordion-body">
            <div class="mb-3">
                <label for="{{$id}}_propertyName" class="form-label">Property Name</label>
                <input type="text"
                       class="form-control {{(isset($server_errors['name']) && is_array($server_errors['name'])?'is-invalid':'')}}"
                       id="{{$id}}_propertyName" wire:model.live="name">
                <div class="invalid-feedback">
                    {{(isset($server_errors['name']) && is_array($server_errors['name']))?implode('| ',$server_errors['name']):''}}
                </div>
            </div>
            <div class="mb-3">
                <label for="{{$id}}_propertySlug" class="form-label">Property Slug</label>
                <input type="text"
                       class="form-control {{(isset($server_errors['slug']) && is_array($server_errors['slug'])?'is-invalid':'')}}"
                       id="{{$id}}_propertySlug" wire:model.live="slug">
                <div class="invalid-feedback">
                    {{(isset($server_errors['slug']) && is_array($server_errors['slug']))?implode('| ',$server_errors['slug']):''}}
                </div>
            </div>

            <div class="mb-3">
                <label for="{{$id}}_propertyType" class="form-label">Property Type</label>
                <select wire:model.live="type"
                        class="form-control {{(isset($server_errors['type']) && is_array($server_errors['type'])?'is-invalid':'')}}"
                        id="{{$id}}_propertyType" name="type">
                    <option value="">Select Property Type</option>
                    <option value="relational">Relational</option>
                    <option value="text">Text</option>
                    <option value="select">Select</option>
                </select>
                <div class="invalid-feedback">
                    {{(isset($server_errors['type']) && is_array($server_errors['type']))?implode('| ',$server_errors['type']):''}}
                </div>
            </div>

            @if($type === 'relational')
                <div class="mb-3">
                    <label for="{{$id}}_modelName" class="form-label">Related Model</label>
                    <select wire:model.live="model"
                            class="form-control {{(isset($server_errors['model']) && is_array($server_errors['model'])?'is-invalid':'')}}"
                            id="{{$id}}_modelName">
                        <option value="">Select Model Has Relation With This Property</option>
                        <option value="country">Country</option>
                        <option value="brand">Brand</option>
                    </select>
                    <div class="invalid-feedback">
                        {{(isset($server_errors['model']) && is_array($server_errors['model']))?implode('| ',$server_errors['model']):''}}
                    </div>
                </div>
            @endif

            @if($type === 'select')
                <div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input {{(isset($server_errors['optionsHasDescription']) && is_array($server_errors['optionsHasDescription'])?'is-invalid':'')}}" type="checkbox" id="{{$id}}_optionsHasDescription"
                               wire:model.live="optionsHasDescription" {{$optionsHasDescription?'checked':''}}>
                        <label class="form-check-label" for="{{$id}}_optionsHasDescription">Options has
                            description</label>
                        <div class="invalid-feedback">
                            {{(isset($server_errors['optionsHasDescription']) && is_array($server_errors['optionsHasDescription']))?implode('| ',$server_errors['optionsHasDescription']):''}}
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input {{(isset($server_errors['optionsHasImage']) && is_array($server_errors['optionsHasImage'])?'is-invalid':'')}}" type="checkbox" id="{{$id}}_optionsHasImage"
                               wire:model.live="optionsHasImage" {{$optionsHasImage?'checked':''}}>
                        <label class="form-check-label" for="{{$id}}_optionsHasImage">Options has image</label>
                        <div class="invalid-feedback">
                            {{(isset($server_errors['optionsHasImage']) && is_array($server_errors['optionsHasImage']))?implode('| ',$server_errors['optionsHasImage']):''}}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    @php
                        $items_required_error = isset($server_errors['items']) && is_array($server_errors['items']) && is_string($server_errors['items'][0]);
                    @endphp
                    <button class="btn {{$items_required_error?'btn-outline-danger':'btn-outline-success'}}"
                            {!! $items_required_error?('data-bs-toggle="tooltip" data-bs-placement="bottom" title="'.$server_errors['items'][0].'"'):'' !!}  wire:click.prevent="addOptionToProperty()">
                        <span class="fa fa-plus"></span>
                    </button>
                </div>

                @if(count($items)>0)
                    <div class="accordion mb-3" id="{{$id}}_option_accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{$id}}_option_structure">
                                    Property Options
                                </button>
                            </h2>

                            <div id="{{$id}}_option_structure" class="accordion-collapse collapse show"
                                 data-bs-parent="#{{$id}}_option_accordion">
                                <div class="accordion-body">
                                    <div class="row">
                                        @foreach ($items as $cnt=>$item)
                                            @php
                                                    $loop_index = $item['id'];
                                                    $info = [
                                                        'optionsHasDescription'=>$optionsHasDescription,
                                                        'optionsHasImage'=>$optionsHasImage,
                                                ];
                                                    $server_error = $server_errors['items'][$cnt]??[];
                                            @endphp
                                            <livewire:select-property-option :parent="$id" :info="$info"
                                                                             :index="$loop_index" :item="$item"
                                                                             :key="$loop_index"
                                                                             :server_errors="$server_error"
                                                                             @remove-property-option="removeOption($event.detail.index)"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-block btn-outline-danger" wire:click="removeProperty()">
                Remove Property
            </button>
        </div>
    </div>
</div>

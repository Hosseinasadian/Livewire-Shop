<div class="mb-3">
    <div class="accordion mb-3" id="{{$id}}_accordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="flex-grow-1">
                        <button class="accordion-button"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#{{$id}}_structure">
                            {{$label}}
                        </button>
                    </div>
                    <div>
                        <button class="btn" wire:click="addItem()">
                            <span class="fa fa-plus"></span>
                        </button>
                    </div>
                </div>

            </h2>
        </div>
    </div>
    <div id="{{$id}}_structure" class="accordion-collapse collapse show"
         data-bs-parent="#{{$id}}_accordion">
        <div class="accordion-body">
            <div class="row">
                @if($value)
                    @foreach($value as $v)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    @foreach($items as $item)
                                        @php
                                            $item_unique_id = ($id??'') .'.' . $loop->parent->index . '.'. ($item['id']??'');
                                            $component_name = "dynamic-field." . ($item['type']??'text');
                                            $attributes = array_merge($item,[
                                                'id'=>$item_unique_id,
                                                'value'=>$v[$item['id']??'']??null,
                                                'errors'=>[]
                            ]);
                                        @endphp

                                        @livewire($component_name,$attributes,key($item_unique_id))

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">
            Properties
            <button class="btn btn-outline-dark-light btn-sm mx-1" wire:click="addProperty()">
                <span class="fa fa-plus"></span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="accordion" id="$id">
            @if(count($properties)>0)
                @foreach($properties as $cnt=>$property)
                    @php
                        $index = $property['id'];
                        $server_error = $server_errors['properties'][$cnt]??[];
                    @endphp
                    <livewire:property-item :index="$index" :parent="$id" :info="$property" :key="$index" :server_errors="$server_error"
                                            @property-updated="updateTemplateProperties($event.detail.property)"/>
                @endforeach
            @else
                <div class="alert alert-warning">Don't defined any properties yet</div>
            @endif
        </div>
    </div>
    <div class="card-footer">
        <form action="{{route('admin.template.properties.sync',$templateId)}}" method="post">
            @csrf

            @php
                function generateInputNames($properties, $prefix = '') {
                    foreach ($properties as $key => $value) {
                        if ($key=='id'){
                            continue;
                        }
                        if (is_array($value)) {
                            $newPrefix = $prefix . '[' . $key . ']';
                            generateInputNames($value, $newPrefix);
                        } else {
                            $inputName = $prefix . '[' . $key . ']';
                            echo '<input type="hidden" name="properties' . $inputName . '" value="' . $value . '">';
                        }
                    }
                }
                generateInputNames($properties);
            @endphp

            <button class="btn btn-info">
                Save Properties
            </button>
        </form>
    </div>
</div>


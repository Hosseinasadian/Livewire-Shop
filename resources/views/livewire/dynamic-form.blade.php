<div>
    @foreach($structure as $element)
        @php
            $id = $element['id']??'';
            $type = $element['type']??'text';
            $value = $data[$id]??null;
            $attributes = array_merge($element,[
                'value'=>$value,
                'errors'=>[]
]);
            $component_name = "dynamic-field." . $type;
        @endphp
        @livewire($component_name,$attributes,key($id))
    @endforeach
    <form action="{{$action}}" method="{{$method}}">
        @csrf

        @php
            function generateInputNames($properties, $prefix = '') {
                foreach ($properties as $key => $value) {
                    if ($key=='id'){
                        continue;
                    }
                    if (is_array($value)) {
                        $newPrefix = $prefix?($prefix . '[' . $key . ']'):$key;
                        generateInputNames($value, $newPrefix);
                    } else {
                        $inputName = $prefix?($prefix . '[' . $key . ']'):$key;
                        echo '<input type="hidden" name="' . $inputName . '" value="' . $value . '">';
                    }
                }
            }
            generateInputNames($data);
        @endphp

        <button class="btn btn-info">
            Save Properties
        </button>
    </form>
</div>

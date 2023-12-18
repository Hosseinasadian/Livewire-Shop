<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$label}}</label>
    <select wire:model.live="value"
            class="form-control {{(isset($server_errors['type']) && is_array($server_errors['type'])?'is-invalid':'')}}"
            id="{{$id}}">
        @foreach($options as $item=>$label)
            <option value="{{$item}}">{{$label}}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        {{(isset($server_errors['type']) && is_array($server_errors['type']))?implode('| ',$server_errors['type']):''}}
    </div>
</div>

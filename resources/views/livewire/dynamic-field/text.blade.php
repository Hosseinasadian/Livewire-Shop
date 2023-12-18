<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$label}}</label>
    <input type="text"
           class="form-control {{(isset($server_errors['slug']) && is_array($server_errors['slug'])?'is-invalid':'')}}"
           id="{{$id}}" wire:model.live="value">
    <div class="invalid-feedback">
        {{(isset($server_errors['slug']) && is_array($server_errors['slug']))?implode('| ',$server_errors['slug']):''}}
    </div>
</div>

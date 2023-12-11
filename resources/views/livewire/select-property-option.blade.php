<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <label for="{{$id}}_{{ $index }}_name" class="form-label">Label</label>
            <input type="text" class="form-control {{(isset($server_errors['name']) && is_array($server_errors['name'])?'is-invalid':'')}}" id="{{$id}}_{{ $index }}_name"
                   wire:model.live="name">
            <div class="invalid-feedback">
                {{(isset($server_errors['name']) && is_array($server_errors['name']))?implode('| ',$server_errors['name']):''}}
            </div>
        </div>
        @if($optionsHasDescription || $optionsHasImage)
            <div class="card-body">
                @if ($optionsHasDescription)
                    <div class="mb-3">
                        <label for="{{$id}}_{{ $index }}_description"
                               class="form-label">Description</label>
                        <textarea class="form-control {{(isset($server_errors['description']) && is_array($server_errors['description'])?'is-invalid':'')}}"
                                  id="{{$id}}_{{ $index }}_description"
                                  wire:model.live="description"
                                  rows="3"></textarea>
                        <div class="invalid-feedback">
                            {{(isset($server_errors['description']) && is_array($server_errors['description']))?implode('| ',$server_errors['description']):''}}
                        </div>
                    </div>
                @endif

                @if ($optionsHasImage)
                    <div class="mb-3">
                        <label for="{{$id}}_{{ $index }}_image"
                               class="form-label">Image
                            URL</label>
                        <input type="text" class="form-control {{(isset($server_errors['image']) && is_array($server_errors['image'])?'is-invalid':'')}}"
                               id="{{$id}}_{{ $index }}_image"
                               wire:model.live="image">
                        <div class="invalid-feedback">
                            {{(isset($server_errors['image']) && is_array($server_errors['image']))?implode('| ',$server_errors['image']):''}}
                        </div>
                    </div>
                @endif
            </div>
        @endif
        <div class="card-footer">
            <div class="btn-group">
                <button class="btn btn-danger" wire:click.prevent="removePropertyOption()">
                    Remove Option
                </button>
                <button class="btn btn-info" wire:click.prevent="dumpDetail()">
                    Dump Detail
                </button>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3 g-2">
    <div class="col-8">
        <input type="search" wire:model.live.debounce.500ms="search" class="form-control" placeholder="Search products...">
    </div>
    <div class="col-4">
        <div class="btn-group w-100">
            <button class="btn btn-primary">Scan</button>
            <button class="btn btn-info">Cart</button>
            <button class="btn btn-secondary">Menu</button>
        </div>
    </div>
</div>

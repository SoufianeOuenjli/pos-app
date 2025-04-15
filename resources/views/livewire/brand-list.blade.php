<div class="row mb-1 g-2 mx-0">
    <div class="col-12 position-relative">
        <div class="d-flex gap-2 overflow-x-auto pb-2 drag-scroll"
            style="scrollbar-width: none; -ms-overflow-style: none; cursor: grab;" onmousedown="handleMouseDown(event)"
            onmouseup="handleMouseUp(event)" onmouseleave="handleMouseUp(event)" onmousemove="handleMouseMove(event)">
            <button class="btn btn-{{ !$selectedBrand ? 'primary' : 'outline-secondary' }} btn-sm flex-shrink-0"
                wire:click="filterByBrand(null)">
                All Brands
            </button>

            @foreach ($brands as $brand)
                <button
                    class="btn btn-{{ $selectedBrand == $brand->id ? 'primary' : 'outline-secondary' }} btn-sm flex-shrink-0"
                    wire:click="filterByBrand({{ $brand->id }})">
                    {{ $brand->marque }}
                </button>
            @endforeach
        </div>
        <div class="fade-overlay end-0"></div>
    </div>
</div>

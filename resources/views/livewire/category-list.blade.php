<div class="row mb-1 g-2 mx-0">
    <div class="col-12 position-relative">
        <div class="d-flex gap-2 overflow-x-auto pb-2 drag-scroll"
            style="scrollbar-width: none; -ms-overflow-style: none; cursor: grab;" onmousedown="handleMouseDown(event)"
            onmouseup="handleMouseUp(event)" onmouseleave="handleMouseUp(event)" onmousemove="handleMouseMove(event)">
            <!-- Add your category buttons here -->
            <button class="btn btn-{{ !$selectedCategory ? 'primary' : 'outline-secondary' }} btn-sm flex-shrink-0"
                wire:click="filterByCategory(null)">
                All Categories
            </button>

            @foreach ($familles as $famille)
                <button
                    class="btn btn-{{ $selectedCategory == $famille->id ? 'primary' : 'outline-secondary' }} btn-sm flex-shrink-0"
                    wire:click="filterByCategory({{ $famille->id }})">
                    {{ $famille->famille }}
                </button>
            @endforeach
        </div>
        <div class="fade-overlay end-0"></div>
    </div>
</div>

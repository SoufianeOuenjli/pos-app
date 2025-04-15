<div class="product-grid-container" onmousedown="handleMouseDownProduct(event)" onmouseup="handleMouseUpProduct(event)"
    onmouseleave="handleMouseUpProduct(event)" onmousemove="handleMouseMoveProduct(event)">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
        <!-- Product Card -->
        @foreach ($products as $product)
        <div class="col">
            <div class="card product-card h-100" wire:click="selectProduct({{ $product->id }})" style="cursor: pointer;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-primary">${{ number_format($product->prix_ht, 2) }}</span>
                        <span class="badge bg-secondary">Stock: {{ $product->stock ?? 'N/A' }}</span>
                    </div>
                    <div class="text-center my-3">
                        <img src="{{ $product->image ?? 'placeholder.jpg' }}" class="img-fluid" style="height: 100px" alt="product">
                    </div>
                    <h6 class="card-title mb-1">{{ $product->nom }}</h6>
                    <small class="text-muted">Barcode: {{ $product->code_barre }}</small>
                </div>
            </div>
        </div>
    @endforeach

    </div>
    <div class="mt-3">
        {{ $products->links() }}
    </div>
</div>

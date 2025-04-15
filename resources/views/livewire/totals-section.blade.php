<div>
    <div class="row g-2 mb-2">
        {{-- <div class="col-4">
            <input type="number" class="form-control" placeholder="Tax %">
        </div> --}}
        <div class="col-8">
            <div class="input-group">
                <select class="form-select w-30">
                    <option>Fixed</option>
                    <option>Percentage</option>
                </select>
                <input type="number" step="any" class="form-control" placeholder="Discount" wire:model.live.debounce.500ms="discount">
            </div>
        </div>
        <div class="col-4">
            <input type="number" step="any" class="form-control" placeholder="Shipping" wire:model.live.debounce.500ms="shipping">
        </div>
    </div>

    <div class="row g-2 mb-3 justify-content-end">
        <div class="col-6 text-end">
            <p class="mb-0">Total QTY: {{$totalQty}}</p>
            <p class="mb-0">Sub Total: {{$subTotal}}</p>
            <h5>Total: {{$total}}</h5>
        </div>
    </div>
</div>

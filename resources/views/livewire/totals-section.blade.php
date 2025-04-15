<div>
    <div class="row g-2 mb-2">
        {{-- <div class="col-4">
            <input type="number" class="form-control" placeholder="Taxe %">
        </div> --}}
        <div class="col-8">
            <div class="input-group">
                <select class="form-select w-30">
                    <option>Fixe</option>
                    <option>Pourcentage</option>
                </select>
                <input type="number" step="any" class="form-control" placeholder="Remise" wire:model.live.debounce.500ms="discount">
            </div>
        </div>
        <div class="col-4">
            <input type="number" step="any" class="form-control" placeholder="Livraison" wire:model.live.debounce.500ms="shipping">
        </div>
    </div>

    <div class="row g-2 mb-3 justify-content-end">
        <div class="col-6 text-end">
            <p class="mb-0">Quantité Totale : {{$totalQty}}</p>
            <p class="mb-0">Sous-total : {{$subTotal}} DH</p>
            <h5>Total : {{$total}} DH</h5>
        </div>
    </div>
</div>

<div class="row g-2">
    @if ($flashMessage)
        <div class="alert alert-success alert-dismissible fade show">
            {{ $flashMessage }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="col-4">
        <button class="btn btn-danger w-100" wire:click='clearCart()'>Annuler</button>
    </div>
    <div class="col-4">
        <button class="btn btn-warning w-100">Garder</button>
    </div>
    <div class="col-4">
        <button class="btn btn-success w-100" wire:click='checkout()'>Payer</button>
    </div>
</div>

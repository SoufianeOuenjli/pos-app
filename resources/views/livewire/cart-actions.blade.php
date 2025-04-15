<div class="row g-2">
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
@if (session('success'))

<script>
    Swal.fire({
        position: "top-end",
        icon: "success",
        title:{{ session('success') }},
        showConfirmButton: false,
        timer: 1500
    });
</script>
@endif

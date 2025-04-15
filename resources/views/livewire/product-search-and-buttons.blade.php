<div class="row mb-3 g-3">
    <div class="col-10">
        <div class="input-group">
            <span class="input-group-text bg-transparent border-end-0">
                <i class="bi bi-search"></i>
            </span>
            <input type="search" wire:model.live.debounce.500ms="search" class="form-control border-start-0"
                placeholder="Rechercher des produits...">
        </div>
    </div>
    <div class="col-2">
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-icon  p-2" title="En attente">
                <i class="bi bi-clock fs-5"></i>
            </button>
            <button class="btn btn-outline-primary btn-icon p-2" title="Panier">
                <i class="bi bi-cart fs-5"></i>
            </button>
            <a href="{{ route('commandes') }}" wire:navigate class="btn btn-outline-primary btn-icon p-2">
                <i class="bi bi-list fs-5"></i>
            </a>
        </div>
    </div>


    <style>
        .btn-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .btn-icon:hover {
            transform: scale(1.1);
        }

        .btn-outline-primary {
            border-color: #2A4E6C;
            color: #2A4E6C;
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover {
            background: #2A4E6C;
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-primary:active {
            transform: translateY(0);
        }

        .input-group-text {
            padding: 0.35rem 1rem;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #2A4E6C;
        }
    </style>
</div>

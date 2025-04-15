<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ajoutez ceci dans votre section head -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- @livewireStyles() --}}
    <title>Commandes</title>
</head>

<body>
    <!-- resources/views/commandes.blade.php -->
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold text-primary">
                <i class="bi bi-receipt"></i> Historique des Commandes
            </h1>
            <a href="{{ route('home') }}" wire:navigate class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i> Retour au POS
            </a>
        </div>

        @livewire('commandes')
    </div>


    <style>
        .card {
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        dt {
            font-weight: 500;
            color: #4a5568;
        }

        dd {
            color: #2d3748;
        }
    </style>
    {{--
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" ></script>
    {{-- @livewireScripts() --}}
</body>

</html>

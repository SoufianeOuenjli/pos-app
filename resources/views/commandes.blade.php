<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add this in your head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @livewireStyles()
    <title>commandes</title>
</head>

<body>
    <!-- resources/views/commandes.blade.php -->
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-5 fw-bold text-primary">
                <i class="bi bi-receipt"></i> Order History
            </h1>
            <a href="{{ route('home') }}" wire:navigate class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i> Back to POS
            </a>
        </div>

        <div class="row g-4">
            @forelse($commandes as $commande)
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center" x-data="{ showDetails: false }"
                                @click="showDetails = !showDetails" style="cursor: pointer">
                                <div>
                                    <h5 class="card-title mb-1">
                                        Order #{{ $commande->id }}
                                        <span class="badge bg-{{ $commande->regle ? 'success' : 'danger' }} ms-2">
                                            {{ $commande->regle ? 'Paid' : 'Unpaid' }}
                                        </span>
                                    </h5>
                                    <p class="text-muted mb-0">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $commande->date->format('d M Y H:i') }}
                                    </p>
                                    <small class="text-muted">
                                        Client: {{ $commande->client->name }}
                                    </small>
                                </div>

                                <div class="text-end">
                                    <h4 class="text-primary mb-0">
                                        ${{ number_format($commande->total_amount, 2) }}
                                    </h4>
                                    <small class="text-muted">
                                        {{ $commande->modeReglement->name }}
                                    </small>
                                </div>
                            </div>

                            <!-- Order Details -->
                            <div x-show="showDetails" x-collapse class="mt-4 border-top pt-3">
                                <h6 class="mb-3 fw-bold">
                                    <i class="bi bi-list-check me-2"></i>Order Items
                                </h6>

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Unit Price</th>
                                                <th>Qty</th>
                                                <th>VAT</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($commande->details as $detail)
                                                <tr>
                                                    <td>{{ $detail->article->name }}</td>
                                                    <td>${{ number_format($detail->prix_ht, 2) }}</td>
                                                    <td>{{ number_format($detail->quantite, 2) }}</td>
                                                    <td>{{ number_format($detail->tva, 2) }}%</td>
                                                    <td>${{ number_format(($detail->prix_ht * $detail->quantite) * (1 + $detail->tva / 100), 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row justify-content-end mt-3">
                                    <div class="col-4">
                                        <dl class="row">
                                            <dt class="col-6">Subtotal:</dt>
                                            <dd class="col-6 text-end">${{ number_format($commande->subtotal, 2) }}</dd>

                                            <dt class="col-6">Discount:</dt>
                                            <dd class="col-6 text-end">-${{ number_format($commande->remise, 2) }}</dd>

                                            <dt class="col-6">Total VAT:</dt>
                                            <dd class="col-6 text-end">${{ number_format($commande->total_vat, 2) }}</dd>

                                            <dt class="col-6 fw-bold">Grand Total:</dt>
                                            <dd class="col-6 text-end fw-bold">
                                                ${{ number_format($commande->total_amount, 2) }}</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 justify-content-end">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-printer"></i> Print
                                    </button>
                                    @if(!$commande->regle)
                                        <button class="btn btn-sm btn-success">
                                            <i class="bi bi-credit-card"></i> Mark as Paid
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <div class="col-12">
                    <div class="card border-0 text-center py-5">
                        <div class="card-body">
                            <i class="bi bi-inbox fs-1 text-muted"></i>
                            <h4 class="mt-3">No orders found</h4>
                            <p class="text-muted">Your order history will appear here</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <div class="container py-4">

        {{$commandes->links('pagination::bootstrap-5')}}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts()
</body>

</html>

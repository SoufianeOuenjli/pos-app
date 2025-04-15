<div class="row g-4">
    @forelse($commandes as $commande)
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center" x-data="{ showDetails: false }"
                        style="cursor: pointer">
                        <div>
                            <h5 class="card-title mb-1">
                                Commande #{{ $commande->id }}
                                <span class="badge bg-{{ $commande->regle ? 'success' : 'danger' }} ms-2">
                                    {{ $commande->regle ? 'Payée' : 'Non Payée' }}
                                </span>
                            </h5>
                            <p class="text-muted mb-0">
                                <i class="bi bi-calendar me-1"></i>
                                {{ $commande->date->format('d M Y H:i') }}
                            </p>
                            <small class="text-muted">
                                Client : {{ $commande->client->name }}
                            </small>
                        </div>

                        <div class="text-end">
                            <h4 class="text-primary mb-0">
                                {{ number_format($commande->total_amount, 2) }} DH
                            </h4>
                            <small class="text-muted">
                                {{ $commande->modeReglement->name }}
                            </small>
                        </div>
                    </div>

                    <!-- Détails de la commande -->
                    <div class="mt-4 border-top pt-3">
                        <h6 class="mb-3 fw-bold">
                            <i class="bi bi-list-check me-2"></i>Articles de la Commande
                        </h6>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix Unitaire</th>
                                        <th>Qté</th>
                                        <th>TVA</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commande->details as $detail)
                                        <tr>
                                            <td>{{ $detail->article->nom }}</td>
                                            <td>{{ number_format($detail->prix_ht, 2) }} DH</td>
                                            <td>{{ number_format($detail->quantite, 2) }}</td>
                                            <td>{{ number_format($detail->tva, 2) }}%</td>
                                            <td>{{ number_format(($detail->prix_ht * $detail->quantite) * (1 + $detail->tva / 100), 2) }} DH
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-end mt-3">
                            <div class="col-4">
                                <dl class="row">
                                    <dt class="col-6">Sous-total :</dt>
                                    <dd class="col-6 text-end">{{ number_format($commande->subtotal, 2) }} DH</dd>

                                    <dt class="col-6">Remise :</dt>
                                    <dd class="col-6 text-end">-{{ number_format($commande->remise, 2) }} DH</dd>

                                    <dt class="col-6">Total TVA :</dt>
                                    <dd class="col-6 text-end">{{ number_format($commande->total_vat, 2) }} DH</dd>

                                    <dt class="col-6 fw-bold">Total Général :</dt>
                                    <dd class="col-6 text-end fw-bold">
                                        {{ number_format($commande->total_amount, 2) }} DH</dd>
                                </dl>
                            </div>
                        </div>

                        {{-- <div class="d-flex gap-2 justify-content-end">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-printer"></i> Imprimer
                            </button>
                            @if(!$commande->regle)
                                <button class="btn btn-sm btn-success">
                                    <i class="bi bi-credit-card"></i> Marquer comme Payée
                                </button>
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

    @empty
        <div class="col-12">
            <div class="card border-0 text-center py-5">
                <div class="card-body">
                    <i class="bi bi-inbox fs-1 text-muted"></i>
                    <h4 class="mt-3">Aucune commande trouvée</h4>
                    <p class="text-muted">Votre historique de commandes apparaîtra ici</p>
                </div>
            </div>
        </div>
    @endforelse
    <div class="container py-4">

        {{$commandes->links()}}
    </div>
</div>

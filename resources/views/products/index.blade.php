@extends('layouts.app')

@section('title', 'Gestion des produits')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestion des produits</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Ajouter un produit
        </a>
    </div>

    @if($products->count() > 0)
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Référentiel</th>
                            <th>Prix unitaire</th>
                            <th>Quantité</th>
                            <th>Valeur totale</th>
                            <th>Statut</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-light rounded p-2 me-2">
                                            <i class="bi bi-box-seam text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $product->name }}</h6>
                                            <small class="text-muted">#{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->referentiel }}</td>
                                <td>{{ number_format($product->price, 2, ',', ' ') }} €</td>
                                <td>
                                    <span class="badge {{ $product->quantity == 0 ? 'bg-danger' : ($product->quantity < 5 ? 'bg-warning' : 'bg-success') }}">
                                        {{ $product->quantity }} unité{{ $product->quantity > 1 ? 's' : '' }}
                                    </span>
                                </td>
                                <td>{{ number_format($product->price * $product->quantity, 2, ',', ' ') }} €</td>
                                <td>
                                    @if($product->quantity == 0)
                                        <span class="badge bg-danger">Rupture</span>
                                    @elseif($product->quantity < 5)
                                        <span class="badge bg-warning">Stock faible</span>
                                    @else
                                        <span class="badge bg-success">En stock</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')"
                                                    data-bs-toggle="tooltip" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total :</td>
                            <td class="fw-bold">
                                {{ number_format($products->sum(function($product) { return $product->price * $product->quantity; }), 2, ',', ' ') }} €
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #dee2e6;"></i>
                <h5 class="mt-3">Aucun produit enregistré</h5>
                <p class="text-muted">Commencez par ajouter votre premier produit</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Ajouter un produit
                </a>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Initialisation des tooltips Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endpush
@endsection
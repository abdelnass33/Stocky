@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Tableau de bord</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Ajouter un produit
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi bi-box-seam text-primary" style="font-size:2rem;"></i></div>
                    <h6 class="text-muted">Produits en stock</h6>
                    <h3 class="fw-bold">{{ $products->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi bi-currency-euro text-success" style="font-size:2rem;"></i></div>
                    <h6 class="text-muted">Valeur totale</h6>
                    <h3 class="fw-bold">{{ number_format($products->sum(fn($p) => $p->price * $p->quantity), 2, ',', ' ') }} €</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <div class="mb-2"><i class="bi bi-exclamation-triangle text-warning" style="font-size:2rem;"></i></div>
                    <h6 class="text-muted">Stock faible (&lt; 5)</h6>
                    <h3 class="fw-bold">{{ $products->where('quantity', '<', 5)->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Derniers produits ajoutés</h5>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                <i class="bi bi-list"></i> Voir tous les produits
            </a>
        </div>
        <div class="card-body p-0">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Référentiel</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Valeur</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products->sortByDesc('created_at')->take(5) as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->referentiel }}</td>
                                    <td>{{ number_format($product->price, 2, ',', ' ') }} €</td>
                                    <td>
                                        <span class="badge {{ $product->quantity == 0 ? 'bg-danger' : ($product->quantity < 5 ? 'bg-warning text-dark' : 'bg-success') }}">
                                            {{ $product->quantity }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($product->price * $product->quantity, 2, ',', ' ') }} €</td>
                                    <td class="text-end">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="tooltip" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce produit ?')" data-bs-toggle="tooltip" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #dee2e6;"></i>
                    <h5 class="mt-3">Aucun produit enregistré</h5>
                    <p class="text-muted">Commencez par ajouter votre premier produit</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i> Ajouter un produit
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

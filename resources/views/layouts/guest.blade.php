<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Gestion de Stock') }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-light">
        <div class="min-vh-100 d-flex align-items-center justify-content-center py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <!-- Logo -->
                        <div class="text-center mb-4">
                            <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-box-seam text-white" style="font-size: 2rem;"></i>
                            </div>
                            <h4 class="fw-bold text-dark">{{ config('app.name', 'Gestion de Stock') }}</h4>
                            <p class="text-muted">Connectez-vous à votre compte</p>
                        </div>
                        
                        <!-- Auth Card -->
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4">
                                {{ $slot }}
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="text-center mt-4">
                            <p class="text-muted small">
                                <i class="bi bi-heart-fill text-danger me-1"></i>
                                Développé avec Laravel & Bootstrap
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'ExpenseControl')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/expense.css') }}">
</head>
<body>

<div class="app-container">

    <aside class="sidebar">
        <div class="brand">
            <i class="bi bi-wallet2"></i>
            <span>Expense<span class="brand-highlight">Control</span></span>
        </div>

        <p class="menu-label">MENÚ PRINCIPAL</p>

        <nav class="sidebar-nav">
            <a href="{{ url('/') }}" class="nav-item active">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>

      
<a href="{{ url('/gastos') }}"
   class="nav-item {{ request()->routeIs('gastos.*') ? 'active' : '' }}">
    <i class="bi bi-receipt"></i>
    Mis gastos
</a>


           <a href="{{ url('/categorias') }}"
   class="nav-item {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
    <i class="bi bi-tags"></i>
    Categorías
</a>

            <a href="{{ url('/estadisticas') }}"
   class="nav-item {{ request()->routeIs('estadisticas.*') ? 'active' : '' }}">
    <i class="bi bi-bar-chart"></i>
    Estadísticas
</a>
        </nav>

        <div class="sidebar-bottom">
            <div class="sidebar-user">
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <strong>Usuario</strong>
                    <small>Mi cuenta</small>
                </div>
            </div>
        </div>
    </aside>

    <main class="main-content">

        <header class="topbar">
            <div>
                <h5>Panel de control</h5>
                <small>Administra tus finanzas personales</small>
            </div>

            <div class="topbar-icon">
                <i class="bi bi-bell"></i>
            </div>
        </header>

        <section class="page-content">
            @yield('contenido')
        </section>

        <footer class="footer">
            ExpenseControl © 2026 - Control de gastos personales
        </footer>

    </main>

</div>
@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

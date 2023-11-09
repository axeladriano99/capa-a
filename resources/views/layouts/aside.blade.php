<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            @can('has_permissions', ['Panel', 'Acceder'])
            <li class="">
                <a href="{{ route('home') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            @endcan
        </ul>
        @can('has_permissions', ['Mi cuenta', 'Acceder'])
        <ul class="pcoded-item pcoded-left-item">
            

            <li class="pcoded-hasmenu active pcoded-trigger">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Mi cuenta</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('has_permissions', ['Gestionar pagos', 'Acceder'])
                    <li class="">
                        <a href="{{ route('payments.index') }}">
                            <span class="pcoded-mtext">Gestionar pagos</span>
                        </a>
                    </li>
                    @endcan
                    @can('has_permissions', ['Gestionar referidos', 'Acceder'])
                    <li class="">
                        <a href="{{ route('campaign-referrals.index') }}">
                            <span class="pcoded-mtext">Gestionar referidos</span>
                        </a>
                    </li>
                    @endcan

                    @can('has_permissions', ['Gestionar referidos', 'Acceder'])
                    <li class="">
                        <a href="{{ route('networks.index') }}">
                            <span class="pcoded-mtext">Mi red</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>

            
        </ul>
        <hr>
        @endcan
        
        <ul class="pcoded-item pcoded-left-item">
            @can('has_permissions', ['Administrar', 'Acceder'])

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Administrar</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('has_permissions', ['Métodos de pago', 'Acceder'])
                    <li class="">
                        <a href="{{ route('payment-methods.index') }}">
                            <span class="pcoded-mtext">Métodos de pagos</span>
                        </a>
                    </li>
                    @endcan
                    @can('has_permissions', ['Campañas', 'Acceder'])
                    <li class="">
                        <a href="{{ route('campaigns.index') }}">
                            <span class="pcoded-mtext">Campañas</span>
                        </a>
                    </li>
                    @endcan
                    @can('has_permissions', ['Usuarios', 'Acceder'])
                    <li class=" ">
                        <a href="{{ route('users.index') }}">
                            <span class="pcoded-mtext">Usuarios</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('has_permissions', ['Seguridad', 'Acceder'])

            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Seguridad</span>
                </a>
                <ul class="pcoded-submenu">
                    @can('has_permissions', ['Roles', 'Acceder'])
                    <li class="">
                        <a href="{{ route('roles.index') }}">
                            <span class="pcoded-mtext">Roles</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
        </ul>


        
    </div>
</nav>
<style>
    a:hover {
        text-decoration: none;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <img src="/assets/img/Logo VSATLink.png" alt="logo" style="max-width: 120px">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Sidebar Menu -->
        @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Sales Admin')
            <li class="menu-item {{ $management === 'orders' ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-receipt"></i>
                    <div>Orders</div>
                    @if ($unconfirmedOrdersCount > 0)
                        <div class="badge bg-danger rounded-pill ms-auto" style="min-width: 22px">
                            {{ $unconfirmedOrdersCount }}
                        </div>
                    @endif
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ $page === 'order-management' ? 'active' : '' }}">
                        <a href="/" class="menu-link">
                            <div>All Orders</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $page === 'order-confirmation' ? 'active' : '' }}">
                        <a href="/order-confirmation" class="menu-link">
                            <div>Confirm Orders</div>
                            @if ($unconfirmedOrdersCount > 0)
                                <div class="badge bg-danger rounded-pill ms-auto" style="min-width: 22px">
                                    {{ $unconfirmedOrdersCount }}
                                </div>
                            @endif
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Logistic Admin')
            <li class="menu-item {{ $management === 'logistics' ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-package"></i>
                    <div>Logistics</div>
                    @if ($logisticsPendingTotal > 0)
                        <div class="badge bg-danger rounded-pill ms-auto" style="min-width: 22px">
                            {{ $logisticsPendingTotal }}
                        </div>
                    @endif
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ $page === 'logistic-expedition' ? 'active' : '' }}">
                        <a href="/logistics/expedition" class="menu-link">
                            <div>Expedition Orders</div>
                            @if ($logisticsExpeditionPendingCount > 0)
                                <div class="badge bg-danger rounded-pill ms-auto" style="min-width: 22px">
                                    {{ $logisticsExpeditionPendingCount }}
                                </div>
                            @endif
                        </a>
                    </li>
                    <li class="menu-item {{ $page === 'logistic-pickup' ? 'active' : '' }}">
                        <a href="/logistics/pickup" class="menu-link">
                            <div>Pickup Orders</div>
                            @if ($logisticsPickupPendingCount > 0)
                                <div class="badge bg-danger rounded-pill ms-auto" style="min-width: 22px">
                                    {{ $logisticsPickupPendingCount }}
                                </div>
                            @endif
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Service Operation Admin')
            <li class="menu-item {{ $management === 'service-activation' ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-broadcast"></i>
                    <div>Service Activations</div>
                    @if ($activationSchedulePendingCount > 0)
                        <div class="badge bg-danger rounded-pill ms-auto" style="min-width: 22px">
                            {{ $activationSchedulePendingCount }}
                        </div>
                    @endif
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ $page === 'all-activations' ? 'active' : '' }}">
                        <a href="/service-activations" class="menu-link">
                            <div>All Activations</div>
                            @if ($activationSchedulePendingCount > 0)
                                <div class="badge bg-danger rounded-pill ms-auto" style="min-width: 22px">
                                    {{ $activationSchedulePendingCount }}
                                </div>
                            @endif
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</aside>

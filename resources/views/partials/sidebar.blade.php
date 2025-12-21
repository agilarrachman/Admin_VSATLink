<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <img src="assets/img/Logo VSATLink.png" alt="logo" style="max-width: 120px">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Sidebar Menu -->
        <li class="menu-item {{ ($management === 'orders') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-receipt"></i>
                <div data-i18n="Dashboards">Orders</div>
                <div class="badge bg-danger rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ ($page === 'order-management') ? 'active' : '' }}">
                    <a href="/" class="menu-link">
                        <div data-i18n="Analytics">All Orders</div>
                    </a>
                </li>
                <li class="menu-item {{ ($page === 'order-confirmation') ? 'active' : '' }}">
                    <a href="/order-confirmation" class="menu-link">
                        <div data-i18n="Analytics">Confirm Orders</div>
                        <div class="badge bg-danger rounded-pill ms-auto">5</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ ($management === 'logistics') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Dashboards">Logistics</div>
                <div class="badge bg-danger rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Analytics">Expedition Orders</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Analytics">Pickup Orders</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ ($management === 'service-activation') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-broadcast"></i>
                <div data-i18n="Dashboards">Service Activation</div>
                <div class="badge bg-danger rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Analytics">All Orders</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Analytics">Confirm Orders</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Analytics">Verification Orders</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>

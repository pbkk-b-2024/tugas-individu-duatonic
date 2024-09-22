<nav id="sidebar" class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('items') ? 'active' : '' }}" href="{{ route('items') }}" aria-expanded="false">
                Items
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ route('users') }}" aria-expanded="false">
                Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('roles') ? 'active' : '' }}" href="{{ route('roles') }}" aria-expanded="false">
                Roles
            </a>
        </li>
        <!-- Add more menu items here -->
    </ul>
</nav>
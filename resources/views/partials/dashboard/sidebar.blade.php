<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <i class="align-middle" data-feather="drum"></i><span class="align-middle"> Music App</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ request()->is('dashboard') ? "active" : '' }}">
                <a class="sidebar-link" href="/dashboard">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('dashboard/posts') ? "active" : '' }}">
                <a class="sidebar-link" href="{{ route('posts.index') }}">
                    <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Alat Music</span>
                </a>
            </li>

            <li class="sidebar-item ">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="send"></i> <span
                        class="align-middle">Sejarah Umum</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle" data-feather="send"></i> <span
                        class="align-middle">About Apps</span>
                </a>
            </li>

            @can('IsAdmin')
                <!-- <li class="sidebar-header">
                    Admin resource
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('categories.index') }}">
                        <i class="align-middle" data-feather="map"></i> <span class="align-middle">Categoires</span>
                    </a>
                </li> -->
            @endcan
        </ul>
    </div>
</nav>

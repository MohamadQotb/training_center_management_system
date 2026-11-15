<aside id="sidebar">
    <!-- Brand Logo -->
    <a href="" class="sidebar-brand">
        <i class="bi bi-mortarboard-fill"></i>
        <span>EduAdmin</span>
    </a>

    <!-- Navigation Header -->
    <div class="nav-header">Main Menu</div>

    <!-- Navigation Links -->
    <nav class="nav flex-column">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Students</span>
        </a>

        <a href="{{ route('courses.index') }}" class="nav-link  {{ request()->routeIs('courses.*') ? 'active' : '' }}">
            <i class="bi bi-journal-bookmark-fill"></i>
            <span>Courses</span>
        </a>

    </nav>

    <!-- Sidebar Footer / Project Info -->
    <div class="sidebar-footer">
        <div class="fw-semibold text-light mb-1">PHP OOP Project</div>
        <div class="small">Training Edition &bull; PDO & MySQL</div>
    </div>
</aside>
<div class="position-sticky pt-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active color-b" href="{{ route('admin.dashboard') }}" aria-current="page">
                <i class="bi bi-speedometer me-1"></i> @lang('app.dashboard')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-b" href="{{ route('admin.estates.index') }}">
                <i class="bi bi-building me-1"></i> @lang('app.estates')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-b" href="{{ route('admin.locations.index') }}">
                <i class="bi bi-geo-alt-fill me-1"></i> @lang('app.locations')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-b" href="{{ route('admin.categories.index') }}">
                <i class="bi bi-bar-chart-line-fill me-1"></i> @lang('app.categories')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-b" href="{{ route('admin.messages.index') }}">
                <i class="bi bi-chat-dots-fill me-1"></i> @lang('app.messages')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-b" href="{{ route('admin.visitors.index') }}">
                <i class="bi bi-people-fill me-1"></i> @lang('app.visitors')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-b" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                <i class="bi bi-box-arrow-right"></i> @lang('app.logout') <span class="text-warning">{{ auth()->user()->name }}</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                @honeypot
                @honeypot
                @honeypot
            </form>
        </li>
    </ul>
</div>
<div class="navbar-inner">
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
            <li class="nav-item">
                @if (URL::current()==route('dashboard'))
                <a class="nav-link" href="#">
                    @else
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        @endif
                        <i class="ni ni-shop text-primary"></i>
                        <span class="nav-link-text">Dashboards</span>
                    </a>
            </li>
            <li class="nav-item">
                @if (URL::current()==route('books.index'))
                <a class="nav-link" href="#">
                    @else
                    <a class="nav-link" href="{{ route('books.index') }}">
                        @endif
                        <i class="ni ni-books text-orange"></i>
                        <span class="nav-link-text">Books</span>
                    </a>
            </li>
            <li class="nav-item">
                @if (URL::current()==route('publishers.index'))
                <a class="nav-link" href="#">
                    @else
                    <a class="nav-link" href="{{ route('publishers.index') }}">
                        @endif
                        <i class="ni ni-ui-04 text-info"></i>
                        <span class="nav-link-text">Publishers</span>
                    </a>
            </li>
            </li>
        </ul>
    </div>
</div>

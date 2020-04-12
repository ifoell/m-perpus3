<div class="navbar-inner">
    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Nav items -->
        <ul class="navbar-nav">
            @foreach(getMenu('admin_menu')->items as $m)
                <li class="nav-item">
                @if($m->child->count() > 0)
                @if (isset($set_active_menu_items))
                    @if (in_array($m->id, array_keys($set_active_menu_items)))
                    {{ $set_active_menu_items }}
                    <a class="nav-link active" href="javascript:void(0)" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="{{ $m->link }}">
                    @else
                    <a class="nav-link" href="@if(Str::before($m->link, $m->label) == 'navbar-') #{{ $m->link }} @else {{ route($m->link) }} @endif" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{ $m->link }}">
                    @endif
                @else
                <a class="nav-link" href="@if(Str::before($m->link, $m->label) == 'navbar-') #{{ $m->link }} @else {{ route($m->link) }} @endif" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{ $m->link }}">
                @endif                        
                @if(!empty($m->class)) <i class="{{ $m->class }}"></i> @endif
                    <span class="nav-link-text">{{ $m->label }}</span>
                </a>
                @if (isset($set_active_menu_items))
                    @if (in_array($m->id, array_keys($set_active_menu_items)))
                    <div class="collapse show" id="{{ $m->link }}">
                    @else
                    <div class="collapse" id="{{ $m->link }}">
                    @endif
                @else
                <div class="collapse" id="{{ $m->link }}">
                @endif
                <ul class="nav nav-sm flex-column">
                    @foreach ($m->child as $child)
                    <li class="nav-item">
                        @if (URL::current()==route($child->link))
                        <a class="nav-link active" href="javascript:void(0)">
                        @else
                        <a class="nav-link active" href="{{ route($child->link) }}">
                        @endif
                        @if(!empty($child->class)) <i class="{{ $child->class }}"></i> @endif
                        {{ $child->label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                </div>
                @else
                    @if (URL::current()==route($m->link))
                        <a class="nav-link active" href="javascript:void(0)">
                    @else
                        <a class="nav-link" href="@if(Str::before($m->link, $m->label) == 'navbar-') #{{ $m->link }} @else {{ route($m->link) }} @endif">
                    @endif
                            @if(!empty($m->class)) <i class="{{ $m->class }}"></i> @endif
                            <span class="nav-link-text">{{ $m->label }}</span>
                        </a>
                    </li>
                @endif
                
            @endforeach
        </ul>
    </div>
</div>

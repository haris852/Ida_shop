@props(['icon' => '', 'title' => '', 'href' => '#', 'id' => '', 'active' => false])
<li class="nav-item">
    <a class="nav-link {{ $active ? 'bg-white' : '' }}" href="{{ $href }}" id="{{ $id }}">
        <i class="{{ $icon }} {{ $active ? 'text-primary' : '' }}""></i>
        <span class="menu-title">
            {{ $title }}
        </span>
    </a>
</li>

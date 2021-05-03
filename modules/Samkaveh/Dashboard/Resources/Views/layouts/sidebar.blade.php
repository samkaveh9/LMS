<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="#"></a>
    <x-user-photo-profile />

    <ul>
        @foreach(config('sidebar.items') as $item)
            @if(!array_key_exists('permission',$item)
             || auth()->user()->hasAnyPermission($item['permission'])
             || auth()->user()->hasPermissionTo(\Samkaveh\RolePermission\Models\Permission::PERMISSION_ADMIN))
            <li class="item-li {{ $item['icon'] }} {{ str_starts_with(request()->url(),$item['url']) ? 'is-active' : '' }}"><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
            @endif
        @endforeach

    </ul>
</div>
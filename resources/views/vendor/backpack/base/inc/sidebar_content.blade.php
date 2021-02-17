<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-sitemap"></i> Structure</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('department') }}'><i class='nav-icon lab la-discord'></i> Departments</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('unit') }}'><i class='nav-icon lab la-github'></i> Units</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('position') }}'><i class='nav-icon las la-code-branch'></i> Positions</a></li>
    </ul>
</li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-chart-bar"></i> Tableau</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('project') }}'><i class='nav-icon las la-project-diagram'></i> Projects</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('workbook') }}'><i class='nav-icon las la-book'></i> Workbooks</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('view') }}'><i class='nav-icon la la-file'></i> Views</a></li>
    </ul>
</li>



<li class='nav-item'><a class='nav-link' href='{{ backpack_url('activitylog') }}'><i class='nav-icon la la-question'></i> ActivityLogs</a></li>
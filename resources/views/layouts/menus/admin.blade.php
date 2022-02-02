<a class="nav-link" href="{{ url('dashboard') }}">
    <div class="sb-nav-link-icon">
        <i data-feather="activity">
        </i>
    </div>
    {{ _lang('Dashboard') }}
</a>
<a aria-controls="collapseLayouts" aria-expanded="false" class="nav-link collapsed" data-target="#user-management" data-toggle="collapse" href="#">
    <div class="sb-nav-link-icon">
        <i data-feather="users">
        </i>
    </div>
    {{ _lang('User Management') }}
    <div class="sb-sidenav-collapse-arrow">
        <i class="fas fa-angle-down">
        </i>
    </div>
</a>
<div class="collapse" data-parent="#accordionSidenav" id="user-management">
    <nav class="sb-sidenav-menu-nested nav accordion">
        <a class="nav-link" href="{{ url('admin/users/create') }}">
            {{ _lang('Add New') }}
        </a>
        <a class="nav-link" href="{{ url('admin/users') }}">
            {{ _lang('All Users') }}
        </a>
    </nav>
</div>


<a class="nav-link" href="{{ url('admin/accounts') }}">
    <div class="sb-nav-link-icon">
        <i data-feather="home">
        </i>
    </div>
    {{ _lang('Accounts') }}
</a>

<a aria-controls="collapseLayouts" aria-expanded="false" class="nav-link collapsed" data-target="#cards" data-toggle="collapse" href="#">
    <div class="sb-nav-link-icon">
        <i data-feather="credit-card">
        </i>
    </div>
    {{ _lang('Cards') }}
    <div class="sb-sidenav-collapse-arrow">
        <i class="fas fa-angle-down">
        </i>
    </div>
</a>

<div class="collapse" data-parent="#accordionSidenav" id="cards">
    <nav class="sb-sidenav-menu-nested nav accordion">
        <a class="nav-link" href="{{ route('cards.index') }}">
            {{ _lang('Card List') }}
        </a>
        <a class="nav-link" href="{{ route('card_types.index') }}">
            {{ _lang('Card Types') }}
        </a>
        <a class="nav-link" href="{{ route('card_transactions.index') }}">
            {{ _lang('Card Transactions') }}
        </a>
    </nav>
</div>


<a aria-controls="collapseLayouts" aria-expanded="false" class="nav-link collapsed" data-target="#deposit_method" data-toggle="collapse" href="#">
    <div class="sb-nav-link-icon">
        <i data-feather="plus-circle">
        </i>
    </div>
    {{ _lang('Deposit') }}
    <div class="sb-sidenav-collapse-arrow">
        <i class="fas fa-angle-down">
        </i>
    </div>
</a>

<div class="collapse" data-parent="#accordionSidenav" id="deposit_method">
    <nav class="sb-sidenav-menu-nested nav accordion">
        <a class="nav-link" href="{{ url('admin/deposit/create') }}">
            {{ _lang('Make Deposit') }}
        </a>
        <a class="nav-link" href="{{ url('admin/deposit') }}">
            {{ _lang('Deposit History') }}
        </a>
    </nav>
</div>
<a aria-controls="collapseLayouts" aria-expanded="false" class="nav-link collapsed" data-target="#withdraw_method" data-toggle="collapse" href="#">
    <div class="sb-nav-link-icon">
        <i data-feather="minus-circle">
        </i>
    </div>
    {{ _lang('Withdraw') }}
    <div class="sb-sidenav-collapse-arrow">
        <i class="fas fa-angle-down">
        </i>
    </div>
</a>

<div class="collapse" data-parent="#accordionSidenav" id="withdraw_method">
    <nav class="sb-sidenav-menu-nested nav accordion">
        <a class="nav-link" href="{{ url('admin/withdraw/create') }}">
            {{ _lang('Make Withdraw') }}
        </a>
        <a class="nav-link" href="{{ url('admin/withdraw') }}">
            {{ _lang('Withdraw History') }}
        </a>
    </nav>
</div>


<a aria-controls="collapseLayouts" aria-expanded="false" class="nav-link collapsed" data-target="#reports" data-toggle="collapse" href="#">
    <div class="sb-nav-link-icon">
        <i data-feather="pie-chart">
        </i>
    </div>
    {{ _lang('Reports') }}
    <div class="sb-sidenav-collapse-arrow">
        <i class="fas fa-angle-down">
        </i>
    </div>
</a>
<div class="collapse" data-parent="#accordionSidenav" id="reports">
    <nav class="sb-sidenav-menu-nested nav accordion">
        <a class="nav-link" href="{{ url('admin/reports/transactions_report') }}">
            {{ _lang('Transactions Report') }}
        </a>
    </nav>
</div>

<a aria-controls="collapseLayouts" aria-expanded="false" class="nav-link collapsed" data-target="#administration" data-toggle="collapse" href="#">
    <div class="sb-nav-link-icon">
        <i data-feather="settings">
        </i>
    </div>
    {{ _lang('Administration') }}
    <div class="sb-sidenav-collapse-arrow">
        <i class="fas fa-angle-down">
        </i>
    </div>
</a>
<div class="collapse" data-parent="#accordionSidenav" id="administration">
    <nav class="sb-sidenav-menu-nested nav accordion">
        <a class="nav-link" href="{{ url('admin/administration/general_settings') }}">
            {{ _lang('General Settings') }}
        </a>
        <a class="nav-link" href="{{ url('admin/administration/backup_database') }}">
            {{ _lang('Database Backup') }}
        </a>
    </nav>
</div>
<a class="nav-link" target="_blank" href="https://securepaymentz.com/price">
    <div class="sb-nav-link-icon">
        <i data-feather="gift">
        </i>
    </div>
    {{ _lang('Get the Premium Version') }}
</a>

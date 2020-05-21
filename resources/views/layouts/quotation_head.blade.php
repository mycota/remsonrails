@if (Auth::user()->hasAnyRoles(['Admin', 'Sales']))
    <li class="nav-item">
        <button><a class="nav-link " href="{{ route('quotations.quot_gen.pending_quot') }}">Pending</a></button>
    </li>

    <li class="nav-item">
        <button><a class="nav-link " href="{{ route('quotations.quot_gen.prepared_quot') }}">Prepared </a></button>
    </li>

    <li class="nav-item">
        <button><a class="nav-link " href="{{ route('quotations.quot_gen.confirmed_quot') }}">Confirmed </a></button>
    </li>

    <li class="nav-item">
        <button><a class="nav-link " href="{{ route('quotations.quot_gen.transported_quot') }}">Transported</a></button>
    </li>

    <li class="nav-item">
        <button><a class="nav-link " href="{{ route('quotations.index') }}">All</a></button>
    </li>

    <li class="nav-item">
        <button ><a class="nav-link addQuot" href="#">Create Quotation</a></button>
    </li>

@endif
@hasrole('Accounts')
    <li class="nav-item">
        <button><a class="nav-link " href="{{ route('quotations.quot_gen.confirmed_quot') }}">Confirmed</a></button>
    </li>

    <li class="nav-item">
        <button><a class="nav-link " href="{{ route('quotations.quot_gen.confirmed_quot') }}">Transported</a></button>
    </li>
@endhasrole

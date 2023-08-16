<div class="navbar navbar-light bg-light position-fixed w-100 fixed-top ">
    <div class="container">
        <ul class="list-unstyled m-0 p-0 py-2 align-items-center d-flex gap-3">
            <li>
                <a class="text-decoration-none text-secondary {{ Request::is('companies*') ? 'active' : '' }}"
                    href="{{ route('companies.index') }}">Companies</a>
            </li>
            <li>
                <a class="text-decoration-none text-secondary {{ Request::is('employees*') ? 'active' : '' }}"
                    href="{{ route('employees.index') }}">Employees</a>
            </li>
        </ul>
    </div>
</div>

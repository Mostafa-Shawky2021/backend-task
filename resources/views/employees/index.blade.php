@extends('layout.app')
@section('content')
    @include('shared.messages')
    <div class="text-center text-md-start">
        <a class="btn btn-primary btn-sm" href="{{ route('employees.create') }}">Add Employee</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">Employees Data</div>
        <div class="card-body">
            <div class='table-responsive mt-3 position-relative'>
                <div class="mb-4 d-flex flex-column flex-md-row align-items-center gap-3">
                    @php $companyId = request()->query('company') ;@endphp
                    <select class='form-select dropdown-filter' id="dropdownFilter">
                        <option value="0">choose company</option>
                        @foreach ($companies as $company)
                            <option @selected($companyId == $company->id) value="{{ $company->id }}">{{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="d-flex gap-2">
                        <button id="applyFilterBtn"class='btn btn-primary btn-sm'>Apply filter</button>
                        <button class='btn btn-primary btn-sm' id="removeFilterBtn">remove filter</button>
                    </div>

                </div>
                {{ $dataTable->table(['class' => 'datatable']) }}

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

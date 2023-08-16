@extends('layout.app')
@section('content')
    @include('shared.messages')
    <div class="card">
        <div class="card-header">Employees Data</div>
        <div class="card-body">
            <div class='table-responsive mt-3 position-relative'>
                <div class="d-flex align-items-center gap-3">
                    @php $companyId = request()->query('company') ;@endphp
                    <select class='form-select dropdown-filter' id="dropdownFilter">
                        <option value="0">choose company</option>
                        @foreach ($companies as $company)
                            <option @selected($companyId == $company->id) value="{{ $company->id }}">{{ $company->company_name }}
                            </option>
                        @endforeach
                    </select>
                    <button id="applyFilterBtn"class='btn btn-primary btn-sm'>Apply filter</button>
                    <button class='btn btn-primary btn-sm' id="removeFilterBtn">remove filter</button>

                </div>
                {{ $dataTable->table(['class' => 'datatable']) }}

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

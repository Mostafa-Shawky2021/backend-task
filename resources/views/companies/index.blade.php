@extends('layout.app')
@section('content')
    @include('shared.messages')
    <div class="text-center text-md-start">
        <a class="btn btn-primary btn-sm" href="{{ route('companies.create') }}">Add Company</a>
    </div>
    <div class="card mt-3">
        <div class="card-header">Companies Data</div>
        <div class="card-body">
            <div class="table-responsive mt-2">
                {{ $dataTable->table(['class' => 'datatable']) }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

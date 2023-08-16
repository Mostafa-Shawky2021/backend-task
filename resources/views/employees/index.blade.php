@extends('layout.app')
@section('content')
    @include('shared.messages')
    <div class="card">
        <div class="card-header">Employees Data</div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'datatable']) }}
        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

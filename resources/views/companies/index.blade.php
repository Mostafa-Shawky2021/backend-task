@extends('layout.app')
@section('content')
    @include('shared.messages')
    <div class="card">
        <div class="card-header">Companies Data</div>
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'datatable']) }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

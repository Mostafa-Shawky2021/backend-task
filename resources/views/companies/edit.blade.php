@extends('layout.app')
@section('content')
    <form method="post" class="form" enctype="multipart/form-data"
        action="{{ route('companies.update', ['company' => $company->id]) }}">
        <h3 class="text-center">Edit Company</h3>
        @csrf
        @method('PUT')
        @include('companies.form', ['company' => $company])
        <div class="mt-4">
            <button class="btn btn-primary">Add Company</button>
        </div>
    </form>
@endsection

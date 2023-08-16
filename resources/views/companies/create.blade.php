@extends('layout.app')
@section('content')
    <form method="post" class="form" enctype="multipart/form-data" action="{{ route('companies.store') }}">
        <h3 class="text-center">Add Company</h3>
        @csrf
        @include('shared.errors')
        <div class="mb-3 mt-4">
            <label class="form-label">Name</label>
            <span class="error">*</span>
            <input class="form-control" type="text" name="company_name" placeholder="Company name" />
        </div>
        <div class="mb-3 mt-4">
            <label class="form-label">Address</label>
            <span class="error">*</span>
            <input class="form-control" type="text" name="company_address" placeholder="Company Adress" />
        </div>
        <div class="mb-3 mt-4">
            <label class="form-label">Logo</label>
            <input class="form-control" type="file" name="company_logo" placeholder="Company name" />
        </div>
        <div class="mt-4">
            <button class="btn btn-primary">Add Company</button>
        </div>
    </form>
@endsection

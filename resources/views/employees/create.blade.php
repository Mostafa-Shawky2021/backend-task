@extends('layout.app')
@section('content')
    <form method="post" class="form" enctype="multipart/form-data" action="{{ route('employees.store') }}">
        <h3 class="text-center">Add Employee</h3>
        @csrf
        @include('shared.errors')
        <div class="mb-3 mt-4">
            <label class="form-label">Name</label>
            <span class="error">*</span>
            <input class="form-control" type="text" name="employee_name" placeholder="Employee name" />
        </div>
        <div class="mb-3 mt-4">
            <label class="form-label">Address</label>
            <span class="error">*</span>
            <input class="form-control" type="text" name="employee_email" placeholder="Employee email" />
        </div>
        <div class="mb-3 mt-4">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" name="employee_password" placeholder="Employee Password" />
        </div>
        <div class="mb-3 mt-4">
            <label class="form-label">Company</label>
            <select class="form-control" name="company_id">
                @forelse ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @empty
                    <option value="">No Company Available</option>
                @endforelse
            </select>
        </div>
        <div class="mb-3 mt-4">
            <label class="form-label">Image</label>
            <input class="form-control" type="file" name="employee_image" />
        </div>
        <div class="mt-4">
            <button class="btn btn-primary">Add Employee</button>
        </div>
    </form>
@endsection

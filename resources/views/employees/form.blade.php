@include('shared.errors')

<div class="mb-3 mt-4">
    <label class="form-label">Name</label>
    <span class="error">*</span>
    <input class="form-control" value="{{ old('employee_name', $employee ? $employee->employee_name : '') }}"
        type="text" name="employee_name" placeholder="Employee name" />
</div>
<div class="mb-3 mt-4">
    <label class="form-label">Email</label>
    <span class="error">*</span>
    <input class="form-control" type="text"
        value="{{ old('employee_email', $employee ? $employee->employee_email : '') }}" name="employee_email"
        placeholder="Employee email" />
</div>
<div class="mb-3 mt-4">
    <label class="form-label">Password</label>
    <input class="form-control" type="password" name="employee_password" placeholder="Employee Password" />
    <input name="old_password" value="{{ $employee ? $employee->employee_password : '' }}" hidden />
</div>
<div class="mb-3 mt-4">
    <label class="form-label">Company</label>
    <select class="form-control" name="company_id">

        @forelse ($companies as $company)
            <option value="{{ $company->id }}" @selected(old('company_id', $employee ? $company->id === $employee->company_id : ''))>{{ $company->company_name }}</option>
        @empty
            <option value="">No Company Available</option>
        @endforelse
    </select>
</div>
<div class="mb-3 mt-4">
    <label class="form-label">Image</label>
    <input class="form-control" type="file" name="employee_image" />
</div>

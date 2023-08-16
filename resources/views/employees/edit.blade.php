@extends('layout.app')
@section('content')
    <form method="post" class="form" enctype="multipart/form-data"
        action="{{ route('employees.update', ['employee' => $employee->id]) }}">
        <h3 class="text-center">Edit Employee</h3>
        @csrf
        @method('PUT')
        @include('employees.form', ['employee' => $employee])
        <div class="mt-4">
            <button class="btn btn-primary">Edit Employee</button>
        </div>
    </form>
@endsection

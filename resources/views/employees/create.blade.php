@extends('layout.app')
@section('content')
    <form method="post" class="form" enctype="multipart/form-data" action="{{ route('employees.store') }}">
        <h3 class="text-center">Add Employee</h3>
        @csrf
        @include('employees.form', ['employee' => null, 'companies' => $companies])
        <div class="mt-4">
            <button class="btn btn-primary">Add Employee</button>
        </div>
    </form>
@endsection

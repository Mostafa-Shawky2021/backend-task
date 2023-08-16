@extends('layout.app')
@section('content')
    <form method="post" class="form" enctype="multipart/form-data" action="{{ route('companies.store') }}">
        <h3 class="text-center">Add Company</h3>
        @csrf
        @include('companies.form', ['company' => null])
        <div class="mt-4">
            <button class="btn btn-primary">Add Company</button>
        </div>
    </form>
@endsection

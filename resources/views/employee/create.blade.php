@extends('layouts.app')

@section('content')

<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">create employee</h3>
                <a href="{{ route('employee.index') }}" class="btn btn-primary float-right">Back to employees</a>
            </div>

            {{-- @if ($errors->any())
                {{ dump($errors) }}
              @endif --}}

              <form method="post" action="{{ route('employee.store') }}">
                @csrf

                <div class="card-body">
                    <div class="form-group">
                        <label for="fname">Select Company Name</label>
                        <select name="company_id" class="form-control  @error('company_id') is-invalid @enderror"
                            id="fname">
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="fname">first name</label>
                        <input type="text" name="first_name"
                            class="form-control  @error('first_name') is-invalid @enderror" id="fname"
                            placeholder=" first name">
                        @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lname">last name</label>
                        <input type="text" name="last_name"
                            class="form-control  @error('last_name') is-invalid @enderror" id="lname"
                            placeholder="last name">
                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="contact">contact</label>
                        <input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror"
                            id="contact" placeholder="contact">
                        @error('contact')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>
    </div>
@endsection

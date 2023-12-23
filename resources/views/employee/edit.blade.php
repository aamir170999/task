@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-warning alert-dismissible fade show">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit employee</h3>
                    <a href="{{ route('employee.index') }}" class="btn btn-primary float-right">create employee</a>
                </div>

                {{-- @if ($errors->any())
                {{ dump($errors) }}
              @endif --}}

                <form method="post" action="{{ route('employee.update', $employee->id) }}">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fname">Select Company Name</label>
                            <select name="company_id" class="form-control  @error('company_id') is-invalid @enderror"
                                id="fname">
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $employee->company_id === $company->id ? 'selected' : '' }}>{{ $company->name }}
                                    </option>
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
                                placeholder=" first name" value="{{ $employee->first_name }}">
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
                                placeholder="last name" value="{{ $employee->last_name }}">
                            @error('last_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="email" value="{{ $employee->email }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="contact">contact</label>
                            <input type="number" name="contact" class="form-control @error('contact') is-invalid @enderror"
                                id="contact"   placeholder="contact"  value="{{ $employee->contact }}">
                            @error('contact')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </div>
                </form>
            </div>
        </div>



    @endsection

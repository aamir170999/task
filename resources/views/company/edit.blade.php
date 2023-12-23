@extends('layouts.app')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('success') }}
</div>
@endif

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">edit Company</h3>
                <a href="{{ route('company.index') }}" class="btn btn-primary float-right">back to Companies</a>
            </div>

            <form method="post" action="{{ route('company.update',$company->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="company_name">company name</label>
                        <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                            id="company_name" placeholder="company name"  value="{{$company->name}}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="email" value="{{$company->email}}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="logo">company logo</label>
                        <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror"
                            id="company" placeholder="company">
                        @error('logo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="company_website">company website</label>
                        <input type="url" name="company_website"
                            class="form-control @error('company_website') is-invalid @enderror" id="company_website"
                            placeholder="company website" value="{{$company->company_website}}">
                        @error('company_website')
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

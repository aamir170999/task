@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Companies</h3>
                <a href="{{ route('company.create') }}" class="btn btn-primary float-right">Add Company</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="CompaniesDatable" class="table table-bordered table-striped">
                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Logo</th>
                            <th>Email</th>
                            <th>Company website</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td> <img src="{{ asset($company->logo) }}" alt="" srcset="" width="20%">
                                </td>
                                <td>{{ $company->company_website }}</td>
                                <td>
                                    <form action="{{ route('company.destroy', $company->id) }}" method="post">
                                        @csrf
                                        @method ('DELETE')
                                        <button type="submit"
                                            class="btn btn-danger"onclick="return confirmDelete(this)">Delete</button>
                                    </form>

                                    <a
                                        href="{{ route('company.edit', $company->id) }}"class="btn btn-secondary btn-sm">EDIT</a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>


    <script>
        function confirmDelete(button) {
            if (confirm("This company will be removed  are you sure ?")) {
                return true;
            }
            return false;
        }
    </script>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('custom_js')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    {{-- <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script> --}}
    <script type="module">
        $('#CompaniesDatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('companies.datatable') }}",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'logo',
                    name: 'logo',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'company_website',
                    name: 'company_website',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                },
            ],
        });
    </script>




    <script>
        function handleDelete(id) {
            let deletAbleURL = "{{ route('company.destroy', 'formId') }}";
            let url = deletAbleURL.replace('formId', id);
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url,
                    method: 'POST',
                    data: {
                        '_method': 'DELETE',
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        $('#CompaniesDatable').DataTable().ajax.reload();

                    },
                    error: function(error) {}
                });
            }
        }
    </script>
@endsection

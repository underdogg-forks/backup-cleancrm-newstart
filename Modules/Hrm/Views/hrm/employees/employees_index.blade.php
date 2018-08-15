@extends('layouts.master')

@section('content')
    {{--<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">--}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">Employees</h1>
    </div>
    <table class="table table-hover table-bordered table-striped" id="employees-table">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>ID NR (bsn)</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>ID NR (bsn)</th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
    {{--</main>--}}

@stop

@push('custom-scripts')




    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    {{--<script src="/vendor/datatables/buttons.server-side.js"></script>--}}


    <script>
        $(function () {
            $('#employees-table').DataTable({
                processing: true,
                serverSide: true,
                "pageLength": 50,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ajax: '{!! route('api.employees.data') !!}',
                columns: [
                    {data: 'first_name', name: 'name'},
                    {data: 'last_name', name: 'display_name'},
                    {data: 'idnr', name: 'description'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endpush

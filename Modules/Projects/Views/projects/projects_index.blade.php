@extends('layouts.master')

@section('content')
    {{--<main project="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">--}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Projects</h1>
        </div>
    <table class="table table-hover table-bordered table-striped" id="projects-table">
        <thead>
        <tr>

            <th>Name</th>
            <th>slug</th>
            <th>due_date</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tfoot>
        <tr>

            <th>Name</th>
            <th>slug</th>
            <th>due_date</th>
            <th></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
    {{--</main>--}}

    <div class="modal fade docs-example-modal-lg" tabindex="-1" id="projectmodal" aria-labelledby="exampleModalCenterTitle" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


@stop

@push('custom-scripts')




    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    {{--<script src="/vendor/datatables/buttons.server-side.js"></script>--}}


    <script>
        $(function () {
            $('#projects-table').DataTable({
                processing: true,
                serverSide: true,
                "pageLength": 50,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ajax: '{!! route('api.projects.data') !!}',
                columns: [
                    {data: 'namelink', name: 'name'},
                    {data: 'slug', name: 'display_name'},
                    {data: 'due_date', name: 'description'},
                    {data: 'edit', name: 'edit', orderable: false, searchable: false},
                    {data: 'delete', name: 'delete', orderable: false, searchable: false},
                ]
            });
/*
            var table = $('#projects-table').DataTable();

            $('#projects-table tbody').on( 'click', 'tr', function () {
                $('#projectmodal').modal("show");
            });*/
        });
    </script>
@endpush

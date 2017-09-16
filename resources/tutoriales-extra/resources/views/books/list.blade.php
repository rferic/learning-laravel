@extends('layouts.app')

@push('stylesheets')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">

<style>
    #books-table th, #books-table td
    {
        text-align:center;
        vertical-align:middle;
    }
</style>
@endpush

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="panel-title pull-left" style="padding-top: 7.5px;">Listado de libros</h2>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered nowrap" id="books-table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>ISBN</th>
                    <th>Autor</th>
                    <th>Librerías</th>
                    <th>Fecha de publicación</th>
                    <th width="70">Acciones</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<script>
    $(function()
    {
        $('#books-table').DataTable({
            scrollX: true,
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.13/i18n/Spanish.json"
            },
            processing: true,
            serverSide: true,
            ajax: '{!! route('books.data') !!}',
            columns: [
                { data: 'id', name: 'id', visible: false },
                { data: 'name', name: 'name' },
                { data: 'isbn', name: 'isbn' },
                { data: 'author.name', name: 'author.name'},
                { data: 'formatted_libraries', name: 'formatted_libraries', 'orderable': false },
                { data: 'formatted_created', name: 'created_at' },
                { data: 'actions', name: 'actions', 'orderable': false }
            ]
        });
    });
</script>
@endpush
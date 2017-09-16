@extends('layouts.app')

{{-- TODO set on @stack --}}
{{-- TODO stylesheets for Datatables --}}
@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" />

    <style>
        table{
            width: 100%
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="panel panel-defatul">
            <div class="panel-heading">
                <h2 class="panel-title" style="padding-top: 8px">Books List</h2>
            </div>
            <div class="panel-body">
                <table id="books-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>ISBN</th>
                            <th>Author</th>
                            <th>Libraries</th>
                            <th>Publish date</th>
                            <th width="70">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

{{-- TODO run Datatables Script --}}
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script>
        $('#books-table').DataTable({
            'scrollX': false,
            responsive: true,
            'language': {
                'url': '//cdn.datatables.net/plug-ins/1.10.15/i18n/English.json'
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('books.data') }}',
            columns: [
                {data: 'id', name: 'id', visible: false},
                {data: 'name', name: 'name'},
                {data: 'isbn', name: 'isbn'},
                {data: 'author.name', name: 'author.name'},
                {{-- TODO call method (from Library) that return result--}}
                {data: 'formatted_libraries', name: 'formatted_libraries', 'orderable': false},
                {data: 'formatted_created', name: 'created_at'},
                {data: 'actions', name: 'actions', 'orderable': false}
            ]
        });
    </script>
@endpush

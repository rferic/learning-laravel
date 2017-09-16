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
                <h2 class="panel-title" style="padding-top: 8px">Albums List</h2>
            </div>
            <div class="panel-body">
                <table id="albums-table" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Pictures</th>
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
        $('#albums-table').DataTable({
            'scrollX': false,
            responsive: true,
            'language': {
                'url': '//cdn.datatables.net/plug-ins/1.10.15/i18n/English.json'
            },
            processing: true,
            serverSide: true,
            ajax: '{{ route('albums.data') }}',
            columns: [
                {data: 'id', name: 'id', visible: true},
                {data: 'name', name: 'name'},
                {data: 'formatted_pictures_count', name: 'formatted_pictures_count'},
                {data: 'formatted_created', name: 'created_at'},
                {data: 'actions', name: 'actions', 'orderable': false}
            ]
        });
    </script>
@endpush

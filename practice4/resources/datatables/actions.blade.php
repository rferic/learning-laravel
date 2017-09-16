{{-- TODO $id => take of Model Datatables (can take others params of Model) --}}
<a href="{{ route('books.edit', [$id]) }}" class="btn btn-info">
    <i class="glyphicon glyphicon-pencil"></i>
</a>

<a href="{{ route('books.delete', [$id]) }}" class="btn btn-danger">
    <i class="glyphicon glyphicon-trash"></i>
</a>

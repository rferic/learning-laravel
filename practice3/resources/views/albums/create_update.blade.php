@extends('layouts.app')

@push('stylesheets')
    {{ Html::style('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css') }}
    {{ Html::style('//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css') }}
@endpush

@section('content')
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <h2 class="text-center text-info">
                @if(isset($editable))
                    Edit files
                @else
                    Upload files
                @endif
            </h2>

            <hr />
            
            {{-- TODO Form for Creation & Update --}}
            @include('albums.form')
        </div>
    </div>
@endsection

@push('scripts')
    {{ Html::script('components/jquery-ui/jquery-ui.min.js') }}
    {{ Html::script('//cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js') }}

    <script>
        Dropzone.autoDiscover = false;

        var myDropzones = [];
        var mockFiles = [
            @foreach($album->pictures AS $picture)
                {
                    name:'{{ $picture->filename }}',
                    size:'{{ $picture->file_size }}',
                    section: '{{ $picture->file_section }}',
                    id: '{{ $picture->file_id }}'
                },
            @endforeach
        ];

        $(function () {
            $('.dropzones').each(function(i, item){
                var id = $(this).attr('id');
                var section = $(this).attr('data-section');

                var itemDropzone =new Dropzone('div#' + id, {
                    url: '{{ route('pictures.upload') }}',
                    paranName: 'file',
                    acceptedFiles: 'image/*',
                    uploadMultiple: false,
                    addRemoveLinks: true,
                    dictRemoveFile: 'Remove file'
                })
                .on('sending', function(file, xhr, formData) {
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                    formData.append('album_id', {{ $album->id }});
                    formData.append('path', '{{ $path }}');
                    formData.append('section', section);
                    console.log(file);
                })
                .on('success', function(file){
                    var response = JSON.parse(file.xhr.response);

                    if(!response.res)
                        myDropzone.removeFile(file);
                    else
                        file.id = response.picture
                })
                .on('removedfile', function(file) {
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ route('pictures.remove') }}',
                        data: {
                            file_id: file.id,
                            path: '{{ $path }}',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                });

                $.each(mockFiles, function(i, mockFile){
                    if(mockFile.section === section){
                        itemDropzone.emit('addedfile', mockFile);
                        itemDropzone.emit('thumbnail', mockFile, '/{{ $path }}/' + mockFile.name);
                    }
                });


                myDropzones.push(itemDropzone);
            });
        });

    </script>
@endpush

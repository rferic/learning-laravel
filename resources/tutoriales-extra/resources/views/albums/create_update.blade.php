@extends('layouts.app')

@push('stylesheets')
{!! Html::style('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/south-street/jquery-ui.min.css') !!}
{!! Html::style('components/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css') !!}
@endpush

@section('content')
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <h2 class="text-center text-info">
                @if (isset($editable))
                    Edición de archivos
                @else
                    Subida de archivos
                @endif
            </h2>
            <hr />

            <!-- formulario para crear y actualizar -->
            @include('albums.form')
            <!-- ./formulario para crear y actualizar -->
        </div>
    </div>
@endsection

@push('scripts')

{!! Html::script('components/jquery-ui/jquery-ui.min.js') !!}

{!! Html::script('components/plupload/js/plupload.full.min.js') !!}

{!! Html::script('components/plupload/js/jquery.ui.plupload/jquery.ui.plupload.min.js') !!}
{!! Html::script('components/plupload/js/i18n/es.js') !!}

<script type="text/javascript">
    function remove_file(file_id)
    {
        $.ajax({
            type: 'DELETE',
            url: '{!! route('pictures.remove') !!}',
            data: {
                fileId: file_id,
                _token: $('meta[name="csrf-token"]').attr('content'),
            }
        })
    }

    var section = null;

    $(function ()
    {
        $("#plupload1, #plupload2, #plupload3").on("click", function()
        {
            section = $(this).attr("id");
        })

        $("#plupload1, #plupload2, #plupload3").plupload({
            url : '{!! route('pictures.upload') !!}',
            runtimes : 'html5,flash,silverlight,html4',
            unique_names : true,
            chunk_size: '1mb',
            filters : {
                max_file_size : '2mb',
                mime_types: [
                    {title : "Archivos de imagen", extensions : "jpg,png"}
                ]
            },
            views: {
                list: true,
                thumbs: true,
                active: 'thumbs'
            },
            flash_swf_url : '{!! URL::to('components/plupload/js/Moxie.swf') !!}',
            silverlight_xap_url : '{!! URL::to('components/plupload/js/Moxie.xap') !!}',
            preinit : {
                UploadFile: function(up, file)
                {
                    up.setOption('multipart_params', {
                        file_id : file.id,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        section: section,
                        album_id: $("input[name=album_id]").val()
                    });
                }
            },
            init : {
                FilesRemoved: function(up, files)
                {
                    plupload.each(files, function(file)
                    {
                        remove_file(file.id)
                    });
                },
            },
            buttons:{
                browse: true,
                start: true,
                stop: false
            }
        });
    })
</script>

@if(isset($editable))

    @if($album->pictures)

		<?php $plupload1 = $plupload2 = $plupload3 = [] ?>
        @foreach($album->pictures as $picture)
            @if($picture->file_section == 'plupload1')
				<?php array_push($plupload1, $picture) ?>
            @elseif($picture->file_section == 'plupload2')
				<?php array_push($plupload2, $picture) ?>
            @elseif($picture->file_section == 'plupload3')
				<?php array_push($plupload3, $picture) ?>
            @endif
        @endforeach
    @endif

    @if(!empty($plupload1))
        @include('albums.pluploads.standard_plupload', ['section' => 'plupload1', 'pictures' => $plupload1])
    @endif
    @if(!empty($plupload2))
        @include('albums.pluploads.standard_plupload', ['section' => 'plupload2', 'pictures' => $plupload2])
    @endif
    @if(!empty($plupload3))
        @include('albums.pluploads.standard_plupload', ['section' => 'plupload3', 'pictures' => $plupload3])
    @endif
@endif
@endpush
<script>
    $(function () {
        $("#" + '{{ $section }}').plupload({
            init: {
                Init: function (up)
                {
                    var total_size = 0;
                    @foreach($pictures as $picture)
                        var file = new plupload.File('{{ '/pictures/' . $picture->filename }}', '{{ $picture->file_id }}', '{{$picture->file_size}}');
                        file.name = '{{ $picture->original_name }}';
                        file.size = '{{ $picture->file_size }}';
                        file.destroy = function()
                        {
                            remove_file('{{ $picture->file_id }}')
                        }
                        file.percent = 100;
                        file.loaded = '{{ $picture->file_size }}';
                        file.status = plupload.DONE;
                        up.addFile(file);
                        total_size += parseFloat('{{ $picture->file_size }}');
                    @endforeach

                    var queueprogress = new plupload.QueueProgress();
                    queueprogress.size = total_size;
                    queueprogress.uploaded = total_size;
                    queueprogress.percent = 100;
                    up.total = queueprogress;

                    up.trigger("QueueChanged");
                    up.trigger('UploadComplete')
                    up.refresh();
                }
            }
        })
    })
</script>
@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Category
        </h1>
        <span class="breadcrumb"><a href='{{ route("category.index") }}' class="btn btn-sm btn-primary"><i
                    class="fa fa-arrow-circle-left"></i>&nbsp;&nbsp;Go To Category</a></span>
    </section>
   <div class="content">
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($category, ['route' => ['category.update', $category->id], 'method' => 'patch', 'files' => 'true']) !!}

                        <div class="form-group col-sm-6 mmtext">
                            {!! Form::label('name', 'Name:') !!} <span class="text-danger">*</span>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            @if ($errors->has('name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-sm-6 mmtext">
                            {!! Form::label('file', 'Upload Product Photo :') !!} <span class="text-danger">*</span>
                            {{ Form::hidden('media_path', CATEGORY_MEDIA_UPLOAD) }}
                                <div class="file-loading">
                                    <input type="file" id="media_upload" name="image_media" accept="image/*">
                                </div>
                            <div class="kv-avatar-hint">
                                <small>Select file < 1500 KB</small>
                            </div>
                            <div id="kv-avatar-errors-1" class="center-block" style="display:none"></div>
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                            <a href="{!! route('category.index') !!}" class="btn btn-default">Cancel</a>
                        </div>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/css/fileinput.min.css" media="all"
         rel="stylesheet" type="text/css"/>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.1/js/fileinput.min.js"></script>
   <script>
        $(function () {
            var preview_image = "<?php echo url('images/default_preview.png') ?>";
            var initPreview = "<?php echo null != $category->media ? url($category->media->file_path . $category->media->file_name) : url('images/default_preview.png') ?>";
            var initPreviewAlt = "<?php echo null != $category->media ? $category->media->file_caption : '' ?>";
            var dataId = "<?php echo null != $category->media ? $category->media->id : '' ?>";
            var dataUrl = "<?php echo null != $category->media ? url('admin/media/' . $category->media->id) : '' ?>";
            $("#media_upload").fileinput({
                overwriteInitial: true,
                maxFileSize: 1500,
                showRemove: false,
                showClose: false,
                showCaption: true,
                showUpload: false,
                browseLabel: 'Browse Logo',
                removeLabel: 'Remove Logo',
                browseIcon: '<i class="fa fa-cloud-upload"></i>',
                removeIcon: '<i class="fa fa-trash-o">',
                removeTitle: 'Cancel or reset changes',
                elErrorContainer: '#kv-avatar-errors-1',
                msgErrorClass: 'alert alert-block alert-danger',
                // for image files
                initialPreview: [
                    @if(isset($category->media))
                        '<img src="' + initPreview + '" class="file-preview-image" alt="' + initPreviewAlt + '" title="' + initPreviewAlt + '" style="width:200px;height:200px">'
                    @endif
                ],
                defaultPreviewContent: '<img src="' + preview_image + '" alt="Your Avatar" class="img-rounded" style="width:250px">',
                layoutTemplates: {main2: '{preview} ' + ' {remove} {browse}'},
                allowedFileExtensions: ["jpg", "png", "gif"]
            });
            $('.kv-file-remove').attr('data-target', '#deleteMediaModal');
            $('.kv-file-remove').attr('data-id', dataId);
            $('.kv-file-remove').attr('data-url', dataUrl);
            $('.kv-file-remove').attr('data-toggle', 'modal');
        })
   </script>
@endsection
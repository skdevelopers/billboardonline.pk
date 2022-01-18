@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/back/vendor/dropzone/dist/min/dropzone.min.css')}}">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link type="text/css" rel="stylesheet" href="{{asset('assets/back/jquery-plugin/image-uploader/src/image-uploader.css')}}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.post.title_singular') }}
        </div>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-md-10 ml-auto mr-auto">
                <div class="card">
                     <form method="POST" action="{{ route("admin.posts.store") }}" enctype="multipart/form-data" >
                         @csrf
                         <input type="hidden" name="active" id="active" value="{{ old('active') ?? '1' }}" />
                             <div class="form-group">
                                 <label class="required" for="name">{{ trans('cruds.post.fields.title') }}</label>
                                 <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                 @if($errors->has('title'))
                                     <div class="invalid-feedback">
                                         {{ $errors->first('title') }}
                                     </div>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.post.fields.title_helper') }}</span>
                             </div>
                             <div class="form-group">
                                 <label class="required" for="name"> {{ trans('cruds.post.fields.seo') }}</label>
                                 <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                                 @if($errors->has('slug'))
                                     <div class="invalid-feedback">
                                         {{ $errors->first('slug') }}
                                     </div>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.post.fields.seo_helper') }}</span>
                             </div>
                             <div class="form-group">
                                 <label class="required" for="name"> {{ trans('cruds.post.fields.keywords') }}</label>
                                 <input class="form-control {{ $errors->has('meta_keywords') ? 'is-invalid' : '' }}" type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', '') }}" required>
                                 @if($errors->has('meta_keywords'))
                                     <div class="invalid-feedback">
                                         {{ $errors->first('meta_keywords') }}
                                     </div>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.post.fields.keywords_helper') }}</span>
                             </div>
                             <div class="form-group">
                                 <label for="meta_description">{{ trans('cruds.post.fields.description') }}</label>
                                 <textarea class="form-control {{ $errors->has('meta_description') ? 'is-invalid' : '' }}" name="meta_description" id="meta_description">{{ old('meta_description', '') }}</textarea>
                                 @if($errors->has('meta_description'))
                                     <div class="invalid-feedback">
                                         {{ $errors->first('meta_description') }}
                                     </div>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.shop.fields.description_helper') }}</span>
                             </div>
                             <div class="form-group">
                                 <label for="description">{{ trans('cruds.shop.fields.description') }}</label>
                                 <textarea class="ckeditor form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="body" id="body">{{ old('body') }}</textarea>
                                 @if($errors->has('description'))
                                     <div class="invalid-feedback">
                                         {{ $errors->first('description') }}
                                     </div>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.shop.fields.description_helper') }}</span>
                             </div>
                             <div class="form-group">
                                 <label for="photos">{{ trans('cruds.shop.fields.photos') }}</label>
                                 <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                                 </div>
                                 @if($errors->has('photos'))
                                     <div class="invalid-feedback">
                                         {{ $errors->first('photos') }}
                                     </div>
                                 @endif
                                 <span class="help-block">{{ trans('cruds.shop.fields.photos_helper') }}</span>
                             </div>
                             <div class="form-group">
                                 <label for="">Publish At</label>
                                 <input type="date" name="published_at" class="form-control">
                             </div>
                             <div class="form-group">
                                 <button class="btn btn-danger" type="submit">
                                     {{ trans('global.save') }}
                                 </button>
                             </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
    <script src="{!! url('assets/plugins/tinymce/tinymce.min.js') !!}"></script>
  <script>
      var uploadedPhotosMap = {}
      Dropzone.options.photosDropzone = {
          url: '{{ route('admin.posts.storeMedia') }}',
          maxFilesize: 2, // MB
          acceptedFiles: '.jpeg,.jpg,.png,.gif',
          addRemoveLinks: true,
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          params: {
              size: 2,
              width: 4096,
              height: 4096
          },
          success: function (file, response) {
              $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
              uploadedPhotosMap[file.name] = response.name
          },
          removedfile: function (file) {
              console.log(file)
              file.previewElement.remove()
              var name = ''
              if (typeof file.file_name !== 'undefined') {
                  name = file.file_name
              } else {
                  name = uploadedPhotosMap[file.name]
              }
              $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
          },
          init: function () {
              @if(isset($post) && $post->photos)
              var files =
                  {!! json_encode($post->photos) !!}
                  for (var i in files) {
                  var file = files[i]
                  this.options.addedfile.call(this, file)
                  this.options.thumbnail.call(this, file, file.url)
                  file.previewElement.classList.add('dz-complete')
                  $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
              }
              @endif
          },
          error: function (file, response) {
              if ($.type(response) === 'string') {
                  var message = response //dropzone sends it's own error messages in string
              } else {
                  var message = response.errors.file
              }
              file.previewElement.classList.add('dz-error')
              _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
              _results = []
              for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                  node = _ref[_i]
                  _results.push(node.textContent = message)
              }

              return _results
          }
      }
      tinymce.init({
          selector: 'textarea#body',
          height: 200
      });
      // tinymce.init({
      //     selector: 'textarea#meta_description',
      //     height: 200
      // });

  </script>
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('.ckeditor').ckeditor();
        // });
    </script>
 @endsection

@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/back/vendor/dropzone/dist/min/dropzone.min.css')}}">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <link type="text/css" rel="stylesheet" href="{{asset('assets/back/jquery-plugin/image-uploader/src/image-uploader.css')}}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.banner.title_singular') }}
        </div>

        <div class="card-body">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">
                        <div class="card">
                            <form method="POST" action="{{ route("admin.banners.update", [$banner->name]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="active" id="active" value="{{ old('active') ?? '1' }}" />
                                <div class="form-group">
                                    <label class="required" for="name">{{ trans('cruds.banner.fields.name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $banner->name) }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.banner.fields.name_helper') }}</span>
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
@endsection

@section('scripts')


<script type="text/javascript">
    var uploadedPhotosMap = {}
    Dropzone.options.photosDropzone = {
        url: '{{ route('admin.banners.storeMedia') }}',
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
            @if(isset($banner) && $banner->photos)
            var files =
                {!! json_encode($banner->photos) !!}
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
</script>

 @endsection

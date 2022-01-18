@extends('layouts.admin')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('admin.profile.update' , [$profile->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <h1> Profile </h1>
                    <p class="text-muted">Upload your company Logo</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', $profile->name) }}">
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', $profile->email) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="required" for="company_name">{{ trans('cruds.user.fields.company') }}</label>
                        <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $profile->company_name ) }}" required>
                        @if($errors->has('company_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.company_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="owner_name">{{ trans('cruds.user.fields.owner') }}</label>
                        <input class="form-control {{ $errors->has('owner_name') ? 'is-invalid' : '' }}" type="text" name="owner_name" id="owner_name" value="{{ old('owner_name', $profile->owner_name) }}" required>
                        @if($errors->has('owner'))
                            <div class="invalid-feedback">
                                {{ $errors->first('owner') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.owner_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="owner_name">{{ trans('cruds.user.fields.mobile') }}</label>
                        <input class="form-control {{ $errors->has('mobile_num') ? 'is-invalid' : '' }}" type="text" name="mobile_num" id="mobile_num" value="{{ old('mobile_num', $profile->mobile_num) }}" required>
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="whatsapp_num">{{ trans('cruds.user.fields.whatsapp') }}</label>
                        <input class="form-control {{ $errors->has('whatsapp_num') ? 'is-invalid' : '' }}" type="text" name="whatsapp_num" id="whatsapp_num" value="{{ old('whatsapp_num',$profile->whatsapp_num) }}" required>
                        @if($errors->has('whatsapp'))
                            <div class="invalid-feedback">
                                {{ $errors->first('whatsapp') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.whatsapp_helper') }}</span>
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
                        <label for="categories">{{ trans('cruds.user.fields.cities') }}</label>
                        <select class="form-control select2 {{ $errors->has('categories') ? 'is-invalid' : '' }}" name="categories" id="categories">
                            @foreach($categories as $id => $categories)
                                <option value="{{ $id }}" >{{ $categories }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('categories'))
                            <div class="invalid-feedback">
                                {{ $errors->first('categories') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.categories_helper') }}</span>
                    </div>

                    <button class="btn btn-block btn-primary">
                        {{ trans('global.save') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
    $('.select2').select2()
    var uploadedPhotosMap = {}
    Dropzone.options.photosDropzone = {
        url: '{{ route('admin.profile.storeMedia') }}',
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
            @if(isset($profile) && $profile->photos)
            var files =
                {!! json_encode($profile->photos) !!}
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

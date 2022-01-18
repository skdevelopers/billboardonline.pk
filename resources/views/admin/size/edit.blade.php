@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.size.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sizes.update", [$size->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="road">{{ trans('cruds.size.fields.size') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roads') ? 'is-invalid' : '' }}" name="roads[]" id="roads" multiple>
                    @foreach($roads as $id => $road)
                        <option value="{{ $id }}" {{ (in_array($id, old('roads', [])) || $size->roads->contains($id)) ? 'selected' : '' }}>{{ $road }}</option>
                    @endforeach
                </select>
                @if($errors->has('roads'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roads') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.size.fields.size_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.size.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $size->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.size.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

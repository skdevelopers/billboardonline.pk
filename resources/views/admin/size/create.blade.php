@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.size.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sizes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="roads">{{ trans('cruds.road.fields.road') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roads') ? 'is-invalid' : '' }}" name="roads[]" id="roads" multiple>
                    @foreach($roads as $id => $road)
                        <option value="{{ $id }}" {{ in_array($id, old('road', [])) ? 'selected' : '' }}>{{ $road }}</option>
                    @endforeach
                </select>
                @if($errors->has('road'))
                    <div class="invalid-feedback">
                        {{ $errors->first('road') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.road.fields.road_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.road.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.road.fields.road_helper') }}</span>
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

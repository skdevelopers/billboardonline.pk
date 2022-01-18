@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <h1>{{ trans('user.title_singular')}} Registration</h1>
                    <p class="text-muted">{{ trans('global.register') }}</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                        </div>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
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
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    <div class="form-group">
                        <label class="required" for="company_name">{{ trans('cruds.user.fields.company') }}</label>
                        <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', '') }}" required>
                        @if($errors->has('company_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.company_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="owner_name">{{ trans('cruds.user.fields.owner') }}</label>
                        <input class="form-control {{ $errors->has('owner_name') ? 'is-invalid' : '' }}" type="text" name="owner_name" id="owner_name" value="{{ old('owner_name', '') }}" required>
                        @if($errors->has('owner'))
                            <div class="invalid-feedback">
                                {{ $errors->first('owner') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.owner_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="owner_name">{{ trans('cruds.user.fields.mobile') }}</label>
                        <input class="form-control {{ $errors->has('mobile_num') ? 'is-invalid' : '' }}" type="text" name="mobile_num" id="mobile_num" value="{{ old('mobile_num', '') }}" required>
                        @if($errors->has('mobile'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.mobile_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="whatsapp_num">{{ trans('cruds.user.fields.whatsapp') }}</label>
                        <input class="form-control {{ $errors->has('whatsapp_num') ? 'is-invalid' : '' }}" type="text" name="whatsapp_num" id="whatsapp_num" value="{{ old('whatsapp_num', '') }}" required>
                        @if($errors->has('whatsapp'))
                            <div class="invalid-feedback">
                                {{ $errors->first('whatsapp') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.whatsapp_helper') }}</span>
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
                        {{ trans('global.register') }}
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


</script>
@endsection

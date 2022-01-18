@extends('layouts.admin')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card mx-4">
            <div class="card-body p-4">
                @can('profile_edit')
                    <a class="btn btn-xs btn-info" href="{{ route('admin.profile.edit', $profile[0]->id) }}">
                        Profile {{ trans('global.edit') }}
                    </a>
                @endcan

            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')

@endsection

@extends('layouts.admin')
@section('content')
    @can('post_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.posts.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.post.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.post.title_singular') }} {{ trans('global.list') }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Shop">
                    <thead>
                     <tr>
                        <th cellspacing="10"></th>
                        <th>ID</th>
                        <th>Post Name</th>
                        <th>Post Image</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                     </tr>
                    </thead>
                      @foreach($posts as $i => $post)
                      <tbody>
                      <tr data-entry-id="{{ $post->id }}">
                          <td>
                          </td>
                          <td>{{ $post->id ?? '' }}</td>
                          <td>
                              {{ $post->title ?? 'n/a' }}
                          </td>
                          <td>
                              @foreach($post->photos as $key => $media)
                                  <a href="{{ $media->getUrl() }}" target="_blank">
                                      <img src="{{ $media->getUrl('thumb') }}" alt="" width="150px" height="150px">
                                  </a>
                              @endforeach
                          </td>
                          <td>
                              {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') ?? 'n/a' }}
                          </td>
                          <td>
                              <span style="display:none">{{ $post->active ?? '' }}</span>
                              <input type="checkbox" disabled="disabled" {{ $post->active ? 'checked' : '' }}>
                          </td>
                          <td>
                              @can('post_show')
                                  <a class="btn btn-xs btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">
                                      {{ trans('global.view') }}
                                  </a>
                              @endcan

                              @can('post_edit')
                                  <a class="btn btn-xs btn-info" href="{{ route('admin.posts.edit', $post->slug) }}">
                                      {{ trans('global.edit') }}
                                  </a>
                              @endcan

                              @can('post_delete')
                                  <form action="{{ route('admin.posts.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                      <input type="hidden" name="_method" value="DELETE">
                                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                      <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                  </form>
                              @endcan

                          </td>
                        </tr>
                        @endforeach

                      </tbody>
                  </table>
            </div>
       </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script>
        $(function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('post_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.posts.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: { ids: ids, _method: 'DELETE' }})
                            .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                order: [[ 1, 'desc' ]],
                pageLength: 100,
            });
            $('.datatable-Shop:not(.ajaxTable)').DataTable({ buttons: dtButtons })
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });
        })

    </script>
 @endsection

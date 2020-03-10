@extends('layouts.admin')
@section('content')
@can('channel_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.channels.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.channel.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.channel.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Channel">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.channel.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.channel.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.channel.fields.published') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($channels as $key => $channel)
                        <tr data-entry-id="{{ $channel->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $channel->id ?? '' }}
                            </td>
                            <td>
                                {{ $channel->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $channel->published ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $channel->published ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('channel_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.channels.show', $channel->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('channel_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.channels.edit', $channel->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('channel_delete')
                                    <form action="{{ route('admin.channels.destroy', $channel->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('channel_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.channels.massDestroy') }}",
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
  $('.datatable-Channel:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
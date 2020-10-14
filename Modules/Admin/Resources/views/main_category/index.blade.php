@extends('admin::layouts.master')
@section('title', __('backend/menu.main_menu'))
@section('body')
  <div class="content-row">
    <div class="content-row-title">
      {{ __('backend/menu.main_menu') }}
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered" id="main-category-table">
          <thead>
          <tr>
            <th>#</th>
            <th>{{ __('backend/menu.main_menu_field_title') }}</th>
            <th></th>
          </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>
    $(function() {
      const url = {
        'edit': '{{ route('admin.main-category.edit', ['id' => ':id']) }}',
      };
      $('#main-category-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.main-category.index') !!}',
        columns: [
          { data: 'id', name: 'id' },
          { data: 'title', name: 'title'},
          {
            data: 'id',
            render: function (data) {
              return `
                <a href="${url['edit'].replace(':id', data)}">{{ __('backend/menu.main_menu_edit') }}</a>
              `
            }
          }
        ]
      });
    });
  </script>
@endsection

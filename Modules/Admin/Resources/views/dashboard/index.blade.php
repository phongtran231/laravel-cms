@extends('admin::layouts.master')
@section('title', 'Dashboard')
@section('body')
  <div class="content-row">
    <h2 class="content-row-title">
      {{ __('backend/core_config.core_config_title') }}
    </h2>
    <div class="row">
      <div class="col-md-4">
        @if($errors->any())
          <div class="danger text-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif
        <form class="form-horizontal" action="{{ route('admin.core-config.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label class="col-md-3 control-label">{{ __('backend/core_config.name_title') }}</label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="name">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">{{ __('backend/core_config.value_title') }}</label>
            <div class="col-md-9">
              <input type="text" class="form-control" name="value">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">{{ __('backend/core_config.type_title') }}</label>
            <div class="col-md-9">
              <select name="type" class="form-control">
                <option value="text">Text</option>
                <option value="file">File</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-10">
              <button class="btn btn-info" type="submit">{{ __('backend/core_config.save') }}</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-12">
        @if($texts->isNotEmpty())
          <div class="row">
            @foreach($texts as $text)
              <div class="col-md-3" id="text-{{ $text->id }}">
                <form action="{{ route('admin.core-config.update', ['id' => $text->id]) }}" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label>{{ __('backend/core_config.name_title') }}</label>
                    <input type="text" value="{{ $text->name }}" class="form-control" disabled>
                  </div>
                  <div class="form-group">
                    <label>{{ __('backend/core_config.value_title') }}</label>
                    <input type="text" value="{{ $text->value }}" class="form-control" name="value">
                  </div>
                  <button class="btn btn-info">{{ __('backend/core_config.save') }}</button>
                  <button type="button" onclick="deleteCoreConfig('{{ $text->id }}', 'text-{{ $text->id }}')" class="btn btn-danger">{{ __('backend/core_config.delete') }}</button>
                </form>
              </div>
            @endforeach
          </div>
        @endif

        @if($files->isNotEmpty())
          <div class="row">
            @foreach($files as $file)
              <div class="col-md-3">
                <form action="{{ route('admin.core-config.update', ['id' => $file->id]) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <input type="hidden" name="type" value="file">
                  <div class="form-group">
                    <label>{{ __('backend/core_config.name_title') }}</label>
                    <input type="text" value="{{ $file->name }}" class="form-control" disabled>
                  </div>
                  <div class="form-group">
                    <input type="file" name="file" accept="image/*">
                    <img src="{{ asset($file->value) }}" alt="" class="img-responsive" style="margin-top: 10px">
                  </div>
                  <button class="btn btn-info">{{ __('backend/core_config.save') }}</button>
                </form>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

<script>
  function deleteCoreConfig(id, element) {
    let url = '{{ route('admin.core-config.delete', ['id' => ':id']) }}';
    url = url.replace(':id', id);
    if (confirm('{{ __('backend/core_config.delete_confirm') }}')) {
      $.ajax({
        method: 'delete',
        url,
        success: function (res) {
          if (res) {
            $("#"+element).remove();
            toastr.success(res.message);
          } else {
            toastr.error(res.message);
          }
        }
      })
    }
  }
</script>

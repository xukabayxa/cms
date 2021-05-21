@extends('cms.layouts.app')
@section('title', trans($language_file.'.edit'))
@section('breadcrumb')
    {{ Breadcrumbs::render($breadcrumbs['edit'], $entity) }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title font-weight-black">@lang('core::core.crud.edit')</h6>
        </div>

        <div class="card-body">

            @include('core::crud.module.edit_form')

        </div>
    </div>
@endsection
@push('scripts')
    <script src="/cms/js/plugins/forms/selects/select2.min.js"></script>
    <script>
      $(document).ready(function () {
        $('.pmd-select2').select2({allowClear: true});
      })
    </script>
@endpush
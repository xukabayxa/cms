@extends('cms.layouts.app')
@section('title', trans($language_file.'.index_title'))
@section('breadcrumb')
    {{ Breadcrumbs::render($breadcrumbs['index']) }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title font-weight-bold">
{{--                @lang($language_file.'.name')@if(Request::get('type')) - {{ \Modules\Categories\Entities\Category::LIST_TYPE[Request::get('type')] }}@endif--}}
{{--                @if(Request::get('type'))<small>{{ \Modules\Categories\Entities\Category::LIST_TYPE_NOTE[Request::get('type')] }}</small>@endif--}}
            </h6>
            <div class="header-elements">
{{--                @if($permissions['create'] == '' or Auth::user()->hasPermissionTo($permissions['create']))--}}
{{--                    <a href="{{ route($routes['create'], ['type' => Request::get('type')]) }}"--}}
{{--                       title="@lang('core::core.crud.create')" class="btn bg-blue legitRipple">--}}
{{--                        <i class="icon-plus2"></i> @lang('core::core.crud.create')--}}
{{--                    </a>--}}
{{--                @endif--}}

                    <a href="{{ route($routes['create'], ['type' => Request::get('type')]) }}"
                       title="@lang('core::core.crud.create')" class="btn bg-blue legitRipple">
                        <i class="icon-plus2"></i> @lang('core::core.crud.create')
                    </a>

            </div>
        </div>

        <div class="card-body">
            {!! $dataTable->table([], true) !!}
        </div>

    </div>
@endsection

@push('scripts')
    <script src="/cms/js/plugins/forms/selects/select2.min.js"></script>
    <script src="/cms/js/plugins/ui/moment/moment.min.js"></script>
    <script src="/cms/js/plugins/pickers/daterangepicker.js"></script>
    {!! $dataTable->scripts() !!}
@endpush

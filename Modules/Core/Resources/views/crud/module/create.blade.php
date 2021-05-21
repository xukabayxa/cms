@extends('cms.layouts.app')
@section('title', trans($language_file.'.create_new'))
@section('breadcrumb')
    {{ Breadcrumbs::render($breadcrumbs['create']) }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header bg-white header-elements-inline">
            <h6 class="card-title font-weight-black">@lang('core::core.crud.create')</h6>
        </div>

        <div class="card-body">

            @include('core::crud.module.create_form')

        </div>
    </div>
@endsection
@push('scripts')
    @foreach($jsFiles as $jsFile)
        <script src="{!! Module::asset($moduleName.':js/'.$jsFile) !!}"></script>
    @endforeach
@endpush
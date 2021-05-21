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

{{--            <h4>chọn ảnh từ thư viện ảnh</h4></br></br>--}}

{{--            <table id="exam" class="table" style="width:100%">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Ảnh</th>--}}
{{--                    <th>Name</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach ($images as $img)--}}
{{--                    <tr>--}}
{{--                        <td><img src="{{$img->path}}" alt="{{$img->id}}" style="width:50px;height:50px;"></td>--}}
{{--                        <td>{{$img->name}}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}

            <div class="card-body">
                {!! $dataTable->table([], true) !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! $dataTable->scripts() !!}
    <script src="/cms/js/plugins/forms/selects/select2.min.js"></script>
    <script>
        table= $('#exam').DataTable( {
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "orderable": false,
                },
                {
                    "targets": [ 1 ],
                    "visible": true,
                },
            ],
            "bLengthChange": false,
            "bInfo": false,
            "pageLength" : 5,
        } );


        $(document).ready(function() {

            $('#exam tbody').on( 'click', 'tr', function () {

                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

        } );

        $('#exam tbody').on( 'click', 'tr', function () {
            img=table.row( this ).data()[1];
            console.log(img);
            // document.getElementById("img").value=img;
            // document.getElementById("output").src = "image/"+img ;
            // document.getElementById("source").value = 2 ;
            $("input[name='source']").val(2);
            $("input[name='img']").val(img);
            console.log($("input[name='source']").val())
        } );
    </script>
    <script>
        $("input[name='image']").on('change', function (e) {
            alert('sd');
            $("input[name='source']").val(1);
        })
    </script>
@endpush

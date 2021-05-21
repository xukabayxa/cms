@extends('cms.layouts.app')
@section('title', trans($language_file.'.create_new'))
@section('breadcrumb')
    {{ Breadcrumbs::render($breadcrumbs['create']) }}
@endsection
@section('content')


    <!-- Content area -->
        <!-- Form inputs -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Thêm mới bài viết</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="reload"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('posts.store')}}" method="POST">
                    @csrf
                    <fieldset class="mb-3">
                        <legend class="text-uppercase font-size-sm font-weight-bold">Bài viết</legend>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Tiêu đề</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Kiểu bài viết</label>
                            <div class="col-lg-10">
                                <select class="form-control">
                                    <option value="opt1">Default select box</option>
                                    <option value="opt2">Option 2</option>
                                    <option value="opt3">Option 3</option>
                                    <option value="opt4">Option 4</option>
                                    <option value="opt5">Option 5</option>
                                    <option value="opt6">Option 6</option>
                                    <option value="opt7">Option 7</option>
                                    <option value="opt8">Option 8</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Danh mục</label>
                            <div class="col-lg-10">
                                <select multiple="multiple" class="form-control">
                                    <option selected>Amsterdam</option>
                                    <option selected>Atlanta</option>
                                    <option>Baltimore</option>
                                    <option>Boston</option>
                                    <option>Buenos Aires</option>
                                    <option>Calgary</option>
                                    <option selected>Chicago</option>
                                    <option>Denver</option>
                                    <option>Dubai</option>
                                    <option>Frankfurt</option>
                                    <option>Hong Kong</option>
                                    <option>Honolulu</option>
                                    <option>Houston</option>
                                    <option>Kuala Lumpur</option>
                                    <option>London</option>
                                    <option>Los Angeles</option>
                                    <option>Melbourne</option>
                                    <option>Mexico City</option>
                                    <option>Miami</option>
                                    <option>Minneapolis</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Ảnh đại diện</label>
                            <div class="col-lg-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Mô tả ngắn</label>
                            <div class="col-lg-10">
                                <textarea rows="3" cols="3" class="form-control" placeholder="Default textarea"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-lg-2">Nội dung</label>
                            <div class="col-lg-10">
                                <textarea rows="3" cols="3" class="form-control" placeholder="Default textarea"></textarea>
                            </div>
                        </div>

                        <!-- Basic example -->
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" class="form-control tokenfield" value="These,are,tokens" data-fouc>
                        </div>
                    </fieldset>



                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-paperplane ml-2"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /form inputs -->


    <!-- /content area -->
    <!-- Footer -->
    <div class="footer text-muted">
        &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
    </div>
    <!-- /footer -->


<!-- /content area -->
@endsection
@push('scripts')
    <script src="/cms/js/main/jquery_ui/core.min.js"></script>
    <script src="/cms/js/main/jquery_ui/effects.min.js"></script>
    <!-- Theme JS files -->
    <script src="/cms/js/plugins/forms/tags/tagsinput.min.js"></script>
    <script src="/cms/js/plugins/forms/tags/tokenfield.min.js"></script>
    <script src="/cms/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js"></script>
    <script src="/cms/js/plugins/ui/prism.min.js"></script>

    <script src="/cms/js/app.js"></script>
    <script src="/cms/js/demo_pages/form_tags_input.js"></script>
    <!-- /theme JS files -->
    <script src="/cms/js/plugins/forms/selects/select2.min.js"></script>
    <script>
        table= $('#exam').DataTable( {
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": true,
                },
                {
                    "targets": [ 1 ],
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
            img = table.row( this ).data()[0];
            $("input[name='img_id']").val(img);
            $("input[name='source']").val(2);
        } );
    </script>

    <script>
        $("input[name='image']").on('change', function (e) {
            $("input[name='source']").val(1);
        })
    </script>
@endpush

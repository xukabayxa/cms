<script src="/cms/js/main/jquery.min.js"></script>
<script src="/cms/js/main/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="/cms/js/plugins/loaders/blockui.min.js"></script>
<script src="/cms/js/plugins/loaders/nprogress.js"></script>
<script src="/cms/js/plugins/ui/ripple.min.js"></script>
<script src="/cms/js/plugins/pagination/bs_pagination.min.js"></script>
<script src="/cms/js/plugins/notifications/pnotify.min.js"></script>
<script src="/cms/js/plugins/notifications/noty.min.js"></script>
<script src="/cms/js/plugins/notifications/sweet_alert.min.js"></script>
<script src="/cms/js/plugins/forms/styling/uniform.min.js"></script>
<script src="/cms/js/plugins/datatables.min.js"></script>
<script src="/cms/js/plugins/ui/moment/moment.min.js"></script>
<script src="/cms/js/plugins/pickers/daterangepicker.js"></script>
<script src="/cms/js/plugins/pickers/pickadate/picker.js"></script>
<script src="/cms/js/plugins/pickers/pickadate/picker.date.js"></script>
<script src="/cms/js/app.js"></script>
<script src="/cms/js/common.js"></script></html>
@stack('scripts')
<script>
    Noty.overrideDefaults({
        theme: 'limitless',
        layout: 'topRight',
        type: 'alert',
        timeout: 3500
    });

    $(document).on('click', '.btn-delete', function (event) {
        var form = $(this).parent('form');
        event.preventDefault();

        swal({
            title: 'Xóa?',
            text: 'Bạn có chắc chắn muốn thực hiện hành động này?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xóa',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-light',
            cancelButtonText: 'Hủy',
        }).then((result) => {
            if (result.value) {
                form.submit();
                swal(
                    'Xóa thành công!',
                    '',
                    'success'
                )
            }
        })
    });

    @if(session('message'))
    @php
        $notification = !empty(session('message')['message']) ? session('message')['message'] : '';
        $type         = !empty(session('message')['type']) ? session('message')['type'] : '';
        switch ($type) {
            case 'success' :
                $alert = 'bg-success';
                break;
            case 'warning' :
                $alert = 'bg-warning';
                break;
            default:
                $alert = 'bg-danger';
        }

    @endphp
    new Noty({
        theme: ' alert {{ $alert }} text-white alert-styled-left p-0',
        text: "{{ $notification }}",
        type: '{{ $type }}',
        progressBar: false,
        closeWith: ['button']
    }).show();
    @endif
</script>
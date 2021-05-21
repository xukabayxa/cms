@foreach (session('flash_notification', collect())->toArray() as $message)
    <script>
        $(document).ready(function() {
            @if($message['level'] === 'danger')
            new PNotify({
                title: 'Lỗi',
                text: '{!! $message['message'] !!} ',
                type: 'errors',
                addclass: 'bg-danger border-danger',
                delay: 3000
            });
            @elseif($message['level'] === 'success')
            new PNotify({
                title: 'Thành công',
                text: '{!! $message['message'] !!}',
                type: 'success',
                styling: 'bootstrap3',
                delay: 3000,
                addclass: 'bg-success border-success'
            });
            @endif
        });
    </script>
@endforeach

{{ session()->forget('flash_notification') }}

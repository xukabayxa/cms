<div class="list-icons">
    <div class="dropdown">
        <a href="#" class="list-icons-item" data-toggle="dropdown" aria-expanded="false">
            <i class="icon-menu9"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-end">
            <a href="{{route($route.'.edit', ['category' => $id, 'type' => $type])}}" class="dropdown-item"><i class="icon-pencil5"></i> Chỉnh sửa</a>
{{--            <a href="" class="dropdown-item"><i class="icon-pencil5"></i> Chỉnh sửa</a>--}}
{{--            <form method="POST" action="{{route($route.'.destroy',$id)}}">--}}
            <form method="POST" action="{{route($route.'.destroy',$id)}}">
                @csrf
                @method('delete')
                <a href="#" class="dropdown-item btn-delete"><i class="icon-bin2"></i> Xóa</a>
            </form>
        </div>
    </div>
</div>

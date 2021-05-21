
@if (count($breadcrumbs) >= 0)

    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Trang chủ</a>
                @foreach ($breadcrumbs as $breadcrumb)
                    @if (!$loop->last)
                        <a href="{{ $breadcrumb->url }}" class="breadcrumb-item">{{ $breadcrumb->title }}</a>
                    @else
                        <span class="breadcrumb-item active">{{ $breadcrumb->title }}</span>
                    @endif

                @endforeach
            </div>
        </div>
    </div>
@endif

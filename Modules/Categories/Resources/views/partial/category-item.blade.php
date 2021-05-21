<ul>
    @foreach($children as $child)
        <li  id="{{ $child->id }}" class="{{ in_array($child->id, $product_categories_id) ? 'selected' : '' }}">
            {{ $child->name }}
            @if(count($child->children))
                @include('categories::partial.category-item',['children' => $child->children, 'product_categories_id' => $product_categories_id])
            @endif
        </li>
    @endforeach
</ul>
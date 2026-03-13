<tr>
    <td>{{ str_repeat('— ', $level) }} {{ $category->title }}</td>
    <td>{{ $category->slug }}</td>
    <td>
        @if($category->is_active)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-secondary">Inactive</span>
        @endif
    </td>
    <td>
        <div class="dropdown">
            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li>
                    <a class="dropdown-item" href="{{ route('admin.categories.show', $category->id) }}">
                        <i class="fas fa-eye me-2 text-info"></i> View
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}">
                        <i class="fas fa-edit me-2 text-primary"></i> Edit
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-trash me-2"></i> Delete
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </td>
</tr>

{{-- Recursively show child categories --}}
@if($category->children && $category->children->count())
    @foreach($category->children as $child)
        @include('admin.categories2.category-row', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
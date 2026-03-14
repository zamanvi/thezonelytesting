<div class="col-lg-6">
    <div class="section-card">

        {{-- Card Header --}}
        <div class="card-header bg-dark text-white p-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>
                Categories
            </h5>
        </div>

        {{-- Card Body --}}
        <div class="card-body p-0">
            @if ($categories && count($categories))
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Paren</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th width="10">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through top-level categories --}}
                            @foreach ($categories as $category)
                                <tr>
                                    {{-- <td>{{ $category->parent ? $category->parent->title : 'No Parent' }}</td> --}}
                                    <td>{{ categoryPath($category) }}</td>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if ($category->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.categories.show', $category->id) }}">
                                                        <i class="fas fa-eye me-2 text-info"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.categories.edit', $category->id) }}">
                                                        <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form
                                                        action="{{ route('admin.categories.destroy', $category->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Delete this category?');">
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
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-3 px-3">
                    {{ $paginated->links() }}
                </div>
            @else
                {{-- No categories --}}
                <div class="text-center py-5">
                    <i class="fas fa-folder fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No categories found.</p>
                </div>
            @endif
        </div>
    </div>
</div>

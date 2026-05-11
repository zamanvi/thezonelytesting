<div class="col-lg-6">
    <div class="section-card">

        <div class="card-header bg-dark text-white p-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-folder-open me-2"></i>
                Mother Categories
                <span class="badge bg-primary ms-2">{{ $paginated->total() }}</span>
            </h5>
        </div>

        <div class="card-body p-0">
            @if($paginated->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th class="text-center">Sub-cats</th>
                            <th class="text-center">Status</th>
                            <th width="10"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paginated as $i => $cat)
                        <tr>
                            <td class="text-muted small">{{ ($paginated->currentPage() - 1) * $paginated->perPage() + $i + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-2 bg-primary bg-opacity-10 d-flex align-items-center justify-content-center"
                                         style="width:34px;height:34px;flex-shrink:0">
                                        <i class="fas fa-folder text-primary" style="font-size:14px"></i>
                                    </div>
                                    <span class="fw-bold">{{ $cat->title }}</span>
                                </div>
                            </td>
                            <td><code class="small text-muted">{{ $cat->slug }}</code></td>
                            <td class="text-center">
                                @if($cat->children_count > 0)
                                <a href="{{ route('admin.categories.show', $cat->id) }}"
                                   class="badge bg-info text-white text-decoration-none">
                                    {{ $cat->children_count }} sub
                                </a>
                                @else
                                <span class="text-muted small">—</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $cat->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $cat->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.categories.show', $cat->id) }}">
                                                <i class="fas fa-eye me-2 text-info"></i> View Sub-cats
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.categories.edit', $cat->id) }}">
                                                <i class="fas fa-edit me-2 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete ' + {{ @json($cat->title) }} + ' and all its sub-categories?')">
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

            @if($paginated->hasPages())
            <div class="p-3 border-top">
                {{ $paginated->links() }}
            </div>
            @endif

            @else
            <div class="text-center py-5 text-muted">
                <i class="fas fa-folder fa-3x mb-3 opacity-25"></i>
                <p class="mb-0">No categories yet. Create one →</p>
            </div>
            @endif
        </div>

    </div>
</div>

<div class="col-lg-6">
    <div class="section-card">

        <div class="card-header bg-dark text-white p-4">
            <h5 class="mb-0">
                <i class="fas fa-blog me-2"></i>
                Blogs
            </h5>
        </div>

        <div class="card-body p-4">

            @if ($blogs && $blogs->count())
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="80">Image</th>
                                <th>Name</th>
                                <th>Views</th>
                                <th width="10">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogs as $blog)
                                <tr>
                                    <td>
                                        <img src="{{ get_file($blog->image_path, 'user') }}" class="rounded"
                                            height="50">
                                    </td>

                                    <td>
                                        <strong>{{ $blog->name }}</strong>
                                    </td>

                                    <td>
                                        <span class="badge bg-info">
                                            {{ $blog->pageview }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.blogs.show', $blog->id) }}">
                                                        <i class="fas fa-eye me-2 text-info"></i> View
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.blogs.edit', $blog->id) }}">
                                                        <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                    </a>
                                                </li>

                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>

                                                <li>
                                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                        method="POST" onsubmit="return confirm('Delete this blog?');">
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

                <div class="mt-3">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No blogs found.</p>
                </div>
            @endif

        </div>
    </div>
</div>

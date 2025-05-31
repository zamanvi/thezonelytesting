<div class="col-sm-12 col-lg-6">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Blogs</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <table id="user-list-table" class="table table-striped table-bordered mt-1" role="grid"
                aria-describedby="user-list-page-info">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Page View</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($blogs != null)
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>
                                    <img src="{{ get_file($blog->image_path, 'user') }}" height="50">
                                </td>
                                <td>{{ $blog->name }}</td>
                                <td>{{ $blog->pageview }}</td>
                                <td>
                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle text-primary" id="dropdownMenuButton5"
                                                data-toggle="dropdown">
                                                <a href="" class="align-items-center"><i
                                                        class="ri-more-fill"></i></a>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton5">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.blogs.show', $blog->id) }}"><i
                                                        class="ri-eye-fill mr-2"></i>View</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.blogs.edit', $blog->id) }}"><i
                                                        class="ri-pencil-fill mr-2"></i>Edit</a>
                                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="ri-delete-bin-6-fill mr-2"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>
</div>

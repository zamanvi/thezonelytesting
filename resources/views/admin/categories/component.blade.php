<div class="col-sm-12 col-lg-6">
    <div class="iq-card">
        <div class="iq-card-header d-flex justify-content-between">
            <div class="iq-header-title">
                <h4 class="card-title">Categories</h4>
            </div>
        </div>
        <div class="iq-card-body">
            <table id="category-list-table" class="table table-striped table-bordered mt-1" role="grid"
                aria-describedby="category-list-page-info">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories != null)
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if($category->is_active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="iq-card-header-toolbar d-flex align-items-center">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle text-primary" id="dropdownMenuButtonCategory{{ $category->id }}"
                                                data-toggle="dropdown">
                                                <a href="" class="align-items-center"><i class="ri-more-fill"></i></a>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButtonCategory{{ $category->id }}">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.categories.show', $category->id) }}"><i
                                                        class="ri-eye-fill mr-2"></i>View</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.categories.edit', $category->id) }}"><i
                                                        class="ri-pencil-fill mr-2"></i>Edit</a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
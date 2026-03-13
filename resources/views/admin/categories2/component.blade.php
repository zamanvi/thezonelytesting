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
            @if($categories && count($categories))
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th width="10">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through top-level categories --}}
                            @foreach ($categories as $category)
                                @include('admin.categories2.category-row', ['category' => $category, 'level' => 0])
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
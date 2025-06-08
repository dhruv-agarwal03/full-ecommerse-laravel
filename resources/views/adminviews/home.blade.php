@include('adminviews.AdminNav')
<div>

<div class="container">
    <h2 class="my-4">Carousel Entries</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Product ID</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($carousel as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->Name }}</td>
                <td>{{ $item->discription }}</td>
                <td>{{ $item->id }}</td>
                <td>
                    @if($item->image)
                        <img src="data:image/jpeg;base64,{{ $item->image }}" alt="carousel" width="100">

                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    <!-- Edit Button triggers modal -->
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">Edit</button>

                    <!-- Delete Button -->
                    <form action="/admin/home/{{$item->id}}" method="POST" style="display:inline-block;">
                        <button class="btn btn-sm btn-danger" type="submit" name="update" value="delete" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <form method="POST" action="/admin/home/{{$item->id}}" enctype="multipart/form-data">
                    <div class="modal-header">
                      <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Carousel</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $item->Name }}" class="form-control" required>
                      </div>
                      <div class="form-group mb-3">
                        <label>Description</label>
                        <textarea name="discription" class="form-control" required>{{ $item->discription }}</textarea>
                      </div>
                      <div class="form-group mb-3">
                        <label>Replace Image (optional)</label>
                        <input type="file" name="image" class="form-control">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" name="update" value="update" class="btn btn-primary">Update Carousel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No carousel entries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


</div>
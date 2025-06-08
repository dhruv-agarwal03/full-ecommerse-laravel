@include("adminviews.AdminNav")
@if(session('status'))
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const toastEl = document.getElementById('statusToast');
        const toast = new bootstrap.Toast(toastEl, {
            delay: 3000
        });
        toast.show();
    });

</script>
@endif

@if(session('status'))
  <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
    <div class="toast align-items-center text-white 
        @if(session('status') == 'U') bg-success 
        @elseif(session('status') == 'D') bg-primary 
        @else bg-info @endif border-0" 
        role="alert" aria-live="assertive" aria-atomic="true" id="statusToast">

      <div class="d-flex">
        <div class="toast-body">
          @if(session('status') == 'U')
            Product updated successfully!
          @elseif(session('status') == 'D')
            Product deleted successfully!
          @elseif(session('status') == 'E')
            Something went wrong!
          @endif
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
@endif


<table class="table">
  <thead>
    <tr>
      <th>S.no</th>
      <th>ID</th>
      <th>Name</th>
      <th>HRS code</th>
      <th>Quality</th>
      <th>GST</th>
      <th>Expires</th>
      <th>Category</th>
      <th>Priority</th>
      <th>Cost Price</th>
      <th>Selling Price</th>
      <th>Selling Price (Priority 1)</th>
      <th>Selling Price (Priority 2)</th>
      <th>Available</th>
      <th>Last Change</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @php $i = 1; @endphp
    @foreach($data as $item)
      <tr>
  <form method="POST">
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item["productId"] }}</td>
    <td><input class="form-control" type="text" name="name" value="{{ $item['name'] }}" /></td>
    <td><input class="form-control" type="text" name="HSNcode" value="{{ $item['HSNcode'] }}" /></td>
    <td><input class="form-control" type="text" name="qualityNo" value="{{ $item['qualityNo'] }}" /></td>
    <td><input class="form-control" type="text" name="gst" value="{{ $item['gst'] }}" /></td>
    <td><input class="form-control" type="date" name="expires" value="{{ $item['expirs'] }}" /></td>
    <td>{{ $cata[$loop->index] ?? 'N/A' }}</td>
    <td><input class="form-control" type="text" name="priority" value="{{ $item['priorty'] }}" /></td>
    <td><input class="form-control" type="text" name="costprice" value="{{ $item['costprice'] }}" /></td>
    <td><input class="form-control" type="text" name="sellingPrice" value="{{ $item['sellingPrice'] }}" /></td>
    <td><input class="form-control" type="text" name="sell1" value="{{ $item['sell1'] }}" /></td>
    <td><input class="form-control" type="text" name="sell2" value="{{ $item['sell2'] }}" /></td>
    <td><input class="form-control" type="text" name="available" value="{{ $item['Available'] }}" /></td>
    <td>{{ $item['updated_at'] }}</td>
    <td>
      <input type="hidden" name="productId" value="{{ $item['productId'] }}">
      <button type="submit" name="action" value="update" class="btn btn-success">Update</button><br><br>
      <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
    </td>
  </form>
</tr>

    @endforeach
  </tbody>
</table>

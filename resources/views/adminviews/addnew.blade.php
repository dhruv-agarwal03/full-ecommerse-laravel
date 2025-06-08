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
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
    <div class="toast align-items-center text-white 
        @if(session('status') == 'C') bg-success 
        @elseif(session('status') == 'P') bg-primary 
        @else bg-info @endif border-0" 
        role="alert" aria-live="assertive" aria-atomic="true" id="statusToast">

      <div class="d-flex">
        <div class="toast-body">
          @if(session('status') == 'C')
            categery added succsussfully
          @elseif(session('status') == 'P')
            Product added succsussfully
          @elseif(session('status') == 'E')
            Something went wrong!
          @endif
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
@endif
<html>
    <div class="row">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-12 p-5">
            <div class="card">
                <div class="card-header h3">New Category</div>
                <div class="card-body">
                    <h5 class="card-title">Enter the details</h5>
                    <form method="post" enctype="multipart/form-data" action="/admin/new">
                        <div class="form-group">
                            <div>
                                <label for="name">Name of Category</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div>
                                <label for="Class">Select the Classifications</label>
                                <select class="form-select" required name="classification">
                                    @foreach($class as $class)
                                        <option value="{{$class['ID']}}">{{$class['Name']}}</option>
                                    @endforeach  
                                </select>
                            </div>
                            <a href="mailto:dhruvagarwal6396@gmail.com?subject=Classification not found&body=," class="text-danger">Contact us</a>
                            <div>
                                <label for="exampleFormControlFile1">Enter the image</label><br>
                                <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" accept="image/*" required>
                            </div>
                        </div>
                        <button type="submit" name="submit" value="categery" class="btn btn-info m-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-12 p-5">
            <div class="card">
                <div class="card-header h3">New Product</div>
                <div class="card-body">
                    <h5 class="card-title">Enter the details</h5>
                    <form method="post" enctype="multipart/form-data" action="/admin/new">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" required>

                            <label>HSN Code</label>
                            <input type="text" class="form-control" name="HSNcode" required>

                            <label>Cost Price</label>
                            <input type="number" class="form-control" name="costprice" required>

                            <label>Selling Price</label>
                            <input type="number" class="form-control" name="sellingPrice" required>
                            
                            <label>Selling Price(Priority 1)</label>
                            <input type="number" class="form-control" name="sell1" required>
                            
                            <label>Selling Price (Priority 2)</label>
                            <input type="number" class="form-control" name="sell2" required>
                            

                            <label>MRP</label>
                            <input type="number" class="form-control" name="MRP" required>

                            <label>Quantity</label>
                            <input type="number" class="form-control" name="qualityNo" required>

                            <label>GST (%)</label>
                            <input type="number" class="form-control" name="gst" required>

                            <label>Expiry Date</label>
                            <input type="date" class="form-control" name="expirs" required>

                            <label>Category</label>
                            <select class="form-select" name="category" required>
                                    @foreach($cat as $cat)
                                        <option value="{{$cat['catId']}}">{{$cat['name']}}</option>
                                    @endforeach  
                                </select>
                            <label>Priority</label>
                            <input type="text" class="form-control" name="priorty" placeholder="Enter only digits">


                            <label>Priority</label>
                            <input type="text" class="form-control" name="priorty" placeholder="Enter only digits">

                            <label>Availability</label>
                            <select class="form-select" name="Available" required>
                                <option value="Y">Available</option>
                                <option value="N">Not Available</option>
                            </select>   
                            <div>                         <div>
                                <label for="exampleFormControlFile1">Enter the image</label><br>
                                <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" accept="image/*" required>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success m-3" value="product" >Submit Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</html>

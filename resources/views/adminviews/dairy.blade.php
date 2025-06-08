@include('adminviews.AdminNav')

<div class="container mt-4">
    <!-- Search Row -->
    <div class="row mb-3 gx-2">
        <div class="col-8 col-md-6">
            <input type="text" class="form-control" id="searchid" placeholder="Search by name, email, etc." onKeyUp="search()">
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap align-middle" id="searchdata">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $cus)
                    <tr>
                        <td>{{ $cus['id'] }}</td>
                        <td>{{ $cus['fname'] . ' ' . $cus['lname'] }}</td>
                        <td>{{ $cus['number'] }}</td>
                        <td style="word-break: break-word;">{{ $cus['email'] }}</td>
                        <td style="word-break: break-word;">{{ $cus['address'] }}</td>
                        <td>{{ $cus['city'] }}</td>
                        <td>{{ $cus['state'] }}</td>
                        <td>
                            <form action="{{route('customer.get',['id'=>$cus['id']])}}" method="GET">
                                <button type="submit" value="{{$cus['id']}}" class="btn btn-sm btn-info w-100">More</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function search(){
        let data=document.getElementById("searchid").value.toLowerCase();
        let rows=document.querySelectorAll("#searchdata tbody tr");
        rows.forEach(row=>{
            const id=row.cells[0].innerText.toLowerCase();
            const name=row.cells[1].innerText.toLowerCase();
            const number=row.cells[2].innerText.toLowerCase();
            const email=row.cells[3].innerText.toLowerCase();
            const address=row.cells[4].innerText.toLowerCase();
            const city=row.cells[5].innerText.toLowerCase();
            const match= id.includes(data)||name.includes(data)||number.includes(data)||email.includes(data)||address.includes(data)||city.includes(data);
            row.style.display=match?'':'none';
        });
    }
</script>
@include('nav')

<body>
    <div class="container row">
        @foreach ($categories as $category)
        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-4 col-6 p-2 " >
        <div><img src="data:image/png;base64,{{ $category['image'] }}" alt="Category Image" height='150px'></div>
            
            <div> ID: {{ $category["CID"] }}</div>
            <div class="h3 text-secondary" >{{ $category["name"] }}</div>
            <a class="btn btn-primary" href="/products/{{$category['CID']}}" >More products</a>
        </div>
        @endforeach
</div>
</body>

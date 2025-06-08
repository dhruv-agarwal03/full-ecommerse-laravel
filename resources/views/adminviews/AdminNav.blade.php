@include('header')

<section>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/admin">Admin Panel</a>

      <!-- Toggle button for mobile view -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
              aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navigation links -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/admin">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/admin/home">Home Page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/products">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/new">New</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/diary">Diary</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</section>

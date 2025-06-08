@include('header')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Brand with optional image -->
  <a class="navbar-brand" href="/home">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" height="50" class="ms-4">

  </a>

  <!-- Toggle button for mobile -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto"> <!-- Use ms-auto to align right -->
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/category"><b>Category</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/products"><b>Products</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/history"><b>History</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/cart"><b>Cart</b></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/logout"><b>Logout</b></a>
      </li>
    </ul>
  </div>
</nav>

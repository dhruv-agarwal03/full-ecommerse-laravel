@include("nav")

<style>
  .carousel-inner img {
    height: 400px;
    width: 100%;
    object-fit: cover;
    object-position: center center;
  }
</style>

<div>
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000" data-bs-pause="hover" style="height:400px">
    <div class="carousel-inner">
      @foreach($carousel as $index => $cau)
        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
          <a href="product/{{ $cau['prodID'] }}">
            <img class="d-block w-100" src="data:image/jpeg;base64,{{ $cau['image'] }}" alt="Slide {{ $index + 1 }}">
          </a>
          <div class="carousel-caption d-none d-md-block">
            <h5>{{ $cau['Name'] }}</h5>
            <p>{{ $cau['discription'] }}</p>
          </div>
        </div>
      @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

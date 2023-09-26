<div class="col-md-2  p-0">
    <!-- brands to be displayed -->
    <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info">
            <a href="" class="nav-link text-light"> <h4>Delivery Brands</h4></a>
        </li>
        @foreach ($brands as $brand)
        <li class="nav-item ">
            <a href="{{ url('insert-brands/'.$brand->id)}}" class="nav-link text-light"> {{$brand['brand_title']}}</a>
        </li>
       
        @endforeach
    </ul>
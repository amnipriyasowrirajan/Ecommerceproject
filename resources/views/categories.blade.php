  <!-- categories  to be displayed-->
  <ul class="navbar-nav me-auto text-center">
    <li class="nav-item bg-info">
        <a href="" class="nav-link text-light"> <h4>Categories</h4></a>
    </li>
    @foreach ($categories as $category)
    <li class="nav-item ">
        <a href="{{ url('insert-categories/'.$category->id) }}" class="nav-link text-light"> {{$category['category_title']}}</a>
    </li>
    {{-- <li class="nav-item ">
        <a href="" class="nav-link text-light"> Categories2</a>
    </li>
    <li class="nav-item">
        <a href="" class="nav-link text-light"> Categories3</a>
    </li>
    <li class="nav-item">
        <a href="" class="nav-link text-light"> Categories4</a>
    </li>
    <li class="nav-item">
        <a href="" class="nav-link text-light"> Categories5</a>
    </li> --}}
    @endforeach
</ul>
</div>
</div>
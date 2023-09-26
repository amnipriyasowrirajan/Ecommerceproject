
@foreach ($products as $product)
<div class="col-md-4 mb-2">
    <div class="card product_data h-100" >
      <!--  products  is displayed-->
        <img src="{{ asset('storage/uploads/'.$product['product_image1']) }}" 
        class="card-img-top" alt="{{$product['product_title']}}">
        <div class="card-body">
          <h5 class="card-title text-color">{{$product['product_title']}}</h5>
          <p class="card-text text-color">{{$product['product_description']}}</p>
          <form action="{{URL::to('addToCart')}}" method="POST">
            @csrf
            <div class="row mt-2">
              <div class="col-md-3">
               
                <input type="number" class="form-control qty-input" name="quantity"
                 value="1" min="1" max="{ $product->quantity }"
               style="width:50px">
              
            </div>
            <div class="col-md-4">
              <input type="hidden" name="product_id" value="{{$product->id}}">
              {{-- <button type="button" class="btn btn-info me-3 float-start">Add to Wishlist</button> --}}
              <input type="submit" class="btn btn-info bgcolor "    value="Add to cart">

            </div>
            <div class="col-md-4">
            <a href="{{ url('product-details/'.$product->id)}}"   style="width:100px" 
              class="btn btn-secondary view">View more</a>
            </div>
            </div>
          
          </form>
         
            {{-- <a href="{{ url('insert-categories/'.$category->id) }}" class="btn btn-info">Add to cart</a> --}}
          
          
        
        </div>
      </div>
</div>
@endforeach
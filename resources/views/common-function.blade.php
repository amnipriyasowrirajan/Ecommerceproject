@foreach ($products as $product)
                    <div class="col-md-4 mb-2">
                        <div class="card" >
                          <!--  products  is displayed-->
                            <img src="storage/uploads/{{$product['product_image1']}}" class="card-img-top" alt="{{$product['product_title']}}">
                            <div class="card-body">
                              <h5 class="card-title">{{$product['product_title']}}</h5>
                              <p class="card-text">{{$product['product_description']}}</p>
                              <a href="#" class="btn btn-info">Add to cart</a>
                              <a href="#" class="btn btn-secondary">View more</a>
                            </div>
                          </div>
                    </div>
                    @endforeach
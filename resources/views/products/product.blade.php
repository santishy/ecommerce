<div class="card product text-left">
      @if(Auth::check() && Auth::user()->id==$product->user_id)
        <div class="absolute actions">
          <a href="{{url('/products/'.$product->id.'/edit')}}" class="btn btn-primary btn-xs">Editar</a>
          @include('products.delete',['product'=>$product])
        </div>
      @endif
      <h1>{{$product->title}}</h1>
      <div class="row">
        <div class="col-sm-6 col-xs-6">
          @if($product->extension)
            <img src="{{url('/products/image/'.$product->id.'.'.$product->extension)}}" class="product-avatar">
          @endif
        </div>
        <div class="col-sm-6 col-xs-6">
          <p>
            <strong>Descripción</strong>
          </p>
          <p>
            {{$product->description}}
          </p>
          <p>
            @include('in_shopping_carts.form',['product'=>$product])
          </p>
        </div>
      </div>
    </div>
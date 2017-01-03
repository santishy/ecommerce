@extends('layouts.app')
@section('title','Curso CodigoFacilito')
@section('content')
    <div class="container text-center products-container">
    	<div class="row">
    		
    		@foreach($products as $product)
    			<div class="col-xs-10 col-md-6">
		            @include('products.product',['product'=>$product])
		         </div>
		    @endforeach
    	</div>
        <div>
	       	{{$products->links()}}
	    </div>
    </div>
@endsection

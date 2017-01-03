{!! Form::Open(['url'=>$url,'method'=>$method,'files'=>true]) !!}
  <div class="form-group">
    {{ Form::text('title',$product->title,['class'=>'form-control','placeholder'=>'Titulo...']) }}
  </div>
  <div class="form-group">
    {{ Form::number('princing',$product->princing,['class'=>'form-control','placeholder'=>'Precio para publico']) }}
  </div>
  <div class="form-group">
    {{Form::file('cover')}}
  </div>
  <div class="form-group">
    {{ Form::textarea('description',$product->description,['class'=>'form-control','placeholder'=>'Describa el producto...']) }}
  </div>
  <div class="form-group">
    <a href="{{url('/products')}}">Regresar la lista de productos</a>
    <input type="submit" class="btn btn-success" value="Enviar">
  </div>
{!! Form::Close() !!}

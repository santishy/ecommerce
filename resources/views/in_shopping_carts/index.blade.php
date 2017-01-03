@extends('layouts.app')
@section('content')
  <div class="big-padding blue-gray text-center white-text">
    <h1>Tu carrito de compras</h1>
  </div>
  <div class="container">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>
            Producto
          </th>
          <th>
            Descripcíon
          </th>
          <th>
            Precio
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
          <tr>
            <td>
              {{$product->title}}
            </td>
            <td>
              {{$product->description}}
            </td>
            <td>
              {{$product->princing}}
            </td>
          </tr>
        @endforeach
        <tr>
          <td colspan="2">
            Total
          </td>
          <td>
            {{$total}}
          </td>
        </tr>
      </tbody>
    </table>
    <div class="text-right">
      @include('shopping_cart.form')
    </div>
  </div>
  <h1>{{$total}}</h1>
@endsection

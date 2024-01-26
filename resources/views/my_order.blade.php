@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>My Order</h1>
                <p>let's finish payment</p>
            </div>
            <table class="table table-striped">
                <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($order as $item)
                <tr>
                  <th scope="row">1</th>
                  <td>{{$item->product->name}}</td>
                  <td>{{$item->product->price}}</td>
                  <td>{{$item->status}}</td>
                  <td>@mdo</td>
                </tr>
                @endforeach
              {{-- <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@twitter</td>
                <td>@twitter</td>
              </tr> --}}
            </tbody>
          
            </table>
        </div>
    </div>
@endsection

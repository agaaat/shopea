@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>List Chat</h1>
            <p>Customer bawel</p>
        </div>

        <div class="col-md-12">
            

            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($room as $item)    
                    <tr>
                      <td>
                          <a href="{{ route('chatcustomer.index',['id' => $item->id]) }}" class="d-flex align-items-center text-decoration-none">
                              <img class="rounded-circle" style="width: 60px; height:60px" class="card-img-top" src="https://cdn0-production-images-kly.akamaized.net/GJIoBDX2DFa-vcj9eaTzyH6TEog=/800x450/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/2754932/original/005940800_1552970791-fotoHL_kucing.jpg" alt="Room Image">
              
                              <div class="mx-4">
                                  <h5 class="card-title font-bold text-black">{{ $item->user->name }}</h5>
                                  <p class="card-text text-secondary">Start Conversation</p>
                              </div>
                          </a>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                

        </div>
    </div>
</div>
@endsection

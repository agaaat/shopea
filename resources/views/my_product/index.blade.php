@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row">
            <div class="flex align-items-end justify-content-between">
                <div>
                    <h1>My Order</h1>
                    <p>let's finish payment</p>
                </div>

                <!-- Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    Create
                </button>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">New Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Modal content goes here -->
                                <div class="card">

                                    <div class="card-body">
                                        <form enctype="multipart/form-data" method="POST"
                                            action="{{ route('myProduct.store') }}">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="name" class="form-label">name</label>
                                                <input type="text" id="name" class="form-control" name="name"
                                                    placeholder="name product here" required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">description</label>
                                                <input type="text" id="description" class="form-control"
                                                    name="description" placeholder="description here" required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">price</label>
                                                <input type="number" id="price" class="form-control" name="price"
                                                    placeholder="price here" required="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input accept="image/*" type="file" id="image" class="form-control"
                                                    name="file" required="">
                                            </div>

                                            <div>
                                                <!-- Button -->
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"> Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        {{-- <th scope="col">Quantity</th> --}}
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($myProduct as $index => $item)
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>RP. {{ $item->price }}</td>
                            {{-- <td>{{ $item->qty }}</td> --}}
                            <td>
                                <img width="50" src="{{ $item->image }}" alt="image" />
                            </td>
                            <td>{{ $item->description }}</td>
                            <td class="align-middle ">
                                <div class="d-flex">
                                    
                                        <button type="button" class="btn btn-sm mx-2 btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#update{{$item->id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>

                                        </button>
                                        <div class="modal fade" id="update{{$item->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalCenterTitle">New Product
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Modal content goes here -->
                                                        <div class="card">

                                                            <div class="card-body">
                                                                <form enctype="multipart/form-data" method="POST"
                                                                    action="{{ route('myProduct.update',['id' => $item->id]) }}">
                                                                    @csrf
                                                                    @method('put')

                                                                    <div class="mb-3">
                                                                        <label for="name"
                                                                            class="form-label">name</label>
                                                                        <input type="text" id="name"
                                                                            value="{{$item->name}}"
                                                                            class="form-control" name="name"
                                                                            placeholder="name product here"
                                                                            required="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="description"
                                                                            class="form-label">description</label>
                                                                        <input type="text" id="description"
                                                                        value="{{$item->description}}"

                                                                            class="form-control" name="description"
                                                                            placeholder="description here" required="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="price"
                                                                            class="form-label">price</label>
                                                                        <input type="number" id="price"
                                                                        value="{{$item->price}}"

                                                                            class="form-control" name="price"
                                                                            placeholder="price here" required="">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="image"
                                                                            class="form-label">Image</label>
                                                                        <input accept="image/*" type="file"
                                                                            id="image" class="form-control"
                                                                            name="file" required="">
                                                                    </div>

                                                                    <div>
                                                                        <!-- Button -->
                                                                        <div class="d-grid">
                                                                            <button type="submit"
                                                                                class="btn btn-primary"> Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <p>Modal body text goes here.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    {{-- <a class="mx-1" href="#">
                                      <button class="btn btn-primary btn-sm">
                                          
                                      </button>
                                  </a> --}}
                                    <form method="POST" action="{{ route('myProduct.destroy', ['id' => $item->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>

                                        </button>
                                    </form>
                                </div>


                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

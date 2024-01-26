@foreach ($room->message as $item)
                    @if ($userLogedIn->id != $item->user_id)
                    <div class="d-flex w-lg-40 mb-4">

                        <div class=" ms-3">
                            {{-- <small><span class="username">
                                    Denise Reece
                                </span> , 09:35</small> --}}
                            <div class="d-flex">
                                <div class="card mt-2 rounded-top-md-left-0 border">
                                    <div class="card-body p-3">
                                        <p class="mb-0 text-dark">
                                            {{$item->message}}
                                        </p>
                                    </div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="d-flex justify-content-end mb-4">
                        <!-- media -->
                        <div class="d-flex w-lg-40">
                            <!-- media body -->
                            <div class=" me-3 text-end">
                                {{-- <small> 09:39</small> --}}
                                <div class="d-flex">
                    
                                    <!-- card -->
                                    <div class="card mt-2 rounded-top-md-end-0 bg-primary text-white ">
                                        <!-- card body -->
                                        <div class="card-body text-start p-3">
                                            <p class="mb-0">
                                                {{$item->message}}

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- img -->
                        </div>
                    </div>
                    @endif
                    
                @endforeach
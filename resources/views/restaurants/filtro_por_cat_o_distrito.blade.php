        @foreach ( $restaurants as $restaurant )

            <div class="col-12 col-md-6 col-lg-4 mb-4 ">
                <a href="{{ route('restaurant.detalle',["id"=>$restaurant->id,"nombre"=>strtolower(implode("-",explode(" ",$restaurant->name)))])}}" class="a-card-restaurant">
                <div class="card card-restaurant ">
                    @include('includes.image_restaurante')
                    <div class="card-body p-0 px-3 pt-2 ">

                        <div class="d-flex justify-content-between">
                            <p class="card-title my-0"><strong class="navbar-brand">{{$restaurant->name}}</strong></p>
                            <div class="badge badge-dark badge-restaurant mt-1" >
                                <strong>{{$restaurant->categoria}}</strong>
                            </div>
                        </div>
                        <p class="my-2 font-weight-light">
                            <img class="mb-1" src="https://img.icons8.com/ios/50/000000/place-marker.png" width="14"> {{$restaurant->distrito}} - {{$restaurant->address}}</p>
                    </div>
                </div>
                </a>
            </div>

        @endforeach
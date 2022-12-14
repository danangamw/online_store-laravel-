@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
    <section class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{asset('/storage/'.$viewData['product']->getImage())}}" alt="{{$viewData['product']['name']}}" class="img-fluid rounded-start">
            </div>

            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$viewData['product']->getName()}} ($ {{$viewData['product']['price']}})
                    </h5>
                    
                    <p class="card-text">{{$viewData['product']->getDescription()}}</p>

                    <p class="cart-text">
                        <form action="/cart/add/{{$viewData['product']->getId()}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-auto">
                                    <div class="input-group col-auto">
                                        <div class="input-group-text">Quantity</div>
                                        <input type="number" name="quantity" min="1" max="10" class="form-control quantity-input" value="1">
                                    </div>
                                </div>
                                
                                <div class="col-auto">
                                    <button class="btn bg-primary text-white" type="submit">Add to cart</button>
                                </div>
                            </div>
                        </form>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
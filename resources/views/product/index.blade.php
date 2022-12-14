@extends('layouts.app')
@section('title', $viewData['title'])
@section('content')
   <section class="row">
    @foreach ($viewData['products'] as $product)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card">
                <img src="{{asset('/storage/'.$product->getImage()) }}" alt="" class="card-img-top img-card">

                <div class="card-body text-center">
                    <a href="/products/{{$product->getId()}}" class="btn bg-primary text-white">
                    {{$product->getName()}}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
   </section>
@endsection
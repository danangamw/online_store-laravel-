@extends('layouts.app')
@section('title', $viewData['title']);
@section('subtitle', $viewData['subtitle'])
@section('content')
    @forelse ($viewData['orders'] as $order)
        <section class="card mb-4">
            <div class="card-header">
                Order ${{ $order->getId() }}
            </div>

            <div class="card-body">
                <b>Date:</b> {{ $order->getCreatedAt() }}
                <b>Total:</b> {{ $order->getTotal() }}

                <table class="table table-bordered table-striped text-center mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Item ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->getItems() as $item)
                            <tr>
                                <td>
                                    <a href="/product/{{ $item->getProduct()->getId() }}">
                                        {{ $item->getProduct()->getName() }}
                                    </a>
                                </td>
                                <td>{{ $item->getPrice() }}</td>
                                <td>{{ $item->getQuantity() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

    @empty
        <div class="alert alert-danger">
            Seems to be that you have not purchased anything in our store =(.
        </div>
    @endforelse
@endsection

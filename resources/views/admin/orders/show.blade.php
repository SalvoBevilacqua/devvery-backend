@extends('layouts.admin')

@section('admin_page_name')
    Dettagli Ordine
@endsection

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="ms_btn ms_btn-dark">Indietro</a>
        <div class="row justify-content-center mt-4">
            <div class="col-md-12 mb-4">
                <div class="card border">
                    <div class="card-header d-flex justify-content-around">
                        <h3 class="text-center">Ordine n. #{{ $order->id }}</h3>
                        <h3 class="text-center">Totale: {{ $order->total_amount }} €</h3>
                    </div>

                    <div class="card-body fs-5 mt-4">
                        <div class="text-center">
                            <div class="border d-inline-block rounded rounded-4 text-start p-3">
                                <p class="fw-bold">Nome:
                                    <span class="fw-normal">
                                        {{ $order->customer->first_name }}
                                        {{ $order->customer->last_name }}
                                    </span>
                                </p>
                                <p class="fw-bold">Indirizzo:
                                    <span class="fw-normal">
                                        {{ $order->customer->address }}
                                    </span>
                                </p>
                                <p class="fw-bold">Telefono:
                                    <span class="fw-normal">
                                        {{ $order->customer->phone }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="row row-cols-3 mt-5 flex-wrap">
                            @if (count($appetizers) > 0)
                                <div class="appetizers">
                                    <p class="fw-bold">Antipasti</p>
                                    @foreach ($appetizers as $order_food)
                                        <p>{{ $order_food->name }} x
                                            {{ $order_food->pivot->quantity_ordered }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif

                            @if (count($first_dishes) > 0)
                                <div class="first_dishes">
                                    <p class="fw-bold">Primi</p>
                                    @foreach ($first_dishes as $order_food)
                                        <p>{{ $order_food->name }} x
                                            {{ $order_food->pivot->quantity_ordered }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif

                            @if (count($second_dishes) > 0)
                                <div class="second_dishes">
                                    <p class="fw-bold">Secondi</p>
                                    @foreach ($second_dishes as $order_food)
                                        <p>{{ $order_food->name }} x
                                            {{ $order_food->pivot->quantity_ordered }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif

                            @if (count($side_dishes) > 0)
                                <div class="side_dishes">
                                    <p class="fw-bold">Contorni</p>
                                    @foreach ($side_dishes as $order_food)
                                        <p>{{ $order_food->name }} x
                                            {{ $order_food->pivot->quantity_ordered }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif

                            @if (count($sweets) > 0)
                                <div class="sweets">
                                    <p class="fw-bold">Dolci</p>
                                    @foreach ($sweets as $order_food)
                                        <p>{{ $order_food->name }} x
                                            {{ $order_food->pivot->quantity_ordered }}
                                        </p>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('admin_page_name')
    Ordini Completati
@endsection

@section('content')
    <div class="container">
        <div
            class="ms_int d-flex justify-content-between py-2 px-4 align-items-center rounded rounded-4 bg-white border mb-4">
            <h3 class="mb-0">Ordini Completati</h3>
            <a href="{{ route('admin.orders.index') }}" class="ms_btn ms_btn-yellow float-center">Indietro</a>
        </div>

        <table class="table table-hover border">
            <thead>
                <tr class="text-center">
                    <th scope="col">N.Ordine</th>
                    <th class="d-none" scope="col">Cliente</th>
                    <th class="d-none" scope="col" colspan="2">Indirizzo</th>
                    <th scope="col">Data</th>
                    <th class="d-none" scope="col">Spesa Totale</th>
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders_complete as $order)
                    <tr class="text-center">
                        <th>#{{ $order->id }}</th>
                        <td class="d-none">{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                        <td class="d-none" colspan="2">{{ $order->customer->address }}</td>
                        <td>{{ $order->formatted_created_at }}</td>
                        <td class="d-none">{{ $order->total_amount }} €</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('admin.orders.show', ['order' => $order->id]) }}"
                                    class="ms_btn ms_btn-yellow"><i class="fa-regular fa-eye"></i></a>
                                <form action="{{ route('admin.order.uncheck', ['order' => $order->id]) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button @disabled($order->status === 0) type="submit" class="ms_btn ms_btn-green">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders_complete->render() }}

    </div>
@endsection

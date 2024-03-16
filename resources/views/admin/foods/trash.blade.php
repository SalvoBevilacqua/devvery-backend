@extends('layouts.admin')

@section('admin_page_name')
    Cestino
@endsection

@section('content')

    {{-- Trash Table --}}
    <div class="container">

        @if (count($foods) > 0)
            <div
                class="ms_int d-flex justify-content-between py-2 px-4 align-items-center rounded rounded-4 bg-white border">
                <h3 class="mb-0">I tuoi piatti eliminati: {{ count($food_deleted) }}</h3>
                <a href="{{ route('admin.foods.index') }}" class="ms_btn ms_btn-dark">Indietro</a>
            </div>

            {{-- Restore Message Success --}}
            @if (session('message'))
                <div class="py-2 px-4 rounded rounded-4 bg-white border mt-4 d-inline-block">
                    <p class="ms_color-dark fw-bold p-0 m-0">
                        {{ strtoupper(session('message')) }}
                    </p>
                </div>
            @endif

            {{-- Def Delete Message --}}
            @if (session('def_del_mess'))
                <div class="py-2 px-4 rounded rounded-4 bg-white border mt-4 d-inline-block">
                    <p class="ms_color-dark fw-bold p-0 m-0">
                        {{ strtoupper(session('def_del_mess')) }}
                    </p>
                </div>
            @endif

            {{-- CARD --}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                @foreach ($foods as $food)
                    <div class="col g-4">
                        <div class="card rounded rounded-4 h-100 border">
                            <div class="card-body">
                                <h5 class="card-title">{{ $food->name }}</h5>
                                <p class="mt-0">{{ $food->category->name }}</p>
                                <h5>Descrizione:</h5>
                                <p>{{ $food->description }}</p>
                            </div>
                            <div
                                class="gap-2 d-flex card-body flex-wrap align-items-center justify-content-around border-top border-2">
                                <form action="{{ route('admin.foods.restore', ['food' => $food->id]) }}" method="POST">
                                    @csrf
                                    <button class="ms_btn ms_btn-yellow" type="submit">Ripristina</button>
                                </form>
                                <form action="{{ route('admin.foods.def_destroy', ['food' => $food->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ms_btn ms_btn-red def-delete-btn" type="submit" data-bs-toggle="modal"
                                        data-bs-target="#modal-def-delete">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div
                class="ms_int d-flex justify-content-between py-2 px-4 align-items-center rounded rounded-4 bg-white border">
                <h3 class="mb-0">Il tuo cestino è vuoto</h3>
                <a href="{{ route('admin.foods.index') }}" class="ms_btn ms_btn-dark">Indietro</a>
            </div>
        @endif

        {{-- Deleted Modal --}}
        @include('partials.modal_def_delete')
    </div>
@endsection

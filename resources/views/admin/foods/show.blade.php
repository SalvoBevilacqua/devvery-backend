@extends('layouts.admin')

@section('admin_page_name')
    {{ $food->name }}
@endsection

@section('content')
    <div class="container mt-3">
        <a href="{{ route('admin.foods.index') }}" class="ms_btn ms_btn-dark">Indietro</a>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border rounded rounded-4">
                    <div class="row">
                        <div class="col-md-5">
                            @if ($food->cover_image)
                                <img src="{{ asset('storage/' . $food->cover_image) }}"
                                    class="w-100 object-fit-cover rounded-start-4" alt="Foto del {{ $food->name }}">
                            @else
                                <img src="{{ Vite::asset('resources\img\noimg.png') }}"
                                    class="w-100 object-fit-cover rounded-start-4" alt="Immagine non disponibile">
                            @endif
                        </div>

                        <div class="col-md-7">
                            <div class="card-body d-flex flex-column justify-content-between h-100">
                                @if ($food->available === 1)
                                    <p class="badge bg-success w-100">Disponibile</p>
                                @else
                                    <p class="badge bg-danger w-100">Non Disponibile</p>
                                @endif

                                <p class="d-inline-block py-2 px-3 bg-body-secondary rounded fw-bold align-self-start">
                                    {{ $food->category->name }}
                                </p>
                                <h3 class="card-title">{{ $food->name }}</h3>
                                <p class="card-text fs-5">{{ $food->description }}</p>

                                @if ($food->celiac === 1 || $food->vegan === 1)
                                    <div>
                                        @if ($food->celiac === 1)
                                            <p class="d-inline-block py-2 px-3 bg-body-secondary rounded fw-bold">
                                                Gluten Free</p>
                                        @endif
                                        @if ($food->vegan === 1)
                                            <p class="d-inline-block py-2 px-3 bg-body-secondary rounded fw-bold">
                                                Vegano</p>
                                        @endif
                                    </div>
                                @endif

                                <p class="card-text fs-5"><strong>Prezzo:</strong> {{ $food->price }} €</p>
                                <a href="{{ route('admin.foods.edit', ['food' => $food->id]) }}"
                                    class="ms_btn ms_btn-yellow align-self-end">Modifica</a>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

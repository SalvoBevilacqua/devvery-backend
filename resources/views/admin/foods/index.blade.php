@extends('layouts.admin')

@section('admin_page_name')
    Menu'
@endsection

@section('content')
    <div class="container">
        <div class="ms_int d-flex justify-content-between py-2 px-4 align-items-center rounded rounded-4 bg-white border">
            <h3 class="mb-0">I tuoi piatti: {{ count(Auth::user()->restaurant->foods) }}</h3>

            <div class="d-flex gap-3 align-items-center">
                <a href="{{ route('admin.foods.create') }}" class="ms_btn ms_btn-yellow"><i
                        class="fa-regular fa-square-plus"></i></a>
                <a class="ms_btn ms_btn-yellow" href="{{ route('admin.foods.trash') }}"><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>

        {{-- Delete and Restore Message Success --}}
        @if (session('message'))
            <div class="py-2 px-4 rounded rounded-4 bg-white border mt-4 d-inline-block">
                <p class="ms_color-dark fw-bold p-0 m-0">
                    {{ strtoupper(session('message')) }}
                </p>
            </div>
        @elseif (session('trash_message'))
            <div class="py-2 px-4 rounded rounded-4 bg-white border mt-4 d-inline-block">
                <p class="ms_color-dark fw-bold p-0 m-0">
                    {{ strtoupper(session('trash_message')) }}
                </p>
            </div>
        @endif

        {{-- CARD --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5">
            @foreach ($foods as $food)
                <div class="col g-4">
                    <div class="card hover-zoom border h-100">
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-end">
                                @if ($food->available === 1)
                                    <div class="badge bg-success">Disponibile</div>
                                @else
                                    <div class="badge bg-danger">Non Disponibile</div>
                                @endif
                            </div>
                            <h5 class="card-title mb-0">{{ $food->name }}</h5>
                            <p class="mt-0">{{ $food->category->name }}</p>
                        </div>

                        <div class="ratio ratio-16x9 position-relative">
                            @if ($food->cover_image)
                                <img src="{{ asset('storage/' . $food->cover_image) }}" class="object-fit-cover"
                                    alt="Foto del {{ $food->name }}">
                            @else
                                <img src="{{ Vite::asset('resources\img\noimg.png') }}" class="object-fit-cover"
                                    alt="Immagine non disponibile">
                            @endif

                            <div
                                class="d-flex flex-column align-items-end position-absolute gap-2 justify-content-center pe-2 ms_query_for_button">
                                <a href="{{ route('admin.foods.show', ['food' => $food->id]) }}"
                                    class="btn ms_btn-dark btn-sm ms_width_icon">
                                    <i class="fa-solid fa-book-open"></i>
                                </a>
                                <a href="{{ route('admin.foods.edit', ['food' => $food->id]) }}"
                                    class="btn ms_btn-yellow btn-sm ms_width_icon">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.foods.destroy', ['food' => $food->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-title="{{ $food->name }}"
                                        class="btn ms_btn-red btn-sm delete-btn ms_width_icon" data-bs-toggle="modal"
                                        data-bs-target="#modal-delete" type="submit"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @include('partials.modal_delete')
    </div>
@endsection

@extends('layouts.main')

@section('content')
<form class="p-5 col-lg-6 mx-auto" method="POST" action="/admin/tea/edit/{{ $product->id }}" enctype="multipart/form-data">
    @csrf
    <p class="h4 mb-4 text-center">Редактировать чай</p>


    <select class="browser-default custom-select mb-2 @error('teaCategory') is-invalid @enderror" id="teaCategory" name="teaCategory">
        <option value="" disabled="" selected="">Категория</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" @if( $product->category_id == $cat->id) selected @endif >{{ $cat->name }}</option>
        @endforeach
    </select>
    @error('teaCategory')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input class="form-control mb-2 @error('teaName') is-invalid @enderror" id="teaName" value="{{ $product->name }}" name="teaName" type="text" placeholder="Название">
    @error('teaName')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <select class="browser-default custom-select mb-2 @error('teaKind') is-invalid @enderror" id="teaKind" name="teaKind">
        <option value="" disabled="" selected="">Вид чая</option>
        @foreach($kinds as $kind)
        <option value="{{ $kind->id }}" @if( $product->tea_kind == $kind->id) selected @endif >{{ $kind->name }}</option>
        @endforeach
    </select>
    @error('teaKind')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <select class="browser-default custom-select mb-2 @error('teaTaste') is-invalid @enderror" name="teaTaste" id="teaTaste">
        <option value="" disabled="" selected="">Вкус чая</option>
        @foreach($tastes as $taste)
        <option value="{{ $taste->id }}" @if( $product->tea_taste == $taste->id) selected @endif >{{ $taste->name }}</option>
        @endforeach
    </select>
    @error('teaTaste')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <textarea class="form-control mb-2 @error('cardDescription') is-invalid @enderror" id="cardDescription" value="" name="cardDescription" placeholder="Карточное описание">{{ $product->card_description }}</textarea>
    @error('cardDescription')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <textarea class="form-control mb-2 @error('fullDescription') is-invalid @enderror" id="fullDescription" value="" name="fullDescription" placeholder="Полное описание">{{ $product->full_description }}</textarea>
    @error('fullDescription')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <input class="form-control mb-2 @error('teaPrice') is-invalid @enderror" id="teaPrice" name="teaPrice" value="{{ $product->price }}" type="text" placeholder="Стоимость">
    @error('teaPrice')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Upload</span>
        </div>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('teaImg') is-invalid @enderror" value="{{ old('teaImg') }}" name="teaImg" id="teaImg" aria-describedby="teaImg">
            <label class="custom-file-label" for="teaImg">Фото чая</label>
        </div>
        @error('teaImg')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button class="btn btn-green btn-block" type="submit">Save</button>
</form>
@endsection

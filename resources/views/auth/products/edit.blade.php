@extends('auth.layout.master')

@isset($product)
    @section('title', 'Редактировать товар ' . $product->name)
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактировать товар <b>{{ $product->name }}</b></h1>
        @endisset
        <form method="POST" enctype="multipart/form-data"
              @isset($product)
                 action="{{ route('products.update', $product) }}"
              @endisset >
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                @csrf
                <div class="form-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code"
                               value="@isset($product){{ $product->code }}@endisset">
                    </div>
                </div>

                <br>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="@isset($product){{ $product->name }}@endisset">
                    </div>
                </div>
                <br>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название en: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name"
                               value="@isset($product){{ $product->name }}@endisset">
                    </div>
                </div>
                <br>

                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'category_id'])
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if($product->category_id == $category->id)
                                             selected
                                        @endif>
                                        {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>

                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72" rows="7">{{ $product->description }}</textarea>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание en: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'description_en'])
                        <textarea name="description_en" id="description" cols="72" rows="7">{{ $product->description }}</textarea>
                    </div>
                </div>
                <br>

                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" style="display: none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                <br>

                <div class="form-group  row">
                    <label for="category_id" class="col-sm-2 col-form-label">Свойство: </label>
                    <div class="col-sm-6">
                        @include('auth.layout.error', ['fieldName' => 'property_id[]'])
                        <select name="property_id[]" multiple class="form-control">
                            @foreach($properties as $property)
                                <option value="{{ $property->id }}"
                                        @if($product->properties->contains($property->id ))
                                            selected
                                        @endif
                                    >
                                    {{ $property->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>

               {{-- <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-2">
                        @include('auth.layout.error', ['fieldName' => 'price'])
                        <input type="text" class="form-control" name="price" id="price"
                               value="@isset($product){{ $product->price }}@endisset">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="count" class="col-sm-2 col-form-label">Кол-во: </label>
                    <div class="col-sm-2">
                        @include('auth.layout.error', ['fieldName' => 'count'])
                        <input type="text" class="form-control" name="count" id="count"
                               value="@isset($product){{ $product->count }}@endisset">
                    </div>
                </div>
                <br>--}}

                @foreach ([
                'hit' => 'Хит',
                'new' => 'Новинка',
                'recommend' => 'Рекомендуемые'
                ] as $field => $title)
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">{{ $title }}: </label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="{{$field}}" id="{{$field}}"
                            @if(isset($product) && $product->$field === 1)
                                   checked="checked"
                                @endif
                            >
                        </div>
                    </div>
                    <br>
                @endforeach
                <button class="btn btn-primary">Сохранить</button>
                <br>
            </div>
            <br>
        </form>
    </div>
@endsection
<br>

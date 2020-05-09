<div class="form-group">
    <label for="exampleInput">Заголовок продукта</label>
    <input type="text" class="form-control" id="exampleInput" name="name"
           value="{{old('name')?? $product->name??''}}"
           placeholder="Введите заголовок продукта" required="required">
</div>

<div class="form-group">
    <label for="exampleInput">Заголовок продукта на Английском языке</label>
    <input type="text" class="form-control" id="exampleInput" name="name_en"
           value="{{old('name_en')?? $product->name_en??''}}"
           placeholder="Введите заголовок продукта на Английском языке">
</div>

<div class="form-group">
    <label for="exampleInput">Код продукта</label>
    <input type="text" class="form-control" id="exampleInput" name="code"
           value="{{old('code')?? $product->code??''}}"
           placeholder="Введите код продукта" required="required">
</div>

<div class="form-group">
    <label for="exampleInput">Описание продукта</label>
    <input type="text" class="form-control" id="exampleInput" name="description"
           value="{{old('description')?? $product->description??''}}"
           placeholder="Введите описание продукта" required="required">
</div>

<div class="form-group">
    <label for="exampleInput">Описание продукта на Английском языке</label>
    <input type="text" class="form-control" id="exampleInput" name="description_en"
           value="{{old('description_en')?? $product->description_en??''}}"
       placeholder="Введите описание продукта на Английском языке">
</div>

<div class="form-group">
    <label for="exampleInput">Цена продукта</label>
    <input type="text" class="form-control" id="exampleInput" name="price"
           value="{{old('price')?? $product->price??''}}"
           placeholder="Введите цену продукта" required="required">
</div>

<div class="form-group">
    <label for="exampleInput">Количество продукта</label>
    <input type="text" class="form-control" id="exampleInput" name="product_count"
           value="{{old('count')?? $product->product_count??''}}"
           placeholder="Введите количество продукта" required="required">
</div>

<div class="form-group">
    <label for="category_id">Выбор категории продукта</label>
    <select class="form-control" name="category_id" id="category_id" required="required">
        @foreach($all_category as $category)
            <option name="category_id" value="{{$category->id}}">
                {{$category->name}}
            </option>
        @endforeach
    </select>
</div>
@foreach ([
              'is_hit' => 'Хит',
              'is_new' => 'Новинка',
              'is_recommend' => 'Рекомендуемые'
              ] as $field => $title)
    <div class="form-check">
        <label for="code">{{ $title }}: </label>
            <input type="checkbox" name="{{$field}}" id="{{$field}}"
                   @if(isset($product) && $product->$field == true)
                  checked
                @endif
            />
    </div>
@endforeach

<div class="form-group">
    <label for="image">Выберите картинку для продукта(или оставьте текущую)</label>
    <input type="file" class="form-control-file" id="image" name="image">
    <p>Текущая картинка : </p>
    <img src= @if(!isset($product)) {{'Картинка отсутствует'}} @else {{Storage::url($product->image)}} @endif
        alt="{{$product->name ?? 'Картинка отсутствует'}}">
</div>


<div class="form-group">
    <label for="exampleInput">Заголовок категории</label>
    <input type="text" class="form-control" id="exampleInput" name="name"
           value="{{old('name')?? $category->name??''}}"
           placeholder="Введите заголовок категории" required="required">
</div>

<div class="form-group">
    <label for="exampleInput">Заголовок категории на Английском языке</label>
    <input type="text" class="form-control" id="exampleInput" name="name_en"
           value="{{old('name_en')?? $category->name_en??''}}"
           placeholder="Введите заголовок категории на Английском языке">
</div>

<div class="form-group">
    <label for="exampleInput">Код категории</label>
    <input type="text" class="form-control" id="exampleInput" name="code"
           value="{{old('code')?? $category->code??''}}"
           placeholder="Введите код категории" required="required">
</div>
<div class="form-group">
    <label for="exampleInput">Описание категории</label>
    <input type="text" class="form-control" id="exampleInput" name="description"
           value="{{old('description')?? $category->description??''}}"
           placeholder="Введите описание категории" required="required">
</div>

<div class="form-group">
    <label for="exampleInput">Описание категории на Английском языке</label>
    <input type="text" class="form-control" id="exampleInput" name="description_en"
           value="{{old('description_en')?? $category->description??''}}"
           placeholder="Введите описание категории на Английском языке">
</div>
<div class="form-group">
    <label for="image">Выберите картинку для категории(или оставьте текущую)</label>
    <input type="file" class="form-control-file" id="image" name="image">
    <p>Текущая картинка : </p>
    <img src= @if(!isset($category)) {{'Картинка отсутствует'}} @else {{Storage::url($category->image)}} @endif
        alt="{{$category->name ?? 'Картинка отсутствует'}}">
</div>

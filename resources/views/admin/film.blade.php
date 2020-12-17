<x-admin-layout>
  <x-slot name="header">Список фильмов и сериалов</x-slot>

  <x-slot name="breads">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Starter Page</li>
  </x-slot>

  <form action="{{route('admin.film.set')}}" method='Post'>
    @csrf
    <input type="hidden" name="id" value="{{$film->id}}" class="form-control">
    <div class="form-group">
      <label>Название</label>
      <input type="text" disabled name="title" value="{{$film->title}}" class="form-control">
    </div>
    <div class="form-group">
      <label><img src="{{$film->image}}" style="width: 150px; height: 150px;" alt=""></label>
      <input type="file" name="image" style="display: none" class="form-control">
    </div>
    <div class="form-group">
      <label>Описание</label>
      <textarea name="description" rows="5" class="form-control">{{$film->description}}</textarea>
    </div>
    <div class="form-group">
      <label>Жанры</label>
      <input type="text" name="genres" value="{{$film->genres}}" class="form-control">
    </div>
    <div class="form-group">
      <label>Доп. ключи (указываются через запятую)</label>
      <input type="text" name="keys" value="{{$film->keys}}" class="form-control">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>

  </form>
</x-admin-layout>
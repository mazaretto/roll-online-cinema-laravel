<x-admin-layout>
  <x-slot name="header">Список фильмов и сериалов</x-slot>

  <x-slot name="breads">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Starter Page</li>
  </x-slot>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

  <table class="data-table">
    <thead>
    <tr>
      <th>ID</th>
      <th>Название</th>
      <th>Постер</th>
      <th>Описание</th>
      <th>Жанры</th>
      <th style="width: 40px;"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($films??[] as $film)
    <tr>
      <td>{{$film->id}}</td>
      <td>{{$film->title}}</td>
      <td><img src="{{$film->image}}" style="width: 150px; height: 150px;" alt=""></td>
      <td>{{$film->description}}</td>
      <td>{{$film->genres}}</td>
      <td>
        <div class="d-flex">
          <a href="{{route('admin.film', ['id' => $film->id])}}" class="btn btn-success">
            <i class="fas fa-edit"></i>
          </a>
        </div>
      </td>
    </tr>
    @endforeach
    </tbody>
  </table>
</x-admin-layout>
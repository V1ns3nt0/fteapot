@extends('layouts.main')

@section('content')
<h2>Admin Panel</h2>
<div class="btn-group-vertical" role="group" aria-label="Vertical button group">
  <a href="/admin/tea" class="btn btn-success">Чай</a>
  <a href="/admin/articles" class="btn btn-amber">Статьи</a>
  <a href="/admin/news" class="btn btn-red">Новости</a>
  <a href="/admin/staff" class="btn btn-primary">Сотрудники</a>
</div>
@endsection

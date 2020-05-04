@extends('layouts.main')

@section('content')
<div class="text-center my-5">
    <a href="/admin/staff/add" class="btn green darken-1 white-text">Добавить нового сотрудника</a>
</div>
<div class="d-flex flex-wrap justify-content-center">
@foreach ($staff as $worker)
<div class="card mb-3 mx-1" style="min-width:20em;">
  <div class="card-body">
    <h5 class="card-title nav-headers-links">{{$worker->last_name." ".$worker->first_name}} </h5>
    <p class="card-text">{{$worker->email}}</p>
    @if(Auth::user()->id != $worker->id)
    <a class="card-link" href="/admin/staff/diband/{{ $worker->id }}">Снять права</a>
    @endif
  </div>
</div>
@endforeach
</div>
<div class="d-flex justify-content-center">
  {{ $staff->links() }}
</div>
@endsection

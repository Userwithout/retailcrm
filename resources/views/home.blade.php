@extends('layouts.app')

@section('content')
    <h1> Страница контактов </h1>
    @include('inc.messages')

    <form action = "{{ route('order') }}" method='post'>
      <div class = "form-group">
        @csrf

              <label for = 'name'> Введите ФИО </label>
              <input type = 'text' name='name' placeholder="" class = 'form-control'>
              <label for = 'name'> Введите артикул </label>
              <input type = 'text' name='art' placeholder="AZ105W" class = 'form-control'>
              <label for = 'name'> Введите бренд </label>
              <input type = 'text' name='brand' placeholder="Azalita"  class = 'form-control'>
              <label for = 'name'> Оставьте комментарий </label>
              <textarea name='text' class = 'form-control'></textarea>

              <button type = "submit" name='button' class = "btn btn-success">Отправить </button>
      <div>
    </form>
@endsection

@extends('layouts.ytdl')

@section('content')


  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col mt-3">
        Nieźle! Fajnie, że wpadłeś. Aby dokończyć rejestrację musisz się przedstawić oraz ustawić sobie hasło!
        <form class="row" action="{{ route('accept') }}" method="post">
          <div class="col-auto">

            {{ csrf_field() }}
            <input class="form-control" type="text" name="name" placeholder="Imię bądź ksywa" required />
            <input class="form-control" type="password" name="password" placeholder="Wprowadź hasło" required />
            <input class="form-control" type="password" name="repeat" placeholder="Powtórz hasło" required />
            <button class="form-control btn btn-primary mt-1" type="submit">{{ _('Zakończ rejestrację') }}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.ytdl')

@section('content')


  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col mt-3 text-center">
        @if ($inviteCounter > 0)
        Formularz zaproszeniowy. Aby zaprosić osobę, podaj jej adres e-mail. Masz do wykorzystania <b>{{ $inviteCounter }}</b> zaproszeń.<br />
        Możliwość zaproszenia nowej osoby dostaniesz co 30 dni od momentu rejestracji.<br /><br />
        <form class="row justify-content-center" action="{{ route('invite') }}" method="post">
          <div class="col-auto">

            {{ csrf_field() }}
            <input class="form-control" type="email" name="email" placeholder="example@email.com" required />
            <button class="form-control btn btn-primary mt-1" type="submit">{{ __('Wyślij zaproszenie') }}</button>
          </div>
        </form>
        @else
        Nie możesz zapraszać, nie masz dostępnych zaproszeń.
        @endif
      </div>
    </div>
  </div>
@endsection

<p>Cze!</p>

<p>Ktoś Cię właśnie zaprosił do dołączenia na pewnej tajemniczej stronie. :) Jeśli o tym nie wiesz, możesz zignorować tego maila!</p>

<p>Kliknij w poniższy link aktywacyjny, by aktywować konto!<br />
<a href="{{ route('accept', $invite->token) }}">{{ route('accept', $invite->token) }}</a></p>

<p>Jeśli link aktywacyjny nie działa, podaj ten kod: <b>{{ $invite->token }}</b><br />
na tej stronie: <a href="{{ route('register') }}">{{ route('register') }}</a></p>

<p>Pozdrawiam!<br />
sharkson<br />
<a href="{{ route('home') }}">{{ route('home') }}</a></p>

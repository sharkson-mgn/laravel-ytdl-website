@extends('layouts.ytdl')

@section('content')

  <div id="imgExample" class="thumb rounded">
    <img src="" style="width: 100%"/>
    <!-- <iframe type="text/html" width="196" height="110" frameborder="0"></iframe> -->
    <!-- <iframe width="196" height="110" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
    <span class="duration px-2">dur</span>
  </div>

  <div class="row" id="urlExample">
    <div class="col-12 url rounded border fw-bold bg-secondary text-white p-3 mb-1">
      url
    </div>
    <div class="col-12 videos">
      <div class="loader"></div>
    </div>
  </div>

  <div class="container-flow p-1 videoObject" id="videoExample">
    <div class="row">
      <div class="col">
        <div class="row">
          <div class="col-12 fw-bold title">
            dyduł
          </div>
          <div class="col-12 fw-italic info">
            data, wyświetlenia
          </div>
          <div class="col-12 downloadArea">
            <span class="fromto d-none">0:00 - </span>
            <div class="timeSlider mt-3 d-none">

            </div>
            <input type="button" class="btn btn-small btn-success mt-2 fw-bold mx-auto d-flex justify-content-center convertBtn"
              style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: 1rem; --bs-btn-font-size: .6rem; width: 10em;" value="Konwertuj" />
          </div>
        </div>
      </div>
      <div class="col-6 col-md-5 col-lg-4 imgCover">
        miniaturka
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col mt-3">
        <textarea class="form-control" id="inputUrls" rows="3" placeholder="Paste url here..." style="resize: none;">{{ $url }}</textarea>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col my-3">
        <div class="container-fluid" id="urls">

        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col my-3">
        <textarea class="form-control" rows="10" id="debug"></textarea>
        <div id="debugHTML"></div>
      </div>
    </div>
  </div>

  <div class="row justify-content-md-center">
    <div class="col-9 border-top my-4 rounded-top text-center">
      YouTube Downloader by mgn to darmowe narzędzie do pobierania materiałów z serwisu YouTube w wybranym formacie audio lub wideo.<br />
      Narzędzie elitarne ponieważ nie posiada <u>żadnych</u> ograniczeń lecz dostępne jest tylko dla wybranych. Widzisz to więc jesteś <b style="color: gold;">VIP</b>.<br />trolllo
    </div>
  </div>

@endsection

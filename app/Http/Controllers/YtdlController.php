<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

use sharksonmgn\YtdlAdapter\Adapter;

class YtdlController extends Controller
{

    private $yt;
    private $validUrls;
    private $validUrl;

    public function __construct(Request $req)
    {
        $this->middleware('auth')->except(['index','register']);
    }

    private function prepareYt($reason, Request $req, $field) {

      $this->yt = new Adapter();
      $this->yt->setPath('thisDirname',storage_path('app').'/ytdl');

      $this->validUrl = Validator::make($req->all(), [
        $field  =>  'required'
      ]);

      if ($this->validUrl->fails()) {
        return $this->responseError($reason,$req->all());
      }

      return true;
    }

    private function startsWith( $haystack, $needle ) {
      $length = strlen( $needle );
      return substr( $haystack, 0, $length ) === $needle;
    }

    public function index(Request $req)
    {
      if (Auth::check()) {
        $url = $req->input('v');

        if (!$url && false) {
          $url = 'https://www.youtube.com/watch?v=qW8270sfsxM&list=PLL8SN36XIUnYvT1jSyTLgX5gk9TYNduQL';
        }

        if (!empty($url))
        {
          $yt = new Adapter($url);
          if (!$yt->isValid())
          {
            $url = 'https://www.youtube.com/watch?v=' . $url;
          }
        }
        return view('home', ['url' => $url]);
      }
      else {
        return view('auth/login');
      }
    }

    private function responseError($reason,$post,$res=[]) {
      return response()->json([
        'response'  => 'error',
        'reason'    => $reason,
        'post'      => $post,
        'res'       => $res,
      ]);
    }

    private function responseOk($reason,$post,$res=[]) {
      return response()->json([
        'response'  => 'ok',
        'reason'    => $reason,
        'post'      => $post,
        'res'       => $res,
      ]);
    }

    public function infoRequest(Request $req) {

      $this->prepareYt(__FUNCTION__,$req,'urls');

      $res = $this->yt->infoRequest($req->input('urls'));
      return $this->responseOk(__FUNCTION__,$req->all(),$res);

    }

    public function infoGet(Request $req) {

      $this->prepareYt(__FUNCTION__,$req,'urls');

      $res = $this->yt->infoRequestStatus($req->input('urls'));
      return $this->responseOk(__FUNCTION__,$req->all(),$res);

    }

    public function downloadRequest(Request $req) {
      $this->prepareYt(__FUNCTION__,$req,'url');

      try {
        $res = $this->yt->downloadRequest($req->input('url'));
      } catch (Exception $e) {
        return $this->responseError(__FUNCTION__,$req->all(),$e);
      }
      return $this->responseOk(__FUNCTION__,$req->all(),$res);

    }

    public function downloadInfo(Request $req) {
      $this->prepareYt(__FUNCTION__,$req,'url');

      $this->yt->setUrl($req->input('url'));
      $res = $this->yt->downloadProgres();
      return $this->responseOk(__FUNCTION__,$req->all(),$res);
    }

    public function download($id) {
      $this->yt = new Adapter('https://www.youtube.com/watch?v=' . $id);
      $this->yt->setPath('thisDirname',storage_path('app').'/ytdl');
      $file_url = $this->yt->getDownloadPath();
      $headers = [
        'Content-Type: application/octet-stream',
        "Content-Transfer-Encoding: Binary",
      ];
      //return 'test';
      return response()->download($file_url, basename($file_url), $headers);
    }

}

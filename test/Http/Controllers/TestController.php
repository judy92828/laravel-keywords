<?php

namespace JingJing\Keywords\Test\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TestController extends Controller
{

  /**
   * 测试页面
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index()
  {
    return view('jjKeywords::index');
  }

  /**
   * 文章数据处理
   * @param Request $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    $returnJson = app('JKeywords')->check_words($request->get('contents'), $request->get('keywords'));
    return response()->json($returnJson);
  }

}
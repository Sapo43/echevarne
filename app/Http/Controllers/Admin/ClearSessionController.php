<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ClearSessionController extends Controller {

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
            \Session::flush();
            return redirect()->back();
	}

}

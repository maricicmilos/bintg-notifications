<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Admin Dashboard View
     *
     * @return Factory|View
     */
    public function indexAdmin()
    {
        return view('admin.index');
    }

    /**
     * Admin Dashboard View
     *
     * @return Factory|View
     */
    public function indexDoctor()
    {
        return view('doctor.index');
    }


}

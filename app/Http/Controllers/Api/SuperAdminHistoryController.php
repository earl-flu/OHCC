<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SuperAdminHistoryResource;
use App\Models\History;
use Illuminate\Http\Request;

class SuperAdminHistoryController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('_date');

        //Date is required, will return empty array if date is not set
        $histories = History::whereDate('created_at', $date)
            ->orderBy('created_at', 'desc')
            ->get();

        return SuperAdminHistoryResource::collection($histories);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use Str;

// TODO Додати вибір за інтервал дат

//GET http://test.com/api/report/client?rows=5&sort=-status 
class ApiReportsClientsController extends Controller
{
    /**
     * Display a listing of the resource for clients 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int rows
     * @param  string $sort
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    //GET http://test.com/api/report/client?rows=5&sort=-status
    public function clientReport(Request $request)
    {
        $apiKey = $request->header('X-API-KEY');
        $sortCol = $request->input('sort', 'name');
        $rows = $request->input('rows');

        $sortDirection = Str::startsWith($sortCol, '-') ? 'desc' : 'asc';
        $sortCol = ltrim($sortCol, '-');

        if(strlen($apiKey) == 0)
            return response()->json(['status' => 'error', 'message' => 'Token is Invalid'], 500); 
        
        $selClients = Client::where('remember_token', $apiKey)->get();
        
        if($selClients->count() != 1) 
            return response()->json(['status' => 'error', 'message' => 'Unauthenticated'], 500);
        
        if(strlen($sortCol) == 0){
            $sortCol = 'created_at';
            $sortDirection = 'asc';
        }

        if(is_numeric($rows))
            $rows = intval($rows); 
        else
            $rows = 100;
        
        return response()->json(Order::where('client_id', $selClients[0]->id)->orderBy($sortCol, $sortDirection)->paginate($rows, ['name', 'description', 'phone', 'amount', 'open_date', 'close_date']), 200);
    }

}





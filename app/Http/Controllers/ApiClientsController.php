<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Client;
use App\Models\Order;
use App\Models\User;

class ApiClientsController extends Controller
{
    /**
     * Check api-key
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ['status' => '', 'message' => '']
     * 
     */
    private function checkApi($request)
    {
        $apiKey = $request->header('X-API-KEY');

        if(strlen($apiKey) == 0)
            return ['status' => 'error', 'message' => 'Token is Invalid'];
        $selUser = User::where('remember_token', $apiKey)->get();
        if($selUser->count() == 0)
            return ['status' => 'error', 'message' => 'Unauthenticated'];

        return ['status' => 'ok', 'message' => ''];
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    // GET http://test.com/api/clients/
    public function index(Request $request)
    {
        $check = $this->checkApi($request);

        if($check['status'] != 'ok')
            return response()->json($check, 500); 

        return response()->json(Client::get(['name','email','address','phone']), 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * 
     */
    //GET http://test.com/api/clients/{id}
    public function show(Request $request, $id)
    {
        $check = $this->checkApi($request);

        if($check['status'] != 'ok')
            return response()->json($check, 500); 

        if(is_numeric($id))
            $id = intval($id); 
        else
            return response()->json(['status' => 'error', 'message' => 'ID is Invalid'], 500); 

        return response()->json(Client::where('id', $id)->get(['name','email','address','phone']), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    //POST http://test.com/api/clients/create
    //HEADER X-API-KEY for user token
    //PARAMS 'name'   
    //PARAMS 'email'
    //PARAMS 'address'
    //PARAMS 'phone'
    //PARAMS 'type' (0 = 'individual', 1 = 'private entrepreneur', 2 = 'company')
    public function store(Request $request)
    {
        $check = $this->checkApi($request);

        if($check['status'] != 'ok')
            return response()->json($check, 500); 

        $pName = $request->input('name');
        $pEmail = $request->input('email');
        $pAddress = $request->input('address');
        $pPhone = $request->input('phone');
        $pType = $request->input('type');

        if( 
            !isset($pName) || trim($pName) == "" ||
            !isset($pEmail) || trim($pEmail) == "" ||
            !isset($pAddress) || trim($pAddress) == "" ||
            !isset($pPhone) || trim($pPhone) == "" ||
            !isset($pType) || trim($pType) == "" || !is_numeric($pType) || ($pType < 0 && $pType > 2) 
        ) 
            return response()->json(['status' => 'error', 'message' => 'Params are incorrect'], 500); 

        if(Client::where('email', $pEmail)->count() > 0)
            return response()->json(['status' => 'error', 'message' => 'Email is already in use '], 500); 

        $pType = intval($pType);

        $newClient = Client::create([
           'name' => trim($pName),
           'email' => trim($pEmail),
           'address' => trim($pAddress),
           'phone' => trim($pPhone),
           'type' => $pType,
           'remember_token' => Str::random(10),
           'created_at' => now(),
           'updated_at' => now(),
        ]);

        $rezult = $newClient->save();

        if($rezult) 
            return response()->json($newClient, 201);
        else
            return response()->json(['status' => 'error', 'message' => 'Unknown error'], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //PUT http://test.com/api/clients/update/{id}
    //HEADER X-API-KEY for user token
    //PARAMS 'name' (OR AND) 'email' (OR AND) 'address' (OR AND) 'phone' (OR AND) 'type' (0 = 'individual', 1 = 'private entrepreneur', 2 = 'company')
    public function update(Request $request, $id)
    {
        $check = $this->checkApi($request);

        if($check['status'] != 'ok')
            return response()->json($check, 500); 

        if(is_numeric($id))
            $id = intval($id); 
        else
            return response()->json(['status' => 'error', 'message' => 'ID is Invalid'], 500); 

        $pName = $request->input('name');
        $pEmail = $request->input('email');
        $pAddress = $request->input('address');
        $pPhone = $request->input('phone');
        $pType = $request->input('type');

        if( 
            (isset($pName) && trim($pName) == "") ||
            (isset($pEmail) && trim($pEmail) == "") ||
            (isset($pAddress) && trim($pAddress) == "") ||
            (isset($pPhone) && trim($pPhone) == "") ||
            (isset($pType) && trim($pType) == "") || 
            (isset($pType) && (!is_numeric($pType) || ($pType < 0 && $pType > 2))) 
        )
            return response()->json(['status' => 'error', 'message' => 'Params are incorrect'], 500); 

        if(isset($pEmail)) {
            if(Client::where([['email', $pEmail],['id', $id]])->count() > 0)
                return response()->json(['status' => 'error', 'message' => 'Email is already in use '], 500); 
        }

        $client = Client::find($id);

        if(!$client)
            return response()->json(['status' => 'error', 'message' => 'Сlient not found'], 500); 

        $edit = false;

        if(isset($pName)) {
            $edit = true;
            $client->name = trim($pName);
        }

        if(isset($pEmail)) {
            $edit = true;
            $client->email = trim($pEmail);
        }

        if(isset($pAddress)) {
            $edit = true;
            $client->address = trim($pAddress);
        }

        if(isset($pPhone)) {
            $edit = true;
            $client->phone = trim($pPhone);
        }

        if(isset($pType)) {
            $edit = true;
            $client->type = intval($pType);
        }

        if($edit == true)
            $rezult = $client->save();
        else $rezult = false;

        if($rezult) 
            return response()->json($client->get(["name", "email", "address", "phone", "type"]), 200);
        else
            return response()->json(['status' => 'error', 'message' => 'Unknown error'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //DELETE http://test.com/api/clients/delete/{id}
    //HEADER X-API-KEY for user token
    public function destroy(Request $request, $id)
    {
        $check = $this->checkApi($request);

        if($check['status'] != 'ok')
            return response()->json($check, 500); 

        if(is_numeric($id))
            $id = intval($id); 
        else
            return response()->json(['status' => 'error', 'message' => 'ID is Invalid'], 500); 

        $client = Client::find($id);

        if(!$client)
            return response()->json(['status' => 'error', 'message' => 'Сlient not found'], 500); 

        $client->delete();       
        return response()->json(['status' => 'ok', 'message' => ''], 200);
    }
}

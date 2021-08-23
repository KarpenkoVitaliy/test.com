<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Expense;
use DataTables;
use DB;


class ApiReportsCompanyController extends Controller
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
     * Check date
     *
     * @param  String  $date
     * @param  String  $format
     * 
     * @return boolean (true- valid date)  
     * 
     */
    private function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Check date range
     *
     * @param  String $minDate format "yyyy-mm-dd"
     * @param  String $maxDate format "yyyy-mm-dd"
     * @return ['status' => 'error', 'message' => ''] OR ['status' => 'ok', "min_date" => '', "max_date" => '']
     * 
     */
    private function checkDateRange($minDate, $maxDate)
    {
        if($minDate == "")
            return ["status" => "error", "message" => "'min_date', not found"];

        if($maxDate == "")
            return ["status" => "error", "message" => "'max_date', not found"];

        if (!$this->validateDate($minDate, 'Y-m-d'))
            return ["status" => "error", "message" => "'min_date', is not valid"];

        if (!$this->validateDate($maxDate, 'Y-m-d'))
            return ["status" => "error", "message" => "'max_date', is not valid"];

        try {
            $d_min_date = \DateTime::createFromFormat('Y-m-d', $minDate)->setTime(0,0);
        } catch (Exception $e){ 
            return ["status" => "error", "message" => "'min_date', is not valid"];
        }

        try {
            $d_max_date = \DateTime::createFromFormat('Y-m-d', $maxDate)->setTime(0,0);
        } catch (Exception $e) {
            return ["status" => "error", "message" => "'max_date', is not valid"];
        }

        if($d_min_date > $d_max_date)
            return ["status" => "error", "message" => "'min_date' > 'max_date' this is not valid"];

        return ["status" => "ok", "min_date" => $d_min_date, "max_date" => $d_max_date];
    }

    /**
     * Display a listing of the resource for clients 
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  date min_date
     * @param  date max_date
     * 
     * @return \Illuminate\Http\Response
     * 
     */
    public function proceedsReport(Request $request)
    {//GET http://test.com/api/report/proceeds?min_date=YYYY-mm-dd&max_date=YYYY-mm-dd

        $check = $this->checkApi($request);

        if($check['status'] != 'ok')
            return response()->json($check, 500); 

        $minDate = trim($request->input('min_date'));
        $maxDate = trim($request->input('max_date'));

        $checkDateRange = $this->checkDateRange($minDate, $maxDate);
        
        if($checkDateRange['status'] == 'error')
            return response()->json($checkDateRange, 500); 

        //Вивести всі замовлення, дата створення яких у вказаному інтервалі
        // return response()->json(Order::whereBetween('created_at', [$checkDateRange['min_date']->format('Y-m-d'), $checkDateRange['max_date']->format('Y-m-d')])->orderBy('created_at')->paginate(100, ['name', 'description', 'phone', 'amount', 'open_date', 'close_date']), 200);


        //Підрахувати всю суму по замовленням (статуси замовлень не враховувати)
        return response()->json(
            ["data" => 
                [
                 "date_range" => "'".$checkDateRange['min_date']->format('Y-m-d')."' - '".$checkDateRange['max_date']->format('Y-m-d')."'",
                 "quantity" => Order::whereBetween('created_at', [$checkDateRange['min_date']->format('Y-m-d'), $checkDateRange['max_date']->format('Y-m-d')])->count(),
                 "amount" => Order::whereBetween('created_at', [$checkDateRange['min_date']->format('Y-m-d'), $checkDateRange['max_date']->format('Y-m-d')])->sum('amount')
                ]
            ], 
        200);
    }

    /**
     * Display a listing of the resource for clients 
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @param  date min_date
     * @param  date max_date
     * 
     * @return Datatables json
     * 
     */
    public function costsReport(Request $request)
    {//GET http://test.com/api/report/costs?min_date=YYYY-mm-dd&max_date=YYYY-mm-dd

        $check = $this->checkApi($request);

        if($check['status'] != 'ok')
            return response()->json($check, 500); 

        $minDate = trim($request->input('min_date'));
        $maxDate = trim($request->input('max_date'));

        $checkDateRange = $this->checkDateRange($minDate, $maxDate);
        
        if($checkDateRange['status'] == 'error')
            return response()->json($checkDateRange, 500); 

        $expanseBonusMaxRezult =  Expense::where([['id', 1],['type', 0]])->get('amount');
        $expanseInterest = Expense::where([['id', 2],['type', 1]])->get('amount');

        if($expanseBonusMaxRezult->count() == 0)
            response()->json(["status" => "error", "message" => "'Bonus', not found"], 500);             

        if(!is_numeric($expanseBonusMaxRezult[0]['amount']) && $expanseBonusMaxRezult[0]['amount'] < 0)
            response()->json(["status" => "error", "message" => "'Bonus', is not valid"], 500);             

        if($expanseInterest->count() == 0)
            response()->json(["status" => "error", "message" => "'Interest', not found"], 500);             

        if(!is_numeric($expanseInterest[0]['amount']) && $expanseInterest[0]['amount'] < 0 && $expanseInterest[0]['amount'] > 100)
            response()->json(["status" => "error", "message" => "'Interest', is not valid"], 500);             

        $sql = "
        SELECT us.name name, emp.salary salary, tbl.sumAmount total_sum_orders, tbl.interest interest, tbl.calc interest_bonus, (emp.salary + tbl.calc) calculation
        FROM users us
        LEFT JOIN employees emp ON emp.user_id = us.id
        LEFT JOIN (
            SELECT empId, sumAmount, interest, 
            IF(sumAmount = 
                (SELECT @A := max(sumAmount) FROM 
                    (SELECT employee_id empId, sum(amount) sumAmount FROM orders WHERE created_at BETWEEN '".$checkDateRange['min_date']->format('Y-m-d')."' AND '".$checkDateRange['max_date']->format('Y-m-d')."' GROUP BY employee_id) t)
            , interest + ".$expanseBonusMaxRezult[0]['amount'].", interest) calc
            FROM (
            SELECT employee_id empId, SUM(amount) sumAmount, round(SUM(amount)/100*".$expanseInterest[0]['amount'].", 2) interest 
            FROM orders 
            WHERE created_at BETWEEN '".$checkDateRange['min_date']->format('Y-m-d')."' AND '".$checkDateRange['max_date']->format('Y-m-d')."'
            GROUP BY employee_id
        ) tab
        )tbl ON tbl.empId = emp.id";

        $data = DB::select($sql);

        $datas= [];
        $i=0;
        foreach ($data as $val) {
            $datas[$i]['name'] = $val->name;
            $datas[$i]['salary'] = $val->salary;
            $datas[$i]['total_sum_orders'] = $val->total_sum_orders;
            $datas[$i]['interest'] = $val->interest;
            $datas[$i]['interest_bonus'] = $val->interest_bonus;
            $datas[$i]['calculation'] = $val->calculation; 
            $i++;
        }

        return Datatables::of($datas)->toJson();
    }
}

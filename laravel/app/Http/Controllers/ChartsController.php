<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartsController extends Controller
{
    //
    public function show($name, $height)
    {
        $monthlyIncome = $this->getMonthlyIncome();
        $monthlyEventIncome = $this->getMonthlyEventIncome();
        //$monthlyUsers= $this->getMonthlyUsers();

        $yearlyIncome = $this->getyearlyIncome();
        $yearlyEventIncome = $this->getYearlyEventIncome();
        //$yearlyUsers= $this->getYearlyUsers();
//dd($monthlyIncome, $monthlyEventIncome);
        foreach($monthlyIncome as $income){
            $amountMonthly[] = $income;
        }

        return view("charts.$name", ['height' => $height])
            ->with(compact('monthlyIncome', 'yearlyIncome', 'monthlyEventIncome', 'yearlyEventIncome', 'monthlyUsers'));
    }

    private function getMonthlyIncome()
    {
        $monthlyIncome = DB::table('users')
            ->whereMonth('lastpayment','<=', date('m'))
            ->whereYear('lastpayment', date('Y'))
            ->orderby('lastpayment', 'ASC')->get();

        $monthlyIncome->groupBy(function($item){
            return Carbon::createFromFormat('Y-m-d', $item->lastpayment)->format('m');
        });

        $data = [];
        foreach($monthlyIncome as $income){
            $dates[] = preg_split('~-~', $income->lastpayment);
            $amounts[] = $income->lastpaymentamount;
        }
        foreach($dates as $date){
            $months[] = $date[1];
        }
        //dd($dates);

        for($i=0; $i<=count($months)-1; $i++) {
            $stuff[$months[$i]][] = $amounts[$i];
        }

        foreach($stuff as $k=>$v){
            $total[$k] = array_sum($v);
        }
        $monthLabels = array_unique($months);


        $data = [
            'labels' => $monthLabels,
            'amounts'=> $total
        ];

        foreach($data['labels'] as $k=>$v){
            switch ($v){
                case '01';
                    $data['labels'][$k] = 'January';
                    break;
                case '02';
                    $data['labels'][$k] = 'Febuary';
                    break;
                case '03';
                    $data['labels'][$k] = 'March';
                    break;
                case '04';
                    $data['labels'][$k] = 'April';
                    break;
                case '05';
                    $data['labels'][$k] = 'May';
                    break;
                case '06';
                    $data['labels'][$k] = 'June';
                    break;
                case '07';
                    $data['labels'][$k] = 'July';
                    break;
                case '08';
                    $data['labels'][$k] = 'August';
                    break;
                case '09';
                    $data['labels'][$k] = 'September';
                    break;
                case '10';
                    $data['labels'][$k] = 'October';
                    break;
                case '11';
                    $data['labels'][$k] = 'November';
                    break;
                case '12';
                    $data['labels'][$k] = 'December';
                    break;
            }
        }

        //dd($data['labels']);
        return $data;
    }
    private function getMonthlyUsers()
    {
        $monthlyUsers = DB::table('users')
            ->whereMonth('created_at', '<=', date('m'))
            ->whereYear('created_at', date('Y'))
            ->orderby('created_at', 'ASC')->get();

        $monthlyUsers->groupBy(function($item){
            return Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('m');
        });
        dd($monthlyUsers);
        $data = [];
        foreach($monthlyUsers as $user){
            $dates[] = preg_split('~-~', $user->created_at);
            $amounts[] = $user->lastpaymentamount;
        }
        foreach($dates as $date){
            $months[] = $date[1];
        }
        //dd($dates);

        for($i=0; $i<=count($months)-1; $i++) {
            $stuff[$months[$i]][] = $amounts[$i];
        }

        foreach($stuff as $k=>$v){
            $total[$k] = array_sum($v);
        }
        $monthLabels = array_unique($months);


        $data = [
            'labels' => $monthLabels,
            'amounts'=> $total
        ];

        foreach($data['labels'] as $k=>$v){
            switch ($v){
                case '01';
                    $data['labels'][$k] = 'January';
                    break;
                case '02';
                    $data['labels'][$k] = 'Febuary';
                    break;
                case '03';
                    $data['labels'][$k] = 'March';
                    break;
                case '04';
                    $data['labels'][$k] = 'April';
                    break;
                case '05';
                    $data['labels'][$k] = 'May';
                    break;
                case '06';
                    $data['labels'][$k] = 'June';
                    break;
                case '07';
                    $data['labels'][$k] = 'July';
                    break;
                case '08';
                    $data['labels'][$k] = 'August';
                    break;
                case '09';
                    $data['labels'][$k] = 'September';
                    break;
                case '10';
                    $data['labels'][$k] = 'October';
                    break;
                case '11';
                    $data['labels'][$k] = 'November';
                    break;
                case '12';
                    $data['labels'][$k] = 'December';
                    break;
            }
        }

        //dd($data['labels']);
        return $data;
    }

    private function getyearlyIncome()
    {
        $yearlyIncome = DB::table('users')
            ->whereDate('lastpayment', '<=', date('Y-m-d'))->orderBy('lastpayment','ASC')->get();

        $years = [];
        foreach($yearlyIncome as $income){
            $dates[] = preg_split('~-~', $income->lastpayment);
            $amounts[] = $income->lastpaymentamount;
        }
        foreach($dates as $date){
            $years[] = $date[0];
        }
        //dd($amounts);

        for($i=0; $i<=count($years)-1; $i++) {
            $stuff[$years[$i]][] = $amounts[$i];
        }

        foreach($stuff as $k=>$v){
            $total[$k] = array_sum($v);
        }
        //dd($total);
        $yearLabels = array_unique($years);


        $data = [
            'labels' => $yearLabels,
            'amounts'=> $total
            ];
        return $data;
    }

    public function getMonthlyEventIncome()
    {

        $monthlyEventIncome = DB::table('events')
            ->whereMonth('payment_date', '<=', date('m'))
            ->whereYear('payment_date', date('Y'))
            ->orderBy('payment_date', 'ASC')->get();

        $monthlyEventIncome->groupBy(function($item){
            return Carbon::createFromFormat('Y-m-d', $item->payment_date)->format('m');
        });

        $data = [];
        foreach($monthlyEventIncome as $income){
            $dates[] = preg_split('~-~', $income->payment_date);
            $amounts[] = $income->amount_paid;
        }
        if(isset($dates)) {
            foreach ($dates as $date) {
                $months[] = $date[1];
            }
            //dd($dates);

            for ($i = 0; $i <= count($months) - 1; $i++) {
                $stuff[$months[$i]][] = $amounts[$i];
            }

            foreach ($stuff as $k => $v) {
                $total[$k] = array_sum($v);
            }
            $monthLabels = array_unique($months);

            $data = [
                'labels' => $monthLabels,
                'amounts' => $total
            ];
        }

        return $data;
    }
    public function getYearlyEventIncome()
    {
        $yearlyIncome = DB::table('events')
            ->whereDate('payment_date', '<=', date('Y-m-d'))
            ->orderBy('payment_date','ASC')->get();

        $years = [];
        $data = [];

        foreach($yearlyIncome as $income){
            $dates[] = preg_split('~-~', $income->payment_date);
            $amounts[] = $income->amount_paid;
        }
        if(isset($dates)) {
            foreach ($dates as $date) {
                $years[] = $date[0];
            }
            //dd($amounts);

            for ($i = 0; $i <= count($years) - 1; $i++) {
                $stuff[$years[$i]][] = $amounts[$i];
            }

            foreach ($stuff as $k => $v) {
                $total[$k] = array_sum($v);
            }
            //dd($total);
            $yearLabels = array_unique($years);


            $data = [
                'labels' => $yearLabels,
                'amounts' => $total
            ];
        }
        return $data;
    }
}

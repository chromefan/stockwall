<?php

namespace App\Console\Commands;

use App\Price;
use App\Stock;
use Illuminate\Console\Command;

class Stat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stat:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(date('Y-m-d H:i:s')."\n");
        $this->go(1);
        $this->go(5);
        $this->go(10);
        $this->go(30);
        $this->info(date('Y-m-d H:i:s')."\n");
    }

    public function go($num){
        $today = date('Y-m-d');
        //最近5日
        $stat_day = date('Y-m-d',strtotime("-{$num} days"));

        $data = Price::where('day',$today)->get();

        foreach ($data as $v){
            $res = Price::where('day',$stat_day)->where('code',$v->code)->first();
            $chg = 0;
            if($res){
                if($res->price <> 0){
                    if($num==1){
                        $chg = ($v->price_change/100);
                    }else{
                        $chg = ($v->price - $res->price)/$res->price;
                    }
                }
            }else{
                $chg = 0;
            }
            $save_res = Stock::where('code',$v->code)->update([
                //'price' => $v->price,
                'day'.$num.'_chg' => $chg,
                'updated_at' => date('Y-m-d H:i:s')]
            );

            echo "$num day {$v->code} : ".$save_res."\n";
        }
    }
}

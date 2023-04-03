<?php 

/**
 * mosyle_business class
 *
 * @package munkireport
 * @author 
 **/
class Mosyle_business_controller extends Module_controller
{
	    function __construct()
    {
        // Store module path
        $this->module_path = dirname(__FILE__);
    }
	
    /**
     * Get mosyle_business information for serial_number
     *
     * @param string $serial serial number
     **/
    public function get_data($serial_number = '')
    {
        jsonView(
            Mosyle_business_model::select('mosyle_business.*')
            ->whereSerialNumber($serial_number)
            ->filter()
            ->limit(1)
            ->first()
            ->toArray()
        );
    }

    public function get_list($column = '')
    {
        jsonView(
            Mosyle_business_model::select("mosyle_business.$column AS label")
                ->selectRaw('count(*) AS count')
                ->filter()
                ->groupBy($column)
                ->orderBy('count', 'desc')
                ->get()
                ->toArray()
        );
    }

    /**
     * Get  stats
     *
     * @return void
     * @author
     **/
    public function get_stats($hours = 24)
    {
       $timestamp = time() - 60 * 60 * (int) (24 * 7);
        $now = time();
        $today = $now - 3600 * 24;
        $week_ago = $now - 3600 * 24 * 7;
        $month_ago = $now - 3600 * 24 * 30;
       jsonView(
           mosyle_business_model::selectRaw("SUM(success_date > 0) AS total")          
               ->selectRaw("COUNT(CASE WHEN `success_date` > '$today' THEN 1 END) AS today")
               ->selectRaw("COUNT(CASE WHEN `success_date` < '$today' THEN 1 END) AS tardy")              
               ->filter()
               ->first()
               ->toLabelcount()
       );
    }

}
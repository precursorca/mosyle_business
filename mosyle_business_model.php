<?php

use munkireport\models\MRModel as Eloquent;

class Mosyle_business_model extends Eloquent
{
    protected $table = 'mosyle_business';

    protected $hidden = ['id', 'serial_number'];

    protected $fillable = [
      'serial_number', //$this->rt['serial_number'] = 'VARCHAR(255) UNIQUE';
      'version', // Version number of Mosyle Business Self-Service software
      'org_name', // Name of the organization in Mosyle Business
      'attempt_date',  // Date of the last attempted sync
      'success_date',  // Date of the last successful sync
      'location_enabled',  // State of Location Services for this app

    ];

   /**
     * Get statistics
     *
     * @return void
     * @author
     **/
    public function get_stats($hours)
    {
        $now = time();
        $today = $now - 3600 * 24;
        $week_ago = $now - 3600 * 24 * 7;
        $month_ago = $now - 3600 * 24 * 30;
        $sql = "SELECT COUNT(1) as total, 
			COUNT(CASE WHEN success_date > '$today' THEN 1 END) AS today, 
			COUNT(CASE WHEN success_date < '$today' THEN 1 END) AS tardy,
			FROM mosyle_business
			LEFT JOIN reportdata USING (serial_number)
			".get_machine_group_filter();
        return current($this->query($sql));
    }
    
}

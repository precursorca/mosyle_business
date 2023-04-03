<?php

use munkireport\processors\Processor;

class Mosyle_business_processor extends Processor
{
    public function run($data)
    {
        $modelData = ['serial_number' => $this->serial_number];

		// Parse data
        $sep = ' = ';
		foreach(explode(PHP_EOL, $data) as $line) {
            if($line){
                list($key, $val) = explode($sep, $line);
                $modelData[$key] = $val;
            }
		} //end foreach explode lines

        Mosyle_business_model::updateOrCreate(
            ['serial_number' => $this->serial_number], $modelData
        );
        
        return $this;
    }   
}

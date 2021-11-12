<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScheduleSlot
 *
 * @author Pankaj
 */
class ScheduleSlot {
    var $startDate;
    var $endDate;
    
    var $myOrders = array();
    
    function __construct($startDate, $endDate) {
        $format = 'Y-m-d H:i:s';
        
        $this->startDate = DateTime::createFromFormat($format, $startDate.' 00:00:00');
        $this->endDate = DateTime::createFromFormat($format, $endDate.' 00:00:00');
    }
    function considerBean($slotObject){
        $format = 'Y-m-d H:i:s';
        $inquiryTime =  DateTime::createFromFormat($format, $slotObject->inquiry_time);
        if($inquiryTime>= $this->startDate && $inquiryTime <$this->endDate){
            array_push($this->myOrders, $slotObject);
        }
    }
    function printMyOrders(){
        echo "My orders($this->startDate : $this->endDate)<br/>";
        foreach ($this->myOrders as $o) {
            echo $o->id.'-'.$o->customer_name.'-'.$o->customer_contact.'-'.$o->inquiry_time.'<br/>';
        }
        echo "<hr/>";
    }
}

<?php
error_reporting(E_ERROR);
include_once 'ScheduleSlot.php';

class Reporting extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function showDates() {
//        $dates = $this->createDateRangeArray('2016-11-01', '2016-11-15');
//        foreach ($dates as $value) {
//            echo $value.'<br/>';
//        }

        $startDate = null;
        $endDate = null;
        $state = null;
        $district = null;
        $block = null;

        $this->load->model('inquiry_model');
        $allInQuiries = $this->inquiry_model->get_all();


        if ($this->input->post('start_date')) {
            $startDate = $this->input->post('start_date');
            $endDate = $this->input->post('end_date');
            $state = $this->input->post('state_id');
            $district = $this->input->post('district_id');
            $block = $this->input->post('block_id');

            /*
              echo 'Start Date = '.$startDate;
              echo '<br/>End Date = '.$endDate;
              echo '<br/>State  = '.$state;
              echo '<br/>District  = '.$district;
              echo '<br/>Block  = '.$block;
             */
            $allInQuiries = $this->filterOutput($allInQuiries, $state, $district, $block);
            $slotArray = $this->createSlots($startDate, $endDate);
            foreach ($slotArray as $s) {
                foreach ($allInQuiries as $inquiry) {
                    $s->considerBean($inquiry);
                }
            }

            $this->loadViewEmbedded('reporting/view1', array(
                'slotArray' => $slotArray,
                'json_fetch_link' => site_url('Block/index_json'),
                'start_date' => $startDate,
                'end_date' => $endDate,
                'state' => $state,
                'district' => $district,
                'block' => $block,
                'recordCount' => sizeof($allInQuiries)
            ));

            // die();
        } else {
            $slotArray = $this->createSlots($this->inquiry_model->getMinInquiryDate(), $this->getTodaysDate());
            foreach ($slotArray as $s) {
                foreach ($allInQuiries as $inquiry) {
                    $s->considerBean($inquiry);
                }
            }

            $this->loadViewEmbedded('reporting/view1', array(
                'slotArray' => $slotArray,
                'json_fetch_link' => site_url('Block/index_json'),
                'recordCount' => sizeof($allInQuiries)
            ));
        }


        //var_dump($allInQuiries);die();
//        $allInQuiries = $this->filterOutput($allInQuiries, $state, $district, $block);






        foreach ($slotArray as $value) {
            //var_dump($value);
            // echo '<hr/>';
        }
    }

    public function exportPDF() {
        //load mPDF library
        $this->load->library('m_pdf');
        $this->load->model('inquiry_model');
        //load mPDF library
        //now pass the data//
        $this->data['title'] = "MY PDF TITLE 1.";
        $this->data['description'] = "";
        $this->data['description'] = $this->official_copies;
        //now pass the data //
        //collect get data
        $option = $this->input->get('option');

        if (strcasecmp($option, "all")==0) {
            $allInQuiries = $this->inquiry_model->get_all();
            $slotArray = $this->createSlots($this->inquiry_model->getMinInquiryDate(), $this->getTodaysDate());
            foreach ($slotArray as $s) {
                foreach ($allInQuiries as $inquiry) {
                    $s->considerBean($inquiry);
                }
            }
            $this->data['slotArray'] = $slotArray;
            $this->data['title']="All records";
            $this->data['recordCount']=  sizeof($allInQuiries);
            
        } else if (strcasecmp($option, "select")==0) {
            $startDate = $this->input->get('start_date');
            $endDate = $this->input->get('end_date');
            $state = $this->input->get('state');
            $district = $this->input->get('district');
            $block = $this->input->get('block');
            
            $allInQuiries = $this->inquiry_model->get_all();
            $allInQuiries = $this->filterOutput($allInQuiries, $state, $district, $block);
            $slotArray = $this->createSlots($startDate, $endDate);
            foreach ($slotArray as $s) {
                foreach ($allInQuiries as $inquiry) {
                    $s->considerBean($inquiry);
                }
            }
            
            $this->data['slotArray'] = $slotArray;
            $this->data['title']="Records for (State:$state, District$district:, Block:$block";
            $this->data['recordCount']=  sizeof($allInQuiries);
        }

        
        $html = $this->load->view('reporting/pdf_output', $this->data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
        
    //this the the PDF filename that user will get to download
        $pdfFilePath = "JAT_Export-" . time() . "-download.pdf";


        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($html, 2);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    function getTodaysDate() {
        //echo date("Y-m-d");
        return date("Y-m-d");
    }

    function filterOutput($allInQuiries, $state, $district, $block) {
        $inquiryCollect = array();
        if (strcasecmp($state, "ALL") == 0) {
            $inquiryCollect = $allInQuiries;
            //echo 'upper if';
        } else {
            //echo 'lower if';
            if (strcasecmp($state, "ALL") != 0 && strcasecmp($district, "ALL") != 0 && strcasecmp($block, "ALL") != 0) {
                foreach ($allInQuiries as $i) {
                    if (strcasecmp($i->state_name, $state) == 0 && strcasecmp($i->district_name, $district) == 0 && strcasecmp($i->block_name, $block) == 0) {
                        array_push($inquiryCollect, $i);
                    }
                }
            } else if (strcasecmp($state, "ALL") != 0 && strcasecmp($district, "ALL") != 0 && strcasecmp($block, "ALL") == 0) {
                foreach ($allInQuiries as $i) {
                    if (strcasecmp($i->state_name, $state) && strcasecmp($i->district_name, $district)) {
                        array_push($inquiryCollect, $i);
                    }
                }
            } else if (strcasecmp($state, "ALL") != 0 && strcasecmp($district, "ALL") == 0 && strcasecmp($block, "ALL") != 0) {
                foreach ($allInQuiries as $i) {
                    if (strcasecmp($i->state_name, $state)) {
                        array_push($inquiryCollect, $i);
                    }
                }
            } else if (strcasecmp($state, "ALL") != 0 && strcasecmp($district, "ALL") == 0 && strcasecmp($block, "ALL") == 0) {
                foreach ($allInQuiries as $i) {
                    if (strcasecmp($i->state_name, $state)) {
                        array_push($inquiryCollect, $i);
                    }
                }
            }
        }
        return $inquiryCollect;
    }

    function createDateRangeArray($strDateFrom, $strDateTo) {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.
        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = array();

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }

    function createSlots($strDateFrom, $strDateTo) {
        $dates = $this->createDateRangeArray($strDateFrom, $strDateTo);
        $slotArray = array();
        for ($i = 0; $i < sizeof($dates) - 1; $i++) {
            $slot = new ScheduleSlot($dates[$i], $dates[$i + 1]);
            array_push($slotArray, $slot);
        }
        return $slotArray;
    }

}

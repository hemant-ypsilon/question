<?php

class Main_content_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //calculate lat long
    function getLnt($zip) {

        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip) . "&sensor=false";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, TRUE);
        if ($result['status'] != "ZERO_RESULTS") {
            //echo "HERE";
            if ($result['status'] != 'OVER_QUERY_LIMIT') {
                //echo "NT HERE";
                $result1[] = $result['results'][0];
                $result2[] = $result1[0]['geometry'];
                $result3[] = $result2[0]['location'];
                return $result3[0];
            } else {
                //echo "HELLO";
                $result3 = array("Error" => "Error Message");
                return $result3;
            }
        }
    }

    //image decode
    public function getImageBase64Code($img) {
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $img = str_replace('[removed]', '', $img);
        $data = base64_decode($img);
        return $data;
    }

    public function customInsert($options) {
        $table = false;
        $data = false;

        extract($options);

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }


    public function customUpdate($options) {
        $table = false;
        $where = false;
        $orwhere = false;
        $data = false;

        extract($options);

        if (!empty($where)) {
            $this->db->where($where);
        }

        // using or condition in where  
        if (!empty($orwhere)) {
            $this->db->or_where($orwhere);
        }
        $this->db->update($table, $data);

        return $this->db->affected_rows();
    }

    public function customGet($options) {

        $select = false;
        $table = false;
        $join = false;
        $order = false;
        $limit = false;
        $offset = false;
        $where = false;
        $or_where = false;
        $single = false;
        $where_not_in = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($where_not_in != false) {
            foreach ($where_not_in as $key => $value) {
                if (count($value) > 0)
                    $this->db->where_not_in($key, $value);
            }
        }

        if ($or_where != false)
            $this->db->or_where($or_where);

        if ($limit != false) {

            if (!is_array($limit)) {
                $this->db->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $this->db->limit($limitval, $offset);
                }
            }
        }


        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $this->db->order_by($orderby, $orderval);
                    }
                } else {
                    $this->db->order_by($key, $value);
                }
            }
        }


        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {
                    if (count($value) == 3) {
                        $this->db->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $this->db->join($key1, $value1);
                        }
                    }
                } else {
                    $this->db->join($key, $value);
                }
            }
        }
        
        if (isset($having) && $having != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->having($having);
        
        if (isset($group_by) && $group_by != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->group_by($group_by);


        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }
//echo $this->db->last_query();//die();
        return $query->result();
    }

    public function getData($tbl = null, $select = null, $con = null, $orderBy = null, $limit = null, $join = null, $between = null, $multiple = TRUE, $groupBy = null, $orderBy2 = null, $having = NULL) {

        if ($select != null) {
            $this->db->select($select);
        } else {
            $this->db->select('*');
        }

        $this->db->from($tbl);

        if ($join != null) {
            foreach ($join as $j) {
                $type = 'inner';
                if (isset($j['type']))
                    $type = $j['type'];

                $this->db->join($j['table'], $j['relation'], $type);
            }
        }

        if ($con != null)
            $this->db->where($con);

        if ($between != null)
            $this->db->where($between);

        if ($groupBy != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->group_by($groupBy);

        if ($orderBy != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->order_by($orderBy);

        if ($orderBy2 != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->order_by($orderBy2);

        if ($limit != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->limit($limit);

        if ($having != null) //$this->db->order_by('title desc, name asc'); 
            $this->db->having($having);

        $query = $this->db->get();
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            if ($multiple) {
                return $query->result();
            } else {
                return $query->row();
            }
        } else
            return FALSE;
    }

    public function customQuery($query, $single = false, $updDelete = false, $noReturn = false) {
        $query = $this->db->query($query);

        if ($single) {
            return $query->row();
        } elseif ($updDelete) {
            return $this->db->affected_rows();
        } elseif (!$noReturn) {
            return $query->result();
        } else {
            return true;
        }
    }

    public function customQueryCount($query) {
        return $this->db->query($query)->num_rows();
    }

    public function getCountNotice($con = null, $between = null) {

        if ($con != null)
            $this->db->where($con);

        if ($between != null)
            $this->db->where($between);

        return $this->db->count_all_results('notice');
    }

    function getTimeSlotByDay($day = NULL, $cityServiceId) {
        if ($day == NULL) {
            return NULL;
        } else {
            $option = array(
                'table' => 'happyHourTimeSlot',
                'select' => '*',
                'where' => array('fk_bar_id' => $cityServiceId, 'enabled' => 1, 'deleted' => 0, "dayNumber" => $day),
                'single' => FALSE
            );

            $data['womenTimeSlotArray'] = $venderTimeSlotArray = $this->customGet($option);

            if (count($venderTimeSlotArray) != 0) {
                return $venderTimeSlotArray;
            } else {
                return NULL;
            }
        }
    }

    function cutString($string = '', $upto = 100, $strip_tags = TRUE, $title = '') {
        if ($strip_tags)
            $string = strip_tags($string);

        if (strlen($string) > $upto) {
            return substr($string, 0, $upto) . '<span  data-toggle="popover" title="' . $title . '" data-content="' . $string . '" data-placement="left">...</sapn>';
        } else {
            return $string;
        }
    }

    function sendMail($from, $to, $message) {
        $config = array(
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $this->email->initialize($config);

        $this->email->from($from, 'Team Niwari');
        $this->email->to($to);
        //    $this->email->bcc('them@their-example.com');
        $this->email->subject("Apply Tender");

        $this->email->message($message);
        $send = $this->email->send();
        if ($send) {
            return '1';
        } else {
            return '0';
        }
    }

    function sendSms($mobileNo, $mess, $type) {

        $username = urlencode("u16868");
        $msg_token = urlencode("34Qgjg");
        $sender_id = urlencode("SARVSM"); // optional (compulsory in transactional sms)
        $message = urlencode($mess);
        $mobile = urlencode($mobileNo);
        if($type == 1){
            $api = "http://manage.sarvsms.com/api/send_transactional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile."";
        }else{
            $api = "http://manage.sarvsms.com/api/send_promotional_sms.php?username=".$username."&msg_token=".$msg_token."&sender_id=".$sender_id."&message=".$message."&mobile=".$mobile.""; 
        }
        $http_result = file_get_contents($api);
        
        if (!empty($http_result) && $http_result != NULL) {
            return '1';
        } else {
            return '0';
        }
    }

    function findDayNumber($date) {
        $dayNumber = date('D', strtotime($date));

        $days = array('Mon' => 1, 'Tue' => 2, 'Wed' => 3, 'Thu' => 4, 'Fri' => 5, 'Sat' => 6, 'Sun' => 7);
        if ($days != NULL)
            return $days[$dayNumber];
        else
            return $days;
    }
}
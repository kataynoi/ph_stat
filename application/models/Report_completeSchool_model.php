<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/**
 *

 */
class Report_completeSchool_model extends CI_Model
{
    var $sql = " SELECT LEFT(a.SUBDISTRICTCODE,4) as ampcode,b.ampurname,
count(*) as total,SUM(IF(a.hospcode IS NOT NULL,1,0)) as complete ,
SUM(IF(a.hospcode IS NULL,1,0)) as uncomplete
FROM school as a
LEFT JOIN campur as b ON LEFT(SUBDISTRICTCODE,4) = b.ampurcodefull
GROUP BY LEFT(SUBDISTRICTCODE,4)
-- ORDER BY total DESC;";
    var $order_column = Array('ampcode', 'ampurname', 'total', 'complete', 'uncomplete',);

    function make_query()
    {
        $sql = $this->sql;
        $this->db->query($sql);

    }

    function make_datatables()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->result();
    }

    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get_all_data()
    {
        $this->db->query($this->sql);
        return $this->db->count_all_results();
    }


}
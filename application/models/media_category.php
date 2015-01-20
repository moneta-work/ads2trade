<?php ob_start(); ?>
<?php

//following class accesses the lms_user tuple
class media_category extends CI_Model {
    //Data tables
    protected $media_category_table = "media_category";
    protected $media_categories_table = "media_categories";
    protected $master_medium_type_table = "master_medium_type";
    protected $media_family_table = "media_family";

    //Get all the media categories  
    function getMediaCategories() {

        $select_query = $this->db->get('media_categories');

        if ($select_query->num_rows > 0) {
            foreach ($select_query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }
    }

    function getMediaCategoriesByID($category_id) {

        $select_query = $this->db->get_where('media_category', array('mef_id' => $category_id));

        if ($select_query->num_rows > 0) {
            foreach ($select_query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }
    }

    function getMediaCategoriesAvgPricesByID($category_id) {
        /*
        $this->db->where('mc.mec_id', $category_id);
        $this->db->select('mc.mec_id, mc.mec_description, AVG(ag.asg_min_price) as min_price, AVG(ag.asg_max_price) AS max_price');
        $this->db->from('media_category mc');
        $this->db->join("asset_size asi","mc.mec_id = asi.mec_id","left");
        $this->db->join("asset_group ag","asi.asi_id = ag.asi_id","left");
        $this->db->group_by(array('mc.mec_id','mc.mec_description'));
        */
        
        $query_mec_prices = "SELECT `mc`.`mec_id`, `mc`.`mec_description`, IFNULL(AVG(`ag`.`asg_min_price`),0) AS asg_min_price, IFNULL(AVG(`ag`.`asg_max_price`),0) AS asg_max_price 
                             FROM (`media_category` mc) 
                             LEFT JOIN `asset_size` asi ON `mc`.`mec_id` = `asi`.`mec_id` 
                             LEFT JOIN `asset_group` ag ON `asi`.`asi_id` = `ag`.`asi_id` 
                             WHERE `mc`.`mec_id` ='$category_id'
                             GROUP BY `mc`.`mec_id`, `mc`.`mec_description`";

        $select_query = $this->db->query($query_mec_prices);  

        //echo $this->db->last_query(); 
        //exit;
        //$select_query = $this->db->get('asset_size');

        if ($select_query->num_rows > 0) {
            foreach ($select_query->result() as $row) {
                $data[] = $row;
            }

            return $data;
        } else {
            return false;
        }

    }

    function getIDs($data) {
        //$this->db->where('mec_description' , $data)
        $select_query = $this->db->get_where('media_category', array('mec_description' => $data));

        if ($select_query->num_rows > 0) {
            foreach ($select_query->result() as $row) {
                $data = $row;
            }

            return $data;
        } else {
            return false;
        }
    }

    public function getMediaCategoriesByFamily($ids = "") {
        // get all words / category types (print, digital or traditional)
        $words = explode(',', $ids);
        // if no words / category types found,
        if(count($words) == 0 || $ids == "" || $ids == null) {
            $query = $this->db->query('select * from media_categories');
        } else {
            $q = "";
            // for each word, create a where clause
            for($i = 0; $i < count($words); $i++ ) {
                if($i == 0) {
                    // first word in the sequence, so add it as the origianl / first WHERE argument
                    $q .= 'WHERE description LIKE \'%' . $words[$i] . '%\'';
                } else {
                    // not the first word in the sequence, add it as an additional argument in the WHERE clause
                    $q .= ' OR description LIKE \'%' . $words[$i] . '%\'';
                }
            }
            $query = $this->db->query('select * from media_categories ' . $q);
        }

        if(empty($query)) {
            return null;
        }
        return $query->result();
    }

}
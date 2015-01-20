<?php

    class Size_options extends CI_Controller{
        
        public function __construct() {
            parent::__construct();
            $this->load->model('asset_size');
        }
        
        function index(){
            $id = $this->input->get('id');
            $rowid = isset($_GET['id'])?$_GET['id']:1;
            // mecid not working  so left this 
            $mecid = isset($_GET['mecid'])?$_GET['mecid']:1;
            $location = $_GET['location'];
            $media_type = $_GET['med_type'];
            //var_dump($id); exit;
            foreach ($_POST as $id){
                for($i = 0; $i < count($id); $i++){
                    $ass_size[] = $this->asset_size->getMediaSizesById($id[$i]);
                }
            }
            
            //echo count($ass_size);
            //exit();
            
            foreach ($ass_size as $size){
                //for($i = 0; $i < count($ass_size); $i++){
                $a[] = $size[0]->asi_description;
                $b[] = $size[0]->asi_width;
                $c[] = $size[0]->asi_length;
                //pricing
                $n[] = $size[0]->asg_min_price;
                $x[] = $size[0]->asg_max_price;
                //average price = (min+max/2)
                $m[] = ($size[0]->asg_min_price + $size[0]->asg_max_price)/2;
                #get the asset size id
                $size_id[] = $size[0]->asi_id;

                $asg_id[] = $size[0]->asg_id;
                
                //}
            }
            
            //$description = implode(", ", $a);
            $width = implode(", ", $b);
            $length = implode(", ", $c);
            
            //pricing
            $min_price = implode(", ", $n);
            $max_price = implode(", ", $x);
            $avg_price = implode(", ", $m);
            //var_dump($description);
            //exit();
            
            $subtotal = 0;
            for($i = 0; $i < count($ass_size); $i++){
                echo "<input type='hidden' name='chosen_size_id[]' value='$size_id[$i]_$location,$media_type,$asg_id[$i]' /><p id='$a[$i]'><strong>Size:</strong> ".$a[$i] . " <strong>Width: </strong>".$b[$i]." <strong>Length: </strong>".$c[$i]." Min:". $n[$i] ." Max:". $x[$i] ." Avg Price:". $m[$i]. "     <input type=\"button\" value=\"Delete\" class=\"btn btn-danger\" onclick=\"deleteRow3(this,'".$m[$i]."',".$rowid.")\"></p>";
                $subtotal+=$m[$i];
            }
            echo "<!--$subtotal-->"; //REGULAR EXPRESSION IN views/city_cell will extract this total and remove it before displaying html
        }
    }


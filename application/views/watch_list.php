<?php //include("header.php"); ?>
        <div class="breadcrumbs">
          <h1><span class="glyphicon glyphicon-list-alt"></span>My Watch List</h1>
        </div>

<?php
               
              
                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('watch_list','watch_list.auction = auctions.id');
                $select_query1 = $this->db->get(); 


                $this->db->select('distinct(auction) as auction');
		$this->db->from('auctions');
                $this->db->join('bids','bids.auction = auctions.id');
                $select_query = $this->db->get();  
?>
        <div class="main col-xs-12">

          <ul class="nav navbar-nav section-menu">
            <li><a href="../load_stock/asset_details3">Search</a></li>
            <li><a href="../load_stock/active_bids">Your Active Bids<span class="badge"><?php echo $select_query->num_rows;?></span></a></li>
            <li class="active"><a href="../load_stock/watch_list">Watch List<span class="badge"><?php echo $select_query1->num_rows;?></span></a></li>
            <li><a href="../load_stock/won_bids">Won Bids</a></li>
            <li><a href="../load_stock/lost_bids">Lost Bids</a></li>
          </ul>

         <div class="clear"></div>

                    <table class="table table-bordered headed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Pic</th>
                            <th>Asset Name</th>
                            <th>Your Bid</th>
                            <th>Current Bid</th>
                            <th>Time Remaining</th>
                            <th>Asset Type</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
             
                    <tbody>
                        
                 <?php
                      
                 if ($select_query->num_rows > 0){       
                 foreach ($select_query->result() as $rows){       
                        
                        
               // SELECT * FROM bids inner join auctions on auctions.id = bids.auction inner join asset on asset.ass_id = auctions.ass_id WHERE auction = '1' order by bidwhen desc limit 1
                   $user = $this->session->userdata('use_id');
                       
              //     $this->db->where("watch_list.use_id", $user);   
                     $this->db->where("watch_list.status", '1');   
                     $this->db->where("auction", $rows->auction);
                        $this->db->order_by("start_date", "desc");
                        $this->db->limit(1);
                        $this->db->select('images.url,watch_list.start_date,media_category.mec_description,asset.ass_id, auctions.buy_now, asset.ass_name,auctions.ends,auctions.current_bid');
		        $this->db->from('watch_list');
                        $this->db->join('auctions','watch_list.auction = auctions.id');
                        $this->db->join('asset','asset.ass_id = watch_list.ass_id');
                        $this->db->join('media_category','media_category.mec_id = asset.mec_id', 'left outer');
                        $this->db->join('images','images.ass_id = asset.ass_id', 'left outer');
                        $select_query = $this->db->get();
			$ass_name = '';
                        $img = '../../assets/images/add1.jpg';
                        if ($select_query->num_rows > 0){
                        
			foreach ($select_query->result() as $row){
				//$desc=$row->title . ' - ' .$row->ass_name ;
                                $ass_name = $row->ass_name;
                                $img = '';
                                if ($row->url == ''){$img = '../../assets/images/add1.jpg';}else{$img = $row->url;}
                          $elapsed = '';                                               
                        $date = date('Y-m-d h:i:s', time());
                        $date1 = $row->start_date;//'2013-09-11 10:25:00';
                        $current_bid= $row->current_bid;
                        
                        $yobid = 0;
                            if (isset($auction_id) && $auction_id <> '0' ){
                            $this->db->where('auction', $auction_id);
                            $this->db->where('bidder', $this->session->userdata('use_id'));
                            $select_query = $this->db->get('bids');
                                    if ($select_query->num_rows > 0){
			foreach ($select_query->result() as $rows){
				$yobid=$rows->bid;
                                
                               
		}
                        }}
                        $stat = 'Active';
                        
                        
                        $start_date = new DateTime($date);
                        $since_start = $start_date->diff(new DateTime($date1));
                        
                        $a = substr($date1,0,10);
                        $b = substr($date,0,10);
                        
                        if ($a == $b){
                            $today = 'Today ';
                        }else{
                            $today = '';
                        }
 $elapsed = '';
                            if ($since_start->y > 0){
                            $elapsed = $since_start->y .' Years';    
                            }
                            if ($since_start->m > 0){
                            $elapsed = $elapsed . ' '.$since_start->m .' Months';    
                            }
                            if ($since_start->d > 0){
                            $elapsed = $elapsed . ' '.$since_start->d .' Days';    
                            }
                                                     
                           if ($since_start->h > 0){
                            $elapsed = $elapsed. ' ' .$since_start->h .' Hours';    
                            }
                            if ($since_start->i > 0){
                            $elapsed = $elapsed . ' '.$since_start->i .' Mins';    
                            }
                           
                            $elapsed = $elapsed ;
                        
                         
                                
		?>
                        <tr>
                            <td width="50">
                              <a class="thumbnail" href="asset?ass_id=<?php echo $row->ass_id;?>">
                                <img src="<?php echo $img;?>">
                              </a>
                            </td>
                            <td><a href="asset?ass_id=<?php echo $row->ass_id;?>"><?php echo $ass_name ;?></a></td>
                            <td><?php echo $yobid;?></td>
                            <td><?php echo $current_bid;?></td>
                            <td><?php echo $elapsed;?></td>
                            <td><?php echo $row->mec_description;?></td>
                            <td><?php echo $stat;?></td>
                             <td width="260">
                                <a href="#" onclick="modalshow('<?php echo $row->ass_id; ?>','1')" class="btn btn-default"  >Options</a>
                                <a href="#" onclick="removes('<?php echo $row->ass_id; ?>','1')" class="btn btn-default"  >Remove Item</a>
                            </td>
                        </tr>
                <?php }
               
               }
               
               }
		

		}else{ ?>
                    <div class="feed-element">
                    <div class="media-body ">
                      <small class="pull-right"></small>
                      <a href="#">No Bids Yet</a><br>
                      <small class="text-muted"></small>
                    </div>
                  </div> 
                    
               <?php }
?>
                    </tbody>
                </table>

              

            

        </div><!--Main -->


  <?php //include("footer.php"); ?>

        <script>
  function modalshow(a,b){
    

  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
 
  $("#modalwin").load("loadajax?c="+a+"&type="+b+"&p=watch_list");
  modalbak = document.getElementById("modalbak");
  modalbak.style.display = "block";

  modalwin = document.getElementById("modalwin");
  modalwin.style.top     = top+"px";
  modalwin.style.left    = left+"px";
  modalwin.style.display = "block";
}
function modalhide1(){
  document.getElementById("modalbak").style.display = "none";
  document.getElementById("modalwin").style.display = "none";
}

function removes(a,b){
 var r = confirm("Are you sure you want to remove this item from Watch List?");
if (r == true) {
    location.href="remove_watch?ass_id="+a;
}
}

  </script>
  
 <style>
	#modalbak {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #333333;
		display: none;
		opacity: 0.40;
		z-index: 9;
	}

	#modalwin {
		position: fixed;
		top: 0;
		left: 0;
		width: 900px;
		height: 600px;
		background: #FFF;
		display: none;
		padding: 5px;
		border: 3px double #CCC;
		z-index: 10;
		-moz-border-radius: 6px;
		-webkit-border-radius: 6px;
		-moz-box-shadow: 3px 3px 6px #666;
		-webkit-box-shadow: 3px 3px 6px #666;
	}

	#modalmsg {
		text-align: center;
		/* Add more style to your message */
	}

</style>

<div id='modalbak'></div>
<div id='modalwin' >
  
           
 </div> 
<?php ob_start(); ?>
<?php
class bids extends CI_Model
{


	function getBidDetail($auction_id)
	{
    $query = $this->db->query("SELECT MAX(bid) as currentBid FROM `bids` WHERE auction = '$auction_id'");
    if(empty($query)) {
      return null;
    }
    return $query->result();     
	}

	function currentBid($user){
	$query = $this->db->query("SELECT bids.bid as myCurrentBid FROM `bids` WHERE bids.bidder = '$user' ORDER BY bids.id DESC LIMIT 1");
    if(empty($query)) {
      return null;
    }
    return $query->result();
	}
}
<?php

class asset extends CI_Model{
	
	function insertAsset ($latitude){
		$sql = "INSERT INTO ads_asset (longitutde)
        VALUES ($latitude)";
		mysql_query($sql);
	}

	function averageAssetPriceForArea($area){
		$sqlSelect = "SELECT
						`as`.ass_city,
						Count(`as`.ass_city) AS area_count,
						`as`.ass_province,
						IFNULL(Avg(`as`.ass_proportional_costs),0) AS avg_prop_costs,
						IFNULL(Avg(`as`.ass_production_cost_BCY),0) AS avg_prod_cost_bcy,
						IFNULL(Avg(`as`.ass_production_price_SCY),0) AS avg_prod_cost_scy,
						IFNULL(Avg(`as`.ass_acquisition_cost),0) AS avg_acquisition_cost,
						IFNULL(Avg(`as`.ass_book_value),0) AS avg_book_value,
						`as`.mec_id,
						media_category.mec_description
					  FROM
						asset AS `as`
					  INNER JOIN media_category ON media_category.mec_id = `as`.mec_id
					  WHERE
						`as`.ass_city = '$area'
					  GROUP BY `as`.ass_city, `as`.ass_province ";

		$query = $this->db->query($sqlSelect);

		return $query->result();
	}

}
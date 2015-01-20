<?php 
 if (isset($_POST['cluster'])){echo $map1['js'];}elseif(isset($_POST['spiderfy'])){}else{ echo  $map1['js'];}?>
 <style>
    table { border-collapse: collapse; border-spacing: 0; }
    p { margin: 0.75em 0; }
    #map_canvas { height: auto; position: absolute; bottom: 0; left: 0; right: 0; top: 0; }
    @media print { #map_canvas { height: 950px; } }
  </style>
  
  <style>
      #modalbak{
  position:fixed; 
  top:0; 
  left:0; 
  width:100%;  
  height:100%;  
  background:#333333; 
  display:none; 
  opacity:0.40; 
  z-index:9;
}
  #modalwin{
  position:fixed; 
  top:0; 
  left:0; 
  width:900px; 
  height:500px; 
  background:#FFF; 
  display:none; 
  padding:5px; 
  border:3px double #CCC; 
  z-index:10;
  -moz-border-radius:6px;
  -webkit-border-radius:6px; 
  -moz-box-shadow:3px 3px 6px #666;
  -webkit-box-shadow:3px 3px 6px #666; 
}

#modalmsg{ 
  text-align:center; 
  /* Add more style to your message */
}
      
  </style>
  
  
<style>
    html, body, #map-canvas {
        height: 100px;
        margin: 0px;
        padding: 0px
    }

    .tabs_wrap{ border:solid 1px #e1e1e1; }
    .tabs_wrap a.active{ background-color: #cbc9c9; }
    .dn{ display:none;}
    .Faces{ border-bottom: solid 1px #e1e1e1; padding-bottom: 10px; height: 30px; margin-bottom: 10px; }
    .dbfl{float:left; display:inline-block;}
    .tab_content{display:none; height: 215px; overflow: auto;}
    .tab_content.active{display:block;}
    #dialog_content .buttons_wrap a{ margin-right: 10px;}
    #dialog_content{ float:left; width:100%;}
    #dialog_content label{ display: block; margin: 0px;}
    #dialog_content .form-control{ outline: none!important; border-shadow:none; margin: 0px;outline: none; border: solid 2px #e1e1e1; width: 250px; padding: 6px; margin-bottom: 10px;}
</style>



    <style>
       #map-canvas1 {
        height: 150px;
        width: 500px;
        float: right;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
   

<div id="popup_content" style="display:none">
    <div id="dialog_content"><form name="test"  method="post" action="tawas.php">
            
            <div class="Faces">
                <div class="col-xs-4">
                    <input type="radio" name="face" checked="checked" id="fa" class="dbfl">
                    <label for="fa" class="dbfl">Face A</label>
                </div>
                <div class="col-xs-6">
                    <input type="radio" name="face" id="fb" class="dbfl">
                    <label  for="fb" class="dbfl">Face B</label>
                </div>
            </div>
            
            <div class="face_a_content">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Upload Photo</label>
                    <input type="file" name="file_fa" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content
                </div>
                <div class="tab_content" id="rate">
                    Rate Content
                </div>
            </div>
            
            <div class="face_b_content dn">
                <div class="btn-group tabs_wrap">
                    <a href="#" class="btn btn-default active" id="basic">Basic Info</a>
                    <a href="#" class="btn btn-default" id="production">Production Info</a>
                    <a href="#" class="btn btn-default" id="rate">Rate Info</a>            
                </div>

                <div class="tab_content active" id="basic">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control">
                    <label>Media Type</label>
                    <select name="title" class="form-control">
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>
                        <option value="Billboards">Billboards</option>            
                    </select>
                    <label>Description</label>
                    <textarea type="text" name="title" class="form-control"></textarea>
                    <input type="hidden" name="action" value="add_new_asset" >
                    
                </div>
                <div class="tab_content" id="production">
                    Product Content Face B
                </div>
                <div class="tab_content" id="rate">
                    Rate Content Face B
                </div>
            </div>

            <div class="buttons_wrap">
                <input type="hidden" class="form-control latlong" name="position"  value="" >
                <a href="#" class="save_new_asset btn btn-primary">Save Asset</a>
                <a href="#" class="delete_new_asset btn btn-primary">Delete Asset</a>
            </div><br>
        </form></div>
    <div class="clear"></div>
</div>


<div class="breadcrumbs">
    <h1><span class="glyphicon glyphicon-list-alt"></span>Auctions</h1>
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
    <form method="post">
    <ul class="nav navbar-nav section-menu">
            <li class="active"><a href="../load_stock/asset_details3">Search</a></li>
            <li><a href="../load_stock/active_bids">Your Active Bids<span class="badge"><?php echo $select_query->num_rows;?></span></a></li>
            <li><a href="../load_stock/watch_list">Watch List<span class="badge"><?php echo $select_query1->num_rows;?></span></a></li>
            <li><a href="../load_stock/won_bids">Won Bids</a></li>
            <li><a href="../load_stock/lost_bids">Lost Bids</a></li>
    </ul>


    <div class="clear"></div>

    <div class="alert alert-info" role="alert">
        <span class="glyphicon glyphicon-info-sign"></span>
        Select the media type and use the map to point the locations that you prefer</div>

    <br>
    <div class="row">
        <div class="col-xs-4">
            <p><label for="myPlaceTextBox">Location</label> 
                       <input class="form-control" type="text" id="myPlaceTextBox" />
            </p><p></p>
                <label for="first_name">Media Type Required</label>                         
               <select name="ast_id[]" id="ast_id"  data-placeholder="Type Media Type" style="width:100%;" multiple class=" chosen-select" tabindex="8">
                    
                    <?php
                    foreach ($may_asset_types as $row) {
                        echo "<option value=\"$row->ast_id\"  >$row->ast_description</option>";
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="dirst_name">Duration</label>                         
                  <select name="duration[]"  data-placeholder="Please Select Duration" style="width:100%;" multiple class=" chosen-select" tabindex="8">
                
                    <?php
                    foreach ($durations as $row) {
                        echo "<option value=\"$row->days\" " . ((isset($_POST['days']) &&
                        $_POST['days'] == $row->tow_description) ? 'selected="selected"' : '') . " >$row->description</option>";
                    }
                    ?>
                    
                    
                </select>
            </p>

            <div class="row">
                <p class="col-xs-6">
                    <label for="first_name">From Date</label>                           
                    <input type="text" vname="first_name" id="first_name" class="form-control">
                </p>
                <p class="col-xs-6">
                    <label for="first_name">To Date</label>                           
                    <input type="text" vname="first_name" id="first_name" class="form-control">
                </p>
            </div>
                
            <div class="text-center">
                <input name="filter" type="submit" class="btn btn-primary" value="Apply Filter">
            </div>
            <p>&nbsp;</p>
            <?php
            if (isset($_POST['spiderfy'])){
                ?>
             <div class="text-center">
                <input name="cluster" type="submit" class="btn btn-primary" value="Swith View To Cluster">
            </div>
            <?php              
                
            }elseif(isset($_POST['cluster'])){
            ?>
             <div class="text-center">
                <input name="spiderfy" type="submit" class="btn btn-primary" value="Swith View To Spiderfy">
            </div>
            <?php }else{?>
                 <div class="text-center">
                <input name="spiderfy" type="submit" class="btn btn-primary" value="Swith View To Spiderfy">
            </div>
                
            <?php }?>
            
        </div>

        <div class="col-xs-8">

            
                <?php if(isset($_POST['spiderfy'])){
                    
                    ?>
                    
                 <div class="map_wrap">   
                 <div id="map_canvas"></div>
                     </div>
              <?php  }else{?> 
            <div><?php echo $map1['html']; ?></div>
                <?php 
                }?>
        
        </div>
    </div>

    <br>
    <br>
    <h3>Auction Rooms</h3>
    <div class="table_div">
    <table class="table table-bordered headed " cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Auction Room</th>
                <th>Duration</th>
                <th>Artwork Required By</th>
                <th>Auction Start</th>
                <th>No Of Assets</th>
                <th>Campaign To Start </th>
                <th>End Date</th>
                <th>Media Type</th>
                <th>Time Remaining</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $count=0;
           
            if (!empty($mmm1)){
            foreach ($mmm1 as $row) {
                $count=$count + 1;
                $this->db->where('ast_id', $row->ast_id);
                $select_query = $this->db->get('asset_type');
		if ($select_query->num_rows > 0){//echo "tapinda tapinda amai niyasha. musabaika bus service";exit();

			foreach ($select_query->result() as $rows){
				$dat=$rows->ast_description;
		}
		

		}
            ?>
            <tr >
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>"><?php echo $count;?></a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>"><?php echo $row->loc_id . ' Week';?></a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>">01.08.2014</a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>"></a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>"><?php echo $row->counts;?></a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>"><?php $row->ast_id;?></a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>">08.08.2014</a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>"><?php echo $dat;?></a></td>
                <td> <a href="auction_details?aset=<?php echo $row->ast_id; ?>">2 Days</a></td>
            </tr>
        <?php }}else{
            ?><td colspan="10">No Records Found</td> <?php
            
        }?>
        </tbody>
    </table>
    </div>

    </form>



</div><!--Main -->

<?php
//include("footer.php"); ?>
 <?php if(isset($_POST['spiderfy'])){
                    
                    ?>
<script>
  // randomize some overlapping map data -- more normally we'd load some JSON data instead
  var baseJitter = 2.5;
  var clusterJitterMax = 0.1;
  var rnd = Math.random;
  var data = [];
 <?php 
if($mmm2){
foreach ($mmm2 as $key) {  
    $string = explode(',',$key->position);
    $lat = $string[0];
    $lon = $string[1];
    ?>
 data.push({
      lon: '<?= $lon;?>',
      lat: '<?= $lat;?>',
      h:   '<?php echo $key->ass_name;?>',
      d:   '<a href="asset?ass_id=<?php echo $key->ass_id;?>" ><img height="80px" width="150px" onClick="tawas.php" src="../../assets/add2.jpg"></a><div>'
    });
	<?php }} ?>
  
  window.mapData = data;
</script>

 
  <script src="http://maps.google.com/maps/api/js?v=3.9&amp;sensor=false"></script>
  <script  type='text/javascript'>
  (function(){/*
 OverlappingMarkerSpiderfier
https://github.com/jawj/OverlappingMarkerSpiderfier
Copyright (c) 2011 - 2012 George MacKerron
Released under the MIT licence: http://opensource.org/licenses/mit-license
Note: The Google Maps API v3 must be included *before* this code
*/
var h=!0,u=null,v=!1;
(function(){var A,B={}.hasOwnProperty,C=[].slice;if(((A=this.google)!=u?A.maps:void 0)!=u)this.OverlappingMarkerSpiderfier=function(){function w(b,d){var a,g,f,e,c=this;this.map=b;d==u&&(d={});for(a in d)B.call(d,a)&&(g=d[a],this[a]=g);this.e=new this.constructor.g(this.map);this.n();this.b={};e=["click","zoom_changed","maptypeid_changed"];g=0;for(f=e.length;g<f;g++)a=e[g],p.addListener(this.map,a,function(){return c.unspiderfy()})}var p,s,t,q,k,c,y,z;c=w.prototype;z=[w,c];q=0;for(k=z.length;q<k;q++)t=
z[q],t.VERSION="0.3.3";s=google.maps;p=s.event;k=s.MapTypeId;y=2*Math.PI;c.keepSpiderfied=v;c.markersWontHide=v;c.markersWontMove=v;c.nearbyDistance=20;c.circleSpiralSwitchover=9;c.circleFootSeparation=23;c.circleStartAngle=y/12;c.spiralFootSeparation=26;c.spiralLengthStart=11;c.spiralLengthFactor=4;c.spiderfiedZIndex=1E3;c.usualLegZIndex=10;c.highlightedLegZIndex=20;c.legWeight=1.5;c.legColors={usual:{},highlighted:{}};q=c.legColors.usual;t=c.legColors.highlighted;q[k.HYBRID]=q[k.SATELLITE]="#fff";
t[k.HYBRID]=t[k.SATELLITE]="#f00";q[k.TERRAIN]=q[k.ROADMAP]="#444";t[k.TERRAIN]=t[k.ROADMAP]="#f00";c.n=function(){this.a=[];this.j=[]};c.addMarker=function(b){var d,a=this;if(b._oms!=u)return this;b._oms=h;d=[p.addListener(b,"click",function(d){return a.F(b,d)})];this.markersWontHide||d.push(p.addListener(b,"visible_changed",function(){return a.o(b,v)}));this.markersWontMove||d.push(p.addListener(b,"position_changed",function(){return a.o(b,h)}));this.j.push(d);this.a.push(b);return this};c.o=function(b,
d){if(b._omsData!=u&&(d||!b.getVisible())&&!(this.s!=u||this.t!=u))return this.unspiderfy(d?b:u)};c.getMarkers=function(){return this.a.slice(0)};c.removeMarker=function(b){var d,a,g,f,e;b._omsData!=u&&this.unspiderfy();d=this.m(this.a,b);if(0>d)return this;g=this.j.splice(d,1)[0];f=0;for(e=g.length;f<e;f++)a=g[f],p.removeListener(a);delete b._oms;this.a.splice(d,1);return this};c.clearMarkers=function(){var b,d,a,g,f,e,c,m;this.unspiderfy();m=this.a;b=g=0;for(e=m.length;g<e;b=++g){a=m[b];d=this.j[b];
f=0;for(c=d.length;f<c;f++)b=d[f],p.removeListener(b);delete a._oms}this.n();return this};c.addListener=function(b,d){var a,g;((g=(a=this.b)[b])!=u?g:a[b]=[]).push(d);return this};c.removeListener=function(b,d){var a;a=this.m(this.b[b],d);0>a||this.b[b].splice(a,1);return this};c.clearListeners=function(b){this.b[b]=[];return this};c.trigger=function(){var b,d,a,g,f,e;d=arguments[0];b=2<=arguments.length?C.call(arguments,1):[];d=(a=this.b[d])!=u?a:[];e=[];g=0;for(f=d.length;g<f;g++)a=d[g],e.push(a.apply(u,
b));return e};c.u=function(b,d){var a,g,f,e,c;f=this.circleFootSeparation*(2+b)/y;g=y/b;c=[];for(a=e=0;0<=b?e<b:e>b;a=0<=b?++e:--e)a=this.circleStartAngle+a*g,c.push(new s.Point(d.x+f*Math.cos(a),d.y+f*Math.sin(a)));return c};c.v=function(b,d){var a,g,f,e,c;f=this.spiralLengthStart;a=0;c=[];for(g=e=0;0<=b?e<b:e>b;g=0<=b?++e:--e)a+=this.spiralFootSeparation/f+5E-4*g,g=new s.Point(d.x+f*Math.cos(a),d.y+f*Math.sin(a)),f+=y*this.spiralLengthFactor/a,c.push(g);return c};c.F=function(b,d){var a,g,f,e,c,
m,l,x,n;e=b._omsData!=u;(!e||!this.keepSpiderfied)&&this.unspiderfy();if(e||this.map.getStreetView().getVisible()||"GoogleEarthAPI"===this.map.getMapTypeId())return this.trigger("click",b,d);e=[];c=[];a=this.nearbyDistance;m=a*a;f=this.c(b.position);n=this.a;l=0;for(x=n.length;l<x;l++)a=n[l],a.map!=u&&a.getVisible()&&(g=this.c(a.position),this.f(g,f)<m?e.push({A:a,p:g}):c.push(a));return 1===e.length?this.trigger("click",b,d):this.G(e,c)};c.markersNearMarker=function(b,d){var a,g,f,e,c,m,l,x,n,p;
d==u&&(d=v);if(this.e.getProjection()==u)throw"Must wait for 'idle' event on map before calling markersNearMarker";a=this.nearbyDistance;c=a*a;f=this.c(b.position);e=[];x=this.a;m=0;for(l=x.length;m<l;m++)if(a=x[m],!(a===b||a.map==u||!a.getVisible()))if(g=this.c((n=(p=a._omsData)!=u?p.l:void 0)!=u?n:a.position),this.f(g,f)<c&&(e.push(a),d))break;return e};c.markersNearAnyOtherMarker=function(){var b,d,a,g,c,e,r,m,l,p,n,k;if(this.e.getProjection()==u)throw"Must wait for 'idle' event on map before calling markersNearAnyOtherMarker";
e=this.nearbyDistance;b=e*e;g=this.a;e=[];n=0;for(a=g.length;n<a;n++)d=g[n],e.push({q:this.c((r=(l=d._omsData)!=u?l.l:void 0)!=u?r:d.position),d:v});n=this.a;d=r=0;for(l=n.length;r<l;d=++r)if(a=n[d],a.map!=u&&a.getVisible()&&(g=e[d],!g.d)){k=this.a;a=m=0;for(p=k.length;m<p;a=++m)if(c=k[a],a!==d&&(c.map!=u&&c.getVisible())&&(c=e[a],(!(a<d)||c.d)&&this.f(g.q,c.q)<b)){g.d=c.d=h;break}}n=this.a;a=[];b=r=0;for(l=n.length;r<l;b=++r)d=n[b],e[b].d&&a.push(d);return a};c.z=function(b){var d=this;return{h:function(){return b._omsData.i.setOptions({strokeColor:d.legColors.highlighted[d.map.mapTypeId],
zIndex:d.highlightedLegZIndex})},k:function(){return b._omsData.i.setOptions({strokeColor:d.legColors.usual[d.map.mapTypeId],zIndex:d.usualLegZIndex})}}};c.G=function(b,d){var a,c,f,e,r,m,l,k,n,q;this.s=h;q=b.length;a=this.C(function(){var a,d,c;c=[];a=0;for(d=b.length;a<d;a++)k=b[a],c.push(k.p);return c}());e=q>=this.circleSpiralSwitchover?this.v(q,a).reverse():this.u(q,a);a=function(){var a,d,k,q=this;k=[];a=0;for(d=e.length;a<d;a++)f=e[a],c=this.D(f),n=this.B(b,function(a){return q.f(a.p,f)}),
l=n.A,m=new s.Polyline({map:this.map,path:[l.position,c],strokeColor:this.legColors.usual[this.map.mapTypeId],strokeWeight:this.legWeight,zIndex:this.usualLegZIndex}),l._omsData={l:l.position,i:m},this.legColors.highlighted[this.map.mapTypeId]!==this.legColors.usual[this.map.mapTypeId]&&(r=this.z(l),l._omsData.w={h:p.addListener(l,"mouseover",r.h),k:p.addListener(l,"mouseout",r.k)}),l.setPosition(c),l.setZIndex(Math.round(this.spiderfiedZIndex+f.y)),k.push(l);return k}.call(this);delete this.s;this.r=
h;return this.trigger("spiderfy",a,d)};c.unspiderfy=function(b){var d,a,c,f,e,k,m;b==u&&(b=u);if(this.r==u)return this;this.t=h;f=[];c=[];m=this.a;e=0;for(k=m.length;e<k;e++)a=m[e],a._omsData!=u?(a._omsData.i.setMap(u),a!==b&&a.setPosition(a._omsData.l),a.setZIndex(u),d=a._omsData.w,d!=u&&(p.removeListener(d.h),p.removeListener(d.k)),delete a._omsData,f.push(a)):c.push(a);delete this.t;delete this.r;this.trigger("unspiderfy",f,c);return this};c.f=function(b,d){var a,c;a=b.x-d.x;c=b.y-d.y;return a*
a+c*c};c.C=function(b){var d,a,c,f,e;f=a=c=0;for(e=b.length;f<e;f++)d=b[f],a+=d.x,c+=d.y;b=b.length;return new s.Point(a/b,c/b)};c.c=function(b){return this.e.getProjection().fromLatLngToDivPixel(b)};c.D=function(b){return this.e.getProjection().fromDivPixelToLatLng(b)};c.B=function(b,c){var a,g,f,e,k,m;f=k=0;for(m=b.length;k<m;f=++k)if(e=b[f],e=c(e),"undefined"===typeof a||a===u||e<g)g=e,a=f;return b.splice(a,1)[0]};c.m=function(b,c){var a,g,f,e;if(b.indexOf!=u)return b.indexOf(c);a=f=0;for(e=b.length;f<
e;a=++f)if(g=b[a],g===c)return a;return-1};w.g=function(b){return this.setMap(b)};w.g.prototype=new s.OverlayView;w.g.prototype.draw=function(){};return w}()}).call(this);}).call(this);
/* Tue 7 May 2013 14:56:02 BST */
  
  </script>
  <script>
    window.onload = function() {
      var gm = google.maps;
      var map = new gm.Map(document.getElementById('map_canvas'), {
        mapTypeId: gm.MapTypeId.MAP,

        center: new gm.LatLng(27.95042, -26.066344), zoom: 7,  // whatevs: fitBounds will override
        scrollwheel: false
      });
      var iw = new gm.InfoWindow();
      var oms = new OverlappingMarkerSpiderfier(map,
        {markersWontMove: true, markersWontHide: true});
	
      var usualColor = 'eebb22';
      var spiderfiedColor = 'ffee22';
      var iconWithColor = function(color) {
        return 'http://chart.googleapis.com/chart?chst=d_map_xpin_letter&chld=pin|+|' +
          color + '|000000|ffff00';
      }
      var shadow = new gm.MarkerImage(
        'https://www.google.com/intl/en_ALL/mapfiles/shadow50.png',
        new gm.Size(37, 34),  // size   - for sprite clipping
        new gm.Point(0, 0),   // origin - ditto
        new gm.Point(10, 34)  // anchor - where to meet map location
      );
      
	  
		  
      oms.addListener('click', function(marker) {
        iw.setContent(marker.desc);
        $('#imageModal').modal();
        iw.open(map, marker);
      });
      oms.addListener('spiderfy', function(markers) {
        for(var i = 0; i < markers.length; i ++) {
          markers[i].setIcon(iconWithColor(spiderfiedColor));
          markers[i].setShadow(null);
        } 
        iw.close();
      });
      oms.addListener('unspiderfy', function(markers) {
        for(var i = 0; i < markers.length; i ++) {
          markers[i].setIcon(iconWithColor(usualColor));
          markers[i].setShadow(shadow);
        }
      });
      
      var bounds = new gm.LatLngBounds();
      for (var i = 0; i < window.mapData.length; i ++) {
        var datum = window.mapData[i];
        var loc = new gm.LatLng(datum.lat, datum.lon);
        bounds.extend(loc);
        var marker = new gm.Marker({
          position: loc,
          title: datum.h,
          map: map,
		 // cluster: true,
		  
          icon: iconWithColor(usualColor),
          shadow: shadow
        });
		
        marker.desc = datum.d;
		marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png')
        oms.addMarker(marker);
      }
      map.fitBounds(bounds);

      // for debugging/exploratory use in console
      window.map = map;
      window.oms = oms;
    }
  </script>
  <?php }?>

  <script>
  function modalshow(a){
  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  
 

 <?php
   $a = 'My First Asset';
   $b = 'Yess';
   
   ?> 
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;
 
 
  $("#modalwin").load("loadajax?c="+a);

  
  modalbak = document.getElementById("modalbak");
  modalbak.style.display = "block";

  modalwin = document.getElementById("modalwin");
  modalwin.style.top     = top+"px";
  modalwin.style.left    = left+"px";
  modalwin.style.display = "block";

}
function modalhide(){
  document.getElementById("modalbak").style.display = "none";
  document.getElementById("modalwin").style.display = "none";
}
  
  </script>
 
  
<div id='modalbak'></div>
<div  id='modalwin' > 
    


</div>


      
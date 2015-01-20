<?php error_reporting(0);
//print_r($data);
?>
    <div class="breadcrumbs">
      <h1>My Messages</h1>
    </div>
    <div class="main col-xs-12">
      <ul class="nav navbar-nav section-menu">
        <li <?php echo $unread_active;?>>
          <?php echo anchor('messages/inbox?read=0', "UnRead<span class=\"badge\">".number_format($total_unread,0)."</span>", 'title="My Messages"');?>
        </li>
        <li <?php echo $read_active;?>>
          <?php echo anchor('messages/inbox?read=1', "Read<span class=\"badge\">".number_format($total_read,0)."</span>", 'title="My Messages"');?>
        </li>
        <li <?php echo $sent_active;?>>
          <?php echo anchor('messages/inbox?sent=1', "Sent<span class=\"badge\">".number_format($total_sent,0)."</span>", 'title="My Messages"');?>
        </li>
        <li <?php echo $compose_active;?>>
          <?php echo anchor('messages/inbox?write=1', "Compose", 'title="Write a new message"');?>
        </li>
      </ul>
      <div class="clear"></div>
	  <?php

	  //	echo $write;


	  //Compose or foward or reply
	  if($write == 1){
		//compose form
		//print_r($message);
		//var_export($message);

		$sentto = '';
		$subject = '';
		$public = 0;
		$message_text = '';

		if($message->id > 0){
			//extract($message, EXTR_PREFIX_ALL, 'm_');
			/* sample message structure
			stdClass Object ( 
			[id] => 1 [sentto] => 7 [sentfrom] => 7 [fromemail] => . [sentat] => 0 
			[message] => This is a test emilThis is a test emilThis is a test .... 
			[isread] => 0 [subject] => This is a test emil [replied] => 0 
			[reply_of] => 0 [question] => 0 [public] => 0 
			[datetime] => 2014-11-25 14:34:19 )
			*/
			$sentto = $message->sentto;
			$sentfrom = $message->sentfrom;
			$subject = strtoupper($action).':'.$message->subject;
			$public = $message->public;
			$message_text = "<br><br>=====================================================";
			$message_text .= "<br>From: <".$message->from_last.','.$message->from_first."> ";
			$message_text .= "Date/Time:".$message->datetime;
			$message_text .= "<br>To: <".$message->to_last.','.$message->to_first."> ";
			$message_text .= "<br>Subject: ".$message->subject."<br>";
			$message_text .= "<br>";
			$message_text .= $message->message."<br><br>=====================================================";
			$message_text = preg_replace('#<br\s*/?>#i', "\n", $message_text);

		} else {
			//echo 'ST2  22223';
		}
		//echo ' msg '.$message->message;
		//if this is a forward then reset the sentto field
		if(strcmp(strtolower($action),'fwd')==0){
			$sentfrom = 0;
		}
	  ?>

		   <div class="table_div">
			<?php echo form_open_multipart("messages/send") ?>

				<div class="row">

					<div class="col-sm-12">
						<div class="form-control-group">
							<label for="sentto">Send To</label>
							<?php echo form_dropdown('sentto[]', $sendto_options,set_value('sentto',$sentfrom), 'data-placeholder="Choose Recipient" class="chosen-select" multiple style="width:100%;" ' ); ?>
						</div>
					 </div>

					<div class="col-sm-9">
						<div class="form-control-group">
							<label for="subject">Subject</label>
							<?php echo form_input('subject', set_value('subject',$subject), 'class="form-control"' ); ?>
						</div>
					 </div>
					<!--
					 <div class="col-sm-4">
						<div class="form-control-group">
							<label for="first_name">News Date</label>
							<?php //echo form_input('news_date', set_value('news_date'), ' class="form-control"' ); ?>
							<?php echo form_hidden('email_date', set_value('email_date', date('Y-m-d H:j:s')), ' class="form-control"' ); ?>
						</div>
					</div>
					-->

				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="form-control-group">
							<label for="message">Message</label>
							<?php echo form_textarea('message', set_value('message',$message_text), 'class="form-control" rows="4"' ); ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<div class="col-sm-6">
							<div class="form-control-group">
								<label for="public">Public/Private</label>
								<?php echo form_dropdown('public', $public_options, set_value('public', $public), ' class="form-control"' ); ?>
							</div>
						</div>
						<!--
						<div class="form-control-group">
							<label for="user_type">Send to group of users</label>
							<?php echo form_multiselect('user_type[]', $user_type_options, set_value('user_type[]'), 'class="form-control"' ); ?>
						</div>
						-->

					</div>
				</div>
				<br>
				<div class="row" >
					<div class="col-sm-12">
						<div class="form-button-group">
						<?php echo form_submit('create-news', 'Send', 'class="btn btn-primary"' );?>
						</div>
					</div>
				</div>
				<?php echo form_hidden('datetme', set_value('datetime', date('Y-m-d H:j:s')), ' class="form-control"' ); ?>
        		<?php echo form_hidden('sentfrom', set_value('sentfrom', $user_id), ' class="form-control"' ); ?>
        		<?php echo form_hidden('reply_of', set_value('reply_of', $msgid), ' class="form-control"' ); ?>
			<?php echo form_close() ?>
			</div>

	  <?php
	  //end compose form
	  } else {
	  ?>
      <!--
      <a href="#" onclick="modalshow('5','1')" class="btn btn-default">Reply</a>
      <a href="#" onclick="modalshow('5','1')" class="btn btn-default">Reply All</a>
      <a href="#" onclick="modalshow('5','1')" class="btn btn-default">Forward</a>
      <a href="#" onclick="modalshow('5','1')" class="btn btn-default">Delete</a>
      <a href="#" onclick="modalshow('5','1')" class="btn btn-default">Mark as Read</a>
      <a href="#" onclick="modalshow('5','1')" class="btn btn-default">Mark as Unread</a>
      -->
      <br>
      <table class="table table-bordered headed" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th></th>
            <th><?php echo $sender_label?></th>
            <th>Subject</th>
            <th>Date/Time</th>
            <!--
            <th>Public/private</th>
            <th>Message</th>
            -->
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
            //Read/Unread/Sent
            //print_r($messages);
            if (count($messages) > 0){
                foreach ($messages as $row){
          ?>
			  <tr>
        <td>
        <?php
          $js = 'onClick="some_function()"';
          echo form_checkbox('selected_emails', 'selected_emails', '', $js);
        ?>
        </td>
				<td >

          <a href="<?php echo site_url('messages/inbox?action=re&id='.$row->id.'&write=1'); ?>">
          <?php echo $row->use_first_name.', '.$row->use_last_name; ?>
          </a>
				</td>
				<td>
				  <a href="<?php echo site_url('messages/inbox?action=re&id='.$row->id.'&write=1'); ?>">
					<?php echo 'RE:'.$row->subject; ?>
				  </a>
				</td>
				<td>
				  <?php echo $row->datetime;?>
				</td>
        <!--
				<td>
				  <?php echo ($row->public)>0?'Public':'Private';?>
				</td>
				<td>
				  <?php echo substr($row->message,0,100),'...';?>
				</td>
        -->
        <td>
          <a href="<?php echo site_url('messages/inbox?action=re&id='.$row->id.'&write=1'); ?>" class="btn btn-default">Reply</a>
          <a href="<?php echo site_url('messages/inbox?action=fwd&id='.$row->id.'&write=1'); ?>" class="btn btn-default">Forward</a>
          <a href="<?php echo site_url('messages/inbox?action=del&id='.$row->id.''); ?>" class="btn btn-default">Delete</a>
          <!--
          onclick="modalshow('5','1')" 
          <a hrf=""><span class="glyphicon glyphicon-icon-unshare" title="Reply"></span></a>
          <a hrf=""><span class="glyphicon glyphicon-share-alt" title="Forward"></span></a>
          <a hrf=""><span class="glyphicon glyphicon glyphicon-trash" title="Delete"></span></a>
          -->
        </td>
			  </tr><?php
				} //end foreach
          }else{

          ?>
          <tr>
            <td colspan="5">
              <div class="feed-element">
                <div class="media-body">
                  You have no <?php echo $message_type; ?> messages
                  <br />
                </div>
              </div>
            </td>
          </tr>
		  <?php
          } //end if num_rows > 0
          ?>
        </tbody>
      </table>

	 <?php } //end if compose/reply/foward ?>

    </div>
    <!--Main -->
    <?php //include("footer.php"); ?>
    <script>
  function modalshow(a,b){

  var width,height,padding,top,left,modalbak,modalwin;
  width   = 900;
  height  = 500;
  padding = 64;
  top     = (window.innerHeight-height-padding)/2;
  left    = (window.innerWidth-width-padding)/2;

 $(&quot;#modalwin&quot;).load(&quot;loadajax?c=&quot;+a+&quot;&amp;type=&quot;+b+&quot;&amp;p=active_bids&quot;);
 // $(&quot;#modalwin&quot;).load(&quot;bid_pop?ass_id=&quot;+a+&quot;&amp;type=&quot;+b);
  modalbak = document.getElementById(&quot;modalbak&quot;);
  modalbak.style.display = &quot;block&quot;;

  modalwin = document.getElementById(&quot;modalwin&quot;);
  modalwin.style.top     = top+&quot;px&quot;;
  modalwin.style.left    = left+&quot;px&quot;;
  modalwin.style.display = &quot;block&quot;;
}
function modalhide1(){
  document.getElementById(&quot;modalbak&quot;).style.display = &quot;none&quot;;
  document.getElementById(&quot;modalwin&quot;).style.display = &quot;none&quot;;
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
    <div id='modalwin'></div>

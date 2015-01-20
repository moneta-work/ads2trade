<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Messages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('messages_model'); //Already autoloaded in Events library
		$this->load->model('User_model', 'users');
	}

	public function index()
	{
		redirect('/messages/inbox/', 'refresh');
	}

	public function inbox()
	{

		$read = $this->input->get('read');
		$sent = $this->input->get('sent');
		$write = $this->input->get('write');
		$user_id = $this->session->userdata('user_id');
		
		$data = array();
		$data['read'] = $read;
		$data['sent'] = $sent;
		$data['user_id'] = $user_id;
		$data['total_sent'] = $data['total_messages'] = $this->events->getCountSentMessages($user_id);
		$data['total_read'] = $data['total_messages'] = $this->events->getCountReadMessages($user_id);
		$data['total_unread'] = $data['total_messages'] = $this->events->getCountUnreadMessages($user_id);
		
		$data['sent_active'] = '';
		$data['read_active'] = '';
		$data['unread_active'] = '';
		$data['compose_active'] = '';
		$data['sender_label'] = 'Sender';

		if(isset($sent) && $sent == 1){
			//If sent messages	
			$data['messages'] = $this->events->getSentMessages($user_id);
			$data['total_messages'] = $data['total_sent'];
			$data['sent_active'] = 'class="active"';
			$data['message_type'] = 'sent';
			$data['sender_label'] = 'Recipient';
		} elseif(isset($read) && $read == 1){
			//read messages
			$data['messages'] = $this->events->getReadMessages($user_id);
			$data['total_messages'] = $data['total_read'];
			$data['read_active'] = 'class="active"';
			$data['message_type'] = 'read';
		} else {
			//unread messages (default)
			$data['messages'] = $this->events->getUnreadMessages($user_id);
			$data['total_messages'] = $data['total_unread'];
			$data['unread_active'] = 'class="active"';
			$data['message_type'] = 'new';
		}
		//echo $user_id;

		//print_r($data['messages']);
		//exit;
		if(isset($write) && $write == 1){
			$data['compose_active'] = 'class="active"';
			$data['sent_active'] = '';
			$data['read_active'] = '';
			$data['unread_active'] = '';	
			$data['write'] = $write;
			
			//public/private option
			$data['public_options'] = array(
                  '0'  => 'Private',
                  '1'    => 'Public',
                );
				
			//available users to email
			//$data['sendto_options'] = array();
			$users_list = $this->users->get_allusers();
			foreach ($users_list->result() as $row){
				//$data['sendto_options'][] = array($row->use_id => $row->use_first_name.', '.$row->use_last_name);
				$data['sendto_options'][$row->use_id] = $row->use_first_name.', '.$row->use_last_name;
			}
			/*
			$data['sendto_options'] = array(
                  '0'  	 => 'User 1',
                  '1'    => 'User 2',
				  '2'    => 'User 3',
                );
			*/				
		}
		
		$this->layouts->view('messages/inbox', null, $data);
	}

	public function send()
	{
		$message = new stdClass;
		$temp_message = new stdClass;
		//Set message defaults
		/*
		echo '<pre>';
		print_r($this->input->post('sendto'));
		print_r($this->input->post());
		echo '</pre>';
		*/
		
		//Populate message details from posted values
		$message->sentfrom = $this->input->post('sentfrom', TRUE);
		$message->sentto = $this->input->post('sentto', TRUE);
		$message->subject = $this->input->post('subject', TRUE);
		$message->message = $this->input->post('message', TRUE);
		$message->datetime = $this->input->post('datetime', TRUE);
		$message->public = $this->input->post('public', TRUE);

		//echo is_array($message->sentto);

		//exit;
		//Send message
		$message_id = $this->events->sendMessage($message, $temp_message);

		//echo $message_id;
		//Redirect to sent messages when done
		redirect('/messages/inbox/?sent=1', 'refresh');
	}
}
//end of Messages.php	
?>
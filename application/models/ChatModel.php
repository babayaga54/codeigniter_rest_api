<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChatModel extends CI_Model {
//////////////////////////messages////////////////////////////////////////////////////////////
    public function get_sender_messages_by_id($id)
    {
        return $this->db->select('senderId,receiverId,message,date')->from('messages')->where('senderId',$id)->order_by('id','desc')->get()->result();
    }

    public function get_messages_by_id($sender_id,$receiver_id)
    {
          $sql="SELECT * FROM messages WHERE (senderId = '".$sender_id."' AND receiverId = '".$receiver_id."') OR (senderId = '".$receiver_id."' AND receiverId = '".$sender_id."') ORDER BY id DESC";    
          $query = $this->db->query($sql);
          return $query->result();
    }

    public function send_message($data)
    {
        $this->db->insert('messages',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function delete_message($id)
    {
        $this->db->where('id',$id)->delete('messages');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }
//////////////////////////messages////////////////////////////////////////////////////////////


    public function start_chat($data)
    {
        $this->db->insert('chats',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function get_chats($sender_id)
    {
          $sql="SELECT * FROM chats WHERE (creatorId = '".$sender_id."' OR visitorId = '".$sender_id."') ORDER BY id DESC";    
          $query = $this->db->query($sql);
          return $query->result();
    }

    

    public function book_all_data()
    {
        return $this->db->select('id,title,author')->from('books')->order_by('id','desc')->get()->result();
    }

    

    public function book_create_data($data)
    {
        $this->db->insert('books',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function book_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('books',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function book_delete_data($id)
    {
        $this->db->where('id',$id)->delete('books');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }
    
    
    public function mesaj_cek()
    {
        return $this->db->select('id,senderId,receiverId,message,date')->from('messages')->where('id','0')->order_by('id','desc')->get()->row();
    }

}

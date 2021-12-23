<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

  public function get_user_information_by_user_mail($user_mail)
  {
      $this->db->where('user_mail', $user_mail);
      $result = $this->db->get('users');
      return $result;
  }

  public function get_user_id_by_user_mail($user_mail)
  {
    $this->db->where('user_mail', $user_mail);
    $this->db->select('user_id');
    $this->db->limit(1);
    $result = $this->db->get('users');
    return $result->result()[0]->user_id;
  }

  function can_login($username, $password)
  {
    $this->db->where('user_mail', $username);
    $this->db->where('user_password', $password);
    $query = $this->db->get('users');
    //SELECT * FROM users WHERE username = '$username' AND password = '$password'
    if($query->num_rows() > 0){
      return true;
    }else{
      return false;
    }
  }

}

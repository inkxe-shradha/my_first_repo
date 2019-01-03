<?php
require "config.php";
class Controller
{
    public function __construct()
    {

        $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database.";
            exit;
        }
    }
    public function checkUserCredentials($username,$password)
    {
        # code...
        $query = "SELECT * FROM store WHERE email = '$username' AND password = '$password'";
        $process = mysqli_query($this->db,$query) or die(mysqli_error($this->db));
        if (mysqli_num_rows($process) > 0) {
            # code...
            return true;
        }
        else {
            # code...
            return mysqli_error($this->db);
        }
    }
    public function getUserdataByMail($useremail)
    {
        # code...
        $query = "SELECT * FROM store WHERE email = '$useremail'";
        $process = mysqli_query($this->db,$query);
        return $process;
    }
    public function checkUserCredentialsByEmail($useremail)
    {
        # code...
        $query = "SELECT * FROM store WHERE email = '$useremail'";
        $process = mysqli_query($this->db, $query) or die(mysqli_error($this->db));
        if (mysqli_num_rows($process) > 0) {
            # code...
            return true;
        } else {
            # code...
            return false;
        }
    }
    public function getPasswordDetails($username)
    {
        $query = "SELECT * FROM store WHERE email = '$username'";
        $process = mysqli_query($this->db, $query) or die(mysqli_error($this->db));
        while ($row = $process->fetch_assoc()) {
            # code...
            return (md5($row['password']));
        }
    }
    public function insertKey($username,$password)
    {
        # code...
        //mysqli_query($this->db, "DELETE FROM rest_password WHERE `user_name` = '$username' ");
        
       
            # code...
            //$query = "INSERT INTO rest_password (`key`, `user_name`) VALUES ('$password','$username')";
            $query = "UPDATE store SET url_key = '$password' , key_status = '1'  WHERE email='$username' ";
            $process = mysqli_query($this->db, $query) or die(mysqli_error($this->db));
            if ($process) {
            # code...
                return true;
            }
        
    }
    public function updateKey($key)
    {
        # code...
        $query = "UPDATE `store` SET `key_status` = '0' WHERE `store`.`url_key` = '$key'";
        $process = mysqli_query($this->db, $query) or die(mysqli_error($this->db));
        if ($process) {
            # code...
            return true;
        }
        else {
            return false;
        }
    }
    public function checkeyStatus($key)
    {
        # code...
        if (mysqli_num_rows(mysqli_query($this->db, "SELECT * FROM store WHERE `url_key` = '$key' AND `key_status` = '0'")) > 0) {
            # code...
            return true;
        }
        
    }
    public function getUserNameFromKey($key)
    {
        # code...
        $query = "SELECT * FROM store WHERE `url_key` = '$key'";
        $process = mysqli_query($this->db, $query) or die(mysqli_error($this->db));
        while ($row = $process->fetch_assoc()) {
            # code...
            return ($row['email']);
        }
    }
    public function updateCredentcials($email,$password)
    {
        # code...
        $query = "UPDATE store SET password = '$password' WHERE email ='$email'";
        $process = mysqli_query($this->db, $query) or die(mysqli_error($this->db));
        return true;
    }
    public function getCountry($country)
    {
        # code...
        $process = mysqli_query($this->db,"SELECT countries.name as country_name,states.name as state_name,cities.name as cityname FROM `countries`left join states on countries.id=states.country_id left join cities on states.id=cities.state_id WHERE cities.id=$country");
        return $process;
    }
    public function getPlanName($plan_id,$email)
    {
        # code...
        $process = "SELECT plans.plan_name FROM plans LEFT JOIN store ON plans.id = store.selected_plan WHERE plans.id = '$plan_id' AND store.email = '$email'  ";
        $result = mysqli_query($this->db, $process);
        return $result;
    }
    public function isKeyExist($key)
    {
        $process = mysqli_query($this->db,"SELECT * FROM store WHERE url_key = '$key'");
        if(mysqli_num_rows($process) > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }
}

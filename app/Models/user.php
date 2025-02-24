<?php

require_once "../app/Core/DBConnect.php";

class userModel {

    private $db;

    public function __construct() {
        $this->db = new DBConnect();
    }

    public function createUser(string $email, string $password, string $username)
    {
        $username = htmlspecialchars($username);
        $email = htmlspecialchars($email);
        $quary = $this->db->dbconn->prepare("INSERT INTO Users (Username, Password, Email) VALUES (:username,:password,:email)");
        $quary->execute([':username' => $username, ':password' => $password , ':email' => $email]);
        return $quary->fetchAll();
    }

    public function checkIfUserExsistsByUsername(string $username)
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM Users WHERE username = :username");
        $quary->execute([':username' => $username]);
        if($quary->fetchAll() != []){
            return false;
        }else{
            return true;
        }
    }

    public function checkIfUserExsistsByEmail(string $email)
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM Users WHERE email = :email");
        $quary->execute([':email' => $email]);
        if($quary->fetchAll() != []){
            return false;
        }else{
            return true;
        }
    }

    public function loginUser(string $username ,string $password)
    {
        $quary = $this->db->dbconn->prepare("SELECT * FROM users WHERE username = :username");
        $quary->execute([':username' => $username]);
        $user = $quary->fetch();
        if($user && password_verify($password , $user['Password'])){
            return $user;
        }
        return false;   
    }

    public function userChangePassword(int $UserID ,string $username,string $oldPassword, string $newPassword)
    {
        $quary = $this->db->dbconn->prepare("SELECT * FROM users WHERE username = :username");
        $quary->execute([':username' => $username]);
        $user = $quary->fetch();

        if($user && password_verify($oldPassword , $user['Password']))
        {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $quary = $this->db->dbconn->prepare("UPDATE users SET Password = :newPassword WHERE UserID = :UserID");
            $quary->execute([':UserID' => $UserID, ':newPassword' => $newPassword]);
            return true;
        }
        
        return false;   
    }

    public function userLostPassword(int $UserID ,string $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $quary = $this->db->dbconn->prepare("UPDATE users SET Password = :newPassword WHERE UserID = :UserID");
        $quary->execute([':UserID' => $UserID, ':newPassword' => $newPassword]);
        $quary->fetch();
    }

    public function userChangeEmail(int $UserID , string $newEmail)
    {
        $quary = $this->db->dbconn->prepare("UPDATE users SET Email = :newEmail WHERE UserID = :UserID");
        $quary->execute([':UserID' => $UserID, ':newEmail' => $newEmail]);
        $quary->fetchAll();
        return true;
    }
    
    public function deleteUser(int $UserID , string $username , string $password)
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM users WHERE username = :username");
        $quary->execute([':username' => $username]);
        $user = $quary->fetch();
        if($user && password_verify($password , $user['Password'])){

            $quary = $this->db->dbconn->prepare("DELETE FROM tasks WHERE UserID = :UserID");
            $quary->execute([':UserID' => $UserID]);

            $quary = $this->db->dbconn->prepare("DELETE FROM projects WHERE UserID = :UserID");
            $quary->execute([':UserID' => $UserID]);

            $quary = $this->db->dbconn->prepare("DELETE FROM users WHERE UserID = :UserID");
            $quary->execute([':UserID' => $UserID]);
            return true;
        }
        return false;   

    }

    public function getAllUsers()
    {

        $quary = $this->db->dbconn->prepare("SELECT * FROM Users");
        $quary->execute();
        return $quary->fetchAll();
    }

    public function searchUsers($searchValue)
    {
        $query = $this->db->dbconn->prepare("SELECT * FROM Users WHERE Username LIKE ?");
        $searchPattern = "%$searchValue%";
        $query->execute([$searchPattern]);
        return $query->fetchAll();
    }

    public function addUserToProject(int $userID, int $projectID)
    {
        $query = $this->db->dbconn->prepare("INSERT INTO SheredProjects (UserID, ProjectID) VALUES (:userID, :projectID)");
        $query->execute([':userID' => $userID, ':projectID' => $projectID]);
        return $query->fetchAll();
    }

    public function getUsersByProjectID($projectID) {
        $query = $this->db->dbconn->prepare("
            SELECT u.Username 
            FROM users u 
            INNER JOIN SheredProjects sp ON u.UserID = sp.UserID 
            WHERE sp.ProjectID = :projectID
        ");
        $query->execute([':projectID' => $projectID]);
        return $query->fetchAll(PDO::FETCH_ASSOC); // Izmantojiet fetchAll, lai iegūtu visus lietotājus
    }

    public function getUserIdByName(string $username)
    {
        $query = $this->db->dbconn->prepare("SELECT UserID FROM users WHERE Username = :username");
        $query->execute([':username' => $username]);
        return $query->fetch();
    }
    
    
    public function removeUserFromProject(int $userID, int $projectID)
    {
        $query = $this->db->dbconn->prepare("DELETE FROM SheredProjects WHERE UserID = :userID AND ProjectID = :projectID");
        $query->execute([':userID' => $userID, ':projectID' => $projectID]);
        return $query->rowCount(); // Atgriežam ietekmēto ierakstu skaitu
    }
}
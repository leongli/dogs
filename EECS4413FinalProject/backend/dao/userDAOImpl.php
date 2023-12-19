<?php

require 'userDAO.php';

class userDAOImpl implements userDAO {

  
    public function updateUser($mysqli, $first, $last, $email, $role, $userId) {

        // Create Query
        $query = "UPDATE `users`
        SET
            `FirstName` = '" . $first . "',
            `LastName` = '" . $last . "',
            `Email` = '" . $email . "',
            `Rank` = '" . $role . "'
        WHERE
            `UserID` = " . $userId . ";";

        // Get Result
        $result = $mysqli -> query($query);

    }

}
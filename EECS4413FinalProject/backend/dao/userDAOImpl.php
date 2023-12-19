<?php

require 'userDAO.php';

class userDAOImpl implements userDAO {

    /**
     * Updates a user in the database with the specified information
     * @param mysqli $mysqli - an instance of the MySQLi connection to the database
     * @param string $first - the updated first name of the user
     * @param string $last - the updated last name of the user
     * @param string $email - the updated email address of the user
     * @param string $role - the updated role or rank of the user
     * @param int $userId - the ID of the user to be updated
     */
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
<?php
interface userDAO {

    public function updateUser($mysqli, $first, $last, $email, $role, $userId);

}

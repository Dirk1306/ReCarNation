<?php
session_start();
echo json_encode(['user_id' => $_SESSION['user']['id'] ?? null]);
?>
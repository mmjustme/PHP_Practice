<?php


// API example тут є логіка як з прикладом нашого додатку так і роботи з API
// логікі роботи з API та просто додтаком не повинна бути в одному файлі



# так беруться дані з тіла запиту
$api_data = json_decode(file_get_contents('php://input'), true);

$data = $api_data ?? $_POST;

$id = $data['id'] ?? 0;
db()->query("DELETE FROM posts WHERE id=?", [$id]);

if (db()->rowCount()) {
    $res['answer'] = $_SESSION['success'] = "Post deleted";
} else {
    $res['answer'] = $_SESSION['error'] = "Deleting error";
}

// API answer
if ($api_data) {
    echo json_encode($res);
    die();
}

// from form
header('Location: ' . '/');
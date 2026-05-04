<?php
header('Content-Type: application/json');
$pdo = new PDO("mysql:host=localhost;dbname=student_db", "root", "");

$action = $_GET['action'] ?? '';

// Save (Register + Marks + Edit)
if ($action == 'save') {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $marks = $_POST['marks']; // [1 => score, 2 => score, 3 => score]

    // 1. Upsert Student (Add/Edit)
    $stmt = $pdo->prepare("INSERT INTO students (roll_number, full_name) VALUES (?, ?) ON DUPLICATE KEY UPDATE full_name=VALUES(full_name)");
    $stmt->execute([$roll, $name]);
    $sid = $pdo->query("SELECT id FROM students WHERE roll_number='$roll'")->fetchColumn();

    // 2. Save Marks
    foreach ($marks as $c_id => $score) {
        $stmtMark = $pdo->prepare("INSERT INTO marks (student_id, course_id, score) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE score=VALUES(score)");
        $stmtMark->execute([$sid, $c_id, $score]);
    }
    echo json_encode(['status' => 'ok']);
}

// List & Calculate (Total, Percentage, Grade)
if ($action == 'list') {
    $sql = "SELECT s.id, s.roll_number, s.full_name, SUM(m.score) as total, AVG(m.score) as percentage 
            FROM students s JOIN marks m ON s.id = m.student_id GROUP BY s.id";
    $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as &$row) {
        $p = $row['percentage'];
        $row['grade'] = ($p >= 90) ? 'A+' : (($p >= 80) ? 'A' : (($p >= 60) ? 'B' : 'F'));
        $row['percentage'] = round($p, 1);
    }
    echo json_encode($data);
}

// Search
if ($action == 'search') {
    $roll = $_GET['roll'];
    $stmt = $pdo->prepare("SELECT s.full_name, AVG(m.score) as p FROM students s JOIN marks m ON s.id = m.student_id WHERE s.roll_number = ?");
    $stmt->execute([$roll]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    if($res['full_name']) {
        $res['grade'] = ($res['p'] >= 60) ? 'Pass' : 'Fail';
        echo json_encode($res);
    } else echo json_encode(null);
}

// Delete
if ($action == 'delete') {
    $id = $_GET['id'];
    $pdo->prepare("DELETE FROM students WHERE id = ?")->execute([$id]);
    echo json_encode(['status' => 'deleted']);
}
?>
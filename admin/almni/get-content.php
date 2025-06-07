<?php
include_once '../../config/config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $conn->prepare("SELECT * FROM alumni WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($row) {
        $_SESSION['user_id'] = $row['id'];
        echo "
        <div class='mb-3 mt-4 form-container'>
        <div class='message'></div>
            <label><b>Names:</b></label>
            <input type='text' id='names' class='form-control' value='" . htmlspecialchars($row['names']) . "' />
            <label><b>Email:</b></label>
            <input type='text' id='email' class='form-control' value='" . htmlspecialchars($row['email']) . "' />
            <label><b>Gender:</b></label>
            <select id='gender' class='form-control'>
                <option value='" . htmlspecialchars($row['gender']) . "' selected>" . ucfirst($row['gender']) . "</option>
                <option value='male'>Male</option>
                <option value='female'>Female</option>
            </select>
        </div>
        <div class='mb-3 mt-4'>
            <label><b>Profession:</b></label>
            <input type='text' id='proffesion' class='form-control' value='" . htmlspecialchars($row['professional']) . "' />
            <label><b>Awards:</b></label>
            <input type='text' id='awards' class='form-control' value='" . htmlspecialchars($row['award']) . "' />
            <label><b>Profile Year:</b></label>
            <input type='number' id='profile_year' class='form-control' value='" . htmlspecialchars($row['profile_year']) . "' />
        </div>
        <div class='mb-3 mt-4'>
            <label><b>Description:</b></label>
            <textarea id='description' class='form-control'>" . htmlspecialchars($row['description']) . "</textarea>
        </div>
        <div>
            <button type='submit' class='btn btn-primary'>Update Alumni</button>
        </div>";
    } else {
        echo "User not found";
    }
} else {
    echo "Invalid request.";
}
?>

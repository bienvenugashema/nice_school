<?php
include_once '../../config/config.php';
?>
<html>
<?php include_once '../header.php'; ?>

<body>
    <?php include '../navbar.php'; ?>
    <div class="d-flex justify-content-center" style="height: 100vh;">
        <div class="container">
            <h3 class="text-left">Alumni Management Panel</h3>
            <div>
                <ul class="list-unstyled">
                    <li><a href="create_alumna.php">Create New Alumna</a></li>
                </ul>
            </div>
            <table class="table">
                <tr>
                    <th>ID</th><th>Names</th><th>Email</th><th>Gender</th>
                    <th>Profile Year</th><th>Profession</th><th>Profile Picture</th><th>Actions</th>
                </tr>
                <?php 
                $stmt = $conn->prepare("SELECT * FROM alumni");
                $stmt->execute();
                $results = $stmt->fetchAll();
                $count = 0;
                foreach ($results as $result) {
                    $count++;
                    ?>
                    <tr>
                        <td><?= $count; ?></td>
                        <td><?= $result['names']; ?></td>
                        <td><?= $result['email']; ?></td>
                        <td><?= $result['gender']; ?></td>
                        <td><?= $result['profile_year']; ?></td>
                        <td><?= $result['professional']; ?></td>
                        <td>
                            <img src="<?= $result['profile_picture']; ?>" width="30" style="border-radius: 10px"/>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="loadContent(<?= $result['id']; ?>)">Edit</button>
                            <a href="delete_alumna.php?id=<?= $result['id']; ?>" class="text-danger">Delete</a>
                            <a href="view_alumna.php?id=<?= $result['id']; ?>" class="text-warning">View</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <div class="mt-4 p-4 border rounded shadow" id="form-container" style="min-height: 100px; display: none;"></div>
        </div>
    </div>

    <script>
        function loadContent(id) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "get-content.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function () {
                const displDiv = document.getElementById("form-container");
                displDiv.innerHTML = `
                    <p id='message'></p>
                    <form id='edit_alumna_form'>${this.responseText}</form>
                `;
                edit_alumna(); // Attach event listener
                displDiv.style.display = "block";
            };
            xhr.send("id=" + id);
        }

        function edit_alumna() {
            const form = document.getElementById('edit_alumna_form');
            if (!form) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const data = {
                    names: document.getElementById('names').value.trim(),
                    email: document.getElementById('email').value.trim(),
                    gender: document.getElementById('gender').value.trim(),
                    proffesion: document.getElementById('proffesion').value.trim(),
                    awards: document.getElementById('awards').value.trim(),
                    profile_year: document.getElementById('profile_year').value.trim(),
                    description: document.getElementById('description').value.trim()
                };

                fetch('/nice_school/api/update_alumni.php', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data)
                })
                .then(async (response) => {
                    const text = await response.text();
                    try {
                        const json = JSON.parse(text);
                        document.getElementById("message").innerText = json.message;
                    } catch (e) {
                        console.error("JSON parse error:", e.message);
                    }
                })
                .catch(error => {
                    console.error("Network error:", error);
                });
            });
        }
    </script>
</body>
</html>

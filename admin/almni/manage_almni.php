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
            <div id="dispyTable"></div>
            <div class="mt-4 p-4 border rounded shadow" id="form-container" style="min-height: 100px; display: none;"></div>
        </div>
    </div>
    
    <script>
        window.onload = function() {
            load_tabler();
        };
        function load_tabler() {
            const xhr = new XMLHttpRequest();
            xhr.open("GET", "load-dat.php", true);
            xhr.onload = function () {
                if (this.status === 200) {
                    document.getElementById("dispyTable").innerHTML = this.responseText;
                    const buttons = document.querySelectorAll("button");
                    buttons.forEach(button => {
                        button.addEventListener("click", function() {
                            const id = this.getAttribute("data-id");
                            // loadContent(id);
                        });
                    });
                } else {
                    console.error("Failed to load data:", this.statusText);
                }
            };
            xhr.send();
        }

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
        function showLoader() {
            const loader = document.getElementById("loader");
            loader.hidden = false;
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
                        setTimeout(() => {
                            document.getElementById("message").innerText = json.message;
                        }, 3000)
                        if (response.ok) {
                            load_tabler();
                            const disableForm = document.getElementById("form-container");
                            const loader = document.getElementById("loader");
                            setTimeout(() => {
                                loader.hidden = true;
                                disableForm.style.display = "none";
                            }, 5000);
                            
                        } else {
                            console.error("Error:", json.message);
                        }
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

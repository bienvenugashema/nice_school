<?php

require_once '../../config/config.php';

$stmt = $conn->prepare('SELECT * FROM alumni');
$stmt->execute();
$results = $stmt->fetchAll();
$count = 0;
echo " <table class='table'>
                <tr>
                    <th>ID</th><th>Names</th><th>Email</th><th>Gender</th>
                    <th>Profile Year</th><th>Profession</th><th>Profile Picture</th><th>Actions</th>
                </tr>";

                foreach ($results as $result) {
                

                    echo "<tr>";

                echo "<td>" . $result['id'] . "</td>";
                echo "<td>" . $result['names'] . "</td>";
                echo "<td>" . $result['email'] . "</td>";
                echo "<td>" . $result['gender'] . "</td>";
                echo "<td>" . $result['profile_year'] . "</td>";
                echo "<td>" . $result['professional'] . "</td>";
                echo "<td>
                            <img src=\"" . $result['profile_picture'] . "\" width=\"30\" style=\"border-radius: 10px\"/>
                        </td>";
                echo "<td>";
                echo "<button class=\"btn btn-primary btn-sm\" onclick=\"loadContent(" . $result['id'] . ")\">Edit</button>&nbsp;";
                echo "<button class=\"btn btn-sm btn-warning\" onclick=\"view_alumni_info(" . $result['id'] . ")\">View</button>&nbsp;";
                echo "<button class=\"btn btn-sm btn-danger\" onclick=deleteAlumni(".$result['id'].")>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        echo "</table>";
    

?>
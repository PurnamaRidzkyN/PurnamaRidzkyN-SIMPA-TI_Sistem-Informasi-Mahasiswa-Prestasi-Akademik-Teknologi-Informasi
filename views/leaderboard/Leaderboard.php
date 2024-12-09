<?php

use app\cores\View;
use app\helpers\Dump;

$leaderboard = View::getData();

?>
    <div class="container mt-5">
        <h2 class="text-center">Leaderboard</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Rank</th>
                    <th scope="col">Name</th>
                    <th scope="col">Total Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Dump::out($leaderboard);
                // Loop through the array and display the leaderboard
                $rank = 1;
                foreach ($leaderboard as $entry) {
                    echo "<tr>";
                    echo "<td>" . $rank++ . "</td>";
                    echo "<td>" . htmlspecialchars($entry['Nama_Mahasiswa']) . "</td>";
                    echo "<td>" . $entry['Total_Skor'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div id="quiz-result-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jawaban Benar</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                foreach($result as $res){
                    echo "<tr>
                            <td>".$n."</td>
                            <td>".$res['username']."</td>
                            <td>".$res['correctAnswer']."</td>
                            <td>".$res['score']."</td>
                        </tr>";
                    $n++;
                }
            ?>
        </tbody>
    </table>
</div>
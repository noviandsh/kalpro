<div id="quiz-result">
    <div id="result-card">
        <div id="quiz-result-title" style="font-size: 30px;"><?=$quizDetail[0]['title']?></div>
        <div id="quiz-result-detail" style="font-size: 12px;">
            Waktu mulai <?=$userAnswer[0]['startTime']?> | Durasi <?=$quizDetail[0]['duration']?> Menit
        </div><br><br>
        Nilai anda <?=$result[0]['score']?>
    </div>
</div>
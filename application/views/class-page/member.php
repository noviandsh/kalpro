Dosen: <br>
<span><?=$class[0]['teacher']?></span><br><br>

Member:
<ul> 
    <?php
    foreach($member as $mhs){
        if($mhs['classID'] == $class[0]['classID']){
            echo "<li>".$mhs['username']."</li>";
        }
    }
    ?>
</ul>
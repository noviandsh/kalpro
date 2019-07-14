member:
<ul> 
    <?php
    foreach($member as $mhs){
        if($mhs['classID'] == $class[0]['classID']){
            echo "<li>".$mhs['username']."</li>";
        }
    }
    ?>
</ul>
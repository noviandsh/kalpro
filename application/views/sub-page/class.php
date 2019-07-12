<div>

</div>
<div>
    member:
    <ul>
    <?php
    // print_r($class['classID']);
    foreach($member as $mhs){
        if($mhs['classID'] == $class['classID']){
            echo "<li>".$mhs['username']."</li>";
        }
    }
    ?>
    </ul>
</div>
<div>

</div>


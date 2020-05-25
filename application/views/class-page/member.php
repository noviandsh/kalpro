<h2>Dosen: </h2>
<div style="height: 100px;">
    <div class="member-list">
        <?php
            foreach($user as $a){
                if($class[0]['teacher'] == $a['name']){
                    echo "<img src='".$a['photo']."'>";
                }
            }
            ?>
        <div><?=$class[0]['teacher']?></div><br><br>
    </div>
</div>

<h2>Member:</h2>
<ul> 
    
        <?php
        foreach($member as $mhs){
            if($mhs['classID'] == $class[0]['classID']){
                echo "<li>
                    <div class='member-list'>";
                    foreach($user as $a){
                        if($mhs['username'] == $a['name']){
                            echo "<img src='".$a['photo']."'>";
                        }
                    }
                echo "<div>".$mhs['username']."</div></div></li>";
            }
        }
        ?>
    </div>
</ul>
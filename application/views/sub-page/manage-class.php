<div id="container">
    <div>
        <form action="<?=base_url('dataprocess/newClass')?>" method="post">
            <input type="text" name="className" placeholder="Nama Kelas" id="className"><button>buat kelas</button>
        </form><br>
    </div>
    <div>
        <?php 
            function clean($string) {
                $string = strtolower($string);
                $string = trim($string, " ");
                $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
                $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

                return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
            }
            foreach($class as $val){?>
                <div class="class-div">
                    <?=$val['name']?>
                    <a href="<?=base_url('class/'.clean($val['name']).'-'.$val['classID'].'/post')?>">Link</a><br>
                    
                </div>
                <hr>
            <?php
            }
        ?>
    </div>
    <div>
        kelas
    </div>
</div>
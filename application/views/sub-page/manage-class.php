<div id="container">
    <div>
        <?php if($this->session->type == 'd'){ ?>
            <form action="<?=base_url('dataprocess/newClass')?>" method="post">
                <input type="text" name="className" placeholder="Nama Kelas" id="className"><button class="styled-btn">buat kelas</button>
            </form><br>
        <?php } ?>
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
                <div class="class-div" style="height: 100px;background: white;padding: 20px;font-family: sans-serif;">
                    
                    <a style="font-size: 20px;text-decoration: none;font-weight: bold;" href="<?=base_url('class/'.clean($val['name']).'-'.$val['classID'].'/post')?>"><?=$val['name']?></a><br><br><br>
                    <?php
                        echo $this->crud->GetCountWhere('class_member', array('classID'=>$val['classID'])).' anggota';
                    ?>
                </div>
                <hr>
            <?php
            }
        ?>
    </div>
    <div>
    </div>
</div>
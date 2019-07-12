<div id="profile">
    <div class="photo">
        <img src="<?=base_url('assets/img/poto.jpg')?>" alt="">
    </div>
    login as <b><?=$this->session->username;?></b><br>
    <form action="<?=base_url('dataproccess/joinClass')?>" method="post">
        <input type="text" name="classID" placeholder="Masukkan Kode Kelas">
        <button>Gabung Kelas</button>
    </form>
</div>
<div id="content">
    <div id="post-form">
        <form action="<?=base_url('dataproccess/post')?>" method="post">
            <select name="classID">
                <?php
                    foreach($class as $val){
                        echo "<option value=".$val['classID'].">".$val['name']."</option>";
                    }
                ?>
            </select>
            <input type="hidden" value="home" name="prevLink">
            <textarea name="content" id="blas" cols="30" rows="10"></textarea>
            <button onClick="test()">Kirim</button>
        </form>
    </div>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores aspernatur facere dolore aperiam, voluptatem ullam consequuntur assumenda at? Sapiente expedita vero cumque quaerat corporis explicabo laudantium deserunt! Sit, non rem.
</div>
<div id="sidebar">

</div>
<script>
    function test() {
        console.log($('#blas').val());
    }
</script>
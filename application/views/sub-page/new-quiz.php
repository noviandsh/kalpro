<div id="new-quiz-container">
    <input type="text" placeholder="Nama Kuis">
    <input readonly="readonly" type="text" id="startDate" placeholder="Waktu Mulai">
    <input readonly="readonly" type="text" id="dueDate" placeholder="Waktu Selesai">
    <input type="text" placeholder="Durasi"><br><br>
    <div id="new-quiz-number">
        <ul>
            <li class="selected"><a href="#">1</a></li>
            <li id="add-quiz-id"><a id="add-quiz" href="">+</a></li>
        </ul>
    </div>
    <div class="new-quiz-form">
        <form action="" method="post">
            <input type="text">
        </form>
    </div>
</div>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
        let n = 1;
        $("#add-quiz").click(function(e){
            e.preventDefault();
            n++;
            $("#add-quiz-id").before('<li><a href="#">'+n+'</a></li>');
        })
        $("#startDate").datetimepicker({ 
            minDate: 1,
            changeMonth: true,
            dateFormat: "yy-mm-dd",
            onSelect: function(date){
                let selectedDate = new Date(date);
                let msecsInADay = 86400000;
                let endDate = new Date(selectedDate.getTime() + msecsInADay);

                //Set Minimum Date of EndDatePicker After Selected Date of StartDatePicker
                $("#dueDate").datepicker( "option", "minDate", endDate );
            }
        });
        $("#dueDate").datetimepicker({ 
            dateFormat: 'yy-mm-dd',
            changeMonth: true
        });

    })
</script>
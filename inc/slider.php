



<div class="slidersection templete clear">
    <div id="slider">
        
        <?php
        $query="select * from tbl_slider";
        $slider=$db->select($query);
        while($result=$slider->fetch_assoc()){
        ?>
        <a href="#"><img src="admin/<?php echo $result['image']?>" alt="nature 1" width="960px" height="280px" title="<?php echo $result['title']?>" /></a>
        <?php }?>
    </div>

</div>









<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>

<style>

.list_item {
    background-color: #F1F1F1;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    margin: 5px 15px 2px;
    padding: 2px;
    font-size: 14px;
    line-height: 1.5;
}
.show_more_main {
    margin: 15px 25px;
}
.show_more {
    background-color: #f8f8f8;
    background-image: -webkit-linear-gradient(top,#fcfcfc 0,#f8f8f8 100%);
    background-image: linear-gradient(top,#fcfcfc 0,#f8f8f8 100%);
    border: 1px solid;
    border-color: #d3d3d3;
    color: #333;
    font-size: 12px;
    outline: 0;
}
.show_more {
    cursor: pointer;
    display: block;
    padding: 10px 0;
    text-align: center;
    font-weight:bold;
}
.loding {
    background-color: #e9e9e9;
    border: 1px solid;
    border-color: #c6c6c6;
    color: #333;
    font-size: 12px;
    display: block;
    text-align: center;
    padding: 10px 0;
    outline: 0;
    font-weight:bold;
}
.loding_txt {
    background-image: url(loading.gif);
    background-position: left;
    background-repeat: no-repeat;
    border: 0;
    display: inline-block;
    height: 16px;
    padding-left: 20px;
}
</style>

<div class="postList">
    <?php
    // Get records from the database
    $result = $conn->query("SELECT * FROM allcategories ORDER BY RAND() DESC LIMIT 3");
    
    if($conn->num_rows > 0){ 
        while($row = $conn->fetch_assoc()){ 
            $postID = $row['id'];
    ?>
    <div class="list_item"><?php echo $row['title']; ?></div>
    <?php } ?>
    <div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
        <span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Show more</span>
        <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
    </div>
    <?php } ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        $.ajax({
            type:'POST',
            url:'ajax_more.php',
            data:'id='+ID,
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.postList').append(html);
            }
        });
    });
});
</script>

</body>
</html>
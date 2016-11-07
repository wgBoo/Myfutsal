<!DOCTYPE html>
<html>
<head>
    <title>403 Forbidden</title>
</head>
<body>
<ul>
    <?php
    foreach($topics as $entry){
        ?>
        <li><a href="/index.php/topic/get/<?=$entry->id?>"><?=$entry->title?></a></li>
        <?php
    }
    ?>
</ul>
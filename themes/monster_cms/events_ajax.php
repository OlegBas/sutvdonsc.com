<?if(!empty($row['date'])) print date("d.m.Y", $row['date']);?> <a href="/article.html?id=<?=$row['article_id']?>">
    <?=$row['title']?></a><br />
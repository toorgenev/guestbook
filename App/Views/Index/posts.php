<?php 
if(empty($posts)){
    echo '<tr><td colspan="6">Guest book is empty</td></tr>';
}else{
    foreach($posts as $post){
        echo '<tr>'.
                '<td>' . date('Y-m-d h:i',$post['date']) . '</td>'.
                '<td>' . htmlspecialchars($post['user']) . '</td>'.
                '<td>' . htmlspecialchars($post['email']) . '</td>'.
                '<td>' . htmlspecialchars($post['homepage']) . '</td>'.
                '<td>' . htmlspecialchars($post['text']) . '</td>';
        if($post['photo']){
            echo '<td><img src="/www/images/' . $post['photo'] . '" width="150"></td>';
        }else{
            echo '<td></td>';
        }
        echo '</tr>';
    }
}
?>

<div id="comment_header">All comments</div>
<div id="comments">
    <table id="comment_table" cellspacing="0" border="1">
        <thead>
            <tr>
                <th id="th_1"><a href="#" id="sort_date">Date</a></th>
                <th id="th_2"><a href="#" id="sort_user">User name</a></th>
                <th id="th_3"><a href="#" id="sort_email">E-mail</a></th>
                <th id="th_4">Homepage</th>
                <th id="th_5">Comment text</th>
                <th id="th_6">Attached picture</th>
        </thead>
        <tbody>
                <?php echo $this->render('posts',false,array('posts'=>$posts)); ?>
        </tbody>
    </table>
</div>
<div id="pagination">
    <div id="pagination_content">
    <?php echo $this->render('pagination',false,array('cnt'=>$cnt, 'perPage'=>$perPage)); ?>
    </div>
</div>
<div class="transparent" style="display:none;"></div>

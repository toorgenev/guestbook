<div id="comment_header">Add comment</div>
<?php if(!empty($error)) echo '<div id="add_error">ERROR! ' . $error . '</div>'; ?>
<div id="form_wrapper">
    <form id="comment_form" method="post" action="/index/add" enctype="multipart/form-data">
        <p class="form_label">Your name:<span class="required">*</span></p>
        <input type="text" name="username" size="40" maxlength="50" required/>
        <p class="form_label">Your email:<span class="required">*</span></p>
        <input type="email" name="email" size="40" maxlength="100" required />
        <p class="form_label">Homepage:</p>
        <input type="text" name="homepage" size="40" maxlength="100"/>
        <p class="form_label">Comment text:<span class="required">*</span></p>
        <textarea name="text" cols="40" rows="5" required></textarea><br/>
        <p class="form_label">Add image:</p>
        <input type="file" name="img" accept="image/jpeg,image/png,image/gif"/><br/><br/>
        <input type="submit" name="submit" value="Add comment" id="submit_button"/>
    </form>
</div>

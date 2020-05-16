
<div class="container">
    <h1>User</h1>
    <form 
        method= "post"
        action="/api/users<?= $userExists ?  "/".$user["id"] : "" ?>"
        id="user-edit-form"
        data-user-exists="<?php echo $userExists; ?>"
        enctype="multipart/form-data">

        <?php if ($userExists): ?>
        <div class="form-group">
            <label for="user-id">id</label>
            <input type="text" name="id" class="form-control" disabled id="user-id" value="<?php echo $user["id"]; ?>">
        </div>
        <?php endif; ?>

        <div class="form-group">
            <label for="exampleInputText1">Login</label>
            <input type="text" name="login" class="form-control" id="exampleInputText1" aria-describedby="textHelp" placeholder="Enter text" value="<?php echo $user["login"]; ?>"  >
            <small id="textHelp" class="form-text text-muted">We'll never share your text with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">User picture</span>
            </div>
            <div class="custom-file">
                <input type="file"
                       class="custom-file-input"
                       id="inputGroupFile01"
                       name="picture"
                       aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>

        <?php if ($userExists): ?>
        <div class="form-group form-check">
            <input type="checkbox" name="active" class="form-check-input" id="exampleCheck1" <?php if ($user["active"]) echo "checked" ?>>
            <label class="form-check-label" for="exampleCheck1">Active</label>
        </div>
        <?php endif; ?>

        <button type="submit"  class="btn btn-primary">Submit</button>
    </form>
</div>


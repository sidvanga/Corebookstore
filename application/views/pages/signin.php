<div class="container">
    <!--    <form class="form-signin mx-auto text-center" style="width:20rem;margin-top:10rem;">-->
        <?php echo form_open('auth', 'class="form-signin mx-auto text-center" style="width:20rem;margin-top:10rem;"');?>
        <h2 class="form-signin-heading">BookStore</h2>
        <label for="inputEmail" class="sr-only">User name :</label>
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control mb-4" placeholder="Password" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        
        <p class='mt-2 text-danger'><?php echo $errmsg ?></p>
    </form>
</div>
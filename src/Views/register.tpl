<!--header-->
<h1>Create Account</h1>
<form method=POST>
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" name="login" class="form-control" id="login" required value="{login}">
    </div>

    <div class="row">

        <div class="form-group col">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        <div class="form-group col">
            <label for="password2">Confirm Password</label>
            <input type="password" name="password2" class="form-control" id="password2" required>
        </div>
    </div>

    <div class="form-group">
        <label for="group">Group</label>
        <select name="role" class="form-control" id="group">
            <option value="Father">Father</option>
            <option value="Mother">Mother</option>
            <option value="Child" selected>Child</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Create Account</button> - OR - <a href="/login">Go to Login page</a>
</form>
<!--footer-->

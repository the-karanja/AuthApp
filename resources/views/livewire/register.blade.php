<div class="col-md-6 offset-md-3">
    <h2 class="text-center mb-4">Register Account</h2>
    <form>
        <div class="mb-3">
            <label for="email" class="form-label">Username</label>
            <input type="email" class="form-control" id="username" name="username" required placeholder="Username">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
        <button type="submit" onclick="captureFingerPrint()" class="btn btn-primary btn-bg">Capture Fingerprint</button>
    <br>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

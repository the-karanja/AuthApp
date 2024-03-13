<div>
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center mb-4">Login</h2>
        <form wire:submit.prevent="submit">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" wire:model="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password"  class="form-label">Password</label>
                <input wire:model="password" type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary">Login with Password</button></br>

        </form>

        <button type="button" wire:click="get_credential" onclick="LoginWithFinger()" style="margin-top: 10px" class="btn btn-primary">Login with FingerPrint Prompt</button>


        <p><a href="/register">Create Account</a></p>
    </div>
    <script>

        function generateRandomString(length) {
                const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let randomString = '';

                // Generate an array to hold the random values
                const values = new Uint32Array(length);

                // Fill the array with cryptographically secure random values
                window.crypto.getRandomValues(values);

                for (let i = 0; i < length; i++) {
                    // Use the random values to get characters from the charset
                    randomString += charset[values[i] % charset.length];
                }

                return randomString;
            }
            let randomStringFromServer = generateRandomString(30);
            function generateChallenge() {
    // Length of the challenge in bytes (recommended to be at least 16 bytes)
    const length = 32;

    // Generate a cryptographically secure random array of bytes
    const array = new Uint8Array(length);
    window.crypto.getRandomValues(array);

    // Convert the byte array to a base64url-encoded string
    const challenge = btoa(String.fromCharCode.apply(null, array))
        .replace(/\+/g, '-')
        .replace(/\//g, '_')
        .replace(/=/g, '');

    return challenge;
}

        // Example usage:
        const challenge = generateChallenge();
        const credentialId = "AXpwfs9+qn9QMOUPGY91LjTHIzl2NpyTnaO/SJLLO3el3mFk4aZitQAZvd4LU+HrW2B/LX3viLaX3DI+Df1mWrQ=";

                const publicKeyCredentialRequestOptions = {
                    challenge: Uint8Array.from(challenge, c => c.charCodeAt(0)),
                    allowCredentials: [{
                        type: 'public-key',
                        id: Uint8Array.from(atob(credentialId), c => c.charCodeAt(0))
                    }],
                    timeout: 60000, // Optional timeout
                    // Other optional parameters can be added as needed
        };


        async function LoginWithFinger()
        {
            const requestOptions = {
                email: document.getElementById('email').value
            }
            // use the fetch function to send a post request to the server
            fetch('/get-credential-id',requestOptions)
            .then(response=>{
                console.log(response)
            })
        }



    </script>


</div>

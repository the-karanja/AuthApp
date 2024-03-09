<div>
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center mb-4">Register Account</h2>
        <form wire:submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" class="form-control"  wire:model="username" id="username" name="username" required placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" wire:model="email" id="email" name="email" required placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" wire:model="password" name="password" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            {{-- <button type="submit" onclick="captureFingerPrint()" class="btn btn-primary btn-bg">Capture Fingerprint</button> --}}
        <br>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <script>

        //i generate a random string from my local server
        // Function to generate a random string
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
                const publicKeyCredentialCreationOptions = {
                challenge: Uint8Array.from(
                    randomStringFromServer, c => c.charCodeAt(0)),
                rp: {
                    name: "Duo Security", // Relying Party Name
                    id:window.location.hostname, // Relying Party ID
                },
                user: {
                    id: Uint8Array.from(
                        "UZSL85T9AFC", c => c.charCodeAt(0)), // User ID
                    name: "brian", // Username
                    displayName: "Brian", // Display Name
                    email: "bcaranja@gmail.com" // Email
                },
                pubKeyCredParams: [
            { alg: -7, type: "public-key" }, // ES256
            { alg: -257, type: "public-key" } // RS256
            ], // Public Key Credential Parameters
                authenticatorSelection: {
                    authenticatorAttachment: "cross-platform", // Authenticator Attachment
                },
                timeout: 60000, // Timeout
                attestation: "direct" // Attestation Conveyance Preference
            };

            async function  captureFingerPrint(){
                if (!navigator.credentials) {
            console.error('WebAuthn is not supported in this browser');
        }else {
            const credential = await navigator.credentials.create({
                publicKey: publicKeyCredentialCreationOptions
            });
            console.log(credential)
        }
            }
        </script>
</div>

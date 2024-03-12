<div>
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center mb-4">Register Account</h2>
        @if ($WebAuthnSuccessMessage)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Hey !</strong> {{ $WebAuthnSuccessMessage }} <a href="/login">click here to login</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>


        @endif

        <form wire:submit.prevent="submit">
            <div class="mb-3">
                <label for="email" class="form-label">Username</label>
                <input type="text" class="form-control"  wire:model="username" id="username" name="username" required placeholder="Username">
                @error('username') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" wire:model="email" id="email" name="email" required placeholder="Email">
                @error('email') <span style="color: red">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" wire:model="password" name="password" required>
                @error('password') <span style="color: red">{{ $message }}</span> @enderror
            </div>
                @if ($FingerprintIsCaptured)
                <div class="alert alert-info" role="alert">
                    Your Biometric data has been captured successfully
                  </div>
                @else
                <div class="alert alert-info" role="alert">
                    Please cooperate in capturing your biometric data to improve security and streamline authentication. This ensures smoother access to our platform.
                  </div>
                @endif
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            @if ($FingerprintIsCaptured)
            <button type="submit" class="btn btn-primary">Complete Registration</button>
            @else
            <button type="button" onclick="captureFingerPrint()"  class="btn btn-primary">Capture Fingerprint</button>
            {{-- <button  @if (!$isValid) disabled @endif onclick="captureFingerPrint()" class="btn btn-primary btn-bg">
                @if ($isValid)
                    Capture Fingerprint
                @else
                    Fill in the Fields to capture your fingerprint
                @endif
            </button> --}}
            @endif


        <br>

        </form>
    </div>


    <script>


        //  i generated a random string from my local server
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
                    displayName:  document.getElementById('username').value, // Display Name
                    email:  document.getElementById('email').value // Email
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
                    Livewire.emit('WebAuthnErrorMessage','Your web browser doesnt support WebAuthn')
                }else {
                    Livewire.emit('WebAuthnErrorMessage','Your web browser supports WebAuthn')
                const credential = await navigator.credentials.create({
                    publicKey: publicKeyCredentialCreationOptions
                });
                Livewire.emit('IsFingerPrintCaptured',true)
                const arrayBuffer = credential.rawId

                // convert array buffer to a Uint8Array
                const uint8Array = new Uint8Array(arrayBuffer);

                // Encode the Uint8Array to Base64
                const base64String = btoa(String.fromCharCode.apply(null, uint8Array));
                console.log(base64String);
                Livewire.emit('FingerPrintData',base64String)
                Livewire.emit('WebAuthnSuccess','Your Account Has been Successfully created')
            }

        }
        </script>
</div>

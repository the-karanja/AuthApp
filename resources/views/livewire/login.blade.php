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

        <button type="button" wire:click="get_credential" onclick="logs()" style="margin-top: 10px" class="btn btn-primary">Login with FingerPrint Prompt</button>

            <input type="text" id="credential"  value={{ $credential_id }} wire:model="credential_id"/>

        <p><a href="/register">Create Account</a></p>
    </div>
    <script>
        function logs ()
        {
            const email_data = document.getElementById('email').value
            console.log(email_data)
            //create a json to send as a request
            const requestData = {
                email: email_data
            }



            // Fetch request options
            const requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email: email_data })
            };

            // Make the fetch request
            fetch('/get-credential-id', requestOptions)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    // Do something with the retrieved credential ID
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        //    console.log(document.getElementById('credential').value)
            // console.log(base64Credential_id)
        }
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
        // Define publicKeyCredentialRequestOptions
        // const publicKeyCredentialRequestOptions = {
        //     challenge: Uint8Array.from(
        //         randomStringFromServer, c => c.charCodeAt(0)),
        //     allowCredentials: [{
        //         id: Uint8Array.from(
        //             credentialId, c => c.charCodeAt(0)),
        //         type: 'public-key',
        //         transports: ['usb', 'ble', 'nfc'],
        //     }],
        //     timeout: 60000,
        // };

        // Define your LoginWithFingerPrint function
        async function LoginWithFingerPrint() {
            try {
                // Attempt to get the assertion
                const assertion = await navigator.credentials.get({
                    publicKey: publicKeyCredentialRequestOptions
                });

                // Handle the assertion
                handleAssertion(assertion);
            } catch (error) {
                console.error('Error during login:', error);
            }
        }

        // Define a function to handle the assertion
        function handleAssertion(assertion) {
            // Your logic to handle the assertion goes here
            console.log('Assertion:', assertion);
        }


    </script>

</div>

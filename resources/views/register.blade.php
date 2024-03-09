<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    @livewireStyles
</head>
<body>
    <div class="container">
        <div class="row">

        </div>
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
        @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntXf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMp9Mvc" crossorigin="anonymous"></script>
</body>
</html>

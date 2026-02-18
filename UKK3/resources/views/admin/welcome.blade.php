<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form UKK</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #f8f9fa; /* Warna background abu muda halus */
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Efek bayangan tipis */
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="form-container">
                <h3 class="text-center mb-4">Form Input Data</h3>
                
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Recipient's username">
                        <span class="input-group-text">@example.com</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="basic-url" class="form-label">Your vanity URL</label>
                    <div class="input-group">
                        <span class="input-group-text">https://</span>
                        <input type="text" class="form-control" id="basic-url" placeholder="example.com/users/">
                    </div>
                    <div class="form-text">Example help text goes outside.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Donation Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="text" class="form-control" aria-label="Amount">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Server Details</label>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="User">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" placeholder="Server">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Notes</label>
                    <div class="input-group">
                        <span class="input-group-text">With textarea</span>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="button">Submit Data</button>
                    <button class="btn btn-outline-secondary" type="button">Cancel</button>
                </div>

            </div> </div>
    </div>
</div>

</body>
</html>
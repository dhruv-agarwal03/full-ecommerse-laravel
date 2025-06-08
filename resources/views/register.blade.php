@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page with Pagination</title>
    <style>
        .form-section {
            display: none;
        }
        .form-section.active {
            display: block;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body class="bg-light">
<a class="m-4 pt-4 h2" href="/"> &#x2190; </a>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 600px;">
        <h2 class="text-center">Register</h2>
        <form method="POST" action="/register">
            <!-- Section 1: Personal Info -->
            <div class="form-section active">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="fname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lname">
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-primary next">Next</button>
                </div>
            </div>

            <!-- Section 2: Contact Info -->
            <div class="form-section">
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="number" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button type="button" class="btn btn-primary next">Next</button>
                </div>
            </div>

            <!-- Section 3: Password & Address -->
            <div class="form-section">
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" name="address">
                </div>
                <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name="city">
                </div>
                <div class="mb-3">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control" name="state">
                </div>
                <div class="mb-3">
                    <label class="form-label">Pincode</label>
                    <input type="text" class="form-control" name="pincode">
                </div>
                <div class="btn-container">
                    <button type="button" class="btn btn-secondary prev">Previous</button>
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const sections = document.querySelectorAll(".form-section");
    const nextBtns = document.querySelectorAll(".next");
    const prevBtns = document.querySelectorAll(".prev");

    let currentSection = 0;

    function showSection(index) {
        sections.forEach((section, i) => {
            section.classList.toggle("active", i === index);
        });
    }

    nextBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentSection < sections.length - 1) {
                currentSection++;
                showSection(currentSection);
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener("click", () => {
            if (currentSection > 0) {
                currentSection--;
                showSection(currentSection);
            }
        });
    });
</script>

</body>
</html>

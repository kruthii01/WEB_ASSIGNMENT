<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success - Your Information</title>
    <link rel="stylesheet" href="registration.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        
        .success-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        
        .success-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .success-header h1 {
            color: #27ae60;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .success-icon {
            font-size: 4em;
            color: #27ae60;
            margin-bottom: 20px;
        }
        
        .info-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #667eea;
        }
        
        .info-section h2 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.5em;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px;
            margin-top: 15px;
        }
        
        .info-label {
            font-weight: bold;
            color: #2c3e50;
        }
        
        .info-value {
            color: #555;
        }
        
        .interests-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }
        
        .interest-tag {
            background: #667eea;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9em;
        }
        
        .back-button {
            text-align: center;
            margin-top: 30px;
        }
        
        .btn-back {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .info-label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-header">
            <div class="success-icon">✓</div>
            <h1>Registration Successful!</h1>
            <p style="color: #666; font-size: 1.1em;">Thank you for registering. Your information has been received.</p>
        </div>

        <?php
        // Check if form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Sanitize and get form data
            $firstName = htmlspecialchars(trim($_POST['firstName'] ?? ''));
            $lastName = htmlspecialchars(trim($_POST['lastName'] ?? ''));
            $email = htmlspecialchars(trim($_POST['email'] ?? ''));
            $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
            $dateOfBirth = htmlspecialchars(trim($_POST['dateOfBirth'] ?? ''));
            $gender = htmlspecialchars(trim($_POST['gender'] ?? ''));
            $address = htmlspecialchars(trim($_POST['address'] ?? ''));
            $city = htmlspecialchars(trim($_POST['city'] ?? ''));
            $state = htmlspecialchars(trim($_POST['state'] ?? ''));
            $pincode = htmlspecialchars(trim($_POST['pincode'] ?? ''));
            $course = htmlspecialchars(trim($_POST['course'] ?? ''));
            $interests = isset($_POST['interests']) ? $_POST['interests'] : [];
            
            // Format date of birth
            $formattedDate = '';
            if ($dateOfBirth) {
                $dateObj = DateTime::createFromFormat('Y-m-d', $dateOfBirth);
                if ($dateObj) {
                    $formattedDate = $dateObj->format('F d, Y');
                }
            }
        ?>
        
        <div class="info-section">
            <h2>Personal Information</h2>
            <div class="info-grid">
                <div class="info-label">Full Name:</div>
                <div class="info-value"><?php echo $firstName . ' ' . $lastName; ?></div>
                
                <div class="info-label">Email:</div>
                <div class="info-value"><?php echo $email; ?></div>
                
                <div class="info-label">Phone:</div>
                <div class="info-value"><?php echo $phone; ?></div>
                
                <div class="info-label">Date of Birth:</div>
                <div class="info-value"><?php echo $formattedDate ? $formattedDate : $dateOfBirth; ?></div>
                
                <div class="info-label">Gender:</div>
                <div class="info-value"><?php echo $gender; ?></div>
            </div>
        </div>

        <div class="info-section">
            <h2>Address Information</h2>
            <div class="info-grid">
                <div class="info-label">Address:</div>
                <div class="info-value"><?php echo nl2br($address); ?></div>
                
                <div class="info-label">City:</div>
                <div class="info-value"><?php echo $city; ?></div>
                
                <div class="info-label">State:</div>
                <div class="info-value"><?php echo $state; ?></div>
                
                <div class="info-label">Pincode:</div>
                <div class="info-value"><?php echo $pincode; ?></div>
            </div>
        </div>

        <div class="info-section">
            <h2>Academic Information</h2>
            <div class="info-grid">
                <div class="info-label">Course/Program:</div>
                <div class="info-value"><?php echo $course; ?></div>
            </div>
        </div>

        <?php if (!empty($interests)): ?>
        <div class="info-section">
            <h2>Interests</h2>
            <div class="interests-list">
                <?php foreach ($interests as $interest): ?>
                    <span class="interest-tag"><?php echo htmlspecialchars($interest); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="back-button">
            <a href="registration.html" class="btn-back">Register Another Person</a>
        </div>

        <?php
        } else {
            // If form was not submitted via POST, redirect to registration form
            header("Location: registration.html");
            exit();
        }
        ?>
    </div>
</body>
</html>


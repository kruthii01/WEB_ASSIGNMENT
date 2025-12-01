<?php
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
$values = [
    'full_name' => '',
    'email' => '',
    'phone' => '',
    'program' => '',
    'start_term' => '',
    'statement' => ''
];
$errors = [];

if ($submitted) {
    $values['full_name'] = trim($_POST['full_name'] ?? '');
    $values['email'] = trim($_POST['email'] ?? '');
    $values['phone'] = trim($_POST['phone'] ?? '');
    $values['program'] = trim($_POST['program'] ?? '');
    $values['start_term'] = trim($_POST['start_term'] ?? '');
    $values['statement'] = trim($_POST['statement'] ?? '');

    if ($values['full_name'] === '') {
        $errors['full_name'] = 'Full name is required.';
    }

    if ($values['email'] === '' || !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please provide a valid email address.';
    }

    if ($values['phone'] === '') {
        $errors['phone'] = 'Phone number is required.';
    }

    if ($values['program'] === '') {
        $errors['program'] = 'Select a program.';
    }

    if ($values['start_term'] === '') {
        $errors['start_term'] = 'Select a start term.';
    }

    if ($values['statement'] === '') {
        $errors['statement'] = 'Statement of purpose cannot be empty.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Application Form</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="assets/app.js" defer></script>
</head>
<body>
    <main class="container">
        <section class="hero">
            <h1>Graduate Program Application</h1>
            <p>Complete the form below to submit your application. Fields marked * are required.</p>
        </section>
        <section class="form-card">
            <form id="applicationForm" method="POST" novalidate>
                <div class="form-group">
                    <label for="full_name">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($values['full_name']); ?>" required>
                    <?php if (isset($errors['full_name'])): ?>
                        <small class="error"><?php echo $errors['full_name']; ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($values['email']); ?>" required>
                        <?php if (isset($errors['email'])): ?>
                            <small class="error"><?php echo $errors['email']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone *</label>
                        <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($values['phone']); ?>" required>
                        <?php if (isset($errors['phone'])): ?>
                            <small class="error"><?php echo $errors['phone']; ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="program">Program of Interest *</label>
                        <select id="program" name="program" required>
                            <option value="" disabled <?php echo $values['program'] === '' ? 'selected' : ''; ?>>Select a program</option>
                            <option value="MS Computer Science" <?php echo $values['program'] === 'MS Computer Science' ? 'selected' : ''; ?>>MS Computer Science</option>
                            <option value="MBA" <?php echo $values['program'] === 'MBA' ? 'selected' : ''; ?>>MBA</option>
                            <option value="MS Data Science" <?php echo $values['program'] === 'MS Data Science' ? 'selected' : ''; ?>>MS Data Science</option>
                            <option value="MS Cybersecurity" <?php echo $values['program'] === 'MS Cybersecurity' ? 'selected' : ''; ?>>MS Cybersecurity</option>
                        </select>
                        <?php if (isset($errors['program'])): ?>
                            <small class="error"><?php echo $errors['program']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="start_term">Preferred Start Term *</label>
                        <select id="start_term" name="start_term" required>
                            <option value="" disabled <?php echo $values['start_term'] === '' ? 'selected' : ''; ?>>Select a term</option>
                            <option value="Fall 2025" <?php echo $values['start_term'] === 'Fall 2025' ? 'selected' : ''; ?>>Fall 2025</option>
                            <option value="Spring 2026" <?php echo $values['start_term'] === 'Spring 2026' ? 'selected' : ''; ?>>Spring 2026</option>
                            <option value="Summer 2026" <?php echo $values['start_term'] === 'Summer 2026' ? 'selected' : ''; ?>>Summer 2026</option>
                        </select>
                        <?php if (isset($errors['start_term'])): ?>
                            <small class="error"><?php echo $errors['start_term']; ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="statement">Statement of Purpose *</label>
                    <textarea id="statement" name="statement" rows="5" required><?php echo htmlspecialchars($values['statement']); ?></textarea>
                    <?php if (isset($errors['statement'])): ?>
                        <small class="error"><?php echo $errors['statement']; ?></small>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-primary">Submit Application</button>
            </form>
        </section>

        <?php if ($submitted && empty($errors)): ?>
            <section class="result-card">
                <h2>Submission Received</h2>
                <p>Thank you for applying, <?php echo htmlspecialchars($values['full_name']); ?>. Here is a summary of your application:</p>
                <ul class="summary-list">
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($values['email']); ?></li>
                    <li><strong>Phone:</strong> <?php echo htmlspecialchars($values['phone']); ?></li>
                    <li><strong>Program:</strong> <?php echo htmlspecialchars($values['program']); ?></li>
                    <li><strong>Start Term:</strong> <?php echo htmlspecialchars($values['start_term']); ?></li>
                </ul>
                <article class="statement-preview">
                    <h3>Statement of Purpose</h3>
                    <p><?php echo nl2br(htmlspecialchars($values['statement'])); ?></p>
                </article>
            </section>
        <?php elseif ($submitted && !empty($errors)): ?>
            <section class="result-card error-card">
                <h2>Submission Failed</h2>
                <p>Please correct the highlighted fields and submit again.</p>
            </section>
        <?php endif; ?>
    </main>
</body>
</html>


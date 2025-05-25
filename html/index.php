<?php
session_start();
$configs = require __DIR__ . '/email_configs.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Email Sender</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Test Email Sender</h1>
        <div id="message-container">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="<?php echo $_SESSION['message']['type']; ?>">
                    <?php echo $_SESSION['message']['text']; ?>
                    <span class="close-button" onclick="clearMessage()">&times;</span>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>
        <form action="process_email.php" method="POST" id="emailForm">
            <div class="form-group">
                <label for="config_select">Choose Configuration:</label>
                <select id="config_select" name="config_index">
                    <option value="">-- Custom / Manual --</option>
                    <?php foreach ($configs as $idx => $cfg): ?>
                        <option value="<?php echo $idx; ?>"><?php echo htmlspecialchars($cfg['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="smtp_host">SMTP Host:</label>
                <input type="text" id="smtp_host" name="smtp_host" value="<?php echo isset($_SESSION['form_data']['smtp_host']) ? $_SESSION['form_data']['smtp_host'] : 'smtp.gmail.com'; ?>" required>
            </div>
            <div class="form-group">
                <label for="smtp_port">SMTP Port:</label>
                <input type="text" id="smtp_port" name="smtp_port" value="<?php echo isset($_SESSION['form_data']['smtp_port']) ? $_SESSION['form_data']['smtp_port'] : '587'; ?>" required>
            </div>
            <div class="form-group">
                <label for="smtp_username">SMTP Username:</label>
                <input type="text" id="smtp_username" name="smtp_username" value="<?php echo isset($_SESSION['form_data']['smtp_username']) ? $_SESSION['form_data']['smtp_username'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="smtp_password">SMTP Password:</label>
                <input type="password" id="smtp_password" name="smtp_password" value="<?php echo isset($_SESSION['form_data']['smtp_password']) ? $_SESSION['form_data']['smtp_password'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="from_email">From Email:</label>
                <input type="email" id="from_email" name="from_email" value="<?php echo isset($_SESSION['form_data']['from_email']) ? $_SESSION['form_data']['from_email'] : 'no-reply-plastimax@mail1-aws.sltech-gt.com'; ?>" required>
            </div>
            <div class="form-group">
                <label for="to_email">To Email:</label>
                <input type="email" id="to_email" name="to_email" value="<?php echo isset($_SESSION['form_data']['to_email']) ? $_SESSION['form_data']['to_email'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" value="<?php echo isset($_SESSION['form_data']['subject']) ? $_SESSION['form_data']['subject'] : 'Standalone Test Email'; ?>">
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <textarea id="body" name="body"><?php echo isset($_SESSION['form_data']['body']) ? $_SESSION['form_data']['body'] : 
                    'This is a test email sent using PHPMailer with SMTP configuration in the script. If you received this, the SMTP settings are likely working.'; ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit">Send Test Email</button>
                <button type="reset">Reset</button>
                <button type="submit" name="clear_session">Clear Session</button>
            </div>
        </form>
    </div>

    <script>
        // Configs for JS
        const configs = <?php echo json_encode($configs); ?>;
        const form = document.getElementById('emailForm');
        const configSelect = document.getElementById('config_select');

        configSelect.addEventListener('change', function() {
            const idx = this.value;
            if (idx === "") return; // Manual mode
            const cfg = configs[idx];
            if (!cfg) return;
            form.smtp_host.value = cfg.smtp_host;
            form.smtp_port.value = cfg.smtp_port;
            form.smtp_username.value = cfg.smtp_username;
            form.smtp_password.value = cfg.smtp_password;
            form.from_email.value = cfg.from_email;
            form.to_email.value = cfg.to_email;
        });

        function clearMessage() {
            const messageContainer = document.getElementById('message-container');
            messageContainer.innerHTML = '';
        }
    </script>
</body>
</html>
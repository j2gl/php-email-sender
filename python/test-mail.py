import smtplib
from email.message import EmailMessage

msg = EmailMessage()
msg['Subject'] = 'Amazon SES SMTP Test'
msg['From'] = 'no-reply-plastimax@mail1-aws.sltech-gt.com'
msg['To'] = 'juan.garcia@sltech-gt.com'
msg.set_content('This is a test email sent via Amazon SES SMTP over port 587.')

# Replace with your SMTP username/password
SMTP_USERNAME = ''
SMTP_PASSWORD = ''

with smtplib.SMTP('email-smtp.us-west-2.amazonaws.com', 587) as server:
    server.starttls()
    server.login(SMTP_USERNAME, SMTP_PASSWORD)
    server.send_message(msg)

print("Email sent!")
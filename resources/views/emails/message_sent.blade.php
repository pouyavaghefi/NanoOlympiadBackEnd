<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $customMessage->subject }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 30px; color: #333;">

<div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">

    <h2 style="color: #2c3e50; font-size: 24px; margin-bottom: 20px;">
        📬 {{ $customMessage->subject }}
    </h2>

    <p style="font-size: 16px; line-height: 1.6;">
        {{ $customMessage->body }}
    </p>

    <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">

    <p style="font-size: 14px; color: #555;">
        <strong>Priority:</strong>
        <span style="color:
                @if($customMessage->priority === 'critical') #e74c3c
                @elseif($customMessage->priority === 'important') #f39c12
                @else #2ecc71
                @endif;
            ">
                {{ ucfirst($customMessage->priority) }}
            </span>
    </p>

    @if($customMessage->can_reply)
        <p style="font-size: 14px; color: #555;">
            ✅ You can reply to this message.
        </p>
    @endif

    <p style="margin-top: 40px; font-size: 12px; color: #aaa;">
        This is an automated message. Please do not reply unless instructed.
    </p>
</div>

</body>
</html>

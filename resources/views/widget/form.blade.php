<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Форма обратной связи</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }

        .widget {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="widget">
        <h2>Обратная связь</h2>

        <div id="message" class="message" style="display: none;"></div>

        <form id="feedbackForm">
            @csrf
            <div class="form-group">
                <label>Ваше имя *</label>
                <input type="text" name="customer[name]" required>
            </div>
            <div class="form-group">
                <label>Телефон (E.164, напр. +79991234567) *</label>
                <input type="text" name="customer[phone]" pattern="^\+[1-9]\d{1,14}$" required>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="customer[email]" required>
            </div>
            <div class="form-group">
                <label>Тема *</label>
                <input type="text" name="subject" required>
            </div>
            <div class="form-group">
                <label>Сообщение *</label>
                <textarea name="text" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label>Прикрепить файлы (до 10MB каждый)</label>
                <input type="file" name="files[]" multiple accept="image/*,.pdf,.doc,.docx">
            </div>
            <button type="submit">Отправить</button>
        </form>
    </div>

    <script>
        document.getElementById('feedbackForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const messageDiv = document.getElementById('message');

            try {
                const response = await fetch('/api/tickets', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                });

                const result = await response.json();

                if (response.ok) {
                    messageDiv.className = 'message success';
                    messageDiv.textContent = result.message;
                    document.getElementById('feedbackForm').reset();
                } else {
                    messageDiv.className = 'message error';
                    messageDiv.textContent = result.message || 'Ошибка при отправке.';
                }
            } catch (error) {
                messageDiv.className = 'message error';
                messageDiv.textContent = 'Ошибка сети. Попробуйте позже.';
            }

            messageDiv.style.display = 'block';
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 5000);
        });
    </script>
</body>

</html>
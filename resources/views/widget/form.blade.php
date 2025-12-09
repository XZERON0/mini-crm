<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Форма обратной связи</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .file-input {
            opacity: 0;
            position: absolute;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        /* Анимации */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <!-- Заголовок -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-6">
                <h2 class="text-2xl font-bold text-white mb-2">Обратная связь</h2>
                <p class="text-blue-100">Мы свяжемся с вами в ближайшее время</p>
            </div>

            <!-- Сообщения -->
            <div id="message" class="hidden mx-6 mt-6 p-4 rounded-lg fade-in"></div>

            <!-- Форма -->
            <form id="feedbackForm" class="p-6 space-y-4">
                @csrf

                <!-- Имя -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Ваше имя *
                    </label>
                    <input type="text" name="name" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400"
                        placeholder="Иван Иванов">
                </div>

                <!-- Телефон -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Телефон *
                    </label>
                    <input type="text" name="phone" pattern="^\+7\d{10}$" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400"
                        placeholder="+79991234567">
                    <p class="mt-1 text-xs text-gray-500">Формат: +7XXXXXXXXXX (11 цифр)</p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email *
                    </label>
                    <input type="email" name="email" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400"
                        placeholder="example@mail.com">
                </div>

                <!-- Тема -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Тема *
                    </label>
                    <input type="text" name="subject" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400"
                        placeholder="О чём вы хотите поговорить?">
                </div>

                <!-- Сообщение -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Сообщение *
                    </label>
                    <textarea name="text" rows="4" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 resize-none"
                        placeholder="Опишите вашу проблему или вопрос..."></textarea>
                </div>

                <!-- Файлы -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Прикрепить файлы (до 10MB каждый)
                    </label>
                    <div class="relative">
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition cursor-pointer bg-gray-50">
                            <input type="file" name="files[]" multiple accept="image/*,.pdf,.doc,.docx,.txt"
                                class="file-input" id="fileInput">

                            <div class="pointer-events-none">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-gray-600 mb-1">Нажмите для загрузки файлов</p>
                                <p class="text-xs text-gray-500">PDF, DOC, изображения, текст</p>
                            </div>
                        </div>
                    </div>
                    <div id="fileList" class="mt-3 space-y-2"></div>
                </div>

                <!-- Кнопка отправки -->
                <button type="submit" id="submitBtn"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 mt-6">
                    Отправить заявку
                </button>

                <p class="text-center text-xs text-gray-500 mt-4">
                    Отправляя форму, вы соглашаетесь с обработкой персональных данных
                </p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('feedbackForm');
            const messageDiv = document.getElementById('message');
            const fileInput = document.getElementById('fileInput');
            const fileList = document.getElementById('fileList');
            const submitBtn = document.getElementById('submitBtn');

            // Отображение выбранных файлов
            fileInput.addEventListener('change', function () {
                fileList.innerHTML = '';

                if (this.files.length > 0) {
                    Array.from(this.files).forEach((file, index) => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'flex items-center justify-between bg-gray-50 p-3 rounded-lg';
                        fileItem.innerHTML = `
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 truncate max-w-xs">${file.name}</div>
                                    <div class="text-xs text-gray-500">${(file.size / 1024).toFixed(1)} KB</div>
                                </div>
                            </div>
                            <button type="button" onclick="removeFile(${index})" class="text-red-500 hover:text-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        `;
                        fileList.appendChild(fileItem);
                    });
                }
            });

            // Удаление файла
            window.removeFile = function (index) {
                const dt = new DataTransfer();
                const files = fileInput.files;

                for (let i = 0; i < files.length; i++) {
                    if (i !== index) {
                        dt.items.add(files[i]);
                    }
                }

                fileInput.files = dt.files;
                fileInput.dispatchEvent(new Event('change'));
            };

            // Отправка формы
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const formData = new FormData();
                formData.append('customer[name]', form.name.value);
                formData.append('customer[phone]', form.phone.value);
                formData.append('customer[email]', form.email.value);
                formData.append('subject', form.subject.value);
                formData.append('text', form.text.value);

                // Добавляем файлы
                if (fileInput.files.length > 0) {
                    for (let i = 0; i < fileInput.files.length; i++) {
                        formData.append('files[]', fileInput.files[i]);
                    }
                }

                // Показываем индикатор загрузки
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 text-white mx-auto" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                    </svg>
                `;
                submitBtn.disabled = true;

                try {
                    const response = await fetch('/api/tickets', {
                        method: 'POST',
                        body: formData,
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showMessage('success', result.message);
                        form.reset();
                        fileList.innerHTML = '';
                    } else {
                        showMessage('error', result.message || 'Ошибка при отправке формы');
                    }
                } catch (error) {
                    showMessage('error', 'Ошибка сети. Попробуйте позже.');
                } finally {
                    submitBtn.innerHTML = 'Отправить заявку';
                    submitBtn.disabled = false;
                }
            });

            // Функция отображения сообщений
            function showMessage(type, text) {
                messageDiv.className = `mx-6 mt-6 p-4 rounded-lg fade-in ${type === 'success'
                        ? 'bg-green-50 text-green-800 border border-green-200'
                        : 'bg-red-50 text-red-800 border border-red-200'
                    }`;
                messageDiv.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="${type === 'success'
                        ? 'M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z'
                        : 'M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z'
                    }" clip-rule="evenodd"/>
                        </svg>
                        <span>${text}</span>
                    </div>
                `;
                messageDiv.classList.remove('hidden');

                setTimeout(() => {
                    messageDiv.classList.add('hidden');
                }, 5000);
            }
        });
    </script>
</body>

</html>
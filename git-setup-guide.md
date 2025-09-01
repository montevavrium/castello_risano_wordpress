# Пошаговая инструкция: Настройка Git для WordPress сайта на Hostinger

## Предварительные требования
- Аккаунт на Hostinger с WordPress сайтом
- Установленный Git на локальном компьютере
- IDE Trae
- Базовые знания работы с терминалом

## Шаг 1: Подготовка локальной среды

### 1.1 Создание локальной папки проекта
```bash
mkdir castello-risano-wp
cd castello-risano-wp
```

### 1.2 Инициализация Git репозитория
```bash
git init
```

### 1.3 Создание .gitignore файла
Создайте файл `.gitignore` со следующим содержимым:
```
# WordPress core files
wp-admin/
wp-includes/
wp-content/index.php
wp-content/languages/
wp-content/upgrade/

# WordPress config
wp-config.php

# Database dumps
*.sql
*.sql.gz

# Log files
*.log
error_log
debug.log

# Cache files
wp-content/cache/
wp-content/w3tc-config/

# Backup files
*.bak
*.backup

# OS generated files
.DS_Store
.DS_Store?
._*
.Spotlight-V100
.Trashes
ehthumbs.db
Thumbs.db

# IDE files
.vscode/
.idea/
*.swp
*.swo

# Node modules (если используете)
node_modules/
npm-debug.log*
yarn-debug.log*
yarn-error.log*

# Uploads (опционально)
wp-content/uploads/
```

## Шаг 2: Настройка доступа к Hostinger

### 2.1 Включение SSH доступа в Hostinger
1. Войдите в панель управления Hostinger
2. Перейдите в раздел "Advanced" → "SSH Access"
3. Включите SSH доступ
4. Запишите данные для подключения:
   - Hostname (обычно вида: ssh.hostinger.com)
   - Port (обычно 65002)
   - Username
   - Password

### 2.2 Настройка SSH ключей (рекомендуется)
```bash
# Генерация SSH ключа
ssh-keygen -t rsa -b 4096 -C "your-email@example.com"

# Копирование публичного ключа
cat ~/.ssh/id_rsa.pub
```

Добавьте публичный ключ в Hostinger:
1. В панели Hostinger перейдите в "SSH Access"
2. Добавьте содержимое файла `id_rsa.pub` в поле "Public Key"

## Шаг 3: Скачивание файлов сайта

### 3.1 Подключение к серверу через SSH
```bash
ssh username@ssh.hostinger.com -p 65002
```

### 3.2 Поиск папки с сайтом
```bash
# Обычно сайт находится в:
cd public_html
# или
cd domains/castello-risano.com/public_html
```

### 3.3 Создание архива сайта на сервере
```bash
# Создание архива (исключая ненужные файлы)
tar --exclude='wp-content/cache' --exclude='wp-content/uploads' -czf site-backup.tar.gz .
```

### 3.4 Скачивание архива на локальный компьютер
```bash
# В новом терминале на локальном компьютере
scp -P 65002 username@ssh.hostinger.com:public_html/site-backup.tar.gz .

# Распаковка
tar -xzf site-backup.tar.gz
```

## Шаг 4: Настройка локальной разработки

### 4.1 Создание локального wp-config.php
Создайте копию `wp-config.php` для локальной разработки:
```php
<?php
// Локальные настройки базы данных
define('DB_NAME', 'local_database');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

// Отладка для разработки
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

// Остальные настройки...
```

### 4.2 Настройка локального сервера
Выберите один из вариантов:

**Вариант A: XAMPP/MAMP**
1. Установите XAMPP или MAMP
2. Поместите файлы в папку htdocs/castello-risano
3. Создайте локальную базу данных

**Вариант B: Local by Flywheel**
1. Установите Local by Flywheel
2. Создайте новый сайт
3. Замените файлы на скачанные

## Шаг 5: Инициализация Git репозитория

### 5.1 Добавление файлов в Git
```bash
# Добавление всех файлов
git add .

# Первый коммит
git commit -m "Initial commit: WordPress site setup"
```

### 5.2 Создание удаленного репозитория
Выберите платформу:
- GitHub
- GitLab
- Bitbucket

Создайте новый приватный репозиторий.

### 5.3 Подключение удаленного репозитория
```bash
# Добавление remote origin
git remote add origin https://github.com/username/castello-risano.git

# Отправка кода
git branch -M main
git push -u origin main
```

## Шаг 6: Настройка рабочего процесса

### 6.1 Создание веток для разработки
```bash
# Создание ветки для разработки
git checkout -b development

# Создание ветки для конкретной функции
git checkout -b feature/new-design
```

### 6.2 Настройка автоматического деплоя (опционально)
Создайте файл `.github/workflows/deploy.yml` для автоматического деплоя:
```yaml
name: Deploy to Hostinger

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Deploy to server
      uses: appleboy/ssh-action@v0.1.5
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        password: ${{ secrets.PASSWORD }}
        port: ${{ secrets.PORT }}
        script: |
          cd public_html
          git pull origin main
```

## Шаг 7: Настройка IDE Trae

### 7.1 Открытие проекта в Trae
1. Запустите Trae IDE
2. Откройте папку с проектом
3. Настройте интеграцию с Git

### 7.2 Полезные расширения для WordPress
- PHP Intelephense
- WordPress Snippets
- GitLens
- WordPress Hooks IntelliSense

## Шаг 8: Рабочий процесс разработки

### 8.1 Ежедневный workflow
```bash
# 1. Получение последних изменений
git pull origin main

# 2. Создание новой ветки для задачи
git checkout -b feature/task-name

# 3. Внесение изменений
# ... работа с кодом ...

# 4. Коммит изменений
git add .
git commit -m "Add: описание изменений"

# 5. Отправка ветки
git push origin feature/task-name

# 6. Создание Pull Request
# Через веб-интерфейс GitHub/GitLab

# 7. После одобрения - слияние с main
git checkout main
git pull origin main
git branch -d feature/task-name
```

### 8.2 Деплой на продакшн
```bash
# Подключение к серверу
ssh username@ssh.hostinger.com -p 65002

# Переход в папку сайта
cd public_html

# Если Git еще не настроен на сервере:
git init
git remote add origin https://github.com/username/castello-risano.git

# Получение изменений
git pull origin main

# Установка правильных прав доступа
chmod -R 755 .
chmod -R 644 *.php
```

## Шаг 9: Безопасность и бэкапы

### 9.1 Настройка .htaccess для безопасности
Добавьте в `.htaccess`:
```apache
# Защита от доступа к Git файлам
<Files ~ "^\.git">
    Order allow,deny
    Deny from all
</Files>

# Защита wp-config.php
<files wp-config.php>
    order allow,deny
    deny from all
</files>
```

### 9.2 Регулярные бэкапы
```bash
# Скрипт для бэкапа базы данных
mysqldump -u username -p database_name > backup_$(date +%Y%m%d).sql

# Бэкап файлов
tar -czf files_backup_$(date +%Y%m%d).tar.gz public_html/
```

## Шаг 10: Полезные команды Git

```bash
# Просмотр статуса
git status

# Просмотр истории
git log --oneline

# Отмена изменений
git checkout -- filename.php

# Просмотр различий
git diff

# Создание тега для релиза
git tag -a v1.0 -m "Release version 1.0"
git push origin v1.0

# Просмотр веток
git branch -a

# Переключение между ветками
git checkout branch-name

# Слияние веток
git merge feature-branch
```

## Возможные проблемы и решения

### Проблема: Большой размер репозитория
**Решение:** Используйте Git LFS для больших файлов
```bash
git lfs install
git lfs track "*.zip"
git lfs track "*.pdf"
git add .gitattributes
```

### Проблема: Конфликты при слиянии
**Решение:** 
```bash
# Просмотр конфликтов
git status

# Ручное разрешение конфликтов в файлах
# Затем:
git add .
git commit -m "Resolve merge conflicts"
```

### Проблема: Случайно добавили чувствительные данные
**Решение:**
```bash
# Удаление файла из истории
git filter-branch --force --index-filter 'git rm --cached --ignore-unmatch wp-config.php' --prune-empty --tag-name-filter cat -- --all
```

## Заключение

Теперь у вас настроена полноценная среда разработки с Git для WordPress сайта на Hostinger. Помните:

1. **Всегда** работайте в отдельных ветках
2. **Никогда** не коммитьте wp-config.php с реальными данными
3. **Регулярно** делайте бэкапы
4. **Тестируйте** изменения локально перед деплоем
5. **Используйте** осмысленные сообщения коммитов

Удачной разработки! 🚀
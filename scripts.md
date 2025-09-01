# Полезные скрипты для автоматизации

## 🔧 Bash скрипты для ускорения работы

### 1. Скрипт для быстрого деплоя

Создайте файл `deploy.sh`:
```bash
#!/bin/bash

# Цвета для вывода
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo -e "${YELLOW}🚀 Начинаем деплой на Hostinger...${NC}"

# Проверяем, что мы на main ветке
CURRENT_BRANCH=$(git branch --show-current)
if [ "$CURRENT_BRANCH" != "main" ]; then
    echo -e "${RED}❌ Ошибка: Вы не на main ветке!${NC}"
    echo -e "${YELLOW}Текущая ветка: $CURRENT_BRANCH${NC}"
    echo -e "${YELLOW}Переключитесь на main: git checkout main${NC}"
    exit 1
fi

# Получаем последние изменения
echo -e "${YELLOW}📥 Получаем последние изменения...${NC}"
git pull origin main

# Подключаемся к серверу и деплоим
echo -e "${YELLOW}🔄 Подключаемся к серверу...${NC}"
ssh username@ssh.hostinger.com -p 65002 << 'EOF'
    cd public_html
    
    # Создаем бэкап
    echo "📦 Создаем бэкап..."
    tar -czf backup_$(date +%Y%m%d_%H%M%S).tar.gz --exclude='backup_*.tar.gz' .
    
    # Обновляем код
    echo "🔄 Обновляем код..."
    git pull origin main
    
    # Устанавливаем права доступа
    echo "🔐 Устанавливаем права доступа..."
    find . -type f -exec chmod 644 {} \;
    find . -type d -exec chmod 755 {} \;
    
    echo "✅ Деплой завершен!"
EOF

echo -e "${GREEN}✅ Деплой успешно завершен!${NC}"
echo -e "${YELLOW}🌐 Проверьте сайт: https://castello-risano.com${NC}"
```

### 2. Скрипт для создания новой ветки

Создайте файл `new-feature.sh`:
```bash
#!/bin/bash

# Цвета
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

if [ -z "$1" ]; then
    echo -e "${YELLOW}Использование: ./new-feature.sh название-функции${NC}"
    echo -e "${YELLOW}Пример: ./new-feature.sh contact-form${NC}"
    exit 1
fi

FEATURE_NAME=$1
BRANCH_NAME="feature/$FEATURE_NAME"

echo -e "${YELLOW}🌿 Создаем новую ветку: $BRANCH_NAME${NC}"

# Переключаемся на main и обновляем
git checkout main
git pull origin main

# Создаем новую ветку
git checkout -b $BRANCH_NAME

echo -e "${GREEN}✅ Ветка $BRANCH_NAME создана и активна!${NC}"
echo -e "${YELLOW}Теперь можете начинать разработку.${NC}"
echo -e "${YELLOW}После завершения используйте: git push origin $BRANCH_NAME${NC}"
```

### 3. Скрипт для бэкапа

Создайте файл `backup.sh`:
```bash
#!/bin/bash

# Цвета
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

BACKUP_DIR="backups"
DATE=$(date +%Y%m%d_%H%M%S)

echo -e "${YELLOW}💾 Создаем бэкап...${NC}"

# Создаем папку для бэкапов
mkdir -p $BACKUP_DIR

# Бэкап файлов с сервера
echo -e "${YELLOW}📁 Скачиваем файлы с сервера...${NC}"
scp -P 65002 -r username@ssh.hostinger.com:public_html/ $BACKUP_DIR/files_$DATE/

# Бэкап базы данных
echo -e "${YELLOW}🗄️ Создаем бэкап базы данных...${NC}"
ssh username@ssh.hostinger.com -p 65002 << EOF
    mysqldump -u db_username -p db_name > backup_db_$DATE.sql
EOF

# Скачиваем бэкап БД
scp -P 65002 username@ssh.hostinger.com:backup_db_$DATE.sql $BACKUP_DIR/

# Удаляем временный файл с сервера
ssh username@ssh.hostinger.com -p 65002 "rm backup_db_$DATE.sql"

echo -e "${GREEN}✅ Бэкап создан в папке $BACKUP_DIR${NC}"
echo -e "${YELLOW}📁 Файлы: $BACKUP_DIR/files_$DATE/${NC}"
echo -e "${YELLOW}🗄️ База данных: $BACKUP_DIR/backup_db_$DATE.sql${NC}"
```

## 📝 Алиасы для .bashrc/.zshrc

Добавьте эти алиасы в ваш файл `.bashrc` или `.zshrc`:

```bash
# Git алиасы для WordPress разработки
alias gs='git status'
alias ga='git add .'
alias gc='git commit -m'
alias gp='git push'
alias gl='git log --oneline'
alias gco='git checkout'
alias gb='git branch'
alias gm='git merge'

# Быстрые команды для проекта
alias cdrisano='cd /path/to/your/castello-risano'
alias risano-deploy='./deploy.sh'
alias risano-backup='./backup.sh'

# SSH подключение к Hostinger
alias hostinger='ssh username@ssh.hostinger.com -p 65002'

# Локальный сервер (для XAMPP/MAMP)
alias start-local='sudo /Applications/XAMPP/xamppfiles/xampp start'
alias stop-local='sudo /Applications/XAMPP/xamppfiles/xampp stop'
```

## 🔄 Git hooks

### Pre-commit hook

Создайте файл `.git/hooks/pre-commit`:
```bash
#!/bin/bash

# Проверяем, что wp-config.php не добавлен в коммит
if git diff --cached --name-only | grep -q "wp-config.php"; then
    echo "❌ Ошибка: wp-config.php не должен быть в коммите!"
    echo "Удалите его из staging: git reset HEAD wp-config.php"
    exit 1
fi

# Проверяем, что есть сообщение коммита
if [ -z "$(git diff --cached --name-only)" ]; then
    echo "❌ Нет файлов для коммита"
    exit 1
fi

echo "✅ Pre-commit проверки пройдены"
```

Сделайте файл исполняемым:
```bash
chmod +x .git/hooks/pre-commit
```

## 📱 Мобильные команды (для работы с телефона)

Если нужно быстро что-то исправить с телефона:

### Через GitHub Mobile
1. Откройте GitHub приложение
2. Найдите файл для редактирования
3. Нажмите на карандаш
4. Внесите изменения
5. Создайте коммит

### Через Termux (Android)
```bash
# Установка Git в Termux
pkg install git openssh

# Клонирование репозитория
git clone https://github.com/username/castello-risano.git

# Быстрое исправление
cd castello-risano
nano wp-content/themes/your-theme/style.css
git add .
git commit -m "Fix: mobile CSS issue"
git push origin main
```

## 🔍 Мониторинг и логи

### Скрипт для проверки статуса сайта

Создайте файл `check-site.sh`:
```bash
#!/bin/bash

URL="https://castello-risano.com"
STATUS=$(curl -o /dev/null -s -w "%{http_code}" $URL)

if [ $STATUS -eq 200 ]; then
    echo "✅ Сайт работает нормально (HTTP $STATUS)"
else
    echo "❌ Проблема с сайтом (HTTP $STATUS)"
    # Отправка уведомления (опционально)
    # curl -X POST -H 'Content-type: application/json' --data '{"text":"Сайт castello-risano.com недоступен!"}' YOUR_SLACK_WEBHOOK_URL
fi
```

### Просмотр логов ошибок
```bash
# Подключение к серверу и просмотр логов
ssh username@ssh.hostinger.com -p 65002
tail -f public_html/error_log

# Или просмотр последних 50 строк
tail -n 50 public_html/error_log
```

## 🚀 Автоматизация с помощью cron

### Ежедневный бэкап (на сервере)
Добавьте в crontab на сервере:
```bash
# Редактирование crontab
crontab -e

# Добавьте строку для ежедневного бэкапа в 2:00
0 2 * * * cd /home/username/public_html && tar -czf ../backups/daily_backup_$(date +\%Y\%m\%d).tar.gz .
```

### Проверка статуса сайта каждые 5 минут
```bash
# На локальном компьютере
*/5 * * * * /path/to/your/check-site.sh
```

---

**Примечание:** Не забудьте сделать все скрипты исполняемыми:
```bash
chmod +x deploy.sh new-feature.sh backup.sh check-site.sh
```

И замените `username`, `db_username`, `db_name` на ваши реальные данные! 🔐
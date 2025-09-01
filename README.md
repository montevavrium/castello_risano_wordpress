# Castello Risano - WordPress Development Setup

🏰 Репозиторий для разработки сайта [Castello Risano](https://castello-risano.com) - уютного retreat-центра в Черногории.

## 📁 Структура проекта

```
risano/
├── README.md                    # Этот файл
├── git-setup-guide.md          # 📖 Полная пошаговая инструкция
├── quick-commands.md            # ⚡ Быстрые команды и чек-лист
├── .gitignore                   # 🚫 Файлы для игнорирования Git
├── github-actions-deploy.yml    # 🚀 Автоматический деплой
└── wp-content/                  # WordPress файлы (после настройки)
    ├── themes/
    └── plugins/
```

## 🚀 Быстрый старт

### Для новичков
1. Откройте файл [`git-setup-guide.md`](./git-setup-guide.md)
2. Следуйте пошаговой инструкции
3. Используйте [`quick-commands.md`](./quick-commands.md) для ежедневной работы

### Для опытных разработчиков
```bash
# Клонирование репозитория
git clone https://github.com/username/castello-risano.git
cd castello-risano

# Создание ветки для разработки
git checkout -b feature/task-name

# После изменений
git add .
git commit -m "Описание изменений"
git push origin feature/task-name
```

## 📚 Документация

| Файл | Описание |
|------|----------|
| [`git-setup-guide.md`](./git-setup-guide.md) | 📖 Полная инструкция по настройке Git для WordPress на Hostinger |
| [`quick-commands.md`](./quick-commands.md) | ⚡ Быстрые команды, чек-лист и полезные ссылки |
| [`.gitignore`](./.gitignore) | 🚫 Настроенный файл исключений для WordPress |
| [`github-actions-deploy.yml`](./github-actions-deploy.yml) | 🚀 Шаблон для автоматического деплоя |

## 🛠 Технологии

- **CMS:** WordPress
- **Хостинг:** Hostinger (shared hosting)
- **Версионирование:** Git + GitHub/GitLab
- **IDE:** Trae
- **Деплой:** SSH + GitHub Actions (опционально)

## 🌐 О проекте

Castello Risano - это retreat-центр в Черногории, предлагающий:
- 🏠 5 элегантных апартаментов с видом на море
- 🧘 Пространство для йоги и медитации
- 🏊 Бассейн с подогревом
- 🍷 Дегустации вин
- 🌄 Потрясающие виды на Которский залив

## 🔧 Рабочий процесс

### Ветки
- `main` - продакшн версия
- `development` - ветка разработки
- `feature/*` - ветки для новых функций
- `hotfix/*` - ветки для срочных исправлений

### Правила коммитов
```
Add: новая функциональность
Fix: исправление бага
Update: обновление существующей функции
Style: изменения стилей
Docs: обновление документации
```

## 🆘 Помощь

Если возникли проблемы:
1. Проверьте [`quick-commands.md`](./quick-commands.md) - раздел "Экстренные команды"
2. Изучите полную инструкцию в [`git-setup-guide.md`](./git-setup-guide.md)
3. Проверьте статус Git: `git status`
4. Посмотрите логи: `git log --oneline`

## 📞 Контакты

- **Сайт:** [castello-risano.com](https://castello-risano.com)
- **Техническая поддержка:** Создайте Issue в этом репозитории

---

**Удачной разработки!** 🚀✨

> Помните: всегда тестируйте изменения локально перед деплоем на продакшн!
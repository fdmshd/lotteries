Lotteries
=====================
Для запуска требуется docker

Клонируйте проект

Перейдите в папку deploy:
```bash
cd deploy
```

Сгенерируйте .env файл из примера:
```bash
make env
```

Сгенерируйте ключ шифрования командой
```bash
make key
```

Вставьте полученный ключ в сгенерированный .env файл. Например:
```
APP_KEY=188a8b8eb1da4e0fc8c20067184eac47
```

Запустите приложение:
```bash
make up
```

Выполните миграции
```bash
make migrate
```

Заполните базу
```bash
make dbseed
```
**Радоваться**


Настройки:
```
DB_DATABASE=homestead //название базы данных
DB_USERNAME=homestead //имя пользователя бд
DB_PASSWORD=secret //пароль дб

JWT_SECRET=changeme //ключ JWT
```

Для остановки приложения:
```bash
make down
```

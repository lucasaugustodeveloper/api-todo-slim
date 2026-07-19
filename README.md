# API TODO SLIM

**Root Path:** `api-todo-slim`

```
├── 📁 Routes
│   ├── 🐘 root.php
│   ├── 🐘 todos.php
├── 📁 app
│   ├── 🐘 app.php
│   ├── 🐘 container.php
│   ├── 🐘 dependencies.php
│   ├── 🐘 dependencies.testing.php
│   ├── 🐘 middleware.php
│   ├── 🐘 routes.php
│   └── 🐘 settings.php
├── 📁 config
│   └── ⚙️ .keep
├── 📁 docker
│   └── 📁 apache
│       └── ⚙️ 000-default.conf
├── 📁 public
│   ├── ⚙️ .htaccess
│   └── 🐘 index.php
├── 📁 src
│   ├── 📁 Contracts
│   │   └── 📁 Repository
│   │       └── 🐘 TodoRepositoryInterface.php
│   ├── 📁 Controllers
│   │   └── 🐘 TodoController.php
│   ├── 📁 DTO
│   │   ├── 🐘 CreateTodoDTO.php
│   │   └── 🐘 UpdateTodoDTO.php
│   ├── 📁 Exceptions
│   │   └── 🐘 TodoNotFoundException.php
│   ├── 📁 Models
│   │   └── 🐘 Todo.php
│   ├── 📁 Repositories
│   │   ├── 🐘 MemoryTodoRepository.php
│   │   └── 🐘 PostgresTodoRepository.php
│   └── 📁 Services
│       └── 🐘 TodoService.php
├── 📁 tests
│   ├── 📁 Fakes
│   │   └── 🐘 FakeTodoRepository.php
│   ├── 📁 Integration
│   │   └── 🐘 TodoRoutesTest.php
│   ├── 📁 Unit
│   │   └── 🐘 ExampleTest.php
│   ├── 🐘 TestCase.php
│   └── 🐘 bootstrap.php
├── 📁 vendor
├── ⚙️ .editorconfig
├── ⚙️ .env.example
├── ⚙️ .gitignore
├── 🐳 Dockerfile
├── 📝 README.md
├── 📄 AGENTS.md
├── ⚙️ composer.json
├── ⚙️ docker-compose.yml
└── ⚙️ phpunit.xml
```

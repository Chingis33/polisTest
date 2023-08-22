Инициализация обьекта
$api = new JsonPlaceholderApi();

Список пользователей
$users = $api->getUsers();

Посты пользователя с id = 1
$userPosts = $api->getUserPosts(1);

Список заданий
$todo = $api->getTasks();

Создание поста юзером с id = 1
$newPost = $api->addPost("New Post", "This is a new post.", 1);

Редактирование поста с id = 1
$editPost = $api->editPost(1, "Updated Post", "This post has been updated.");

Удаление поста с id = 1
$deletePost = $api->deletePost(1);

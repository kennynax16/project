<template>
    <div class="container mt-4">
        <!-- Форма для добавления поста -->
        <form @submit.prevent="submitForm" class="mb-4 p-3 border rounded bg-light">
            <h3 class="mb-3">Создать пост</h3>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" v-model="form.title" id="title" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" v-model="form.description" id="description" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="text" v-model="form.photo" id="photo" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-success">Создать</button>
        </form>

        <!-- Таблица с постами -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th colspan="2" class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="post in posts" :key="post.id">
                    <tr>
                        <td>{{ post.id }}</td>
                        <td>{{ post.title }}</td>
                        <td>{{ post.description }}</td>
                        <td>{{ post.photo }}</td>
                        <td>
                            <button @click="deletePost(post.id)" class="btn btn-danger btn-sm">Удалить</button>
                        </td>
                        <td>
                            <button @click="toggleEdit(post)" class="btn btn-primary btn-sm">Изменить</button>
                        </td>
                    </tr>

                    <!-- Редактирование поста -->
                    <tr v-if="editingPostId === post.id">
                        <td colspan="6">
                            <div class="p-3 border rounded bg-light">
                                <h5>Редактирование поста</h5>
                                <div class="mb-2">
                                    <label class="form-label">Title</label>
                                    <input type="text" v-model="editedPost.title" class="form-control" />
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Description</label>
                                    <input type="text" v-model="editedPost.description" class="form-control" />
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Photo</label>
                                    <input type="text" v-model="editedPost.photo" class="form-control" />
                                </div>
                                <button @click="updatePost" class="btn btn-success btn-sm">Обновить</button>
                            </div>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    name: 'App',

    setup() {
        const posts = ref([]);
        const form = ref({
            title: '',
            description: '',
            photo: ''
        });

        // Редактируемая запись
        const editingPostId = ref(null);
        const editedPost = ref({
            id: null,
            title: '',
            description: '',
            photo: ''
        });

        // Получение постов
        const getPosts = async () => {
            try {
                const response = await axios.get('/api/posts');
                posts.value = response.data;
            } catch (error) {
                console.error('Ошибка при загрузке данных', error);
            }
        };

        // Создание поста
        const submitForm = async () => {
            try {
                const response = await axios.post('/api/posts', form.value);

                posts.value.push(response.data);
                form.value = { title: '', description: '', photo: '' };
            } catch (error) {
                console.error('Ошибка при создании поста', error);
            }
        };

        // Удаление поста
        const deletePost = async (postId) => {
            try {
                await axios.delete(`/api/posts/${postId}`);
                posts.value = posts.value.filter(post => post.id !== postId);
            } catch (error) {
                console.error('Ошибка при удалении поста:', error);
            }
        };

        // Обновление поста
        const updatePost = async () => {
            try {
                console.log('Отправляемые данные:', editedPost.value);

                const response = await axios.put(`/api/posts/${editedPost.value.id}`, {
                    title: editedPost.value.title,
                    description: editedPost.value.description,
                    photo: editedPost.value.photo
                });

                console.log('Ответ сервера:', response.data);

                // Если сервер возвращает обновленные данные
                if (response.data && response.data.id) {
                    posts.value = posts.value.map(post =>
                        post.id === editedPost.value.id ? response.data : post
                    );
                } else {
                    console.warn('Ответ не содержит обновленный пост, обновляем вручную');
                    posts.value = posts.value.map(post =>
                        post.id === editedPost.value.id ? { ...post, ...editedPost.value } : post
                    );
                }

                editingPostId.value = null;
            } catch (error) {
                console.error('Ошибка при обновлении поста:', error.response?.data || error);
            }
        };

        // Включение режима редактирования
        const toggleEdit = (post) => {
            if (editingPostId.value === post.id) {
                editingPostId.value = null;
            } else {
                editingPostId.value = post.id;
                editedPost.value = { ...post }; // Копируем объект, чтобы не изменять сразу в списке
            }
        };

        onMounted(() => {
            getPosts();
        });

        return {
            posts,
            form,
            submitForm,
            deletePost,
            updatePost,
            toggleEdit,
            editedPost,
            editingPostId
        };
    },
};
</script>

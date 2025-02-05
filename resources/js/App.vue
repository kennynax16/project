<template>
    <div>
        <h1>Hello, Laravel + Vue 3!</h1>
        <p>{{ message }}</p>
    </div>
</template>

<script>
export default {
    name: 'App',
    data() {
        return {
            message: 'Это пример компонента Vue 3, интегрированного с Laravel 9 и Vite.'
        };
    }
};
</script>

<style scoped>
h1 {
    color: #3490dc;
}
</style>

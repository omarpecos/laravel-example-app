<template>
    <div class="users-list">
        <div v-for="user in users" :key="user.id" class="user-row">
            {{ user.id }} - {{ user.email }} - {{ user.name }}
        </div>
    </div>
</template>

<script>
export default {
    props: ["users"],
};
</script>

<style>
.users-list {
    margin: 20px auto;
    width: 60%;
}
.users-list .user-row {
    padding: 5px;
    border: 1px solid plum;
}
</style>

<template>
    <div id="users">
        <h1>Users</h1>
        <button @click="createUser" class="btn btn-primary">
            <font-awesome-icon :icon="['fas', 'user-plus']" />
        </button>
        <table>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Password</td>
                    <td>Created at</td>
                    <td>Updated at</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.password }}</td>
                    <td>{{ user.created_at }}</td>
                    <td>{{ user.updated_at }}</td>
                    <td>
                        <button @click="updateUser(user.id)" class="btn btn-warning">
                            <font-awesome-icon :icon="['fas', 'user-pen']" />
                        </button>
                    </td>
                    <td>
                        <button @click="deleteUserById(user.id)" class="btn btn-danger">
                            <font-awesome-icon :icon="['fas', 'user-slash']" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import useUsers from '../composables/Users.js';
import { onMounted } from 'vue';

export default {
    name: 'Users',
    setup() {
        const { user, users, errors, createUser, readUsers, readUser, updateUser, deleteUser } = useUsers();

        onMounted(() => {
            readUsers();
        });

        const deleteUserById = async (id) => {
            try {
                if (!confirm('Are you sure?')) {
                    return;
                }
                await deleteUser(id);
                await readUsers();
            } catch (error) {
                console.error(error);
            }
        }

        return {
            user, users, errors, createUser, readUsers, readUser, updateUser, deleteUser, deleteUserById
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
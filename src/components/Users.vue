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
                    <td>Actions</td>
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
                        &nbsp;
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
#users {
  margin: 20px;
  /* font-family: Arial, sans-serif; */
}

h1 {
  /* font-size: 28px; */
  text-align: center;
  margin-bottom: 20px;
}

table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

thead {
  background-color: #343a40;
  color: #fff;
}

td {
  padding: 10px;
  border: 1px solid #dee2e6;
}

tbody tr:nth-child(even) {
  background-color: #f8f9fa;
}

/* .btn {
  border: none;
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
}

.btn-warning {
  background-color: #ffc107;
  color: #212529;
}

.btn-danger {
  background-color: #dc3545;
  color: #fff;
}

.font-awesome-icon {
  margin-right: 5px;
} */
</style>
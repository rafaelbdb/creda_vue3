// import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import http from '../http-common';

const API_URL = '/api/users';

const useUsers = () => {
    const user = ref(null);
    const users = ref([]);
    const errors = ref([]);
    const router = useRouter();

    const createUser = async (newUserData) => {
        errors.value = [];
        try {
            const response = await http.post(API_URL, newUserData);
            console.log(response.data);
            router.push('/login');
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to create user'
            ];
        }
    };

    const readUsers = async () => {
        errors.value = [];
        try {
            const response = await http.get(API_URL);
            users.value = response.data;
            console.log(users.value);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to retrieve users'
            ];
        }
    };

    const readUser = async (id) => {
        errors.value = [];
        try {
            const response = await http.get(API_URL + `/${id}`);
            user.value = response.data;
            console.log(response.data);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to retrieve user'
            ];
        }
    };

    const updateUser = async (id, updatedUserData) => {
        errors.value = [];
        try {
            const response = await http.put(API_URL + `/${id}`, updatedUserData);
            user.value = response.data;
            console.log(response.data);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to update user'
            ];
        }
    };

    const deleteUser = async (id) => {
        errors.value = [];
        try {
            await http.delete(API_URL + `/${id}`);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to delete user'
            ];
        }
    };

    return {
        user,
        users,
        errors,
        createUser,
        readUsers,
        readUser,
        updateUser,
        deleteUser
    };
};

export default useUsers;

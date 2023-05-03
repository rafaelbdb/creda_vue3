import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
// import http from '../http-common';

const API_URL = 'http://creda_vue3/api/categories';

const useCategories = () => {
    const category = ref(null);
    const categories = ref([]);
    const errors = ref([]);
    const router = useRouter();

    const createCategory = async (newCategoryData) => {
        errors.value = [];
        try {
            const response = await axios.post(API_URL, newCategoryData);
            console.log(response.data);
            router.push('/categories');
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to create category'
            ];
        }
    };

    const readCategories = async () => {
        errors.value = [];
        try {
            const response = await axios.get(API_URL);
            categories.value = response.data;
            console.log(categories.value);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to retrieve categories'
            ];
        }
    };

    const readCategory = async (id) => {
        errors.value = [];
        try {
            const response = await axios.get(API_URL + `/${id}`);
            category.value = response.data;
            console.log(response.data);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to retrieve category'
            ];
        }
    };

    const updateCategory = async (id, updatedCategoryData) => {
        errors.value = [];
        try {
            const response = await axios.put(API_URL + `/${id}`, updatedCategoryData);
            category.value = response.data;
            console.log(response.data);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to update category'
            ];
        }
    };

    const deleteCategory = async (id) => {
        errors.value = [];
        try {
            await axios.delete(API_URL + `/${id}`);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to delete category'
            ];
        }
    };

    return {
        category,
        categories,
        errors,
        createCategory,
        readCategories,
        readCategory,
        updateCategory,
        deleteCategory
    };
};

export default useCategories;

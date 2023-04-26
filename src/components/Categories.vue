<template>
    <div id="categories">
        <h1>Categories</h1>
        <button @click="createCagetory" class="btn btn-primary">
            <font-awesome-icon :icon="['fas', 'square-plus']" />
        </button>
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Type</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.name }}</td>
                    <td>{{ category.type }}</td>
                    <td>
                        <button @click="updateCagetory(category.id)" class="btn btn-warning">
                            <font-awesome-icon :icon="['fas', 'square-pen']" />
                        </button>
                        &nbsp;
                        <button @click="deleteCagetoryById(category.id)" class="btn btn-danger">
                            <font-awesome-icon :icon="['fas', 'square-minus']" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import useCategories from '../composables/Categories.js';
import { onMounted } from 'vue';

export default {
    name: 'Categories',
    setup() {
        const { category, categories, errors, createCagetory, readCategories, readCagetory, updateCagetory, deleteCagetory } = useCategories();

        onMounted(() => {
            readCategories();
        });

        const deleteCagetoryById = async (id) => {
            try {
                if (!confirm('Are you sure?')) {
                    return;
                }
                await deleteCagetory(id);
                await readCategories();
            } catch (error) {
                console.error(error);
            }
        }

        return {
            category, categories, errors, createCagetory, readCategories, readCagetory, updateCagetory, deleteCagetory, deleteCagetoryById
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#categories {
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
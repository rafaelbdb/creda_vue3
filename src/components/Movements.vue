<template>
    <div id="movements">
        <h1>Movements</h1>
        <button @click="createMovement" class="btn btn-primary">
            <font-awesome-icon :icon="['fas', 'square-plus']" />
        </button>
        <table>
            <thead>
                <tr>
                    <td>Date</td>
                    <td>Type</td>
                    <td>Category id</td>
                    <td>Description</td>
                    <td>Amount</td>
                    <td>Created at</td>
                    <td>Updated at</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="movement in movements" :key="movement.id">
                    <td>{{ movement.date }}</td>
                    <td>{{ movement.type }}</td>
                    <td>{{ movement.category_id }}</td>
                    <td>{{ movement.description }}</td>
                    <td>{{ movement.amount }}</td>
                    <td>{{ movement.created_at }}</td>
                    <td>{{ movement.updated_at }}</td>
                    <td>
                        <button @click="updateMovement(movement.id)" class="btn btn-warning">
                            <font-awesome-icon :icon="['fas', 'square-pen']" />
                        </button>
                        &nbsp;
                        <button @click="deleteMovementById(movement.id)" class="btn btn-danger">
                            <font-awesome-icon :icon="['fas', 'square-minus']" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <p>Balance: R$ {{ balance }}</p>
        <p>Average income: R$ {{ avgIncome }}</p>
        <p>Average expense: R$ {{ avgExpense }}</p>
    </div>
</template>

<script>
import { onMounted } from 'vue';
import useMovements from '../composables/Movements.js';

export default {
    name: 'Movements',
    setup() {
        const { movement, movements, errors, createMovement, readMovements, readMovement, updateMovement, deleteMovement, calculateBalance, calculateAvgIncome, calculateAvgExpense } = useMovements();

        let balance = 0;
        let avgIncome = 0;
        let avgExpense = 0;

        onMounted(() => {
            readMovements().then(() => {
                balance = calculateBalance();
                avgIncome = calculateAvgIncome();
                avgExpense = calculateAvgExpense();
            });
        });

        const deleteMovementById = async (id) => {
            try {
                if (!confirm('Are you sure?')) {
                    return;
                }
                await deleteMovement(id);
                await readMovements();
            } catch (error) {
                console.error(error);
            }
        }

        return {
            avgExpense, avgIncome, balance, movement, movements, errors, createMovement, readMovements, readMovement, updateMovement, deleteMovement, calculateBalance, calculateAvgIncome, calculateAvgExpense, deleteMovementById
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#movements {
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
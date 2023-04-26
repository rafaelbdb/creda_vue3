// import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import http from '../http-common';

const API_URL = '/api/movements';

const useMovements = () => {
    const movement = ref(null);
    const movements = ref([]);
    const initialBalance = ref(null);
    const errors = ref([]);
    const router = useRouter();

    const createMovement = async (newMovementData) => {
        errors.value = [];
        try {
            const response = await http.post(API_URL, newMovementData);
            console.log(response.data);
            router.push('/movements');
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to create movement'
            ];
        }
    };

    const readMovements = async () => {
        errors.value = [];
        try {
            const response = await http.get(API_URL);
            movements.value = response.data;
            console.log(movements.value);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to retrieve movements'
            ];
        }
    };

    const readMovement = async (id) => {
        errors.value = [];
        try {
            const response = await http.get(API_URL + `/${id}`);
            movement.value = response.data;
            console.log(response.data);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to retrieve movement'
            ];
        }
    };

    const updateMovement = async (id, updatedMovementData) => {
        errors.value = [];
        try {
            const response = await http.put(API_URL + `/${id}`, updatedMovementData);
            movement.value = response.data;
            console.log(response.data);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to update movement'
            ];
        }
    };

    const deleteMovement = async (id) => {
        errors.value = [];
        try {
            await http.delete(API_URL + `/${id}`);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to delete movement'
            ];
        }
    };

    const getInitialBalance = async (id) => {
        errors.value = [];
        try {
            const user = await http.get(`/api/users/${id}`);
            return user.data[0].initial_balance || 0;
        } catch (error) {
            console.error(error.message);
            errors.value = error.user.data.errors || [
                'Failed to retrieve initial balance'
            ];
        }
    };

    const calculateBalance = async () => {
        try {
            return await movements.value.reduce((acc, movement) => {
                initialBalance.value = getInitialBalance(movement.user_id);
                console.warn(initialBalance.value);
                return movement.type === 'income'
                    ? acc + parseFloat(movement.amount)
                    : acc - parseFloat(movement.amount);
            }, initialBalance.value);
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to calculate balance'
            ];
        }
    };
    
    const calculateAvgIncome = async () => {
        try {
            return await movements.value.reduce((acc, movement) => {
                return movement.type === 'income'
                    ? acc + parseFloat(movement.amount)
                    : acc;
            }, 0) / movements.value.length;
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to calculate average income'
            ];
        }
    }

    const calculateAvgExpense = async () => { 
        try {
            return await movements.value.reduce((acc, movement) => {
                return movement.type === 'expense'
                    ? acc + parseFloat(movement.amount)
                    : acc;
            }, 0) / movements.value.length;
        } catch (error) {
            console.error(error.message);
            errors.value = error.response.data.errors || [
                'Failed to calculate average expense'
            ];
        }
    }

    return {
        movement,
        movements,
        errors,
        createMovement,
        readMovements,
        readMovement,
        updateMovement,
        deleteMovement,
        calculateBalance,
        calculateAvgIncome,
        calculateAvgExpense,
    };
};

export default useMovements;

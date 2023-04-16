<template>
    <div id="dashboard" ref="dashboard" v-if="userLoggedIn == true">
        <MovementsList :forms="forms" />
        <div id="balance" ref="balance">
            <h2>Balance</h2>
            <p>{{ balance }}</p>
        </div>
        <div id="averageIncome" ref="averageIncome">
            <h2>Average income</h2>
            <p>{{ averageIncome }}</p>
        </div>
        <div id="averageExpense" ref="averageExpense">
            <h2>Average expense</h2>
            <p>{{ averageExpense }}</p>
        </div>
        <CreateMovementForm :forms="forms" />
        <EditMovementForm :forms="forms" />
    </div>
</template>

<script>
import CreateMovementForm from './CreateMovementForm.vue';
import EditMovementForm from './EditMovementForm.vue';
import MovementsList from './MovementsList.vue';

export default {
    name: "Dashboard",
    data() {
        return {
            forms: {
                us: {
                    visible: true
                }
            }
        };
    },
    computed: {
        balance() {
            return this.$store.getters.balance;
        },
        income() {
            return this.$store.getters.income;
        },
        expense() {
            return this.$store.getters.expense;
        },
        averageIncome() {
            return this.$store.getters.averageIncome;
        },
        averageExpense() {
            return this.$store.getters.averageExpense;
        }
    },
    components: { CreateMovementForm, EditMovementForm }
}
</script>

<style scoped>
#dashboard {
    display: none;
}
</style>
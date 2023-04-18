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
        <MovementForm :forms="forms" />
    </div>
</template>

<script>
import MovementForm from './MovementForm.vue';
import MovementsList from './MovementsList.vue';

export default {
    name: 'Dashboard',
    props: ['userLoggedIn', 'forms'],
    computed: {
        balance() {
            return this.$store.getters.balance;
        },
        averageIncome() {
            return this.$store.getters.averageIncome;
        },
        averageExpense() {
            return this.$store.getters.averageExpense;
        }
    },
    components: { MovementsList, MovementForm }
};
</script>

<style scoped>
#dashboard {
    display: none;
}
</style>

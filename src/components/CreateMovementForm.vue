<template>
    <div id="createMovement" ref="createMovement">
        <h3>Create</h3>
        <input type="date" name="date" id="date" ref="date" />
        <input type="text" name="category" id="category" ref="category" placeholder="Category" />
        <input type="text" name="description" id="description" ref="description" placeholder="Description" />
        <input type="number" name="amount" id="amount" ref="amount" placeholder="Amount" />
        <select name="type" id="type" ref="type">
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>
        <input type="submit" value="Create" />
    </div>
</template>

<script>
    export default {
        name: 'CreateMovementForm',
        props: ['forms'],
        methods: {
            showForm(formName, visible = true) {
                this.forms[formName].visible = visible;
            }
        }
    }
</script>

<style scoped>
#createMovement {
    display: none;
}
</style>
<template>
    <div id="editMovement" ref="editMovement">
        <h3>Edit</h3>
        <input type="date" name="date" id="date" ref="date" />
        <input type="text" name="category" id="category" ref="category" placeholder="Category" />
        <input type="text" name="description" id="description" ref="description" placeholder="Description" />
        <input type="number" name="amount" id="amount" ref="amount" placeholder="Amount" />
        <select name="type" id="type" ref="type">
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>
        <input type="submit" value="Edit" />
    </div>
</template>

<script>
    export default {
        name: 'EditMovementForm',
        props: ['forms'],
        methods: {
            showForm(formName, visible = true) {
                this.forms[formName].visible = visible;
            }
        }
    }
</script>

<style scoped>
#editMovement {
    display: none;
}
</style>
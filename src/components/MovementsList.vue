<template>
    <div id="movementsList" ref="movementsList">
        <h2>Movements</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="movement in $store.getters.movements" :key="movement.id">
                    <td>{{ movement.date }}</td>
                    <td>{{ movement.category }}</td>
                    <td>{{ movement.description }}</td>
                    <td>{{ movement.amount }}</td>
                    <td>{{ movement.type }}</td>
                    <td>
                        <button @click="showForm('editMovementForm')">Edit</button>
                        <button @click="showForm('deleteMovementForm')">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: 'MovementsList',
        props: ['forms'],
        methods: {
            showForm(formName, visible = true) {
                this.forms[formName].visible = visible;
            }
        }
    }
</script>

<style scoped>
#movementsList {
    display: none;
}
</style>
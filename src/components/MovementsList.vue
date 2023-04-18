<template>
    <div id="movementsList" ref="movementsList">
        <h2>{{ userName }}'s Movements</h2>
        <button @click="showForm('movement')" :actionType="'createMovement'">
            <font-awesome-icon icon="fa-regular fa-square-plus" />
        </button>
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
                <tr
                    v-for="movement in $store.getters.movements"
                    :key="movement.id"
                >
                    <td>{{ movement.date }}</td>
                    <td>{{ movement.category }}</td>
                    <td>{{ movement.description }}</td>
                    <td>{{ movement.amount }}</td>
                    <td>{{ movement.type }}</td>
                    <td>
                        <button
                            @click="showForm('movement')"
                            :movementId="movement.id"
                            :actionType="'editMovement'"
                        >
                            <font-awesome-icon icon="fa-solid fa-pencil" />
                        </button>
                        <button @click="deleteMovement(movement.id)">
                            <font-awesome-icon icon="fa-solid fa-trash-can" />
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- PAGINATION!! -->
    </div>
</template>

<script>
export default {
    name: 'MovementsList',
    props: ['forms'],
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        },
        deleteMovement(id) {
            console.log('deleteMovement => ' + id);
        }
    }
};
</script>

<style scoped>
#movementsList {
    display: none;
}
</style>

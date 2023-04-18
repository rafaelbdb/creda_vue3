<template>
    <div id="movementForm" ref="movementForm">
        <h3>{{ actionType }}</h3>
        <input
            type="date"
            name="date"
            id="date"
            ref="date"
            required
            v-model="movement.date"
        />
        <input
            type="text"
            name="category"
            id="category"
            ref="category"
            placeholder="Category"
            required
            v-model="movement.category"
        />
        <input
            type="text"
            name="description"
            id="description"
            ref="description"
            placeholder="Description"
            required
            v-model="movement.description"
        />
        <input
            type="number"
            name="amount"
            id="amount"
            ref="amount"
            placeholder="Amount"
            required
            v-model="movement.amount"
        />
        <label for="income" class="toggle">
            <p>Expense&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Income</p>
        </label>
        <input
            type="checkbox"
            id="income"
            class="checkbox"
            value="income"
        />
        <button type="submit" value="{{ actionType }}">
            <font-awesome-icon icon="fa-solid fa-money-bill-transfer" />
        </button>
        <button
            type="button"
            value="Cancel"
            @click="showForm('movement', false)"
        >
            <font-awesome-icon icon="fa-solid fa-ban" />
        </button>
    </div>
</template>

<script>
export default {
    name: 'MovementForm',
    props: ['forms', 'actionType'],
    data() {
        return {
            movement: {
                date: '',
                category: '',
                description: '',
                amount: 0.0,
                type: false
            }
        };
    },
    methods: {
        showForm(formName, visible = true) {
            this.forms[formName].visible = visible;
        }
    }
};
</script>

<style scoped>
#movementForm {
    display: none;
}

/* toggle in label designing */
.toggle {
    position: relative;
    display: inline-block;
    width: 100px;
    height: 52px;
    background-color: red;
    border-radius: 30px;
    border: 2px solid gray;
}

/* After slide changes */
.toggle:after {
    content: '';
    position: absolute;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: gray;
    top: 1px;
    left: 1px;
    transition: all 0.5s;
}

/* Toggle text */
p {
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
}

/* Checkbox checked effect */
.checkbox:checked + .toggle::after {
    left: 8rem;
}

/* Checkbox checked toggle label bg color */
.checkbox:checked + .toggle {
    background-color: green;
}

/* Checkbox vanished */
.checkbox {
    display: none;
}
</style>

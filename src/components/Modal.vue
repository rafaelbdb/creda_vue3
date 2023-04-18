<template>
    <div id="modal" ref="modal">
        <div id="modalContent" ref="modalContent">
            <div id="modalHeader" ref="modalHeader">
                <h2>{{ modal.title }}</h2>
                <button type="button" value="Close" @click="closeModal()">
                    <font-awesome-icon icon="fa-solid fa-times" />
                </button>
            </div>
            <div id="modalBody" ref="modalBody">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',
    props: ['modal'],
    methods: {
        closeModal() {
            this.$emit('closeModal');
        }
    }
};
</script>

<style scoped>
#modal {
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}
#modalContent {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}
#modalHeader {
    display: flex;
    justify-content: space-between;
}
#modalBody {
    margin-top: 20px;
}
</style>

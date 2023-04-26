<template>
    <div id="home">
        <h1>{{ title }}</h1>
        <p>{{ description }}</p>
    </div>
</template>

<script>
export default {
    name: 'Home',
    data() {
        return {
            title: 'Home Page',
            description: 'Welcome! Please login or signup to continue.'
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
#home {
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